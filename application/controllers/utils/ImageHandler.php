<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ImageHandler extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->helper('image_upload');
    }

    public function delete_image() {
        $path  = $this->input->post('path', true);
        $image = $this->input->post('image', true);
        $table = $this->input->post('table', true);
        $field = $this->input->post('field', true);
 
        if ( delete_single_image($path, $image) ) {
            $this->db->update($table, [
                $field => NULL
            ], [$field => $image]);

            echo json_encode([
                'status'  => true,
                'message' => 'Gambar berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Gambar gagal dihapus!'
            ]);
        }
    }
}