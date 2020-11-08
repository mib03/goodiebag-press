<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Auth extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('username')) {
			if ($this->session->userdata('role') == "Admin") {
				redirect('admin');
			} else {
				redirect('operator');
			}
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required', [
			'required' => 'Username tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Password tidak boleh kosong.'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login | Goodie Bag Press';
			$this->load->view('templates/auth/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth/auth_footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		if ($user) {
			//jika usernya ada
			if ($user['is_active'] == 'Aktif') {
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'username' => $user['username'],
						'role' => $user['role']
					];
					$this->session->set_userdata($data);
					if ($user['role'] == 'Admin') {
						redirect('admin');
					} else if ($user['role'] == 'Operator') {
						redirect('operator');
					}
				} else {
					$this->session->set_flashdata('flashWrong', 'Password salah.');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('flashActivate', 'Username ini tidak aktif.');
				redirect('auth');
			}
		} else {
			//jika usernya tidak ada
			$this->session->set_flashdata('flashRegister', 'Username tidak terdaftar.');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role');
		$this->session->set_flashdata('flashLogout', 'Anda telah berhasil logout!');
		redirect('auth');
	}
}
