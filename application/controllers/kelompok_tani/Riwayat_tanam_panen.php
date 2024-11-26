<?php

use App\libraries\DataTableHandler;

defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_tanam_panen extends CI_Controller
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

        $data = [
            'view' => 'pages/kelompok_tani/data_tanam_panen/riwayat_tanam_panen/index',
            'active' => 'kelompok_tani',
			'sub' => 'data_tanam_panen'
        ];

        $this->load->view('template/index', $data);
    }

    public function load_table($row_no = 0)
	{
		if ($_SESSION['akses']->m_kel_tani != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$where = ['data_anggota_kel_tani.status !=' => 'Belum Panen'];

		$related_kecamatan = array_column($this->session->userdata('daerah'), 'id_kecamatan');
		$related_desa = array_column($this->session->userdata('daerah'), 'id_desa');

		if (empty($related_kecamatan) && empty($related_desa)) {
		} else {
			if (!empty($related_kecamatan)) {
				$this->db->where_in('data_anggota_kel_tani.id_kecamatan', $related_kecamatan);
			}

			if (!empty($related_desa)) {
				$this->db->where_in('data_anggota_kel_tani.id_desa', $related_desa);
			}
		}

		$config = [
			'table' => 'data_anggota_kel_tani',
			'select' => 'data_anggota_kel_tani.*, kel_tani.nama AS nama_kel_tani, anggota_kel_tani.nama AS nama_anggota, kecamatan.nama AS kecamatan, desa.nama AS desa',
			'order_by' => ['data_anggota_kel_tani.id' => 'desc'],
			'join' => [
				[
					'field' => 'kel_tani',
					'condition' => 'kel_tani.id = data_anggota_kel_tani.id_kel_tani',
					'direction' => ''
				],
				[
					'field' => 'anggota_kel_tani',
					'condition' => 'anggota_kel_tani.id = data_anggota_kel_tani.id_anggota_kel_tani',
					'direction' => ''
				],
				[
					'field' => 'kecamatan',
					'condition' => 'kecamatan.id = data_anggota_kel_tani.id_kecamatan',
					'direction' => ''
				],
				[
					'field' => 'desa',
					'condition' => 'desa.id = data_anggota_kel_tani.id_desa',
					'direction' => ''
				]
			],
			'group_by' => [],
			'where' => $where,
			'base_url' => base_url() . 'kelompok_tani/data_tanam_panen/riwayat_tanam_panen/index'
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
		$id_anggota_kel_tani = $this->input->post('id_anggota_kel_tani', true);
		$luas_tanam = $this->input->post('luas_tanam', true);
		$tgl_tanam = $this->input->post('tgl_tanam', true);
		$estimasi_tgl_panen = $this->input->post('estimasi_tgl_panen', true);
		$tgl_panen = $this->input->post('tgl_panen', true);
		$luas_panen = $this->input->post('luas_panen', true);
		$total_produksi = $this->input->post('total_produksi', true);
		$harga_bersih = $this->input->post('harga_bersih', true);
		$harga_kotor = $this->input->post('harga_kotor', true);
		$harga_borongan = $this->input->post('harga_borongan', true);
		$status = $this->input->post('status', true);

		$id_kecamatan = $this->db->get_where('anggota_kel_tani', ['id' => $id_anggota_kel_tani])->row()->id_kecamatan;
		$id_desa = $this->db->get_where('anggota_kel_tani', ['id' => $id_anggota_kel_tani])->row()->id_desa;
		$id_kel_tani = $this->db->get_where('anggota_kel_tani', ['id' => $id_anggota_kel_tani])->row()->id_kel_tani;

		$is_valid_request = $this->validate_request();

		if ($is_valid_request !== true) {
			echo json_encode($is_valid_request);
			exit;
		}

		$data = [
			'id_kecamatan' => $id_kecamatan,
			'id_desa' => $id_desa,
			'id_kel_tani' => $id_kel_tani,
			'id_anggota_kel_tani' => $id_anggota_kel_tani,
			'luas_tanam' => $luas_tanam,
			'tgl_tanam' => $tgl_tanam,
			'estimasi_tgl_panen' => $estimasi_tgl_panen,
			'tgl_panen' => $tgl_panen,
			'luas_panen' => $luas_panen,
			'total_produksi' => $total_produksi,
			'harga_bersih' => $harga_bersih,
			'harga_kotor' => $harga_kotor,
			'harga_borongan' => $harga_borongan,
			'status' => $status
		];

		if ($id == '') {
			$data['created_by'] = $this->session->userdata('id');
			$data['created_date'] = date('Y-m-d H:i:s');

			$save = $this->db->insert('data_anggota_kel_tani', $data);
			$message = 'Data Tanam Panen berhasil disimpan';
		} else {
			$data['updated_by'] = $this->session->userdata('id');
			$data['updated_date'] = date('Y-m-d H:i:s');

			$save = $this->db->update('data_anggota_kel_tani', $data, ['id' => $id]);
			$message = 'Data Tanam Panen berhasil diperbaharui';
		}

		if ($save) {
			echo json_encode([
				'status' => true,
				'message' => $message
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Data Tanam Panen gagal disimpan'
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
	
		$this->db->select('data_anggota_kel_tani.*, anggota_kel_tani.nama as nama_anggota');
		$this->db->from('data_anggota_kel_tani');
		$this->db->join('anggota_kel_tani', 'data_anggota_kel_tani.id_anggota_kel_tani = anggota_kel_tani.id', 'left');
		$this->db->where('data_anggota_kel_tani.id', $id);
		$data = $this->db->get()->row();
	
		echo json_encode($data);
	}	

    public function delete()
    {
        if ($_SESSION['akses']->m_kel_tani != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->post('id', true);

        if ($this->db->delete('data_anggota_kel_tani', ['id' => $id])) {
            echo json_encode([
                'status' => true,
                'message' => 'Data Tanam Panen berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Data Tanam Panen gagal dihapus'
            ]);
        }
    }

    private function validate_request()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = [
			[
				'field' => 'id_anggota_kel_tani',
				'label' => 'Anggota Kelompok Tani',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus dipilih',
				]
			],
			[
				'field' => 'luas_tanam',
				'label' => 'Luas Tanam',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'tgl_tanam',
				'label' => 'Tanggal Tanam',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'estimasi_tgl_panen',
				'label' => 'Estimasi Tanggal Panen',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'tgl_panen',
				'label' => 'Tanggal Panen',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'luas_panen',
				'label' => 'Luas Panen',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'total_produksi',
				'label' => 'Total Produksi',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'harga_bersih',
				'label' => 'Harga Bersih',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'harga_kotor',
				'label' => 'Harga Kotor',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'harga_borongan',
				'label' => 'Harga Borongan',
				'rules' => 'trim|required|numeric',
				'errors' => [
					'required' => '%s harus diisi',
					'numeric' => '%s harus berupa angka'
				]
			],
			[
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus dipilih',
				]
			]
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
