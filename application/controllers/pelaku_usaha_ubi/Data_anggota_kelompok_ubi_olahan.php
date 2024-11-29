<?php

use App\libraries\DataTableHandler;

defined('BASEPATH') or exit('No direct script access allowed');

class Data_anggota_kelompok_ubi_olahan extends CI_Controller
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
		if ($_SESSION['akses']->m_pelaku_ubi_olahan != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$id_pelaku_ubi_olahan = $this->input->get('id_pelaku_ubi_olahan');
		if (!$id_pelaku_ubi_olahan) {
			show_404();
		}

		$pelaku_ubi_olahan = $this->db->get_where('pelaku_ubi_olahan', ['id' => $id_pelaku_ubi_olahan])->row();

		if (!$pelaku_ubi_olahan) {
			$this->session->set_flashdata('message', 'Data kelompok ubi olahan tidak ditemukan!');
			redirect('pelaku_usaha_ubi/ubi_olahan');
		}

		// Simpan ke session
		$this->session->set_userdata('id_pelaku_ubi_olahan', $id_pelaku_ubi_olahan);

		$data = [
			'pelaku_ubi_olahan' => $pelaku_ubi_olahan,
			'id_pelaku_ubi_olahan' => $id_pelaku_ubi_olahan,
			'view' => 'pages/pelaku_usaha_ubi/ubi_olahan/data_anggota_kelompok_ubi_olahan/index',
			'active' => 'pelaku_usaha_ubi',
			'sub' => 'ubi_olahan'
		];

		$this->load->view('template/index', $data);
	}

    public function load_table($row_no = 0)
	{
		if ($_SESSION['akses']->m_pelaku_ubi_olahan != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$where = [];

		$id_pelaku_ubi_olahan = $this->session->userdata('id_pelaku_ubi_olahan');
		if ($id_pelaku_ubi_olahan) {
			$where['pelaku_anggota_ubi_olahan.id_pelaku_ubi_olahan'] = $id_pelaku_ubi_olahan;

			$this->session->unset_userdata('id_pelaku_ubi_olahan');
		}
		
		$config = [
			'table' => 'pelaku_anggota_ubi_olahan',
			'select' => 'pelaku_anggota_ubi_olahan.*, pelaku_ubi_olahan.id as id_pelaku_ubi_olahan, pelaku_ubi_olahan.nama as nama_pelaku_ubi_olahan, pelaku_ubi_olahan.id_kecamatan as kecamatan_pelaku_ubi_olahan, pelaku_ubi_olahan.id_desa as desa_pelaku_ubi_olahan, kecamatan.nama as kecamatan, desa.nama as desa',
			'order_by' => ['pelaku_anggota_ubi_olahan.id' => 'asc'],
			'join' => [
				[
					'field' => 'pelaku_ubi_olahan',
					'condition' => 'pelaku_ubi_olahan.id = pelaku_anggota_ubi_olahan.id_pelaku_ubi_olahan',
					'direction' => ''
				],
				[
					'field' => 'kecamatan',
					'condition' => 'kecamatan.id = pelaku_anggota_ubi_olahan.id_kecamatan',
					'direction' => ''
				],
				[
					'field' => 'desa',
					'condition' => 'desa.id = pelaku_anggota_ubi_olahan.id_desa',
					'direction' => ''
				]
			],
			'group_by' => [],
			'where' => $where,
			'base_url' => base_url() . 'pelaku_usaha_ubi/ubi_olahan/data_anggota_kelompok_ubi_olahan/index'
		];

		$table = DataTableHandler::getInstance($config);
		$data = $table->load($row_no);

		echo json_encode($data);
	}

    public function save()
	{
		if ($_SESSION['akses']->m_pelaku_ubi_olahan != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$id = trim($this->input->post('id', true));
		$id_pelaku_ubi_olahan = $this->input->post('id_pelaku_ubi_olahan', true);
		$id_kecamatan = $this->input->post('id_kecamatan', true);
		$id_desa = $this->input->post('id_desa', true);

		$nama_anggota = $this->input->post('nama_anggota', true);
		$no_ktp = $this->input->post('no_ktp', true);
		$no_hp = $this->input->post('no_hp', true);
		$alamat = $this->input->post('alamat', true);
		$koordinat = $this->input->post('koordinat', true);

		$sumber_bahan_bakuAllowedValues = ['petani', 'bandar'];
		$sumber_bahan_baku = $this->input->post('sumber_bahan_baku');
		if (!empty(array_diff($sumber_bahan_baku, $sumber_bahan_bakuAllowedValues))) {
			show_error('Nilai sumber_bahan_baku tidak valid');
		}

		$pemasaranAllowedValues = ['lokal', 'ekspor'];
		$pemasaran = $this->input->post('pemasaran');
		if (!empty(array_diff($pemasaran, $pemasaranAllowedValues))) {
			show_error('Nilai pemasaran tidak valid');
		}

		$status = $this->input->post('status', true);

		$is_valid_request = $this->validate_request();

		if ($is_valid_request !== true) {
			echo json_encode($is_valid_request);
			exit;
		}

		$data = [
			'id_pelaku_ubi_olahan' => $id_pelaku_ubi_olahan,
			'id_kecamatan' => $id_kecamatan,
			'id_desa' => $id_desa,
			'nama' => $nama_anggota,
			'no_ktp' => $no_ktp,
			'no_hp' => $no_hp,
			'alamat' => $alamat,
			'koordinat' => $koordinat,
			'status' => $status
		];

		$data['sumber_bahan_baku'] = implode(',', $sumber_bahan_baku);
		$data['pemasaran'] = implode(',', $pemasaran);

		if ($id == '') {
			$data['created_by'] = $this->session->userdata('id');
			$data['created_date'] = date('Y-m-d H:i:s');

			$save = $this->db->insert('pelaku_anggota_ubi_olahan', $data);
			$message = 'Anggota Kelompok Ubi Olahan berhasil disimpan';
		} else {
			$data['updated_by'] = $this->session->userdata('id');
			$data['updated_date'] = date('Y-m-d H:i:s');

			$save = $this->db->update('pelaku_anggota_ubi_olahan', $data, ['id' => $id]);
			$message = 'Anggota Kelompok Ubi Olahan berhasil diperbaharui';
		}

		if ($save) {
			echo json_encode([
				'status' => true,
				'message' => $message
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Anggota Kelompok Ubi Olahan gagal disimpan'
			]);
		}
	}

    public function edit()
    {
        if ($_SESSION['akses']->m_pelaku_ubi_olahan != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->get('id', true);
        $data = $this->db->get_where('pelaku_anggota_ubi_olahan', ['id' => $id])->row();

        echo json_encode($data);
    }

    public function delete()
    {
        if ($_SESSION['akses']->m_pelaku_ubi_olahan != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->post('id', true);

        if ($this->db->delete('pelaku_anggota_ubi_olahan', ['id' => $id])) {
            echo json_encode([
                'status' => true,
                'message' => 'Anggota Kelompok Ubi Olahan berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Anggota Kelompok Ubi Olahan gagal dihapus'
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
