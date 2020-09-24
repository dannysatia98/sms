<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tes_CRUD extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('_sk');
    $this->load->model('_kr');
    $this->load->model('_jabatan');
    $this->load->model('_st');
    $this->load->model('_kelas');
    $this->load->model('_mapel');
    $this->load->model('_topik');
    $this->load->model('_t');


    //jika belum login
    if(!$this->session->userdata('kr_jabatan_id')){
      redirect('Auth');
    }

    //jika bukan guru dan sudah login redirect ke home
    if($this->session->userdata('kr_jabatan_id')!=7 && $this->session->userdata('kr_jabatan_id')!=4 && $this->session->userdata('kr_jabatan_id')!=5 && $this->session->userdata('kr_jabatan_id')){
      redirect('Profile');
    }
  }

  public function index(){

    $data['title'] = 'Nilai Harian';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->db->query(
      "SELECT *
      FROM t
      WHERE t_kunci = 1
      ORDER BY t_nama DESC")->result_array();

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('tes_crud/index',$data);
    $this->load->view('templates/footer');

  }

  public function get_kelas(){

    if($this->input->post('id',TRUE)){
      $t_id = $this->input->post('id',TRUE);
      $kr_id = $this->session->userdata('kr_id');

      if($this->session->userdata('kr_jabatan_id')!=4){
        $data = $this->db->query(
          "SELECT DISTINCT kelas_id, kelas_nama
          FROM d_mpl
          LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
          LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
          WHERE kelas_t_id = $t_id AND d_mpl_kr_id = $kr_id
          ORDER BY kelas_nama")->result();
      }
      elseif($this->session->userdata('kr_jabatan_id')==4){
        $data = $this->db->query(
          "SELECT *
          FROM kelas
          WHERE kelas_t_id = $t_id
          ORDER BY kelas_nama")->result();
      }
      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

  }

  public function get_mapel(){

    if($this->input->post('id',TRUE)){
      $kelas_id = $this->input->post('id',TRUE);
      $kr_id = $this->session->userdata('kr_id');

      if($this->session->userdata('kr_jabatan_id')!=4){
        $data = $this->db->query(
          "SELECT DISTINCT mapel_id, mapel_nama, mapel_sing
          FROM d_mpl
          LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
          WHERE d_mpl_kelas_id = $kelas_id AND d_mpl_kr_id = $kr_id
          ORDER BY mapel_nama")->result();
      }
      elseif($this->session->userdata('kr_jabatan_id')==4){
        $data = $this->db->query(
          "SELECT DISTINCT mapel_id, mapel_nama, mapel_sing
          FROM d_mpl
          LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
          WHERE d_mpl_kelas_id = $kelas_id
          ORDER BY mapel_nama")->result();

        //$data = $this->product_model->get_sub_category($category_id)->result();
      }

      echo json_encode($data);

    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

  }

  public function get_topik(){

    if($this->input->post('id',TRUE)){
      $mapel_id = $this->input->post('id',TRUE);
      $kelas_id = $this->input->post('kelas_id',TRUE);

      //temukan jenjang id pada kelas itu
      $jenjang = $this->db->query(
        "SELECT jenj_id
        FROM kelas
        LEFT JOIN jenj ON kelas_jenj_id = jenj_id
        WHERE kelas_id = $kelas_id")->row_array();

      //print_r($jenjang['jenj_id']);

      $jenj_id = $jenjang['jenj_id'];
      $data = $this->db->query(
        "SELECT topik_id, topik_nama, topik_semester, topik_nama_ket
        FROM topik
        LEFT JOIN jenj ON topik_jenj_id = jenj_id
        LEFT JOIN mapel ON topik_mapel_id = mapel_id
        WHERE jenj_id = $jenj_id AND mapel_id = $mapel_id")->result();

      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

  }

  public function input(){

    if(!$this->input->post('topik_id')){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Tes_CRUD');
    }

    //$arr = explode("|",$this->input->post('arr_cog_psy'));
    $topik_id = $this->input->post('topik_id');
    $mapel_id = $this->input->post('mapel_id');
    $kelas_id = $this->input->post('kelas_id');

    $siswacount = $this->db->join('kelas', 'd_s_kelas_id = kelas_id', 'left')->where('d_s_kelas_id',$kelas_id)->from("d_s")->count_all_results();
    if($siswacount == 0){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Tidak ada siswa dikelas, silahkah hubungi kurikulum!</div>');
      redirect('Tes_CRUD');
    }

    $data['title'] = 'Nilai Harian';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //untuk header
    $data['kelas'] = $this->_kelas->find_kelas_nama($kelas_id);
    $data['mapel'] = $this->_mapel->find_mapel_nama($mapel_id);
    $data['topik'] = $this->_topik->find_by_id($topik_id);

    //untuk tabel
    $data['kelas_id'] = $kelas_id;
    $data['mapel_id'] = $mapel_id;
    $data['topik_id'] = $topik_id;


    if($this->input->post('cek_agama') == 1){
      $_gb = "sis_agama_id,";
    }else{
      $_gb = "";
    }

    $data['cek_agama'] = $this->input->post('cek_agama');

    $tescount = $this->db->join('d_s', 'tes_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$kelas_id)->where('tes_topik_id',$topik_id)->from("tes")->count_all_results();
    if($tescount == 0){
      $data['siswa_all'] = $this->db->query(
        "SELECT d_s_id, sis_agama_id, agama_nama, sis_nama_depan, sis_nama_bel, sis_no_induk
        FROM d_s
        LEFT JOIN sis ON d_s_sis_id = sis_id
        LEFT JOIN agama ON sis_agama_id = agama_id
        WHERE d_s_kelas_id = $kelas_id
        ORDER BY sis_no_induk, $_gb sis_nama_depan, sis_nama_bel")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tes_crud/input',$data);
      $this->load->view('templates/footer');
    }else{
      $data['siswa_all'] = $this->db->query(
        "SELECT *
        FROM tes
        LEFT JOIN d_s ON tes_d_s_id = d_s_id
        LEFT JOIN sis ON sis_id = d_s_sis_id
        LEFT JOIN agama ON sis_agama_id = agama_id
        WHERE d_s_kelas_id = $kelas_id AND tes_topik_id = $topik_id
        ORDER BY sis_no_induk, $_gb sis_nama_depan, sis_nama_bel")->result_array();

      //cari siswa yang ada di kelas tapi tidak mempunyai nilai
      $data['siswa_baru'] = $this->db->query(
      "SELECT d_s_id, sis_no_induk, sis_nama_depan, sis_nama_bel
      FROM d_s
      LEFT JOIN sis ON d_s_sis_id = sis_id
      WHERE d_s_kelas_id = $kelas_id AND d_s_id NOT IN
      (SELECT d_s_id
        FROM tes
        LEFT JOIN d_s ON tes_d_s_id = d_s_id
        LEFT JOIN kelas ON d_s_kelas_id = kelas_id
        WHERE kelas_id = $kelas_id AND tes_topik_id = $topik_id
      )")->result_array();

      // $data['siswa_baru'] = $this->db->query(
      //   "SELECT sis_agama_id, agama_nama, d_s_id, sis_nama_depan, sis_nama_bel, sis_no_induk
      //   FROM d_s
      //   LEFT JOIN sis ON d_s_sis_id = sis_id
      //   LEFT JOIN agama ON sis_agama_id = agama_id
      //   WHERE d_s_kelas_id = $kelas_id AND d_s_sis_id NOT IN
      //     (SELECT d_s_sis_id
      //     FROM tes
      //     LEFT JOIN d_s ON tes_d_s_id = d_s_id
      //     LEFT JOIN sis ON sis_id = d_s_sis_id
      //     LEFT JOIN agama ON sis_agama_id = agama_id
      //     WHERE d_s_kelas_id = $kelas_id AND tes_topik_id = $topik_id
      //     )
      //   ORDER BY sis_nama_depan")->result_array();

      //var_dump($this->db->last_query());

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('tes_crud/update',$data);
      $this->load->view('templates/footer');
    }


  }

  public function save_input(){
    if($this->input->post('nh1[]')){

      $tes_count = $this->db->join('d_s', 'tes_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$this->input->post('kelas_id'))->where('tes_topik_id',$this->input->post('topik_id'))->from("tes")->count_all_results();
      if($tes_count == 0){
        //Save input
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');

        $tes_ph1 = $this->input->post('nh1[]');
        $tes_ph2 = $this->input->post('nh2[]');
        $tes_ph3 = $this->input->post('nh3[]');
        $tes_ph4 = $this->input->post('nh4[]');
        $tes_ph5 = $this->input->post('nh5[]');

        $tes_prak1 = $this->input->post('pr1[]');
        $tes_prak2 = $this->input->post('pr2[]');
        $tes_prak3 = $this->input->post('pr3[]');

        $tes_produk1 = $this->input->post('prod1[]');
        $tes_produk2 = $this->input->post('prod2[]');
        $tes_produk3 = $this->input->post('prod3[]');

        $tes_proyek1 = $this->input->post('proy1[]');
        $tes_proyek2 = $this->input->post('proy2[]');
        $tes_proyek3 = $this->input->post('proy3[]');

        $tes_porto1 = $this->input->post('porto1[]');
        $tes_porto2 = $this->input->post('porto2[]');
        $tes_porto3 = $this->input->post('porto3[]');
        //
        //var_dump($tes_ph2);

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'tes_d_s_id' => $d_s_id[$i],
              'tes_ph1' => $tes_ph1[$i],
              'tes_ph2' => $tes_ph2[$i],
              'tes_ph3' => $tes_ph3[$i],
              'tes_ph4' => $tes_ph4[$i],
              'tes_ph5' => $tes_ph5[$i],
              'tes_jum_ph' => $this->input->post('opt_peng'),
              'tes_prak1' => $tes_prak1[$i],
              'tes_prak2' => $tes_prak2[$i],
              'tes_prak3' => $tes_prak3[$i],
              'tes_jum_prak' => $this->input->post('opt_prak'),
              'tes_produk1' => $tes_produk1[$i],
              'tes_produk2' => $tes_produk2[$i],
              'tes_produk3' => $tes_produk3[$i],
              'tes_jum_prod' => $this->input->post('opt_prod'),
              'tes_proyek1' => $tes_proyek1[$i],
              'tes_proyek2' => $tes_proyek2[$i],
              'tes_proyek3' => $tes_proyek3[$i],
              'tes_jum_proy' => $this->input->post('opt_proy'),
              'tes_porto1' => $tes_porto1[$i],
              'tes_porto2' => $tes_porto2[$i],
              'tes_porto3' => $tes_porto3[$i],
              'tes_jum_porto' => $this->input->post('opt_porto'),
              'tes_topik_id' => $this->input->post('topik_id')
            ];
        }

        $this->db->insert_batch('tes', $data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Input Success!</div>');
        redirect('Tes_CRUD');
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Failed, already have score!</div>');
        redirect('Tes_CRUD');
      }

    }
  }

  public function save_new_student(){


    if($this->input->post('nh1[]')){
      $uj_count = $this->db->join('d_s', 'tes_d_s_id=d_s_id', 'left')->where_in('d_s_id',$this->input->post('d_s_id[]'))->where('tes_topik_id',$this->input->post('topik_id'))->from("tes")->count_all_results();

      //var_dump($this->db->last_query());
      if($uj_count == 0){
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');

        $tes_ph1 = $this->input->post('nh1[]');
        $tes_ph2 = $this->input->post('nh2[]');
        $tes_ph3 = $this->input->post('nh3[]');
        $tes_ph4 = $this->input->post('nh4[]');
        $tes_ph5 = $this->input->post('nh5[]');

        $tes_prak1 = $this->input->post('pr1[]');
        $tes_prak2 = $this->input->post('pr2[]');
        $tes_prak3 = $this->input->post('pr3[]');

        $tes_produk1 = $this->input->post('prod1[]');
        $tes_produk2 = $this->input->post('prod2[]');
        $tes_produk3 = $this->input->post('prod3[]');

        $tes_proyek1 = $this->input->post('proy1[]');
        $tes_proyek2 = $this->input->post('proy2[]');
        $tes_proyek3 = $this->input->post('proy3[]');

        $tes_porto1 = $this->input->post('porto1[]');
        $tes_porto2 = $this->input->post('porto2[]');
        $tes_porto3 = $this->input->post('porto3[]');

        for($i=0;$i<count($d_s_id);$i++){
          $data[$i] = [
            'tes_d_s_id' => $d_s_id[$i],
            'tes_ph1' => $tes_ph1[$i],
            'tes_ph2' => $tes_ph2[$i],
            'tes_ph3' => $tes_ph3[$i],
            'tes_ph4' => $tes_ph4[$i],
            'tes_ph5' => $tes_ph5[$i],
            'tes_jum_ph' => $this->input->post('tes_jum_ph_baru'),
            'tes_prak1' => $tes_prak1[$i],
            'tes_prak2' => $tes_prak2[$i],
            'tes_prak3' => $tes_prak3[$i],
            'tes_jum_prak' => $this->input->post('tes_jum_prak_baru'),
            'tes_produk1' => $tes_produk1[$i],
            'tes_produk2' => $tes_produk2[$i],
            'tes_produk3' => $tes_produk3[$i],
            'tes_jum_prod' => $this->input->post('tes_jum_prod_baru'),
            'tes_proyek1' => $tes_proyek1[$i],
            'tes_proyek2' => $tes_proyek2[$i],
            'tes_proyek3' => $tes_proyek3[$i],
            'tes_jum_proy' => $this->input->post('tes_jum_proy_baru'),
            'tes_porto1' => $tes_porto1[$i],
            'tes_porto2' => $tes_porto2[$i],
            'tes_porto3' => $tes_porto3[$i],
            'tes_jum_porto' => $this->input->post('tes_jum_porto_baru'),
            'tes_topik_id' => $this->input->post('topik_id')
          ];
        }

        $this->db->insert_batch('tes', $data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Input New Student(s) Success!</div>');
        redirect('Tes_CRUD');
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New Student(s) Grade Already Exist!</div>');
        redirect('Tes_CRUD');
      }

    }
  }

  public function save_update(){

    if($this->input->post('nh1[]')){
      $data = array();
      $tes_id = $this->input->post('tes_id[]');

      $tes_ph1 = $this->input->post('nh1[]');
      $tes_ph2 = $this->input->post('nh2[]');
      $tes_ph3 = $this->input->post('nh3[]');
      $tes_ph4 = $this->input->post('nh4[]');
      $tes_ph5 = $this->input->post('nh5[]');

      $tes_prak1 = $this->input->post('pr1[]');
      $tes_prak2 = $this->input->post('pr2[]');
      $tes_prak3 = $this->input->post('pr3[]');

      $tes_produk1 = $this->input->post('prod1[]');
      $tes_produk2 = $this->input->post('prod2[]');
      $tes_produk3 = $this->input->post('prod3[]');

      $tes_proyek1 = $this->input->post('proy1[]');
      $tes_proyek2 = $this->input->post('proy2[]');
      $tes_proyek3 = $this->input->post('proy3[]');

      $tes_porto1 = $this->input->post('porto1[]');
      $tes_porto2 = $this->input->post('porto2[]');
      $tes_porto3 = $this->input->post('porto3[]');

      for($i=0;$i<count($tes_id);$i++){
        $data[$i] = [
          'tes_ph1' => $tes_ph1[$i],
          'tes_ph2' => $tes_ph2[$i],
          'tes_ph3' => $tes_ph3[$i],
          'tes_ph4' => $tes_ph4[$i],
          'tes_ph5' => $tes_ph5[$i],
          'tes_jum_ph' => $this->input->post('opt_peng'),
          'tes_prak1' => $tes_prak1[$i],
          'tes_prak2' => $tes_prak2[$i],
          'tes_prak3' => $tes_prak3[$i],
          'tes_jum_prak' => $this->input->post('opt_prak'),
          'tes_produk1' => $tes_produk1[$i],
          'tes_produk2' => $tes_produk2[$i],
          'tes_produk3' => $tes_produk3[$i],
          'tes_jum_prod' => $this->input->post('opt_prod'),
          'tes_proyek1' => $tes_proyek1[$i],
          'tes_proyek2' => $tes_proyek2[$i],
          'tes_proyek3' => $tes_proyek3[$i],
          'tes_jum_proy' => $this->input->post('opt_proy'),
          'tes_porto1' => $tes_porto1[$i],
          'tes_porto2' => $tes_porto2[$i],
          'tes_porto3' => $tes_porto3[$i],
          'tes_jum_porto' => $this->input->post('opt_porto'),
          'tes_id' =>  $tes_id[$i]
        ];
      }
      $this->db->update_batch('tes',$data, 'tes_id');
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Update Success!</div>');
      redirect('Tes_CRUD');
    }
  }
}
