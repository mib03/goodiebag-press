<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
	public function getAllSupplier()
	{
		return $this->db->get('pemasok')->result();
	}

	public function getIdSupplier()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_pemasok, 3)) AS kd_supplier FROM pemasok");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $sql) {
				$q = ((int) $sql->kd_supplier) + 1;
				$kd = sprintf("SUP" . "%03s", $q);
			}
		} else {
			$kd = "SUP001";
		}
		return $kd;
	}

	public function delete($id)
	{
		$result = $this->db->delete('pemasok', ['id_pemasok' => $id]);
		return $result;
	}
}
