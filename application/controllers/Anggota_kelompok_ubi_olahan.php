<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_kelompok_ubi_olahan extends CI_Controller
{
	public function search()
	{
		$search = $this->input->post('search');
		$this->db->select('pelaku_anggota_ubi_olahan.id, pelaku_anggota_ubi_olahan.nama, pelaku_ubi_olahan.nama as kelompok_ubi_olahan, kecamatan.nama as kecamatan');
		$this->db->from('pelaku_anggota_ubi_olahan');
		$this->db->join('pelaku_ubi_olahan', 'pelaku_ubi_olahan.id = pelaku_anggota_ubi_olahan.id_pelaku_ubi_olahan');
		$this->db->join('kecamatan', 'kecamatan.id = pelaku_anggota_ubi_olahan.id_kecamatan');
		if ($search) {
			$this->db->like('pelaku_anggota_ubi_olahan.nama', $search);
		}
		$query = $this->db->get();
		$data = $query->result_array();

		echo json_encode($data);
	}
}
