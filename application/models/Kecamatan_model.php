<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan_model extends CI_Model
{
	public function get_all_kecamatan()
	{
		return $this->db->get('kecamatan')->result();
	}
}
