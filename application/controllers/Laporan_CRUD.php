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
    $data['title'] = 'DKN Nominasi UN';

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

  public function index_dkn_un_show(){

    if($this->input->post('t_id',TRUE)){

      $data['title'] = 'DKN Nominasi UN';

      $data['t_id'] = $this->input->post('t',TRUE);
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

      $kelas_id = $this->input->post('kelas_id',TRUE);
      $data['sis_all'] = $this->db->query
                      ("SELECT d_s_id, sis_nama_bel, sis_nama_depan, sis_no_induk, sis_id
                      FROM d_s
                      LEFT JOIN sis ON sis_id = d_s_sis_id
                      LEFT JOIN kelas ON d_s_kelas_id = kelas_id
                      WHERE kelas_id = $kelas_id
                      ORDER BY sis_nama_depan, sis_no_induk")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('Laporan_crud/index_dkn_un_show',$data);
      $this->load->view('templates/footer');

    }else{
      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akses Ditolak!</div>');
      redirect('Profile');
    }
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
    $data['title'] = 'Ranking Pararel';

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

  public function index_rank_show(){
    if($this->input->post('jenj_id',TRUE)){

      $jenj_id = $this->input->post('jenj_id',TRUE);
      $program_id = $this->input->post('program_id',TRUE);
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
      $data['title'] = 'Ranking Pararel';

      $data['sis_all'] = $this->db->query
                      ("SELECT d_s_id, sis_nama_bel, sis_nama_depan, sis_no_induk, kelas_nama, kelas_id
                      FROM d_s
                      LEFT JOIN sis ON sis_id = d_s_sis_id
                      LEFT JOIN kelas ON d_s_kelas_id = kelas_id
                      WHERE kelas_program_id = $program_id AND kelas_jenj_id = $jenj_id
                      ORDER BY sis_nama_depan, sis_no_induk")->result_array();


      //kelas siswa yang pertama
      $kelas_id = $data['sis_all'][0]['kelas_id'];

      $data['semester'] = $this->input->post('semester',TRUE);
      //var_dump($kelas_id);

      $data['mapel_all'] = $this->db->query
                      ("SELECT mapel_id, mapel_nama, mapel_sing
                      FROM d_mpl
                      LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
                      WHERE d_mpl_kelas_id = $kelas_id
                      GROUP BY mapel_id
                      ORDER BY mapel_kel, mapel_urutan")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('Laporan_crud/index_rank_show',$data);
      $this->load->view('templates/footer');

    }
  }

  public function index_dkn_naik_show(){
    if($this->input->post('t_id',TRUE)){

      $kelas_id = $this->input->post('kelas_id',TRUE);
      $t_id = $this->input->post('t_id',TRUE);

      $data['t'] = $this->db->query
                      ("SELECT *
                      FROM t
                      WHERE t_id = $t_id")->row_array();

      $data['kelas'] = $this->db->query
                      ("SELECT *
                      FROM kelas
                      WHERE kelas_id = $kelas_id")->row_array();


      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
      $data['title'] = 'DKN Kenaikan Kelas';

      $data['sis_all'] = $this->db->query
                      ("SELECT d_s_id, sis_nama_bel, sis_nama_depan, sis_no_induk, kelas_nama, kelas_id
                      FROM d_s
                      LEFT JOIN sis ON sis_id = d_s_sis_id
                      LEFT JOIN kelas ON d_s_kelas_id = kelas_id
                      WHERE kelas_id = $kelas_id
                      ORDER BY sis_nama_depan, sis_no_induk")->result_array();


      $data['mapel_all'] = $this->db->query
                      ("SELECT mapel_id, mapel_nama, mapel_sing
                      FROM d_mpl
                      LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
                      WHERE d_mpl_kelas_id = $kelas_id AND mapel_bk = 0
                      GROUP BY mapel_id
                      ORDER BY mapel_kel, mapel_urutan")->result_array();


      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('Laporan_crud/index_dkn_naik_show',$data);
      $this->load->view('templates/footer');
    }
  }

  public function index_nilai(){

    $data['title'] = 'Pantauan Input Nilai';

    $data['t_all'] = $this->_t->return_all();
    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_nilai',$data);
    $this->load->view('templates/footer');
  }

  public function index_nilai_show(){

    if($this->input->post('t_id',TRUE)){

      $data['title'] = 'Pantauan Input Nilai';
      $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
      $t_id = $this->input->post('t_id',TRUE);
      $data['tahun'] = $this->db->query
                      ("SELECT *
                      FROM t
                      WHERE t_id = $t_id")->row_array();
      $data['kelas_all'] = $this->db->query
                      ("SELECT *
                      FROM kelas
                      WHERE kelas_t_id = $t_id
                      ORDER BY kelas_jenj_id, kelas_program_id, kelas_nama")->result_array();

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('Laporan_crud/index_nilai_show',$data);
      $this->load->view('templates/footer');
    }
  }

  public function index_ketuntasan(){
    $data['title'] = 'Ketuntasan Klasikal Per Mapel';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    if($this->session->userdata('kr_jabatan_id')==4){
      $data['waka'] = 1;
    }else{
      $data['waka'] = 0;
    }

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_ketuntasan',$data);
    $this->load->view('templates/footer');
  }

  public function index_ketuntasan_show(){
    $data['title'] = 'Ketuntasan Klasikal Per Mapel';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $t_id = $this->input->post('t_id',TRUE);
    $data['sem'] = $this->input->post('sem',TRUE);

    $data['t'] = $this->db->query
                    ("SELECT t_id, t_nama
                    FROM t
                    WHERE t_id = $t_id
                    ORDER BY t_nama")->row_array();

    //jika dia wakakur semua kelas
    if($this->session->userdata('kr_jabatan_id')==4){

      $mapel_id = $this->input->post('mapel_id',TRUE);

      $data['detail_tampil'] = $this->input->post('detail_tampil',TRUE);

      $data['m_nama'] = $this->db->query
                      ("SELECT mapel_nama
                      FROM mapel
                      WHERE mapel_id = $mapel_id")->row_array();

      $data['d_all'] = $this->db->query
                      ("SELECT d_mpl_mapel_id, mapel_nama, kelas_id, kelas_nama, kelas_jenj_id, mapel_kkm
                      FROM d_mpl
                      LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
                      LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
                      WHERE kelas_t_id = $t_id AND d_mpl_mapel_id = $mapel_id
                      ORDER BY kelas_nama")->result_array();
    }

    //jika dia guru hanya mapel yang diajar dan kelas yang diajar
    if($this->session->userdata('kr_jabatan_id')==7){
      $kr_id = $data['kr']['kr_id'];
      $data['detail_tampil'] = 1;

      $data['d_all'] = $this->db->query
                      ("SELECT d_mpl_mapel_id, mapel_nama, kelas_id, kelas_nama, kelas_jenj_id, mapel_kkm
                      FROM d_mpl
                      LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
                      LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
                      WHERE kelas_t_id = $t_id AND d_mpl_kr_id = $kr_id
                      ORDER BY kelas_nama")->result_array();
    }


    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_ketuntasan_show',$data);
    $this->load->view('templates/footer');
  }

  public function get_mapel(){
    if($this->input->post('t_id',TRUE)){

      $t_id = $this->input->post('t_id',TRUE);

      $data = $this->db->query(
        "SELECT mapel_id, mapel_nama, mapel_sing
        FROM d_mpl
        LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
        LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
        WHERE kelas_t_id = $t_id AND mapel_bk = 0
        GROUP BY d_mpl_mapel_id
        ORDER BY mapel_nama")->result();

      echo json_encode($data);
    }
  }

  public function index_rekap(){
    $data['title'] = 'Rekap Nilai';

    //data karyawan yang sedang login untuk topbar
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));

    $kr_id = $data['kr']['kr_id'];

    $data['t_all'] = $this->_t->return_all();

    if($this->session->userdata('kr_jabatan_id')==4){
      $data['waka'] = 1;
    }else{
      $data['waka'] = 0;
    }

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_rekap',$data);
    $this->load->view('templates/footer');
  }

  public function index_rekap_show(){
    $data['title'] = 'Rekap Nilai';
    $data['kr'] = $this->_kr->find_by_username($this->session->userdata('kr_username'));
    $t_id = $this->input->post('t_id',TRUE);
    $data['sem'] = $this->input->post('sem',TRUE);

    $data['t'] = $this->db->query
                    ("SELECT t_id, t_nama
                    FROM t
                    WHERE t_id = $t_id
                    ORDER BY t_nama")->row_array();

    //jika dia wakakur semua kelas
    if($this->session->userdata('kr_jabatan_id')==4){

      $mapel_id = $this->input->post('mapel_id',TRUE);

      $data['detail_tampil'] = $this->input->post('detail_tampil',TRUE);

      $data['m_nama'] = $this->db->query
                      ("SELECT mapel_nama
                      FROM mapel
                      WHERE mapel_id = $mapel_id")->row_array();

      $data['d_all'] = $this->db->query
                      ("SELECT d_mpl_mapel_id, mapel_nama, kelas_id, kelas_nama, kelas_jenj_id, mapel_kkm
                      FROM d_mpl
                      LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
                      LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
                      WHERE kelas_t_id = $t_id AND d_mpl_mapel_id = $mapel_id
                      ORDER BY kelas_nama")->result_array();
    }

    //jika dia guru hanya mapel yang diajar dan kelas yang diajar
    if($this->session->userdata('kr_jabatan_id')==7){
      $kr_id = $data['kr']['kr_id'];
      $data['detail_tampil'] = 1;

      $data['d_all'] = $this->db->query
                      ("SELECT d_mpl_mapel_id, mapel_nama, kelas_id, kelas_nama, kelas_jenj_id, mapel_kkm
                      FROM d_mpl
                      LEFT JOIN mapel ON d_mpl_mapel_id = mapel_id
                      LEFT JOIN kelas ON d_mpl_kelas_id = kelas_id
                      WHERE kelas_t_id = $t_id AND d_mpl_kr_id = $kr_id
                      ORDER BY kelas_nama")->result_array();
    }


    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('Laporan_crud/index_rekap_show',$data);
    $this->load->view('templates/footer');
  }

}
