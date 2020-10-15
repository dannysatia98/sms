<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		if($this->session->userdata('kr_jabatan_id')){
			redirect('Profile');
    }

		$this->form_validation->set_rules('kr_username', 'Username', 'required|trim');
		$this->form_validation->set_rules('kr_password', 'Password', 'required|trim');
		if($this->form_validation->run() == false){
			$data['title'] = 'LOGIN PAGE';
			$data['bgr'] = 'info';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/siswa');
			$this->load->view('templates/auth_footer');
		}
		else{
			$this->_login();
		}
	}

	private function _login(){

		$kr_username = $this->input->post('kr_username');
		$kr_password = $this->input->post('kr_password');

		$siswa = $this->db->get_where('sis', ['sis_no_induk' => $kr_username])-> row_array();

        $json = file_get_contents('http://sisterv4.frateran.sch.id/sisterv4fratz/api/loginapi?nis='.$kr_username.'&password='.$kr_password);
        $obj = json_decode($json);

		if($siswa){   //login siswa cek nis di sister
			if($obj->status == "sukses"){
				$data = [
					'kr_id' => $siswa['sis_id'],
					'kr_username' => $siswa['sis_no_induk'],
					'kr_jabatan_id' => 8,
					'kr_sk_id' => $siswa['sis_sk_id']
				];
				$this->session->set_userdata($data);
				redirect('Profile');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password</div>');
				redirect('login_siswa');
			}
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">User not exist</div>');
			redirect('login_siswa');
		}
	}

	public function logout(){
		$this->session->unset_userdata('kr_id');
		$this->session->unset_userdata('kr_username');
		$this->session->unset_userdata('kr_jabatan_id');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Logout Success!</div>');
		redirect('Login_siswa');
	}
}
