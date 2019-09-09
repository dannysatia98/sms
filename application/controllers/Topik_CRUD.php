<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topik_CRUD extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('_sk');
    $this->load->model('_kr');
    $this->load->model('_jabatan');
    $this->load->model('_st');
    $this->load->model('_mapel');
    $this->load->model('_jenj');
    $this->load->model('_topik');
    $this->load->model('_sosial');
    $this->load->model('_spirit');


    //jika belum login
    if(!$this->session->userdata('kr_jabatan_id')){
      redirect('Auth');
    }

    //jika bukan guru dan sudah login redirect ke home
    if($this->session->userdata('kr_jabatan_id')!=4 && $this->session->userdata('kr_jabatan_id')){
      redirect('Profile');
    }
  }

  public function index(){

    $data['title'] = 'Kompetensi Dasar';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    //$data['tes'] = var_dump($this->db->last_query());

    //cari guru mengajar mapel mana saja

    $kr_id = $data['kr']['kr_id'];

    //SELECT * from d_mpl WHERE d_mpl_kr_id = $data['kr']['kr_id']

    $data['mapel_all'] = $this->_mapel->return_all_by_sk_id($this->session->userdata('kr_sk_id'));

    //var_dump($this->db->last_query());
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('topik_crud/index',$data);
    $this->load->view('templates/footer');

  }

  public function add_sos(){
    $mapel_id = $this->input->post('mapel_id', true);

    if (!$mapel_id) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

    $data['sk'] = $this->db->query(
      "SELECT mapel_sk_id
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['jenj_all'] = $this->_jenj->return_all_by_sk($data['sk']['mapel_sk_id']);

    $data['mapel_id'] = $mapel_id;
    $data['title'] = 'Tambah KD Sosial';

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Topik_CRUD/add_sos',$data);
    $this->load->view('templates/footer');
  }

  public function proses_add_sos(){
    $mapel_id = $this->input->post('mapel_id', true);

    if (!$mapel_id) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }else{
      $data = [
        'sosial_nama' => $this->input->post('sosial_nama'),
        'sosial_urutan' => $this->input->post('sosial_urutan'),
        'sosial_jenjang_id' => $this->input->post('jenj_id'),
        'sosial_semester' => $this->input->post('topik_semester'),
        'sosial_mapel_id' => $this->input->post('mapel_id')
      ];

      $this->db->insert('sosial', $data);
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">KD Sosial berhasil dibuat!</div>');
      redirect('Topik_CRUD');
    }
  }

  public function add_spirit(){
    $mapel_id = $this->input->post('mapel_id', true);

    if (!$mapel_id) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

    $data['sk'] = $this->db->query(
      "SELECT mapel_sk_id
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['jenj_all'] = $this->_jenj->return_all_by_sk($data['sk']['mapel_sk_id']);

    $data['mapel_id'] = $mapel_id;
    $data['title'] = 'Tambah KD Spiritual';

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Topik_CRUD/add_spirit',$data);
    $this->load->view('templates/footer');
  }

  public function proses_add_spirit(){
    $mapel_id = $this->input->post('mapel_id', true);

    if (!$mapel_id) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }else{
      $data = [
        'spirit_nama' => $this->input->post('spirit_nama'),
        'spirit_urutan' => $this->input->post('spirit_urutan'),
        'spirit_jenjang_id' => $this->input->post('jenj_id'),
        'spirit_semester' => $this->input->post('topik_semester'),
        'spirit_mapel_id' => $this->input->post('mapel_id')
      ];

      $this->db->insert('spirit', $data);
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">KD spiritual berhasil dibuat!</div>');
      redirect('Topik_CRUD');
    }
  }

  public function get_topik_spirit_detail(){
    if($this->input->post('id',TRUE)){

      $mapel_id = $this->input->post('id',TRUE);

      $data = $this->db->query(
        "SELECT *
        FROM spirit
        LEFT JOIN jenj ON spirit_jenjang_id = jenj_id
        WHERE spirit_mapel_id = $mapel_id
        ORDER BY jenj_id, spirit_semester, spirit_urutan,  spirit_nama")->result();

      //var_dump($data);
      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function get_topik_sosial_detail(){
    if($this->input->post('id',TRUE)){

      $mapel_id = $this->input->post('id',TRUE);

      $data = $this->db->query(
        "SELECT *
        FROM sosial
        LEFT JOIN jenj ON sosial_jenjang_id = jenj_id
        WHERE sosial_mapel_id = $mapel_id
        ORDER BY jenj_id, sosial_semester, sosial_urutan, sosial_nama")->result();

      //var_dump($data);
      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function get_topik_detail(){
    if($this->input->post('id',TRUE)){

      $mapel_id = $this->input->post('id',TRUE);

      $data = $this->db->query(
        "SELECT *
        FROM topik
        LEFT JOIN jenj ON topik_jenj_id = jenj_id
        WHERE topik_mapel_id = $mapel_id
        ORDER BY jenj_id, topik_urutan, topik_semester, topik_nama")->result();

      //var_dump($data);
      //$data = $this->product_model->get_sub_category($category_id)->result();
      echo json_encode($data);
    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }
  }

  public function proses_add(){

    $mapel_id = $this->input->post('mapel_id', true);

    if (!$mapel_id) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }else{
      $data = [
        'topik_nama' => $this->input->post('topik_nama'),
        'topik_nama_ket' => $this->input->post('topik_nama_ket'),
        'topik_semester' => $this->input->post('topik_semester'),
        'topik_urutan' => $this->input->post('topik_urutan'),
        'topik_jenj_id' => $this->input->post('jenj_id'),
        'topik_mapel_id' => $this->input->post('mapel_id')
      ];

      $this->db->insert('topik', $data);
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">KD berhasil dibuat!</div>');
      redirect('Topik_CRUD');
    }

  }

  public function add(){


    $mapel_id = $this->input->post('mapel_id', true);

    if (!$mapel_id) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

    $data['sk'] = $this->db->query(
      "SELECT mapel_sk_id
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['jenj_all'] = $this->_jenj->return_all_by_sk($data['sk']['mapel_sk_id']);

    $data['mapel_id'] = $mapel_id;
    $data['title'] = 'Tambah KD Pengetahuan';

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Topik_CRUD/add',$data);
    $this->load->view('templates/footer');

  }

  public function edit(){

    $topik_id = $this->input->post('topik_id', true);
    $mapel_id = $this->input->post('mapel_id', true);

    if(!$topik_id || !$mapel_id){
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

    $data['sk'] = $this->db->query(
      "SELECT mapel_sk_id
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

    //data karyawan yang sedang login untuk topbar
    $data['title'] = 'Edit KD';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['jenj_all'] = $this->_jenj->return_all_by_sk($data['sk']['mapel_sk_id']);
    $data['topik_update'] = $this->_topik->find_by_id($topik_id);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Topik_CRUD/edit',$data);
    $this->load->view('templates/footer');

  }

  public function edit_sosial(){

    $sosial_id = $this->input->post('sosial_id', true);
    $mapel_id = $this->input->post('mapel_id', true);

    if(!$sosial_id || !$mapel_id){
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

    $data['sk'] = $this->db->query(
      "SELECT mapel_sk_id
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

    //data karyawan yang sedang login untuk topbar
    $data['title'] = 'Edit KD Sosial';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['jenj_all'] = $this->_jenj->return_all_by_sk($data['sk']['mapel_sk_id']);
    $data['sosial_update'] = $this->_sosial->find_by_id($sosial_id);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Topik_CRUD/edit_sosial',$data);
    $this->load->view('templates/footer');

  }

  public function edit_spirit(){

    $spirit_id = $this->input->post('spirit_id', true);
    $mapel_id = $this->input->post('mapel_id', true);

    if(!$spirit_id || !$mapel_id){
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
      redirect('Profile');
    }

    $data['sk'] = $this->db->query(
      "SELECT mapel_sk_id
      FROM mapel
      WHERE mapel_id = $mapel_id")->row_array();

    //data karyawan yang sedang login untuk topbar
    $data['title'] = 'Edit KD Spiritual';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $data['jenj_all'] = $this->_jenj->return_all_by_sk($data['sk']['mapel_sk_id']);
    $data['spirit_update'] = $this->_spirit->find_by_id($spirit_id);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Topik_CRUD/edit_spirit',$data);
    $this->load->view('templates/footer');

  }

  public function edit_sosial_proses(){
    if($this->input->post('_id', true)){
      $data = [
        'sosial_nama' => $this->input->post('sosial_nama'),
        'sosial_urutan' => $this->input->post('sosial_urutan'),
        'sosial_semester' => $this->input->post('topik_semester'),
        'sosial_jenjang_id' => $this->input->post('jenj_id')
      ];

      //simpan ke db

      $this->db->where('sosial_id', $this->input->post('_id', true));
      $this->db->update('sosial', $data);

      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">KD sosial berhasil diupdate!</div>');
      redirect('Topik_CRUD');
    }
  }

  public function edit_spirit_proses(){
    if($this->input->post('_id', true)){
      $data = [
        'spirit_nama' => $this->input->post('spirit_nama'),
        'spirit_urutan' => $this->input->post('spirit_urutan'),
        'spirit_semester' => $this->input->post('topik_semester'),
        'spirit_jenjang_id' => $this->input->post('jenj_id')
      ];

      //simpan ke db

      $this->db->where('spirit_id', $this->input->post('_id', true));
      $this->db->update('spirit', $data);

      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">KD spiritual berhasil diupdate!</div>');
      redirect('Topik_CRUD');
    }
  }


  public function edit_proses(){
    if($this->input->post('_id', true)){
      $data = [
        'topik_nama' => $this->input->post('topik_nama'),
        'topik_nama_ket' => $this->input->post('topik_nama_ket'),
        'topik_semester' => $this->input->post('topik_semester'),
        'topik_urutan' => $this->input->post('topik_urutan'),
        'topik_jenj_id' => $this->input->post('jenj_id')
      ];

      //simpan ke db

      $this->db->where('topik_id', $this->input->post('_id', true));
      $this->db->update('topik', $data);

      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">KD berhasil diupdate!</div>');
      redirect('Topik_CRUD');
    }
  }
}
