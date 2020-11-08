<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Purchase extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('purchase_model', 'purchase');
		$this->load->library('pdf');

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
		$data['title'] = 'Pesanan Pembelian | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['potable'] = $this->purchase->getAllPurchase();
		$data['idPurchase'] = $this->purchase->getIdPurchase();
		$data['barangtable'] = $this->purchase->getAllBarang();
		$data['dataSupplier'] = $this->purchase->getAllSupplier();
		$data['dateNow'] = $this->purchase->getCurrDate();

		if ($this->session->userdata('role') == "Admin") {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/purchase/index', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('role') == "Operator") {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/operator/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/purchase/index', $data);
			$this->load->view('templates/footer');
		}
	}

	public function details()
	{
		$data['title'] = 'Rincian Pesanan Pembelian | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['getData'] = $this->purchase->getPembelian2();
		$data['getFaktur'] = $this->db->get_where('pembelian2', [
			'no_faktur' => $this->uri->segment(3)
		])->row_array();
		$data['getPemasok'] = $this->db->get_where('pembelian', [
			'no_faktur' => $this->uri->segment(3)
		])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/purchase/report/details/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('id_barang', 'Kode Barang', 'required|trim', [
			'required' => 'Kode Barang wajib diisi.'
		]);
		$this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required|trim|numeric', [
			'required' => 'Jumlah Barang wajib diisi.',
			'numeric' => 'Jumlah Barang wajib diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Pesanan Pembelian | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$data['potable'] = $this->purchase->getAllPurchase();
			$data['idPurchase'] = $this->purchase->getIdPurchase();
			$data['barangtable'] = $this->purchase->getAllBarang();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/purchase/index', $data);
			$this->load->view('templates/footer');
		else :
			$data = [
				'no_faktur' => htmlspecialchars($this->input->post('no_faktur', true)),
				'id_barang' => htmlspecialchars($this->input->post('id_barang', true)),
				'harga' => htmlspecialchars($this->input->post('harga', true)),
				'jumlah' => htmlspecialchars($this->input->post('jumlah', true)),
				'subtotal' => htmlspecialchars($this->input->post('subtotal', true))
			];

			$this->db->insert('pembelian3', $data);
			$this->session->set_flashdata('flashCreate', 'Barang Berhasil Ditambahkan!');
			redirect('purchase');
		endif;
	}

	public function buy()
	{
		$this->form_validation->set_rules('total', 'Total Harga', 'required|trim', [
			'required' => 'Pembelian tidak boleh kosong.'
		]);
		$this->form_validation->set_rules('nama_pemasok', 'Nama Pemasok', 'required|trim', [
			'required' => 'Nama Pemasok wajib diisi.'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Pesanan Pembelian | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

			$data['potable'] = $this->purchase->getAllPurchase();
			$data['idPurchase'] = $this->purchase->getIdPurchase();
			$data['barangtable'] = $this->purchase->getAllBarang();
			$data['dateNow'] = $this->purchase->getCurrDate();
			$data['dataSupplier'] = $this->purchase->getAllSupplier();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/purchase/index', $data);
			$this->load->view('templates/footer');
		} else {
			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");
			$tgl = date("Y-m-d");
			$sql = 'INSERT INTO pembelian2 (no_faktur, id_barang, harga, jumlah, subtotal) SELECT * FROM pembelian3';
			$data = [
				'no_faktur' => htmlspecialchars($this->input->post('no_faktur', true)),
				'tanggal' => $tgl,
				'nama_pemasok' => htmlspecialchars($this->input->post('nama_pemasok', true)),
				'harga' => htmlspecialchars($this->input->post('total', true)),
				'added_by' => htmlspecialchars($this->input->post('added_by', true)),
				'date_added' => $now
			];
			if ($this->db->query($sql)) {
				$this->db->insert('pembelian', $data);
				$this->db->truncate('pembelian3');
				$this->session->set_flashdata('flashCreate', 'Pesanan Berhasil Dibuat!');
				redirect('purchase');
			}
		}
	}

	public function delete()
	{
		$this->db->truncate('pembelian3');
		$this->session->set_flashdata('flashDelete', 'Pesanan Berhasil Dihapus!');
		redirect('purchase');
	}

	public function report()
	{
		$this->form_validation->set_rules('showData', 'Tampilkan Data', 'trim|required');
		if ($this->form_validation->run() == true) {
			if ($this->input->post('showData') === "allData") {
				$this->all();
			} else if ($this->input->post('showData') === "dateRange") {
				$this->period();
			};
		} else {
			$data['title'] = 'Laporan Pesanan Pembelian | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getData'] = $this->purchase->getPembelian();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/purchase/report/index', $data);
			$this->load->view('templates/footer');
		};
	}

	public function all()
	{
		$data['purchase'] = $this->purchase->getPembelian();
		$this->load->view('admin/purchase/report/all', $data);
	}

	public function period()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data['purchase'] = $this->purchase->getPeriod($tgl_awal, $tgl_akhir);
		$this->load->view('admin/purchase/report/period', $data);
	}

	public function reportdetails()
	{
		$data['getFaktur'] = $this->db->get_where('pembelian2', [
			'no_faktur' => $this->uri->segment(3)
		])->row_array();
		$data['getPemasok'] = $this->db->get_where('pembelian', [
			'no_faktur' => $this->uri->segment(3)
		])->row_array();
		$data['getData'] = $this->purchase->getPembelian2();
		$this->load->view('admin/purchase/report/details/details', $data);
	}
}
