<?php

defined('BASEPATH') or exit('No direct script access allowed');

if ( !function_exists('single_image_upload') ) {
    /**
     * Upload single image
     * 
     * Fungsi ini akan memvalidasi dan mengunggah satu gambar,
     * mengembalikan asosiatif array dengan key berupa status dan info.
     *
     * @access public
     * @author kur0nek-o
     * @param string $input_name Nama gambar dalam form input (required).
     * @param string $path Path tempat gambar diunggah, ./public/images/ secara default.
     * @param int $max_size Ukuran maksimum (dalam kilobyte). 2 MB (2048 KB) secara default.
     * @param string $allowed_types Mime types sesuai dengan jenis file yang Anda izinkan untuk diunggah.
     * @return array Berisi status dan info, info dapat berupa pesan error atau nama gambar yang diupload, tergantung statusnya (true or false).
     */
    function single_image_upload($input_name, $path = './public/images/', $max_size = 2048, $allowed_types = 'png|jpg|jpeg|gif') {
        $CI =& get_instance();
        $CI->load->library('upload');

        $config['upload_path']   = $path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size']      = $max_size;
        $config['encrypt_name']  = true;

        $upload = new \CI_Upload($config);

        if ( !$upload->do_upload($input_name) ) {
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

if ( !function_exists('delete_single_image') ) {
    /**
     * Delete single image
     * 
     * Fungsi ini akan menghapus satu gambar,
     * mengembalikan nilai `true` atau `false`.
     *
     * @access public
     * @author kur0nek-o
     * @param string $path Path tempat gambar diunggah (required).
     * @param string $image Nama gambar yang akan dihapus.
     * @return bool Mengembalikan nilai `true` atau `false`.
     */
    function delete_single_image($path, $image) {
        $full_path = $path . $image;
        
        if ( file_exists($full_path) ) {
            if ( unlink($full_path) ) {
                return true;
            }
        }

        return false;
    }
}

if ( !function_exists('multiple_image_upload') ) {
    /**
     * Upload multiple image
     * 
     * Fungsi ini akan memvalidasi dan mengunggah banyak gambar,
     * mengembalikan asosiatif array dengan key berupa status dan info.
     *
     * @access public
     * @author kur0nek-o
     * @param string $input_name Nama gambar dalam form input (required).
     * @param string $path Path tempat gambar diunggah, ./public/images/ secara default.
     * @param int $max_size Ukuran maksimum (dalam kilobyte). 2 MB (2048 KB) secara default.
     * @param string $allowed_types Mime types sesuai dengan jenis file yang Anda izinkan untuk diunggah.
     * @return array Berisi status dan info, info dapat berupa pesan error atau nama gambar yang diupload, tergantung statusnya (true or false).
     */
    function multiple_image_upload($input_name, $path = './public/images/', $max_size = 2048, $allowed_types = 'png|jpg|jpeg|gif') {
        $CI =& get_instance();

        $is_all_valid = validate_multiple_images($input_name, $max_size, $allowed_types);
    
        if ( !$is_all_valid['status'] ) {
            $invalid_image = $is_all_valid['info'];

            if ($invalid_image['error'] === 'invalid_extension') {
                $error_message = "The extension of the uploaded image '{$invalid_image['name']}' is invalid.";
            } elseif ($invalid_image['error'] === 'large_image_size') {
                $error_message = "Image size is too large for '{$invalid_image['name']}', image cannot be more than 2MB.";
            }
            
            return [
                'status' => false,
                'info'   => $error_message
            ];
        }

        $config['upload_path']   = $path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size']      = $max_size;
        $config['encrypt_name']  = true;

        $CI->load->library('upload', $config);

        $uploaded_images = [];
        
        foreach ( $_FILES[$input_name]['name'] as $i => $img ) {
            $_FILES['image']['name']     = $_FILES[$input_name]['name'][$i];
            $_FILES['image']['type']     = $_FILES[$input_name]['type'][$i];
            $_FILES['image']['tmp_name'] = $_FILES[$input_name]['tmp_name'][$i];
            $_FILES['image']['size']     = $_FILES[$input_name]['size'][$i];

            if ( !$CI->upload->do_upload('image') ) {
                return [
                    'status' => false,
                    'data'   => $CI->upload->display_errors('', '')
                ];
            }

            $uploaded_images[] = $CI->upload->data('file_name');
        }

        return [
            'status' => true,
            'info'   => $uploaded_images
        ];
    }
}

function validate_multiple_images($input_name, $max_size, $allowed_types) {
    foreach ($_FILES[$input_name]['name'] as $i => $img) {
        $temp_name = $_FILES[$input_name]['tmp_name'][$i];

        $validation_result = validate_image($temp_name, $max_size, $allowed_types);
        
        if ($validation_result !== true) {
            return [
                'status' => false,
                'info'   => [
                    'name'  => $_FILES[$input_name]['name'][$i],
                    'error' => $validation_result
                ]
            ];
        }
    }

    return ['status' => true];
}

function validate_image($image, $size, $types) {
    $allowed_types = array_map(function($type) {
        return 'image/' . $type;
    }, explode('|', $types));

    $max_size      = $size * 1024;
    $mime_type     = mime_content_type($image);

    if ( !in_array($mime_type, $allowed_types) ) {
        return 'invalid_extension';
    }

    if ( filesize($image) > $max_size ) {
        return 'large_image_size';
    }

    return true;
}
