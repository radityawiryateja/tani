<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('single_pdf_upload')) {
    /**
     * Upload single PDF
     * 
     * Fungsi ini akan memvalidasi dan mengunggah satu file PDF,
     * mengembalikan asosiatif array dengan key berupa status dan info.
     *
     * @access public
     * @param string $input_name Nama file dalam form input (required).
     * @param string $path Path tempat file diunggah, './public/files/' secara default.
     * @param int $max_size Ukuran maksimum (dalam kilobyte). 5 MB (5120 KB) secara default.
     * @param string $allowed_types Mime types sesuai dengan jenis file yang Anda izinkan untuk diunggah.
     * @return array Berisi status dan info, info dapat berupa pesan error atau nama file yang diupload, tergantung statusnya (true or false).
     */
    function single_pdf_upload($input_name, $path = './public/files/', $max_size = 50000, $allowed_types = 'pdf') {
        $CI =& get_instance();
        $CI->load->library('upload');

        $config['upload_path']   = $path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size']      = $max_size;
        $config['encrypt_name']  = true;

        $upload = new \CI_Upload($config);

        if (!$upload->do_upload($input_name)) {
            return [
                'status' => false,
                'info'   => $upload->display_errors('', '')
            ];
        }

        return [
            'status' => true,
            'info'   => $upload->data('file_name')
        ];
    }
}

if (!function_exists('delete_single_pdf')) {
    /**
     * Delete single PDF
     * 
     * Fungsi ini akan menghapus satu file PDF,
     * mengembalikan nilai `true` atau `false`.
     *
     * @access public
     * @param string $path Path tempat file diunggah (required).
     * @param string $file Nama file yang akan dihapus.
     * @return bool Mengembalikan nilai `true` atau `false`.
     */
    function delete_single_pdf($path, $file) {
        $full_path = $path . $file;

        if (file_exists($full_path)) {
            if (unlink($full_path)) {
                return true;
            }
        }

        return false;
    }
}
