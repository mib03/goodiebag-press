<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class In extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('in_model', 'in');
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
			$data['title'] = 'Laporan Barang Masuk | Goodie Bag Press';
			$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
			$data['getData'] = $this->in->getAllIn();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/transaction/report/in/index', $data);
			$this->load->view('templates/footer');
		};
	}

	public function all()
	{
		$data['in'] = $this->in->getAllIn();
		$this->load->view('admin/transaction/report/in/all', $data);
	}

	public function period()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$data['in'] = $this->in->getPeriod($tgl_awal, $tgl_akhir);
		$this->load->view('admin/transaction/report/in/period', $data);
	}
}
