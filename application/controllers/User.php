<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');

		if (!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			if ($this->session->userdata('role') !== "Admin") {
				redirect('Error400');
			}
		}
	}

	public function index()
	{
		$data['title'] = 'Data Pengguna | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['usertable'] = $this->user->getAllUsers();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/user/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim', [
			'required' => 'Nama Lengkap wajib diisi.'
		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'Username ini sudah teregistrasi.',
			'required' => 'Username tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
			'min_length' => 'Password terlalu pendek.',
			'required' => 'Password wajib diisi.'
		]);
		$this->form_validation->set_rules('passconf', 'Confirm Password', 'required|trim|matches[password]', [
			'matches' => 'Password tidak cocok.',
			'required' => 'Konfirmasi Password wajib diisi.'
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Tambah Pengguna | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/user/insert', $data);
			$this->load->view('templates/footer');
		else :
			date_default_timezone_set('Asia/Jakarta');

			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'is_active' => 'Aktif',
				'date_created' => date("Y-m-d H:i:s"),
				'date_updated' => date("Y-m-d H:i:s"),
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('flashCreate', 'Akun Berhasil Dibuat!');
			redirect('user');
		endif;
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim', [
			'required' => 'Nama Lengkap wajib diisi'
		]);
		$this->form_validation->set_rules('username', 'username', 'required|trim', [
			'required' => 'Username tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
			'min_length' => 'Password terlalu pendek.',
			'required' => 'Password wajib diisi.'
		]);
		$this->form_validation->set_rules('passconf', 'Confirm Password', 'required|trim|matches[password]', [
			'matches' => 'Password tidak cocok.',
			'required' => 'Konfirmasi Password wajib diisi.'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Ubah Pengguna | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getUser'] = $this->db->get_where('user', [
				'user_id' => $this->uri->segment(3)
			])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/user/update', $data);
			$this->load->view('templates/footer');
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$data = [
				'user_id' => htmlspecialchars($this->input->post('id')),
				'name' => htmlspecialchars($this->input->post('name')),
				'username' => htmlspecialchars($this->input->post('username')),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
				'is_active' => $this->input->post('selectActive'),
				'date_updated' => date('Y-m-d H:i:s')
			];

			$this->db->where('user_id', $data['user_id']);
			$this->db->update('user', $data);
			$this->session->set_flashdata('flashUpdate', 'Akun Berhasil Diubah!');
			redirect('user');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->user->delete($id);
		$this->session->set_flashdata('flashDelete', 'Akun Berhasil Dihapus!');
		redirect('user');
	}
}
