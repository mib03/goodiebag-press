<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Jenis extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_model', 'jenis');

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
		$data['title'] = 'Data Jenis Barang | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['jenistable'] = $this->jenis->getAllJenis();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/barang/jenis/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required|trim|alpha', [
			'required' => 'Nama Jenis wajib diisi.'
		]);
		$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim|alpha', [
			'required' => 'Satuan wajib diisi.'
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Tambah Jenis Barang | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['idJenis'] = $this->jenis->getIdJenis();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang/jenis/insert', $data);
			$this->load->view('templates/footer');
		else :
			$data = [
				'id_jenis' => htmlspecialchars($this->input->post('id_jenis', true)),
				'jenis' => htmlspecialchars($this->input->post('nama_jenis', true)),
				'satuan' => htmlspecialchars($this->input->post('satuan', true)),
			];

			$this->db->insert('jenis', $data);
			$this->session->set_flashdata('flashCreate', 'Jenis Barang Berhasil Ditambahkan!');
			redirect('jenis');
		endif;
	}

	public function update()
	{
		$this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required|trim', [
			'required' => 'Nama Jenis wajib diisi.'
		]);
		$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim', [
			'required' => 'Satuan wajib diisi.'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Jenis Barang | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getJenis'] = $this->db->get_where('jenis', [
				'id_jenis' => $this->uri->segment(3)
			])->row_array();
			$data['idJenis'] = $this->jenis->getIdJenis();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang/jenis/update', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_jenis' => htmlspecialchars($this->input->post('id_jenis')),
				'jenis' => htmlspecialchars($this->input->post('nama_jenis', true)),
				'satuan' => htmlspecialchars($this->input->post('satuan', true)),
			];

			$this->db->where('id_jenis', $data['id_jenis']);
			$this->db->update('jenis', $data);
			$this->session->set_flashdata('flashUpdate', 'Jenis Barang Berhasil Diubah!');
			redirect('jenis');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->jenis->delete($id);
		$this->session->set_flashdata('flashDelete', 'Jenis Barang Berhasil Dihapus!');
		redirect('jenis');
	}
}
