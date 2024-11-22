<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $redirect_path = [
        'Dinas' => 'kelompok_tani/data_kelompok_tani'
    ];

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    public function index()
    {
        if (isset($_SESSION['token']) && strlen($_SESSION['token']) > 10) {
            $message = $this->session->flashdata('message');

            if ($message) {
                $this->session->set_flashdata('message', $message);
            }

            redirect($this->redirect_path[$this->session->userdata('nama_role')]);
        }

        $this->load->view('login');
    }

    public function verify()
    {
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', TRUE));
        $token    = random_string('md5');

        $where = ['username' => $username, 'password' => $password];
		
        $query = $this->db->get_where('users', $where);

        if ($query->num_rows() > 0) {
            $info   = $query->row_array();

			if ($info['status'] == 0) {
				$this->session->set_flashdata('message', 'Akun Anda tidak aktif, harap hubungi Admin!');
				redirect('login');
			}

			$this->db->select('id_kecamatan, id_desa');
			$this->db->from('daerah_user');
			$this->db->where('id_user', $info['id']);
			$user_daerah = $this->db->get()->result_array();

            $akses  = $this->db->get_where('role', ['id' => $info['id_role']])->row();

            $sess_data['id']        = $info['id'];
            $sess_data['nama']      = $info['nama'];
            $sess_data['username']  = $info['username'];
            $sess_data['role']      = $info['id_role'];
            $sess_data['nama_role'] = $akses->nama_role;
            $sess_data['token']     = $token;
            $sess_data['akses']     = $akses;
			$sess_data['daerah']    = $user_daerah;

            unset($sess_data['akses']->id);
            unset($sess_data['akses']->nama_role);

            $data = [
                'id_user'      => $info['id'],
                'nama'         => $info['nama'],
                'username'     => $info['username'],
                'time_login'   => date('Y-m-d H:i:s'),
            ];

            $sess_data['id_login'] = $this->db->insert_id();

            $this->db->insert('log_login', $data);
            $this->session->set_userdata($sess_data);

            redirect('kelompok_tani/data_kelompok_tani');
        } else {
            $this->session->set_flashdata('message', 'Maaf, Username / Password Yang Anda Masukan Salah');
            redirect('login');
        }
    }

    public function change_password()
    {

        $is_valid_request = $this->validate_change_password_request();

        if ($is_valid_request !== true) {
            echo json_encode($is_valid_request);
            exit;
        }

        $password_baru = $this->input->post('password_baru', true);
        $hashed_password = md5($password_baru);
        $data = [
            'password' => $hashed_password,
            'updated_by' => $this->session->userdata('id'),
            'updated_date' => date('Y-m-d H:i:s')
        ];

        $is_update_success = $this->db
            ->set($data)
            ->where('id', $this->session->userdata('id'))
            ->update('users');

        if ($is_update_success) {
            echo json_encode([
                'status' => true,
                'state' => 'changing password',
                'message' => 'Password Berhasil diganti'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'state' => 'changing password',
                'message' => 'Password Gagal diganti'
            ]);
        }
    }

    private function validate_change_password_request()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $config = [
            [
                'field' => 'password_lama',
                'label' => 'Password Lama',
                'rules' => 'trim|required|callback_check_password_lama',
                'errors' => [
                    'required' => '%s harus diisi',
                    'check_password_lama' => 'Password tidak sama',
                ]
            ],
            [
                'field' => 'password_baru',
                'label' => 'Password Baru',
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => '%s harus diisi',
                    'min_length' => '%s minimal 8 karakter',
                ]
            ],
            [
                'field' => 'verifikasi_password',
                'label' => 'Verifikasi Password',
                'rules' => 'trim|required|matches[password_baru]',
                'errors' => [
                    'required' => '%s harus diisi',
                    'matches' => 'Password tidak sesuai dengan yang dimasukan',
                ]
            ],
        ];

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

    public function check_password_lama($password_lama)
    {
        if ($password_lama == '') {
            return null;
        }
        $is_user_exist = $this->db->get_where('users', ['id' => $this->session->userdata('id')]);

        if ($is_user_exist->num_rows() > 0) {
            $user = $is_user_exist->row();
            if (md5($password_lama) == $user->password) {
                return true;
            } else {
                return false;
            }
        } // Password doesn't match
    }

    public function out()
    {
        $this->db->update('log_login', ['time_logout' => date('Y-m-d H:i:s')], ['id' => $this->session->userdata('id_login')]);
        $this->session->sess_destroy();
        redirect('login');
    }
}
