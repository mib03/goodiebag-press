<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Out extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('out_model', 'out');
		$this->load->library('pdf');

		if (!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			if ($this->session->userdata('role') !== "Admin") {
				redirect('Error400');
			}
		}
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
			$data['title'] = 'Laporan Barang Keluar | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getData'] = $this->out->getAllOut();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/transaction/report/out/index', $data);
			$this->load->view('templates/footer');
		};
	}

	public function all()
	{
		$data['out'] = $this->out->getAllOut();
		$this->load->view('admin/transaction/report/out/all', $data);
	}

	public function period()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data['out'] = $this->out->getPeriod($tgl_awal, $tgl_akhir);
		$this->load->view('admin/transaction/report/out/period', $data);
	}
}
