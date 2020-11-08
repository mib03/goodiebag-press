<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model', 'transaction');

		if (!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			if ($this->session->userdata('role') !== "Admin" and $this->session->userdata('role') !== "Operator") {
				redirect('Error400');
			}
		}
	}

	public function index()
	{
		$data['title'] = 'Transaksi Barang | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['barangtable'] = $this->transaction->getAllBarang();
		$data['dataSupplier'] = $this->transaction->getSupplier();
		$data['idIn'] = $this->transaction->getIdIn();
		$data['idOut'] = $this->transaction->getIdOut();

		if ($this->session->userdata('role') == "Admin") {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/transaction/index', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('role') == "Operator") {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/operator/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/transaction/index', $data);
			$this->load->view('templates/footer');
		}
	}

	public function in()
	{
		$this->form_validation->set_rules('supplier_name', 'Nama Pemasok', 'required|trim', [
			'required' => 'Pilih Nama Pemasok terlebih dahulu.'
		]);
		$this->form_validation->set_rules('quantity', 'Jumlah Barang', 'required|trim|numeric', [
			'required' => 'Jumlah Barang wajib diisi.',
			'numeric' => 'Jumlah Barang harus diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) :
			$data['getBarang'] = $this->db->get_where('barang', [
				'id_barang' => $this->uri->segment(3)
			])->row_array();
			$data['title'] = 'Transaksi Barang | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$data['barangtable'] = $this->transaction->getAllBarang();
			$data['dataSupplier'] = $this->transaction->getSupplier();
			$data['idTransaksi'] = $this->transaction->getIdIn();

			if ($this->userdata->session('role') == "Admin") {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/admin/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/transaction/index', $data);
				$this->load->view('templates/footer');
			} else if ($this->userdata->session('role') == "Operator") {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/operator/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/transaction/index', $data);
				$this->load->view('templates/footer');
			};
		else :
			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");
			$data = [
				'id_masuk' => htmlspecialchars($this->input->post('processin_id', true)),
				'id_barang' => htmlspecialchars($this->input->post('item_id', true)),
				'nama_pemasok' => htmlspecialchars($this->input->post('supplier_name', true)),
				'jumlah' => htmlspecialchars($this->input->post('quantity', true)),
				'added_by' => htmlspecialchars($this->input->post('added_by', true)),
				'date_in' => $now
			];
			$this->db->insert('masuk', $data);
			$this->session->set_flashdata('flashCreate', 'Barang Masuk Berhasil Ditambahkan!');
			redirect('transaction');
		endif;
	}

	public function out()
	{
		$this->form_validation->set_rules('distribution', 'Distribusi', 'required|trim', [
			'required' => 'Pilih Distribusi terlebih dahulu.'
		]);
		$this->form_validation->set_rules('quantity', 'Jumlah Barang', 'required|trim|numeric|callback_quality_out', [
			'required' => 'Jumlah Barang wajib diisi.',
			'numeric' => 'Jumlah Barang harus diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) :
			$data['getBarang'] = $this->db->get_where('barang', [
				'id_barang' => $this->uri->segment(3)
			])->row_array();
			$data['title'] = 'Transaksi Barang | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$data['barangtable'] = $this->transaction->getAllBarang();
			$data['idOut'] = $this->transaction->getIdOut();

			if ($this->userdata->session('role') == "Admin") {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/admin/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/transaction/index', $data);
				$this->load->view('templates/footer');
			} else if ($this->userdata->session('role') == "Operator") {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/operator/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/transaction/index', $data);
				$this->load->view('templates/footer');
			};
		else :
			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");
			$data = [
				'id_keluar' => htmlspecialchars($this->input->post('processout_id', true)),
				'id_barang' => htmlspecialchars($this->input->post('item_id', true)),
				'distribusi' => $this->input->post('distribution'),
				'jumlah' => htmlspecialchars($this->input->post('quantity', true)),
				'added_by' => htmlspecialchars($this->input->post('added_by', true)),
				'date_out' => $now
			];

			$this->db->insert('keluar', $data);
			$this->session->set_flashdata('flashCreate', 'Barang Keluar Berhasil Ditambahkan!');
			redirect('transaction');
		endif;
	}

	function quality_in()
	{
		$item_id = $this->input->post('item_id');
		$quantity = $this->input->post('quality');

		$this->db->select('id_barang');
		$this->db->from('stok');
		$this->db->where('id_barang', $item_id);
		$this->db->where('jumlah >', $quantity);
		$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			$this->form_validation->set_message('quantity', 'Jumlah barang masuk terlalu sedikit');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function quality_out()
	{
		$item_id = $this->input->post('item_id');
		$quantity = $this->input->post('quantity');

		$this->db->select('id_barang');
		$this->db->from('stok');
		$this->db->where('id_barang', $item_id);
		$this->db->where('jumlah <', $quantity);
		$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			$this->form_validation->set_message('quantity', 'Jumlah barang keluar terlalu banyak.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
