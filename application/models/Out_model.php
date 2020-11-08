<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Out_model extends CI_Model
{
	public function getAllOut()
	{
		$this->db->select('*');
		$this->db->from('keluar');
		$this->db->join('barang', 'keluar.id_barang = barang.id_barang');
		$this->db->order_by('keluar.id_barang');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPeriod($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->from('keluar');
		$this->db->join('barang', 'keluar.id_barang = barang.id_barang');
		$this->db->where('keluar.date_out >=', $tgl_awal);
		$this->db->where('keluar.date_out <=', $tgl_akhir);
		$this->db->order_by('keluar.id_barang');
		$query = $this->db->get();
		return $query->result();
	}
}
