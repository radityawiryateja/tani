<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Desa_model extends CI_Model
{
    public function get_desa_by_kecamatan($id_kecamatan)
    {
        return $this->db->get_where('desa', ['id_kecamatan' => $id_kecamatan])->result();
    }
}
