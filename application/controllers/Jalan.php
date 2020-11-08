<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Jalan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jalan_model', 'jalan');

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
		$this->form_validation->set_rules('no_faktur', 'Nomor Faktur', 'required|trim|is_unique[jalan.no_faktur]|callback_faktur_check|callback_faktur_jalan_check', [
			'required' => 'Nomor Faktur wajib diisi.',
			'is_unique' => 'Nomor Faktur sudah ada',
			'callback_faktur_check' => 'Nomor Faktur tidak tersedia.',
			'callback_faktur_jalan_check' => 'Nomor Faktur sudah ada.'
		]);
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
			'required' => 'Tanggal wajib diisi.'
		]);
		$this->form_validation->set_rules('nama_kurir', 'Nama Kurir', 'required|trim', [
			'required' => 'Nama Kurir wajib diisi.'
		]);
		$this->form_validation->set_rules('kendaraan', 'Nama Kendaraan', 'required|trim', [
			'required' => 'Pilih Kendaraan terlebih dahulu.'
		]);
		$this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required|trim', [
			'required' => 'Nama Perusahaan wajib diisi.'
		]);
		$this->form_validation->set_rules('no_pol', 'Nomor Polisi', 'required|trim', [
			'required' => 'Nomor Polisi wajib diisi.',
		]);

		if ($this->form_validation->run() == false) :
			$data['title'] = 'Surat Jalan | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getJalan'] = $this->jalan->getAllJalan();
			$data['getKendaraan'] = $this->jalan->getAllKendaraan();
			$data['dateNow'] = $this->jalan->getCurrDate();
			$data['getId'] = $this->jalan->getIdJalan();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/jalan/index', $data);
			$this->load->view('templates/footer');
		else :

			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d H:i:s");

			$data = [
				'id_jalan' => htmlspecialchars($this->input->post('id_jalan', true)),
				'no_faktur' => htmlspecialchars($this->input->post('no_faktur', true)),
				'tanggal' => htmlspecialchars($this->input->post('tanggal')),
				'nama_kurir' => htmlspecialchars($this->input->post('nama_kurir', true)),
				'nama_kendaraan' => $this->input->post('kendaraan', true),
				'perusahaan' => $this->input->post('perusahaan', true),
				'no_polisi' => htmlspecialchars($this->input->post('no_pol', true)),
				'added_by' => htmlspecialchars($this->input->post('added_by', true)),
				'date_added' => $now
			];

			$this->db->insert('jalan', $data);
			$this->session->set_flashdata('flashCreate', 'Surat Jalan Berhasil Ditambahkan!');
			redirect('jalan');
		endif;
	}

	function faktur_check()
	{
		$nofak = $this->input->post('no_faktur');
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->where('no_faktur', $nofak);
		$query = $this->db->get();
		$sql = $query->num_rows();
		if ($sql > 0) {
			return TRUE;
		} else {
			$this->form_validation->set_message('no_faktur', 'Nomor Faktur tidak ditemukan.');
			return FALSE;
		};
	}

	function faktur_jalan_check()
	{
		$nofak = $this->input->post('no_faktur');
		$this->db->select('*');
		$this->db->from('jalan');
		$this->db->where('no_faktur', $nofak);
		$query = $this->db->get();
		$sql = $query->num_rows();
		if ($sql > 0) {
			return FALSE;
		} else {
			$this->form_validation->set_message('no_faktur', 'Nomor Faktur sudah ada.');
			return TRUE;
		};
	}

	public function report()
	{
		$this->form_validation->set_rules('showData', 'Tampilkan Data', 'trim|required');
		if ($this->form_validation->run()) {
			if ($this->input->post('showData') == "allData") {
				$this->all();
			} else if ($this->input->post('showData') == "dateRange") {
				$this->period();
			};
		} else {
			$data['title'] = 'Laporan Surat Jalan | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getData'] = $this->jalan->getAllJalan();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/jalan/report/index', $data);
			$this->load->view('templates/footer');
		};
	}

	public function all()
	{
		$data['jalan'] = $this->jalan->getAllJalan();
		$this->load->view('admin/jalan/report/all', $data);
	}

	public function period()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data['jalan'] = $this->jalan->getPeriod($tgl_awal, $tgl_akhir);
		$this->load->view('admin/jalan/report/period', $data);
	}
}
