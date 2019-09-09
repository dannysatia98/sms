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



}
