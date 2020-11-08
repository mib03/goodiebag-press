<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Operator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			if ($this->session->userdata('role') !== "Operator") {
				redirect('Error400');
			}
		}
	}

	public function index()
	{
		$data['title'] = 'Halaman Utama | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/operator/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('operator/index', $data);
		$this->load->view('templates/footer');
	}

	public function profile()
	{
		$data['title'] = 'Edit Profil | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|alpha_numeric_spaces', [
			'required' => 'Nama Lengkap wajib diisi.',
			'alpha_numeric_spaces' => 'Nama Lengkap harus diisi dengan alfabet.'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/operator/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('operator/profile/index', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('full_name');
			$username = $this->input->post('username');

			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'png|jpg';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$this->db->set('name', $name);
			$this->db->where('username', $username);
			$this->db->update('user');
			$this->session->set_flashdata('flashUpdate', 'Profil berhasil diperbarui!');
			redirect('operator/profile');
		};
	}
}
