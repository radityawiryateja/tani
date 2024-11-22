<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PiutangModel extends CI_Model
{
  public function get_report($range, $customer)
  {
    $range = explode(' - ', $range);

    $range = [
      'start_date' => $range[0],
      'end_date'   => $range[1]
    ];

    $this->db->select('
      dat_invoice.kode_invoice, dat_invoice.tanggal_invoice, dat_invoice.jatuh_tempo, dat_invoice.id_customer,
      dat_invoice.nama_customer, dat_piutang.sisa_piutang
    ')
      ->from('dat_invoice')
      ->join('dat_piutang', 'dat_invoice.id = dat_piutang.id_invoice', 'left')
      ->where('dat_invoice.jatuh_tempo >=', date('Y-m-d', strtotime($range['start_date'])))
      ->where('dat_invoice.jatuh_tempo <=', date('Y-m-d', strtotime($range['end_date'])))
      ->where_in('dat_invoice.id_metode_pembayaran', [1, 4])
      ->where('dat_piutang.sisa_piutang >', 0);

    if ($customer) {
      $this->db->where('dat_invoice.id_customer', $customer);
    }

    return $this->db->get()->result();
  }
}
