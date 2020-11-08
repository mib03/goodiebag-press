<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jalan_model extends CI_Model
{
	public function getAllKendaraan()
	{
		return $this->db->get('kendaraan')->result();
	}

	public function getCurrDate()
	{
		date_default_timezone_set('Asia/Jakarta');
		return date('m/d/y');
	}

	public function getIdJalan()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_jalan, 3)) AS kd_jalan FROM jalan WHERE DATE(date_added)=CURDATE()");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$sql = ((int) $row->kd_jalan) + 1;
				$kd = sprintf("%03s", $sql);
			}
		} else {
			$kd = "001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('dmy') . "04" . $kd;
	}

	public function getPeriod($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->from('jalan');
		$this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
		$this->db->order_by('id_jalan');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllJalan()
	{
		return $this->db->get('jalan')->result();
	}
}
