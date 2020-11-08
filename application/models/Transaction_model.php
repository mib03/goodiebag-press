<?php
// No direct script execution
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Dropdown_model to handle all related information from MySQL
 */
class Transaction_model extends CI_Model
{
	/**
	 * MySQL table which contains all data about users
	 * @var string
	 */
	/**
	 * Returns, User First Name by Email ID
	 * @param  [type] $email_addres   [description]
	 * @return [type] [description]
	 */

	public function getAllBarang()
	{
		return $this->db->get('barang')->result();
	}

	public function getSupplier()
	{
		$query = $this->db->get('pemasok');
		return $query->result_array();
	}

	public function getIdIn()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_masuk, 3)) AS kd_masuk FROM masuk WHERE DATE(date_in)=CURDATE()");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$sql = ((int) $row->kd_masuk) + 1;
				$kd = sprintf("%03s", $sql);
			}
		} else {
			$kd = "001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('dmy') . "02" . $kd;
	}

	public function getIdOut()
	{
		$query = $this->db->query("SELECT MAX(RIGHT(id_keluar, 3)) AS kd_keluar FROM keluar WHERE DATE(date_out)=CURDATE()");
		$kd = "";
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$sql = ((int) $row->kd_keluar) + 1;
				$kd = sprintf("%03s", $sql);
			}
		} else {
			$kd = "001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('dmy') . "03" . $kd;
	}
}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */
