<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('admin_model', 'admin');

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
		$data['title'] = 'Dashboard | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['currMonth'] = $this->admin->currMonth();
		$data['countBarang'] = $this->admin->countBarang();
		$data['countBeli'] = $this->admin->countBeli();
		$data['countMasuk'] = $this->admin->countMasuk();
		$data['countKeluar'] = $this->admin->countKeluar();

		$data['getStokDikit'] = $this->admin->getStokDikit();
		$data['getStokBanyak'] = $this->admin->getStokBanyak();

		$data['getMasuk'] = $this->admin->getMasuk();
		$data['getKeluar'] = $this->admin->getKeluar();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
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
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/profile/index', $data);
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
			redirect('admin/profile');
		};
	}
}
