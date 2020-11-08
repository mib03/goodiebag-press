<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function getAllUsers()
	{
		return $this->db->get('user')->result();
	}

	public function delete($id)
	{
		$result = $this->db->delete('user', ['user_id' => $id]);
		return $result;
	}
}
