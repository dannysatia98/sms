<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sosaf_CRUD extends CI_Controller
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
    $this->load->model('_sosial');
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

    $data['title'] = 'Sikap Sosial';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];
    $data['t_all'] = $this->_t->return_all();

    //SELECT * from d_mpl WHERE d_mpl_kr_id = $data['kr']['kr_id']
    // if($this->session->userdata('kr_jabatan_id')!=4){
    //   $data['mapel_all'] = $this->db->query(
    //     "SELECT t_nama, sk_nama, d_mpl_mapel_id, mapel_nama, kelas_id, kelas_nama
    //     FROM d_mpl
    //     LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
    //     LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
    //     LEFT JOIN t ON kelas_t_id = t_id
    //     LEFT JOIN sk ON kelas_sk_id = sk_id
    //     WHERE d_mpl_kr_id = $kr_id
    //     ORDER BY t_id DESC, sk_nama, kelas_nama")->result_array();
    //
    //   if(empty($data['mapel_all'])){
    //     $this->session->set_flashdata("message","<div class='alert alert-danger' role='alert'>You don't teach any class, contact curriculum for more information!</div>");
    //     redirect('Profile');
    //   }
    // }
    //
    // if($this->session->userdata('kr_jabatan_id')==4){
    //   $data['mapel_all'] = $this->db->query(
    //     "SELECT t_nama, sk_nama, d_mpl_mapel_id, mapel_nama, kelas_id, kelas_nama
    //     FROM d_mpl
    //     LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
    //     LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
    //     LEFT JOIN t ON kelas_t_id = t_id
    //     LEFT JOIN sk ON kelas_sk_id = sk_id
    //     ORDER BY t_id DESC, sk_nama, kelas_nama")->result_array();
    // }

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('sosaf_crud/index',$data);
    $this->load->view('templates/footer');

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
        "SELECT sosial_id, sosial_nama, sosial_semester
        FROM sosial
        LEFT JOIN jenj ON sosial_jenjang_id = jenj_id
        LEFT JOIN mapel ON sosial_mapel_id = mapel_id
        WHERE jenj_id = $jenj_id AND mapel_id = $mapel_id")->result();

      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function input(){

    if(!$this->input->post('sosial_id')){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Do not access page directly!</div>');
      redirect('sosaf_CRUD');
    }

    $kelas_id = $this->input->post('kelas_id',TRUE);
    $sosial_id = $this->input->post('sosial_id');
    $mapel_id = $this->input->post('mapel_id',TRUE);

    // cek apakah ada siswa di kelas
    $siswacount = $this->db->join('kelas', 'd_s_kelas_id = kelas_id', 'left')->where('d_s_kelas_id',$kelas_id)->from("d_s")->count_all_results();
    if($siswacount == 0){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">No Student Detected in Class, Please Contact Curriculum!</div>');
      redirect('sosaf_CRUD');
    }

    $data['title'] = 'Sikap Sosial';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['kelas'] = $this->_kelas->find_kelas_nama($kelas_id);
    $data['mapel'] = $this->_mapel->find_mapel_nama($mapel_id);
    $data['sosial'] = $this->_sosial->find_by_id($sosial_id);

    $data['kelas_id'] = $kelas_id;
    $data['mapel_id'] = $mapel_id;

    if($this->input->post('cek_agama') == 1){
      $_gb = "sis_agama_id,";
    }else{
      $_gb = "";
    }

    $data['cek_agama'] = $this->input->post('cek_agama');

    //APAKAH SDH PERNAH ISI?
    $soscount = $this->db->join('d_s', 'sosaf_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$kelas_id)->where('sosaf_sosial_id',$sosial_id)->from("sosaf")->count_all_results();
    if($soscount == 0){
      $data['siswa_all'] = $this->db->query(
        "SELECT d_s_id, sis_agama_id, agama_nama, sis_nama_depan, sis_nama_bel, sis_no_induk
        FROM d_s
        LEFT JOIN sis ON d_s_sis_id = sis_id
        LEFT JOIN agama ON sis_agama_id = agama_id
        WHERE d_s_kelas_id = $kelas_id
        ORDER BY $_gb sis_nama_depan, sis_no_induk")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('sosaf_CRUD/input',$data);
      $this->load->view('templates/footer');
    }else{
      //JIKA SUDAH PERNAH ISI
      $data['siswa_all'] = $this->db->query(
        "SELECT *
        FROM sosaf
        LEFT JOIN d_s ON sosaf_d_s_id = d_s_id
        LEFT JOIN sis ON sis_id = d_s_sis_id
        LEFT JOIN agama ON sis_agama_id = agama_id
        WHERE d_s_kelas_id = $kelas_id AND sosaf_sosial_id = $sosial_id
        ORDER BY $_gb sis_nama_depan, sis_no_induk")->result_array();

      //cari siswa yang ada di kelas tapi tidak mempunyai nilai
      $data['siswa_baru'] = $this->db->query(
      "SELECT d_s_id, sis_no_induk, sis_nama_depan, sis_nama_bel
      FROM d_s
      LEFT JOIN sis ON d_s_sis_id = sis_id
      WHERE d_s_kelas_id = $kelas_id AND d_s_id NOT IN
      (SELECT d_s_id
        FROM sosaf
        LEFT JOIN d_s ON sosaf_d_s_id = d_s_id
        LEFT JOIN kelas ON d_s_kelas_id = kelas_id
        WHERE kelas_id = $kelas_id AND sosaf_sosial_id = $sosial_id
      )")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('sosaf_CRUD/update',$data);
      $this->load->view('templates/footer');
    }


  }

  public function save_input(){
    if($this->input->post('a[]')){

      $soscount = $this->db->join('d_s', 'sosaf_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$this->input->post('kelas_id'))->where('sosaf_sosial_id',$this->input->post('sosial_id'))->from("sosaf")->count_all_results();
      if($soscount == 0){
        //Save input
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');

        $sosaf_a = $this->input->post('a[]');
        $sosaf_b = $this->input->post('b[]');
        $sosaf_c = $this->input->post('c[]');
        $sosaf_d = $this->input->post('d[]');
        $sosaf_e = $this->input->post('e[]');
        $sosaf_f = $this->input->post('f[]');
        $sosaf_g = $this->input->post('g[]');
        //
        //var_dump($tes_ph2);

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'sosaf_d_s_id' => $d_s_id[$i],
              'sosaf_a' => $sosaf_a[$i],
              'sosaf_b' => $sosaf_b[$i],
              'sosaf_c' => $sosaf_c[$i],
              'sosaf_d' => $sosaf_d[$i],
              'sosaf_e' => $sosaf_e[$i],
              'sosaf_f' => $sosaf_f[$i],
              'sosaf_g' => $sosaf_g[$i],
              'sosaf_sosial_id' => $this->input->post('sosial_id')
            ];
        }

        $this->db->insert_batch('sosaf', $data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Input Success!</div>');
        redirect('sosaf_CRUD');
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Gagal, nilai sudah ada, silahkan lihat lagi apakah nilai sudah masuk</div>');
        redirect('sosaf_CRUD');
      }

    }
  }

  public function save_new_student(){


    if($this->input->post('a[]')){
      $uj_count = $this->db->join('d_s', 'sosaf_d_s_id=d_s_id', 'left')->where_in('d_s_id',$this->input->post('d_s_id[]'))->where('sosaf_sosial_id',$this->input->post('sosial_id'))->from("sosaf")->count_all_results();

      //var_dump($this->db->last_query());
      if($uj_count == 0){
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');

        $sosaf_a = $this->input->post('a[]');
        $sosaf_b = $this->input->post('b[]');
        $sosaf_c = $this->input->post('c[]');
        $sosaf_d = $this->input->post('d[]');
        $sosaf_e = $this->input->post('e[]');
        $sosaf_f = $this->input->post('f[]');
        $sosaf_g = $this->input->post('g[]');

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'sosaf_d_s_id' => $d_s_id[$i],
              'sosaf_a' => $sosaf_a[$i],
              'sosaf_b' => $sosaf_b[$i],
              'sosaf_c' => $sosaf_c[$i],
              'sosaf_d' => $sosaf_d[$i],
              'sosaf_e' => $sosaf_e[$i],
              'sosaf_f' => $sosaf_f[$i],
              'sosaf_g' => $sosaf_g[$i],
              'sosaf_sosial_id' => $this->input->post('sosial_id')
            ];
        }

        $this->db->insert_batch('sosaf', $data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Input Success!</div>');
        redirect('sosaf_CRUD');
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Gagal, nilai sudah ada, silahkan lihat lagi apakah nilai sudah masuk</div>');
        redirect('sosaf_CRUD');
      }

    }
  }

  public function save_update(){
    if($this->input->post('a[]')){
      $data = array();
      $sosaf_id = $this->input->post('sosaf_id[]');

      $sosaf_a = $this->input->post('a[]');
      $sosaf_b = $this->input->post('b[]');
      $sosaf_c = $this->input->post('c[]');
      $sosaf_d = $this->input->post('d[]');
      $sosaf_e = $this->input->post('e[]');
      $sosaf_f = $this->input->post('f[]');
      $sosaf_g = $this->input->post('g[]');

      for($i=0;$i<count($sosaf_id);$i++){
        $data[$i] = [
          'sosaf_a' => $sosaf_a[$i],
          'sosaf_b' => $sosaf_b[$i],
          'sosaf_c' => $sosaf_c[$i],
          'sosaf_d' => $sosaf_d[$i],
          'sosaf_e' => $sosaf_e[$i],
          'sosaf_f' => $sosaf_f[$i],
          'sosaf_g' => $sosaf_g[$i],
          'sosaf_id' =>  $sosaf_id[$i]
        ];
      }
      $this->db->update_batch('sosaf',$data, 'sosaf_id');
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Update Success!</div>');
      redirect('sosaf_CRUD');
    }
  }
}
