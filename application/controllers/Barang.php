<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model', 'barang');

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
		$data['title'] = 'Data Barang | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['barangtable'] = $this->barang->getAllBarang();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/barang/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('item_name', 'Nama Barang', 'required|trim|callback_item_name', [
			'required' => 'Nama Barang wajib diisi.'
		]);
		$this->form_validation->set_rules('selectType', 'Jenis Barang', 'required|trim', [
			'required' => 'Pilih Jenis Barang terlebih dahulu.'
		]);
		$this->form_validation->set_rules('color', 'Warna', 'required|trim', [
			'required' => 'Warna Barang wajib diisi.'
		]);
		$this->form_validation->set_rules('buy_price', 'Harga Beli', 'required|trim|numeric', [
			'required' => 'Harga Beli wajib diisi.',
			'numeric' => 'Harga Beli harus diisi dengan angka.'
		]);
		$this->form_validation->set_rules('min_jumlah', 'Minimal Stok', 'required|trim|numeric', [
			'required' => 'Minimal Jumlah wajib diisi.',
			'numeric' => 'Minimal Jumlah harus diisi dengan angka.'
		]);
		$this->form_validation->set_rules('maks_jumlah', 'Maksimal Stok', 'required|trim|numeric', [
			'required' => 'Maksimal Jumlah wajib diisi.',
			'numeric' => 'Maksimal Jumlah harus diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Tambah Barang | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['idBarang'] = $this->barang->getIdBarang();
			$data['idStock'] = $this->barang->getIdStock();
			$data['getJenis'] = $this->barang->getAllJenis();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang/insert', $data);
			$this->load->view('templates/footer');
		else :
			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");

			$data = [
				'id_barang' => htmlspecialchars($this->input->post('item_id', true)),
				'nama_barang' => htmlspecialchars($this->input->post('item_name', true)),
				'jenis' => $this->input->post('selectType'),
				'satuan' => htmlspecialchars($this->input->post('satuan', true)),
				'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
				'warna' => htmlspecialchars($this->input->post('color', true)),
				'harga_beli' => htmlspecialchars($this->input->post('buy_price', true)),
				'date_added' => $now,
				'date_updated' => $now
			];

			$this->db->insert('barang', $data);
			$data2 = [
				'id_stok' => htmlspecialchars($this->input->post('stock_id', true)),
				'id_barang' => htmlspecialchars($this->input->post('item_id', true)),
				'jumlah' => 0,
				'min_jumlah' => htmlspecialchars($this->input->post('min_jumlah', true)),
				'maks_jumlah' => htmlspecialchars($this->input->post('maks_jumlah', true))
			];
			$this->db->insert('stok', $data2);
			$this->session->set_flashdata('flashCreate', 'Barang Berhasil Ditambahkan!');
			redirect('barang');
		endif;
	}

	public function update()
	{
		$this->form_validation->set_rules('item_name', 'Nama Barang', 'required|trim|callback_item_name', [
			'required' => 'Nama Barang wajib diisi.'
		]);
		$this->form_validation->set_rules('selectType', 'Tipe Barang', 'required|trim', [
			'required' => 'Pilih Tipe Barang terlebih dahulu.'
		]);
		$this->form_validation->set_rules('color', 'Warna', 'required|trim|alpha', [
			'required' => 'Warna Barang wajib diisi.'
		]);
		$this->form_validation->set_rules('buy_price', 'Harga Beli', 'required|trim|numeric', [
			'required' => 'Harga Beli wajib diisi.',
			'numeric' => 'Harga Beli harus diisi dengan angka.'
		]);
		$this->form_validation->set_rules('min_jumlah', 'Minimal Stok', 'required|trim|numeric', [
			'required' => 'Minimal Jumlah wajib diisi.',
			'numeric' => 'Minimal Jumlah harus diisi dengan angka.'
		]);
		$this->form_validation->set_rules('maks_jumlah', 'Maksimal Stok', 'required|trim|numeric', [
			'required' => 'Maksimal Jumlah wajib diisi.',
			'numeric' => 'Maksimal Jumlah harus diisi dengan angka.'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Barang | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getBarang'] = $this->db->get_where('barang', [
				'id_barang' => $this->uri->segment(3)
			])->row_array();
			$data['getJenis'] = $this->barang->getAllJenis();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang/update', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_barang' => htmlspecialchars($this->input->post('item_id')),
				'nama_barang' => htmlspecialchars($this->input->post('item_name', true)),
				'jenis' => $this->input->post('selectType'),
				'satuan' => htmlspecialchars($this->input->post('satuan', true)),
				'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
				'warna' => htmlspecialchars($this->input->post('color', true)),
				'harga_beli' => htmlspecialchars($this->input->post('buy_price', true)),
				'date_updated' => date("Y-m-d H:i:s")
			];

			$this->db->where('id_barang', $data['id_barang']);
			$this->db->update('barang', $data);

			$data2 = [
				'id_barang' => htmlspecialchars($this->input->post('item_id')),
				'min_jumlah' => htmlspecialchars($this->input->post('min_jumlah', true)),
				'maks_jumlah' => htmlspecialchars($this->input->post('maks_jumlah', true))
			];

			$this->db->where('id_barang', $data2['id_barang']);
			$this->db->update('stok', $data2);

			$this->session->set_flashdata('flashUpdate', 'Barang Berhasil Diubah!');
			redirect('barang');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->barang->delete($id);
		$this->barang->deleteStok($id);
		$this->session->set_flashdata('flashDelete', 'Barang Berhasil Dihapus!');
		redirect('barang');
	}

	function item_name()
	{
		if ($this->input->post('selectType') == "Tas") {
			$info = $this->input->post('size');
		} else if ($this->input->post('selectType') == "Tinta") {
			$info = $this->input->post('jenis');
		} else {
			$info = "";
		}
		$item_name = $this->input->post('item_name');
		$type = $this->input->post('selectType');
		$information = $info;
		$color = $this->input->post('color');
		$buy_price = $this->input->post('buy_price');

		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('nama_barang', $item_name);
		$this->db->where('jenis', $type);
		$this->db->where('keterangan', $information);
		$this->db->where('warna', $color);
		$this->db->where('harga_beli', $buy_price);
		$query = $this->db->get();
		$num = $query->num_rows();
		if ($num > 0) {
			$this->form_validation->set_message('item_name', 'Data barang ini sudah ada.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
