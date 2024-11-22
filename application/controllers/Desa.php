<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Desa extends CI_Controller
{
	public function get_desa_by_kecamatan($id_kecamatan)
	{
		$this->load->model('Desa_model');
		$desa = $this->Desa_model->get_desa_by_kecamatan($id_kecamatan);
		echo json_encode($desa);
	}
}
