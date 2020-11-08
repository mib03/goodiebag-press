<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_model extends CI_Model
{
	public function getAllJenis()
	{
		return $this->db->get('jenis')->result();
	}

	public function getIdJenis()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_jenis, 3)) AS kd_jenis FROM jenis");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $sql) {
				$q = ((int) $sql->kd_jenis) + 1;
				$kd = sprintf("TPE" . "%03s", $q);
			}
		} else {
			$kd = "TPE001";
		}
		return $kd;
	}

	public function delete($id)
	{
		$result = $this->db->delete('jenis', ['id_jenis' => $id]);
		return $result;
	}
}
