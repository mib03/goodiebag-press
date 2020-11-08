<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	public function getAllBarang()
	{
		return $this->db->get('barang')->result();
	}

	public function getAllJenis()
	{
		return $this->db->get('jenis')->result();
	}

	public function getIdBarang()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_barang, 3)) AS kd_barang FROM barang");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $sql) {
				$q = ((int) $sql->kd_barang) + 1;
				$kd = sprintf("BRG" . "%03s", $q);
			}
		} else {
			$kd = "BRG001";
		}
		return $kd;
	}

	public function getIdStock()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_barang, 3)) AS kd_stok FROM stok");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $sql) {
				$q = ((int) $sql->kd_stok) + 1;
				$kd = sprintf("STK" . "%03s", $q);
			}
		} else {
			$kd = "STK001";
		}
		return $kd;
	}

	public function delete($id)
	{
		$result = $this->db->delete('barang', ['id_barang' => $id]);
		return $result;
	}

	public function deleteStok($id)
	{
		$result = $this->db->delete('stok', ['id_barang' => $id]);
		return $result;
	}

	public function getSupplier()
	{
		$query = $this->db->get('pemasok');
		return $query->result_array();
	}

	public function insertOut()
	{
		$this->db->select('*');
		$this->db->from('stok');
		$this->db->join('barang', 'stok.id_barang = barang.id_barang');
		$query = $this->db->get();
		return $query->result();
	}
}
