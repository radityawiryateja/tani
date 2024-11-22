<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Piutang extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    if (!isset($_SESSION['token']) && strlen($_SESSION['token']) < 10) {
      $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

      redirect('');
    }
  }

  public function index()
  {
    if ($_SESSION['akses']->m_laporan_piutang != 1) {
      $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

      redirect('');
    }

    $data = [
      'view'      => 'pages/laporan/piutang/index',
      'active'    => 'laporan',
      'sub'       => 'piutang',
      'customers' => $this->db->select('id, nama')->from('dat_customer')->get()->result()
    ];

    $this->load->view('template/index', $data);
  }

  public function get_report()
  {
    $this->load->model('laporan/PiutangModel', 'PiutangModel');

    $range      = $this->input->get('range', true);
    $customer   = $this->input->get('customer', true);
    $piutang    = $this->PiutangModel->get_report($range, $customer);

    foreach ($piutang as $i => $item) {
      $item->tanggal_invoice  = date('d-m-Y', strtotime($item->tanggal_invoice));
      $item->jatuh_tempo      = date('d-m-Y', strtotime($item->jatuh_tempo));
      $item->sisa_piutang     = convert_to_rupiah($item->sisa_piutang);
    }

    echo json_encode($piutang);
  }

  public function print_report()
  {
    $this->load->model('laporan/PiutangModel', 'PiutangModel');

    $range          = $this->input->get('range', true);
    $customer       = $this->input->get('customer', true);
    $customer_text  = $this->input->get('customerText', true);
    $format         = $this->input->get('format', true);
    $piutang        = $this->PiutangModel->get_report($range, $customer);
    $summary        = 0;

    foreach ($piutang as $item) {
      $summary += $item->sisa_piutang;

      $item->tanggal_invoice  = date('d-m-Y', strtotime($item->tanggal_invoice));
      $item->jatuh_tempo      = date('d-m-Y', strtotime($item->jatuh_tempo));

      if ($format === 'pdf') {
        $item->sisa_piutang     = convert_to_rupiah($item->sisa_piutang);
      }
    }

    $range = explode(' - ', $range);

    $range = [
      'start_date' => $range[0],
      'end_date'   => $range[1]
    ];

    $data = [
      'customer_text' => $customer_text,
      'periode'       => date('d-m-Y', strtotime($range['start_date'])) . ' s/d ' . date('d-m-Y', strtotime($range['end_date'])),
      'piutang'       => $piutang,
      'summary'       => $format === 'pdf' ? convert_to_rupiah($summary) : $summary,
    ];

    if ($format === 'pdf') {
      $this->load->view('pages/laporan/piutang/report/pdf', $data);
    } else {
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=laporan piutang " . $data['periode'] . ".xls");

      $this->load->view('pages/laporan/piutang/report/xls', $data);
    }
  }
}
