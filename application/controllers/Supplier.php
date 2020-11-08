<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Supplier extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('supplier_model', 'supplier');

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
		$data['title'] = 'Data Pemasok | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['suppliertable'] = $this->supplier->getAllSupplier();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/supplier/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('supplier_name', 'Nama Pemasok', 'required|trim|callback_supplier_name', [
			'required' => 'Nama Pemasok wajib diisi.'
		]);
		$this->form_validation->set_rules('address', 'Alamat', 'required|trim', [
			'required' => 'Alamat Pemasok wajib diisi.'
		]);
		$this->form_validation->set_rules('phone', 'Harga Jual', 'required|trim|numeric', [
			'required' => 'Nomor Telepon/Handphone wajib diisi.',
			'numeric' => 'Nomor Telepon/Handphone harus diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Tambah Pemasok | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['idSupplier'] = $this->supplier->getIdSupplier();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/supplier/insert', $data);
			$this->load->view('templates/footer');
		else :
			$data = [
				'id_pemasok' => htmlspecialchars($this->input->post('supplier_id', true)),
				'nama_pemasok' => htmlspecialchars($this->input->post('supplier_name', true)),
				'alamat' => htmlspecialchars($this->input->post('address', true)),
				'no_telp' => htmlspecialchars($this->input->post('phone', true)),
				'date_added' => date("Y-m-d H:i:s"),
				'date_updated' => date("Y-m-d H:i:s")
			];

			$this->db->insert('pemasok', $data);
			$this->session->set_flashdata('flashCreate', 'Pemasok Berhasil Ditambahkan!');
			redirect('supplier');
		endif;
	}

	public function update()
	{
		$this->form_validation->set_rules('supplier_name', 'Nama Pemasok', 'required|trim|callback_supplier_name', [
			'required' => 'Nama Pemasok wajib diisi.'
		]);
		$this->form_validation->set_rules('address', 'Alamat Pemasok', 'required|trim', [
			'required' => 'Alamat Pemasok wajib diisi.'
		]);
		$this->form_validation->set_rules('phone', 'Nomor Telepon/Handphone', 'required|trim|numeric', [
			'required' => 'Nomor Telepon/Handphone wajib diisi.',
			'numeric' => 'Nomor Telepon/Handphone harus diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Pemasok | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getSupplier'] = $this->db->get_where('pemasok', [
				'id_pemasok' => $this->uri->segment(3)
			])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/supplier/update', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_pemasok' => htmlspecialchars($this->input->post('id')),
				'nama_pemasok' => htmlspecialchars($this->input->post('supplier_name')),
				'alamat' => htmlspecialchars($this->input->post('address')),
				'no_telp' => htmlspecialchars($this->input->post('phone')),
				'date_updated' => date("Y-m-d H:i:s")
			];

			$this->db->where('id_pemasok', $data['id_pemasok']);
			$this->db->update('pemasok', $data);
			$this->session->set_flashdata('flashUpdate', 'Pemasok Berhasil Diubah!');
			redirect('supplier');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->supplier->delete($id);
		$this->session->set_flashdata('flashDelete', 'Pemasok Berhasil Dihapus!');
		redirect('supplier');
	}

	function supplier_name()
	{
		$supplier_name = $this->input->post('supplier_name');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');

		$this->db->select('nama_pemasok');
		$this->db->from('pemasok');
		$this->db->where('nama_pemasok', $supplier_name);
		$this->db->where('alamat', $address);
		$this->db->where('no_telp', $phone);
		$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			$this->form_validation->set_message('supplier_name', 'Data pemasok ini sudah ada.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
