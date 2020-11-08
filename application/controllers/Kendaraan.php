<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Kendaraan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kendaraan_model', 'kendaraan');

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
		$data['title'] = 'Data Kendaraan | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['kendaraantable'] = $this->kendaraan->getAllKendaraan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/barang/kendaraan/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_kendaraan', 'Nama Kendaraan', 'required|trim', [
			'required' => 'Nama Kendaraan wajib diisi.'
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Tambah Kendaraan | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['idKendaraan'] = $this->kendaraan->getIdKendaraan();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang/kendaraan/insert', $data);
			$this->load->view('templates/footer');
		else :
			$data = [
				'id_kendaraan' => htmlspecialchars($this->input->post('id_kendaraan', true)),
				'nama_kendaraan' => htmlspecialchars($this->input->post('nama_kendaraan', true)),
			];

			$this->db->insert('kendaraan', $data);
			$this->session->set_flashdata('flashCreate', 'Kendaraan Berhasil Ditambahkan!');
			redirect('kendaraan');
		endif;
	}

	public function update()
	{
		$this->form_validation->set_rules('nama_kendaraan', 'Nama Kendaraan', 'required|trim', [
			'required' => 'Nama Kendaraan wajib diisi.'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Kendaraan | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getKendaraan'] = $this->db->get_where('kendaraan', [
				'id_kendaraan' => $this->uri->segment(3)
			])->row_array();
			$data['idKendaraan'] = $this->kendaraan->getIdKendaraan();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang/kendaraan/update', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_kendaraan' => htmlspecialchars($this->input->post('id_kendaraan')),
				'nama_kendaraan' => htmlspecialchars($this->input->post('nama_kendaraan', true)),
			];

			$this->db->where('id_kendaraan', $data['id_kendaraan']);
			$this->db->update('kendaraan', $data);
			$this->session->set_flashdata('flashUpdate', 'Kendaraan Berhasil Diubah!');
			redirect('kendaraan');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->kendaraan->delete($id);
		$this->session->set_flashdata('flashDelete', 'Kendaraan Berhasil Dihapus!');
		redirect('kendaraan');
	}
}
