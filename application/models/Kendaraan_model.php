<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan_model extends CI_Model
{
	public function getAllKendaraan()
	{
		return $this->db->get('kendaraan')->result();
	}

	public function getIdKendaraan()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_kendaraan, 3)) AS kd_kendaraan FROM kendaraan");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $sql) {
				$q = ((int) $sql->kd_kendaraan) + 1;
				$kd = sprintf("KEN" . "%03s", $q);
			}
		} else {
			$kd = "KEN001";
		}
		return $kd;
	}

	public function delete($id)
	{
		$result = $this->db->delete('kendaraan', ['id_kendaraan' => $id]);
		return $result;
	}
}
