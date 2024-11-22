<?php

use App\libraries\DataTableHandler;

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Umum_model', 'umum');

        if (!isset($_SESSION['token']) && strlen($_SESSION['token']) < 10) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }
    }


    public function index()
    {
        if ($_SESSION['akses']->m_data_customer != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $data = [
            'view'     => 'pages/customer/index',
            'active'   => 'customer',
        ];

        $this->load->view('template/index', $data);
    }

    public function load_table($row_no = 0)
    {
        if ($_SESSION['akses']->m_data_customer != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $config = [
            'table'    => 'dat_customer',
            'select'   => '*',
            'order_by' => ['id' => 'desc'],
            'join'     => [],
            'group_by' => [],
            'where'    => [],
            'base_url' => base_url() . 'customer/index'
        ];

        $table = DataTableHandler::getInstance($config);
        $data  = $table->load($row_no);

        echo json_encode($data);
    }

    public function save()
    {
        if ($_SESSION['akses']->add_data_customer != 1 && $_SESSION['akses']->update_data_customer != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $this->load->model('Umum_model');

        $id         = trim($this->input->post('id', true));
        $nama       = $this->input->post('nama', true);
        $nomor_hp   = $this->input->post('nomor_hp', true);
        $alamat     = $this->input->post('alamat', true);
        $npwp       = $this->input->post('npwp', true);
        $email      = $this->input->post('email', true);
        $status     = $this->input->post('status', true);

        $is_valid_request = $this->validate_request();

        if ($is_valid_request !== true) {
            echo json_encode($is_valid_request);
            exit;
        }

        // generate Kode
        $kodeTabel  = 'dat_customer';
        $kodeField  = 'kode';
        $kodePrefix = 'APICS-';
        $kodeSuffix = 6;
        $kode       = $this->Umum_model->getKode($kodeTabel, $kodeField, $kodePrefix, $kodeSuffix);

        $data = [
            'kode'      => $kode,
            'nama'      => $nama,
            'nomor_hp'  => $nomor_hp,
            'alamat'    => $alamat,
            'npwp'      => $npwp,
            'email'     => $email,
            'status'    => $status
        ];

        if ($id == '') {
            $data['creator_id'] = $this->session->userdata('id');
            $data['created_at'] = date('Y-m-d H:i:s');

            $save    = $this->db->insert('dat_customer', $data);
            $message = 'Data berhasil disimpan';
        } else {
            $data['updated_id'] =  $this->session->userdata('id');
            $data['update_at'] = date('Y-m-d H:i:s');

            $save    = $this->db->update('dat_customer', $data, ['id' => $id]);
            $message = 'Data berhasil diperbaharui';
        }

        if ($save) {
            echo json_encode([
                'status'  => true,
                'message' => $message
            ]);
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Data gagal disimpan'
            ]);
        }
    }


    public function edit()
    {
        if ($_SESSION['akses']->update_data_customer != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->get('id', true);
        $data = $this->db->get_where('dat_customer', ['id' => $id])->row();

        echo json_encode($data);
    }

    public function delete()
    {
        if ($_SESSION['akses']->remove_data_customer != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->post('id', true);

        if ($this->db->delete('dat_customer', ['id' => $id])) {
            echo json_encode([
                'status'  => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Data gagal dihapus'
            ]);
        }
    }

    private function validate_request()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = [
            [
                'field'  => 'nama',
                'label'  => 'Nama',
                'rules'  => 'trim|required',
                'errors' => [
                    'required'   => '%s harus diisi',
                ]
            ],
            [
                'field'  => 'nomor_hp',
                'label'  => 'Nomor Hp',
                'rules'  => 'trim|required|numeric',
                'errors' => [
                    'required'   => '%s harus diisi',
                    'numeric' => '%s yang anda masukan tidak valid'
                ],
            ],
            [
                'field'  => 'alamat',
                'label'  => 'Alamat',
                'rules'  => 'trim|required',
                'errors' => [
                    'required'   => '%s harus diisi',
                ],
            ]
        ];

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            return [
                'status'   => false,
                'messages' => $this->form_validation->error_array()
            ];
        } else {
            return true;
        }
    }
}
