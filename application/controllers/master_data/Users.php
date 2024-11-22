<?php

use App\libraries\DataTableHandler;

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        if ($_SESSION['akses']->m_data_user != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $data = [
            'view' => 'pages/master_data/users/index',
            'active' => 'master_data',
            'sub' => 'users'
        ];

        $this->load->view('template/index', $data);
    }

    public function load_table($row_no = 0)
    {
        if ($_SESSION['akses']->m_data_user != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $config = [
            'table' => 'dat_users',
            'select' => 'dat_users.*,dat_users.id users_id,dat_level.level',
            'order_by' => ['dat_users.id' => 'desc'],
            'join' => [
                [
                    'field' => 'dat_level',
                    'condition' => 'dat_level.id = dat_users.level_id',
                    'direction' => ''
                ]
            ],
            'group_by' => [],
            'where' => [],
            'base_url' => base_url() . 'master_data/users/index'
        ];

        $table = DataTableHandler::getInstance($config);
        $data = $table->load($row_no);

        echo json_encode($data);
    }

    public function save()
    {
        if ($_SESSION['akses']->add_data_user != 1 && $_SESSION['akses']->update_data_user != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = trim($this->input->post('id', true));
        $nama = $this->input->post('nama', true);
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', true));
        $level_id = $this->input->post('level', true);
        $active = $this->input->post('status', true);

        $is_valid_request = $this->validate_request();

        if ($is_valid_request !== true) {
            echo json_encode($is_valid_request);

            exit;
        }

        //cek username
        $cek_username = $this->db->get_where('dat_users', ['username' => $username]);
        if ($cek_username->num_rows() > 0 && $cek_username->row()->id != $id) {
            echo json_encode([
                'status' => false,
                'message' => 'Username sudah digunakan sebelumnya'
            ]);

            die();
        }

        $data = [
            'nama' => $nama,
            'username' => $username,
            'level_id' => $level_id,
            'active' => $active
        ];

        if ($password != '') {
            $data['password'] = $password;
        }

        if ($id == '') {
            $data['creator_id'] = $this->session->userdata('id');
            $data['created_at'] = date('Y-m-d H:i:s');

            $save = $this->db->insert('dat_users', $data);
            $message = 'Data berhasil disimpan';
        } else {
            $data['updated_id'] = $this->session->userdata('id');
            $data['update_at'] = date('Y-m-d H:i:s');

            $save = $this->db->update('dat_users', $data, ['id' => $id]);
            $message = 'Data berhasil diperbaharui';
        }

        if ($save) {
            echo json_encode([
                'status' => true,
                'message' => $message
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Data gagal disimpan'
            ]);
        }
    }


    public function edit()
    {
        if ($_SESSION['akses']->update_data_user != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->get('id', true);
        $data = $this->db->get_where('dat_users', ['id' => $id])->row();

        echo json_encode($data);
    }

    public function delete()
    {
        if ($_SESSION['akses']->remove_data_user != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->post('id', true);

        if ($this->db->delete('dat_users', ['id' => $id])) {
            echo json_encode([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => false,
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
                'field' => 'nama',
                'label' => 'nama',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus diisi',
                ]
            ],
            [
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus diisi',
                ]
            ],
            [
                'field' => 'level',
                'label' => 'Level',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus diisi',
                ]
            ],
        ];

        if ($this->input->post('password', true) != '' || $this->input->post('id', true) == '') {
            $config[] =
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|max_length[128]',
                    'errors' => [
                        'required' => '%s harus diisi',
                        'max_length' => '%s tidak boleh lebih dari 128 karakter'
                    ]
                ];
        }


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            return [
                'status' => false,
                'messages' => $this->form_validation->error_array()
            ];
        } else {
            return true;
        }
    }
}
