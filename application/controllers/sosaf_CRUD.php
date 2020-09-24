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
    $data['t_all'] = $this->db->query(
      "SELECT *
      FROM t
      WHERE t_kunci = 1
      ORDER BY t_nama DESC")->result_array();

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('sosaf_crud/index',$data);
    $this->load->view('templates/footer');

  }


  public function input(){

    if(!$this->input->post('mapel_id',TRUE) || !$this->input->post('kelas_id',TRUE)){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Do not access page directly!</div>');
      redirect('sosaf_CRUD');
    }

    $kelas_id = $this->input->post('kelas_id',TRUE);
    $mapel_id = $this->input->post('mapel_id',TRUE);
    $semester = $this->input->post('semester',TRUE);

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
    $soscount = $this->db->join('d_s', 'sosaf_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$kelas_id)->where('sosaf_mapel_id',$mapel_id)->where('sosaf_semester',$semester)->from("sosaf")->count_all_results();
    if($soscount == 0){
      $data['siswa_all'] = $this->db->query(
        "SELECT d_s_id, sis_agama_id, agama_nama, sis_nama_depan, sis_nama_bel, sis_no_induk
        FROM d_s
        LEFT JOIN sis ON d_s_sis_id = sis_id
        LEFT JOIN agama ON sis_agama_id = agama_id
        WHERE d_s_kelas_id = $kelas_id
        ORDER BY sis_no_induk, $_gb sis_nama_depan")->result_array();

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
        WHERE d_s_kelas_id = $kelas_id AND sosaf_mapel_id = $mapel_id AND sosaf_semester = $semester
        ORDER BY sis_no_induk, $_gb sis_nama_depan")->result_array();

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
        WHERE kelas_id = $kelas_id AND sosaf_mapel_id = $mapel_id AND sosaf_semester = $semester
      )")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('sosaf_CRUD/update',$data);
      $this->load->view('templates/footer');
    }


  }

  public function save_input(){
    if($this->input->post('1[]')){

      $soscount = $this->db->join('d_s', 'sosaf_d_s_id=d_s_id', 'left')->where('d_s_kelas_id',$this->input->post('kelas_id'))->where('sosaf_mapel_id',$this->input->post('mapel_id'))->where('sosaf_semester',$semester)->from("sosaf")->count_all_results();
      if($soscount == 0){
        //Save input
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');
        $mapel_id = $this->input->post('mapel_id');
        $semester = $this->input->post('semester',TRUE);

        $sosaf_1 = $this->input->post('1[]');
        $sosaf_2 = $this->input->post('2[]');
        $sosaf_3 = $this->input->post('3[]');
        $sosaf_4 = $this->input->post('4[]');
        $sosaf_5 = $this->input->post('5[]');
        $sosaf_6 = $this->input->post('6[]');
        $sosaf_7 = $this->input->post('7[]');
        $sosaf_8 = $this->input->post('8[]');
        $sosaf_9 = $this->input->post('9[]');
        $sosaf_10 = $this->input->post('10[]');
        $sosaf_11 = $this->input->post('11[]');
        $sosaf_12 = $this->input->post('12[]');
        $sosaf_13 = $this->input->post('13[]');
        $sosaf_14 = $this->input->post('14[]');
        $sosaf_15 = $this->input->post('15[]');
        $sosaf_16 = $this->input->post('16[]');
        //
        //var_dump($tes_ph2);

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'sosaf_d_s_id' => $d_s_id[$i],
              'sosaf_1' => $sosaf_1[$i],
              'sosaf_2' => $sosaf_2[$i],
              'sosaf_3' => $sosaf_3[$i],
              'sosaf_4' => $sosaf_4[$i],
              'sosaf_5' => $sosaf_5[$i],
              'sosaf_6' => $sosaf_6[$i],
              'sosaf_7' => $sosaf_7[$i],
              'sosaf_8' => $sosaf_8[$i],
              'sosaf_9' => $sosaf_9[$i],
              'sosaf_10' => $sosaf_10[$i],
              'sosaf_11' => $sosaf_11[$i],
              'sosaf_12' => $sosaf_12[$i],
              'sosaf_13' => $sosaf_13[$i],
              'sosaf_14' => $sosaf_14[$i],
              'sosaf_15' => $sosaf_15[$i],
              'sosaf_16' => $sosaf_16[$i],
              'sosaf_mapel_id' => $this->input->post('mapel_id'),
              'sosaf_semester' => $semester
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


    if($this->input->post('1[]')){
      $uj_count = $this->db->join('d_s', 'sosaf_d_s_id=d_s_id', 'left')->where_in('d_s_id',$this->input->post('d_s_id[]'))->where('sosaf_mapel_id',$this->input->post('mapel_id'))->where('sosaf_semester',$semester)->from("sosaf")->count_all_results();

      //var_dump($this->db->last_query());
      if($uj_count == 0){
        $data = array();
        $d_s_id = $this->input->post('d_s_id[]');
        $semester = $this->input->post('semester',TRUE);

        $sosaf_1 = $this->input->post('1[]');
        $sosaf_2 = $this->input->post('2[]');
        $sosaf_3 = $this->input->post('3[]');
        $sosaf_4 = $this->input->post('4[]');
        $sosaf_5 = $this->input->post('5[]');
        $sosaf_6 = $this->input->post('6[]');
        $sosaf_7 = $this->input->post('7[]');
        $sosaf_8 = $this->input->post('8[]');
        $sosaf_9 = $this->input->post('9[]');
        $sosaf_10 = $this->input->post('10[]');
        $sosaf_11 = $this->input->post('11[]');
        $sosaf_12 = $this->input->post('12[]');
        $sosaf_13 = $this->input->post('13[]');
        $sosaf_14 = $this->input->post('14[]');
        $sosaf_15 = $this->input->post('15[]');
        $sosaf_16 = $this->input->post('16[]');

        for($i=0;$i<count($d_s_id);$i++){
            $data[$i] = [
              'sosaf_d_s_id' => $d_s_id[$i],
              'sosaf_1' => $sosaf_1[$i],
              'sosaf_2' => $sosaf_2[$i],
              'sosaf_3' => $sosaf_3[$i],
              'sosaf_4' => $sosaf_4[$i],
              'sosaf_5' => $sosaf_5[$i],
              'sosaf_6' => $sosaf_6[$i],
              'sosaf_7' => $sosaf_7[$i],
              'sosaf_8' => $sosaf_8[$i],
              'sosaf_9' => $sosaf_9[$i],
              'sosaf_10' => $sosaf_10[$i],
              'sosaf_11' => $sosaf_11[$i],
              'sosaf_12' => $sosaf_12[$i],
              'sosaf_13' => $sosaf_13[$i],
              'sosaf_14' => $sosaf_14[$i],
              'sosaf_15' => $sosaf_15[$i],
              'sosaf_16' => $sosaf_16[$i],
              'sosaf_mapel_id' => $this->input->post('mapel_id'),
              'sosaf_semester' => $semester
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
    if($this->input->post('1[]')){
      $data = array();
      $sosaf_id = $this->input->post('sosaf_id[]');

      $sosaf_1 = $this->input->post('1[]');
      $sosaf_2 = $this->input->post('2[]');
      $sosaf_3 = $this->input->post('3[]');
      $sosaf_4 = $this->input->post('4[]');
      $sosaf_5 = $this->input->post('5[]');
      $sosaf_6 = $this->input->post('6[]');
      $sosaf_7 = $this->input->post('7[]');
      $sosaf_8 = $this->input->post('8[]');
      $sosaf_9 = $this->input->post('9[]');
      $sosaf_10 = $this->input->post('10[]');
      $sosaf_11 = $this->input->post('11[]');
      $sosaf_12 = $this->input->post('12[]');
      $sosaf_13 = $this->input->post('13[]');
      $sosaf_14 = $this->input->post('14[]');
      $sosaf_15 = $this->input->post('15[]');
      $sosaf_16 = $this->input->post('16[]');

      for($i=0;$i<count($sosaf_id);$i++){
        $data[$i] = [
          'sosaf_1' => $sosaf_1[$i],
          'sosaf_2' => $sosaf_2[$i],
          'sosaf_3' => $sosaf_3[$i],
          'sosaf_4' => $sosaf_4[$i],
          'sosaf_5' => $sosaf_5[$i],
          'sosaf_6' => $sosaf_6[$i],
          'sosaf_7' => $sosaf_7[$i],
          'sosaf_8' => $sosaf_8[$i],
          'sosaf_9' => $sosaf_9[$i],
          'sosaf_10' => $sosaf_10[$i],
          'sosaf_11' => $sosaf_11[$i],
          'sosaf_12' => $sosaf_12[$i],
          'sosaf_13' => $sosaf_13[$i],
          'sosaf_14' => $sosaf_14[$i],
          'sosaf_15' => $sosaf_15[$i],
          'sosaf_16' => $sosaf_16[$i],
          'sosaf_id' =>  $sosaf_id[$i]
        ];
      }
      $this->db->update_batch('sosaf',$data, 'sosaf_id');
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Update Success!</div>');
      redirect('sosaf_CRUD');
    }
  }
}
