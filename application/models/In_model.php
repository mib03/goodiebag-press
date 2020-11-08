<?php
defined('BASEPATH') or exit('No direct script access allowed');

class In_model extends CI_Model
{
	public function getAllIn()
	{
		$this->db->select('*');
		$this->db->from('masuk');
		$this->db->join('barang', 'masuk.id_barang = barang.id_barang');
		$this->db->order_by('masuk.date_in', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPeriod($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->from('masuk');
		$this->db->join('barang', 'masuk.id_barang = barang.id_barang');
		$this->db->where('masuk.date_in >=', $tgl_awal);
		$this->db->where('masuk.date_in <=', $tgl_akhir);
		$this->db->order_by('masuk.date_in', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
}
