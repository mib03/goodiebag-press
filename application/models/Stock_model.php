<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_model extends CI_Model
{
	public function getAllStock()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('stok', 'barang.id_barang = stok.id_barang');
		$this->db->order_by('barang.id_barang', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
}
