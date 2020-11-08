<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	public function currMonth()
	{
		setlocale(LC_ALL, 'IND');
		$bulan = strftime('%B %y');
		return $bulan;
	}

	public function countBarang()
	{
		$query = $this->db->get('barang');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function countBeli()
	{
		date_default_timezone_set('Asia/Jakarta');
		$currYM = date('Y-m');
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->where("DATE_FORMAT(date_added,'%Y-%m')", $currYM);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function countMasuk()
	{
		date_default_timezone_set('Asia/Jakarta');
		$currYM = date('Y-m');
		$this->db->select('*');
		$this->db->from('masuk');
		$this->db->where("DATE_FORMAT(date_in,'%Y-%m')", $currYM);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function countKeluar()
	{
		date_default_timezone_set('Asia/Jakarta');
		$currYM = date('Y-m');
		$this->db->select('*');
		$this->db->from('keluar');
		$this->db->where("DATE_FORMAT(date_out,'%Y-%m')", $currYM);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function getStokDikit()
	{
		$query = $this->db->query('SELECT * FROM barang JOIN stok ON barang.id_barang = stok.id_barang WHERE jumlah < min_jumlah LIMIT 5');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function getStokBanyak()
	{
		$this->db->limit(5);
		$query = $this->db->query('SELECT * FROM barang JOIN stok ON barang.id_barang = stok.id_barang WHERE jumlah > maks_jumlah LIMIT 5');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function getBulan()
	{
		$this->db->limit(12);
		$bulan = $this->db->get('bulan');
		return $bulan->result();
	}

	public function getMasuk()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->db->limit(12);
		$query = $this->db->query('SELECT YEAR(date_in) AS year, MONTH(date_in) AS month, COUNT(id_masuk) AS total_masuk FROM masuk GROUP BY YEAR(date_in), MONTH(date_in)');
		return $query->result();
	}

	public function getKeluar()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->db->limit(12);
		$query = $this->db->query('SELECT YEAR(date_out) AS year, MONTH(date_out) AS month, COUNT(id_keluar) AS total_keluar FROM keluar GROUP BY YEAR(date_out), MONTH(date_out)');
		return $query->result();
	}
}
