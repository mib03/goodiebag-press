<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Stock extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('stock_model', 'stock');
		$this->load->library('pdf');

		if (!$this->session->userdata('username')) {
			redirect('auth');
		} else {
			if ($this->session->userdata('role') !== "Admin" && $this->session->userdata('role') !== "Operator") {
				redirect('Error400');
			}
		}
	}

	public function report()
	{
		$data['title'] = 'Laporan Stok Barang | Goodie Bag Press';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['getData'] = $this->stock->getAllStock();

		if ($this->session->userdata('role') == "Admin") {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/admin/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/stock/report/index', $data);
			$this->load->view('templates/footer');
		} else if ($this->session->userdata('role') == "Operator") {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/operator/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/stock/report/index', $data);
			$this->load->view('templates/footer');
		}
	}

	public function all()
	{
		$data['stock'] = $this->stock->getAllStock();
		$this->load->view('admin/stock/report/all', $data);
	}
}
