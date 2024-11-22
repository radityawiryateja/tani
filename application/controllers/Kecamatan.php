<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
	public function get_all_kecamatan()
	{
		$this->load->model('Kecamatan_model');
		$kecamatan = $this->Kecamatan_model->get_all_kecamatan();
		echo json_encode($kecamatan);
	}
}
