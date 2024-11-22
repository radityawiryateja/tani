<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Umum_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function getKode($table, $field, $prefix, $length = 4)
  {
    $this->db->select("max(cast(replace($field,'$prefix','') as unsigned)) as kode");
    $query = $this->db->get("$table");

    if ($query->num_rows() > 0) {
      $data = $query->row();
      $angka = str_ireplace($prefix, '', $data->kode);
      $kode = intval($angka) + 1;
    } else {
      $kode = 1;
    }

    if (strlen($kode) < $length) {
      $kodemax = str_pad($kode, $length, "0", STR_PAD_LEFT);
    } else {
      $kodemax = $kode;
    }

    $kodejadi  = $prefix . $kodemax;
    return $kodejadi;
  }

  // function generateKode($table, $field, $prefix, $suffix)
  // {
  //   $kode = $this->db->query("SELECT MAX($field) as $field from $table where $field like '$prefix%'")->row_array()[$field];

  //   $nourut = (int) substr($kode, strlen($prefix), $suffix);
  //   $nourut++;
  //   $kodeBaru = $prefix . sprintf('%0' . $suffix . 's', $nourut);
  //   return $kodeBaru;
  // }

  


}