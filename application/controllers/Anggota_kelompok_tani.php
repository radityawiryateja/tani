<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_kelompok_tani extends CI_Controller
{
	public function search()
	{
		$search = $this->input->post('search');
		$this->db->select('anggota_kel_tani.id, anggota_kel_tani.nama, kel_tani.nama as kelompok_tani, kecamatan.nama as kecamatan');
		$this->db->from('anggota_kel_tani');
		$this->db->join('kel_tani', 'kel_tani.id = anggota_kel_tani.id_kel_tani');
		$this->db->join('kecamatan', 'kecamatan.id = anggota_kel_tani.id_kecamatan');
		if ($search) {
			$this->db->like('anggota_kel_tani.nama', $search);
		}
		$query = $this->db->get();
		$data = $query->result_array();

		echo json_encode($data);
	}
}
