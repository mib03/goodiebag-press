<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_model extends CI_Model
{
	public function getAllSupplier()
	{
		return $this->db->get('pemasok')->result();
	}

	public function getCurrDate()
	{
		date_default_timezone_set('Asia/Jakarta');
		return date('m/d/y');
	}

	public function getAllPurchase()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('pembelian3', 'barang.id_barang = pembelian3.id_barang');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPembelian()
	{
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->order_by('no_faktur', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllBarang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPembelian2()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('pembelian2', 'barang.id_barang = pembelian2.id_barang');
		$this->db->where('no_faktur', $this->uri->segment(3));
		$query = $this->db->get();
		return $query->result();
	}

	public function getIdPurchase()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(no_faktur, 3)) AS kd_beli FROM pembelian WHERE DATE(tanggal)=CURDATE()");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$sql = ((int) $row->kd_beli) + 1;
				$kd = sprintf("%03s", $sql);
			}
		} else {
			$kd = "001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('dmy') . "01" . $kd;
	}

	public function getPeriod($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
		$this->db->order_by('no_faktur');
		$query = $this->db->get();
		return $query->result();
	}
}
