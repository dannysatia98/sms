<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_CRUD extends CI_Controller
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

    $data['title'] = 'Laporan';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index',$data);
    $this->load->view('templates/footer');

  }

  public function show(){

    if(!$this->input->post('mapel_id')){
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Do not access page directly!</div>');
      redirect('Profile');
    }

    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    $mapel_id = $this->input->post('mapel_id');
    $kelas_id = $this->input->post('kelas_id');

    $data['title'] = "Laporan Nilai";

    // echo $mapel_id."<br>";
    // echo $kelas_id."<br>";

    $data['topik'] = $this->db->query
                    ("SELECT DISTINCT topik_id
                    FROM tes
                    LEFT JOIN topik ON tes_topik_id = topik_id
                    LEFT JOIN mapel ON topik_mapel_id = mapel_id
                    LEFT JOIN d_s ON tes_d_s_id = d_s_id
                    WHERE topik_mapel_id = $mapel_id AND d_s_kelas_id = $kelas_id
                    ORDER BY topik_id")->result_array();

    $data['ujian'] = $this->db->query
                    ("SELECT *
                    FROM uj
                    LEFT JOIN d_s ON uj_d_s_id = d_s_id
                    LEFT JOIN sis ON sis_id = d_s_sis_id
                    WHERE uj_mapel_id = $mapel_id AND d_s_kelas_id = $kelas_id
                    ORDER BY sis_no_induk, sis_nama_depan")->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('Laporan_CRUD/show', $data);
    $this->load->view('templates/footer');

  }

  public function index_dkn_naik(){
    $data['title'] = 'DKN Kenaikan Kelas';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_dkn_naik',$data);
    $this->load->view('templates/footer');
  }

  public function index_dkn_un(){
    $data['title'] = 'DKN UN';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_dkn_un',$data);
    $this->load->view('templates/footer');
  }

  public function index_buku_induk(){
    $data['title'] = 'Buku Induk';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_buku_induk',$data);
    $this->load->view('templates/footer');
  }

  public function index_buku_induk_show(){
    if($this->input->post('siswa_check[]',TRUE)){

      if(count($this->input->post('siswa_check[]',TRUE))==0){
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Pilih setidaknya 1 siswa!</div>');
        redirect('Laporan_crud/index_buku_induk');
      }

      $data['title'] = 'Buku Induk';

      $data['t_id'] = $this->input->post('t',TRUE);
      //data karyawan yang sedang login untuk topbar
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
      $data['sis_arr'] = $this->input->post('siswa_check[]',TRUE);

      // $data['kepsek'] = $this->_sk->find_by_id($this->session->userdata('kr_sk_id'));
      $data['walkel'] = $this->_kelas->find_walkel_by_kelas_id($this->input->post('kelas_id',TRUE));
      $data['kelas_id'] = $this->input->post('kelas_id',TRUE);
      $data['tgl_cetak'] = $this->input->post('tgl_cetak',TRUE);

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('Laporan_crud/index_buku_induk_show',$data);
      $this->load->view('templates/footer');

    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akses Ditolak!</div>');
      redirect('Profile');
    }
  }

  public function index_rank(){
    $data['title'] = 'Ranking Kelas';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_rank',$data);
    $this->load->view('templates/footer');
  }

}
