<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Error400 extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Error - Goodie Bag Press';
		$data['previous'] = "javascript:history.go(-1)";
		if (isset($_SERVER['HTTP_REFERER'])) {
			$data['previous'] = $_SERVER['HTTP_REFERER'];
		}

		$this->load->view('templates/error/header', $data);
		$this->load->view('templates/error/topbar');
		$this->load->view('error/400', $data);
		$this->load->view('templates/error/footer');
	}
}
