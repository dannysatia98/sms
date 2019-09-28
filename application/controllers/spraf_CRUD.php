<?php
defined('BASEPATH') or exit('No direct script access allowed');

class spraf_CRUD extends CI_Controller
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
    $this->load->model('_spirit');
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

    $data['title'] = 'Sikap Spiritual';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('spraf_crud/index',$data);
    $this->load->view('templates/footer');

  }

  public function input(){

    if(!$this->input->post('mapel_id',TRUE) || !$this->input->post('kelas_id',TRUE)){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Do not access page directly!</div>');
      redirect('spraf_CRUD');
    }


    $kelas_id = $this->input->post('kelas_id',TRUE);
    $mapel_id = $this->input->post('mapel_id',TRUE);
    $semester = $this->input->post('semester',TRUE);


    //var_dump($spirit_id);

    // cek apakah ada siswa di kelas
    $siswacount = $this->db->join('kelas', 'd_s_kelas_id = kelas_id', 'left')->where('d_s_kelas_id',$kelas_id)->from("d_s")->count_all_results();
    if($siswacount == 0){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">No Student Detected in Class, Please Contact Curriculum!</div>');
      redirect('spraf_CRUD');
    }

    $data['title'] = 'Sikap Spiritual';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['kelas'] = $this->_kelas->find_kelas_nama($kelas_id);
    $data['mapel'] = $this->_mapel->find_mapel_nama($mapel_id);

    $data['kelas_id'] = $kelas_id;
    $data['mapel_id'] = $mapel_id;
    $data['semester'] = $semester;

    if($this->input->post('cek_agama') == 1){
      $_gb = "sis_agama_id,";
    }else{
      $_gb = "";
    }

    $data['cek_agama'] = $this->input->post('cek_agama');

    //APAKAH SDH PERNAH ISI?
    $sprcount = $this->db->join('d_s', 'spraf_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$kelas_id)->where('spraf_mapel_id',$mapel_id)->where('spraf_semester',$semester)->from("spraf")->count_all_results();
    if($sprcount == 0){
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
      $this->load->view('spraf_CRUD/input',$data);
      $this->load->view('templates/footer');
    }else{
      //JIKA SUDAH PERNAH ISI
      $data['siswa_all'] = $this->db->query(
        "SELECT *
        FROM spraf
        LEFT JOIN d_s ON spraf_d_s_id = d_s_id
        LEFT JOIN sis ON sis_id = d_s_sis_id
        LEFT JOIN agama ON sis_agama_id = agama_id
        WHERE d_s_kelas_id = $kelas_id AND spraf_mapel_id = $mapel_id AND spraf_semester = $semester
        ORDER BY $_gb sis_nama_depan, sis_no_induk")->result_array();

      //cari siswa yang ada di kelas tapi tidak mempunyai nilai
      $data['siswa_baru'] = $this->db->query(
      "SELECT d_s_id, sis_no_induk, sis_nama_depan, sis_nama_bel
      FROM d_s
      LEFT JOIN sis ON d_s_sis_id = sis_id
      WHERE d_s_kelas_id = $kelas_id AND d_s_id NOT IN
      (SELECT d_s_id
        FROM spraf
        LEFT JOIN d_s ON spraf_d_s_id = d_s_id
        LEFT JOIN kelas ON d_s_kelas_id = kelas_id
        WHERE kelas_id = $kelas_id AND spraf_mapel_id = $mapel_id AND spraf_semester = $semester
      )")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('spraf_CRUD/update',$data);
      $this->load->view('templates/footer');
    }


  }

  public function save_input(){
    if($this->input->post('1[]')){

      $sprcount = $this->db->join('d_s', 'spraf_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$this->input->post('kelas_id'))->where('spraf_mapel_id',$this->input->post('mapel_id'))->where('spraf_semester',$this->input->post('semester'))->from("spraf")->count_all_results();
      if($sprcount == 0){
        //Save input
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');
        $mapel_id = $this->input->post('mapel_id',TRUE);
        $semester = $this->input->post('semester',TRUE);

        $spraf_1 = $this->input->post('1[]');
        $spraf_2 = $this->input->post('2[]');
        $spraf_3 = $this->input->post('3[]');
        $spraf_4 = $this->input->post('4[]');
        $spraf_5 = $this->input->post('5[]');
        $spraf_6 = $this->input->post('6[]');
        $spraf_7 = $this->input->post('7[]');
        $spraf_8 = $this->input->post('8[]');
        $spraf_9 = $this->input->post('9[]');
        $spraf_10 = $this->input->post('10[]');
        $spraf_11 = $this->input->post('11[]');

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'spraf_d_s_id' => $d_s_id[$i],
              'spraf_1' => $spraf_1[$i],
              'spraf_2' => $spraf_2[$i],
              'spraf_3' => $spraf_3[$i],
              'spraf_4' => $spraf_4[$i],
              'spraf_5' => $spraf_5[$i],
              'spraf_6' => $spraf_6[$i],
              'spraf_7' => $spraf_7[$i],
              'spraf_8' => $spraf_8[$i],
              'spraf_9' => $spraf_9[$i],
              'spraf_10' => $spraf_10[$i],
              'spraf_11' => $spraf_11[$i],
              'spraf_mapel_id' => $mapel_id,
              'spraf_semester' => $semester
            ];
        }

        $this->db->insert_batch('spraf', $data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Input Success!</div>');
        redirect('spraf_CRUD');
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Gagal, nilai sudah ada, silahkan lihat lagi apakah nilai sudah masuk</div>');
        redirect('spraf_CRUD');
      }

    }
  }

  public function save_new_student(){


    if($this->input->post('1[]')){
      $uj_count = $this->db->join('d_s', 'spraf_d_s_id=d_s_id', 'left')->where_in('d_s_id',$this->input->post('d_s_id[]'))->where('spraf_mapel_id',$this->input->post('mapel_id'))->where('spraf_semester',$this->input->post('semester'))->from("spraf")->count_all_results();

      //var_dump($this->db->last_query());
      if($uj_count == 0){
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');
        $mapel_id = $this->input->post('mapel_id',TRUE);
        $semester = $this->input->post('semester',TRUE);

        $spraf_1 = $this->input->post('1[]');
        $spraf_2 = $this->input->post('2[]');
        $spraf_3 = $this->input->post('3[]');
        $spraf_4 = $this->input->post('4[]');
        $spraf_5 = $this->input->post('5[]');
        $spraf_6 = $this->input->post('6[]');
        $spraf_7 = $this->input->post('7[]');
        $spraf_8 = $this->input->post('8[]');
        $spraf_9 = $this->input->post('9[]');
        $spraf_10 = $this->input->post('10[]');
        $spraf_11 = $this->input->post('11[]');

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'spraf_d_s_id' => $d_s_id[$i],
              'spraf_1' => $spraf_1[$i],
              'spraf_2' => $spraf_2[$i],
              'spraf_3' => $spraf_3[$i],
              'spraf_4' => $spraf_4[$i],
              'spraf_5' => $spraf_5[$i],
              'spraf_6' => $spraf_6[$i],
              'spraf_7' => $spraf_7[$i],
              'spraf_8' => $spraf_8[$i],
              'spraf_9' => $spraf_9[$i],
              'spraf_10' => $spraf_10[$i],
              'spraf_11' => $spraf_11[$i],
              'spraf_mapel_id' => $mapel_id,
              'spraf_semester' => $semester
            ];
        }

        $this->db->insert_batch('spraf', $data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Input Success!</div>');
        redirect('spraf_CRUD');
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Gagal, nilai sudah ada, silahkan lihat lagi apakah nilai sudah masuk</div>');
        redirect('spraf_CRUD');
      }

    }
  }

  public function save_update(){
    if($this->input->post('1[]')){
      $data = array();
      $spraf_id = $this->input->post('spraf_id[]');
      $mapel_id = $this->input->post('mapel_id',TRUE);

      $spraf_1 = $this->input->post('1[]');
      $spraf_2 = $this->input->post('2[]');
      $spraf_3 = $this->input->post('3[]');
      $spraf_4 = $this->input->post('4[]');
      $spraf_5 = $this->input->post('5[]');
      $spraf_6 = $this->input->post('6[]');
      $spraf_7 = $this->input->post('7[]');
      $spraf_8 = $this->input->post('8[]');
      $spraf_9 = $this->input->post('9[]');
      $spraf_10 = $this->input->post('10[]');
      $spraf_11 = $this->input->post('11[]');

      for($i=0;$i<count($spraf_id);$i++){
        $data[$i] = [
          'spraf_1' => $spraf_1[$i],
          'spraf_2' => $spraf_2[$i],
          'spraf_3' => $spraf_3[$i],
          'spraf_4' => $spraf_4[$i],
          'spraf_5' => $spraf_5[$i],
          'spraf_6' => $spraf_6[$i],
          'spraf_7' => $spraf_7[$i],
          'spraf_8' => $spraf_8[$i],
          'spraf_9' => $spraf_9[$i],
          'spraf_10' => $spraf_10[$i],
          'spraf_11' => $spraf_11[$i],
          'spraf_id' => $spraf_id[$i]
        ];
      }
      $this->db->update_batch('spraf',$data, 'spraf_id');
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Update Success!</div>');
      redirect('spraf_CRUD');
    }
  }
}
