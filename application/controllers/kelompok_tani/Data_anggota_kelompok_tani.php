<?php

use App\libraries\DataTableHandler;

defined('BASEPATH') or exit('No direct script access allowed');

class Data_anggota_kelompok_tani extends CI_Controller
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
		if ($_SESSION['akses']->m_kel_tani != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$id_kel_tani = $this->input->get('id_kel_tani');
		if (!$id_kel_tani) {
			show_404();
		}

		$kel_tani = $this->db->get_where('kel_tani', ['id' => $id_kel_tani])->row();

		if (!$kel_tani) {
			$this->session->set_flashdata('message', 'Data kelompok tani tidak ditemukan!');
			redirect('kelompok_tani/data_kelompok_tani');
		}

		// Simpan ke session
		$this->session->set_userdata('id_kel_tani', $id_kel_tani);

		$data = [
			'kel_tani' => $kel_tani,
			'id_kel_tani' => $id_kel_tani,
			'view' => 'pages/kelompok_tani/data_kelompok_tani/data_anggota_kelompok_tani/index',
			'active' => 'kelompok_tani',
			'sub' => 'data_kelompok_tani'
		];

		$this->load->view('template/index', $data);
	}

    public function load_table($row_no = 0)
	{
		if ($_SESSION['akses']->m_kel_tani != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$where = [];

		$id_kel_tani = $this->session->userdata('id_kel_tani');
		if ($id_kel_tani) {
			$where['anggota_kel_tani.id_kel_tani'] = $id_kel_tani;

			$this->session->unset_userdata('id_kel_tani');
		}
		
		$config = [
			'table' => 'anggota_kel_tani',
			'select' => 'anggota_kel_tani.*, kel_tani.id as id_kel_tani, kel_tani.nama as nama_kel_tani, kel_tani.id_kecamatan as kecamatan_kel_tani, kel_tani.id_desa as desa_kel_tani, kecamatan.nama as kecamatan, desa.nama as desa',
			'order_by' => ['anggota_kel_tani.id' => 'asc'],
			'join' => [
				[
					'field' => 'kel_tani',
					'condition' => 'kel_tani.id = anggota_kel_tani.id_kel_tani',
					'direction' => ''
				],
				[
					'field' => 'kecamatan',
					'condition' => 'kecamatan.id = anggota_kel_tani.id_kecamatan',
					'direction' => ''
				],
				[
					'field' => 'desa',
					'condition' => 'desa.id = anggota_kel_tani.id_desa',
					'direction' => ''
				]
			],
			'group_by' => [],
			'where' => $where,
			'base_url' => base_url() . 'kelompok_tani/data_kelompok_tani/data_anggota_kelompok_tani/index'
		];

		$table = DataTableHandler::getInstance($config);
		$data = $table->load($row_no);

		echo json_encode($data);
	}

    public function save()
	{
		if ($_SESSION['akses']->m_kel_tani != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$id = trim($this->input->post('id', true));
		$id_kel_tani = $this->input->post('id_kel_tani', true);
		$id_kecamatan = $this->input->post('id_kecamatan', true);
		$id_desa = $this->input->post('id_desa', true);

		$nama_anggota = $this->input->post('nama_anggota', true);
		$no_ktp = $this->input->post('no_ktp', true);
		$no_hp = $this->input->post('no_hp', true);
		$alamat = $this->input->post('alamat', true);
		$koordinat = $this->input->post('koordinat', true);

		$pemasaranAllowedValues = ['lokal', 'ekspor'];
		$pemasaran = $this->input->post('pemasaran');
		if (!empty(array_diff($pemasaran, $pemasaranAllowedValues))) {
			show_error('Nilai pemasaran tidak valid');
		}

		$luas_baku = $this->input->post('luas_baku', true);
		$status = $this->input->post('status', true);

		$is_valid_request = $this->validate_request();

		if ($is_valid_request !== true) {
			echo json_encode($is_valid_request);
			exit;
		}

		$data = [
			'id_kel_tani' => $id_kel_tani,
			'id_kecamatan' => $id_kecamatan,
			'id_desa' => $id_desa,
			'nama' => $nama_anggota,
			'no_ktp' => $no_ktp,
			'no_hp' => $no_hp,
			'alamat' => $alamat,
			'koordinat' => $koordinat,
			'luas_baku' => $luas_baku,
			'status' => $status
		];

		$data['pemasaran'] = implode(',', $pemasaran);

		if ($id == '') {
			$data['created_by'] = $this->session->userdata('id');
			$data['created_date'] = date('Y-m-d H:i:s');

			$save = $this->db->insert('anggota_kel_tani', $data);
			$message = 'Anggota Kelompok Tani berhasil disimpan';
		} else {
			$data['updated_by'] = $this->session->userdata('id');
			$data['updated_date'] = date('Y-m-d H:i:s');

			$save = $this->db->update('anggota_kel_tani', $data, ['id' => $id]);
			$message = 'Anggota Kelompok Tani berhasil diperbaharui';
		}

		if ($save) {
			echo json_encode([
				'status' => true,
				'message' => $message
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Anggota Kelompok Tani gagal disimpan'
			]);
		}
	}

    public function edit()
    {
        if ($_SESSION['akses']->m_kel_tani != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->get('id', true);
        $data = $this->db->get_where('anggota_kel_tani', ['id' => $id])->row();

        echo json_encode($data);
    }

    public function delete()
    {
        if ($_SESSION['akses']->m_kel_tani != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->post('id', true);

        if ($this->db->delete('anggota_kel_tani', ['id' => $id])) {
            echo json_encode([
                'status' => true,
                'message' => 'Anggota Kelompok Tani berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Anggota Kelompok Tani gagal dihapus'
            ]);
        }
    }

    private function validate_request()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = [
            [
                'field' => 'nama_anggota',
                'label' => 'Nama Anggota',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus diisi',
                ]
            ],
			[
				'field' => 'no_ktp',
				'label' => 'Nomor KTP',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[ 
				'field' => 'no_hp',
				'label' => 'Nomor HP',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'koordinat',
				'label' => 'Titik Koordinat',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'luas_baku',
				'label' => 'Luas Baku',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
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
}
