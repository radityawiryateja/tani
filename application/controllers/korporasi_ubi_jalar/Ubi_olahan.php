<?php

use App\libraries\DataTableHandler;

defined('BASEPATH') or exit('No direct script access allowed');

class Ubi_olahan extends CI_Controller
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
        if ($_SESSION['akses']->m_korporasi_ubi_olahan != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $data = [
            'view' => 'pages/korporasi_ubi_jalar/ubi_olahan/index',
            'active' => 'korporasi_ubi_jalar',
			'sub' => 'ubi_olahan'
        ];

        $this->load->view('template/index', $data);
    }

    public function load_table($row_no = 0)
	{
		if ($_SESSION['akses']->m_korporasi_ubi_olahan != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$where = [];

		$related_kecamatan = array_column($this->session->userdata('daerah'), 'id_kecamatan');
		$related_desa = array_column($this->session->userdata('daerah'), 'id_desa');

		if (empty($related_kecamatan) && empty($related_desa)) {
		} else {
			if (!empty($related_kecamatan)) {
				$this->db->where_in('korporasi_ubi_olahan.id_kecamatan', $related_kecamatan);
			}

			if (!empty($related_desa)) {
				$this->db->where_in('korporasi_ubi_olahan.id_desa', $related_desa);
			}
		}

		$config = [
			'table' => 'korporasi_ubi_olahan',
			'select' => 'korporasi_ubi_olahan.*, kecamatan.nama AS kecamatan, desa.nama AS desa',
			'order_by' => ['korporasi_ubi_olahan.id' => 'asc'],
			'join' => [
				[
					'field' => 'kecamatan',
					'condition' => 'kecamatan.id = korporasi_ubi_olahan.id_kecamatan',
					'direction' => ''
				],
				[
					'field' => 'desa',
					'condition' => 'desa.id = korporasi_ubi_olahan.id_desa',
					'direction' => ''
				]
			],
			'group_by' => [],
			'where' => $where,
			'base_url' => base_url() . 'korporasi_ubi_jalar/ubi_olahan/index'
		];

		$table = DataTableHandler::getInstance($config);
		$data = $table->load($row_no);

		echo json_encode($data);
	}


    public function save()
	{
		if ($_SESSION['akses']->m_korporasi_ubi_olahan != 1) {
			$this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');
			redirect('');
		}

		$id = trim($this->input->post('id', true));
		$id_kecamatan = $this->input->post('id_kecamatan', true);
		$id_desa = $this->input->post('id_desa', true);
		$nama_korporasi_ubi_jalar = $this->input->post('nama_korporasi_ubi_jalar', true);
		$brand = $this->input->post('brand', true);
		$no_hp = $this->input->post('no_hp', true);
		$alamat = $this->input->post('alamat', true);
		$koordinat = $this->input->post('koordinat', true);
        $ketua = $this->input->post('ketua', true);
        $sekretaris = $this->input->post('sekretaris', true);
        $bendahara = $this->input->post('bendahara', true);
		$status = $this->input->post('status', true);

		$no_sk_pengukuhan = $this->input->post('no_sk_pengukuhan', true);
		$exp_sk_pengukuhan = $this->input->post('exp_sk_pengukuhan', true);
		$sk_pengukuhan = '';

		$no_sk_terdaftar = $this->input->post('no_sk_terdaftar', true);
		$exp_sk_terdaftar = $this->input->post('exp_sk_terdaftar', true);
		$sk_terdaftar = '';

		$is_valid_request = $this->validate_request();

		if ($is_valid_request !== true) {
			echo json_encode($is_valid_request);
			exit;
		}

		if (!empty($_FILES['sk_pengukuhan']['name'])) {
            $this->load->helper('file_upload');
            $file_path = './public/file/sk-pengukuhan';

            if ($id != '') {
                $old_file = $this->db->select('sk_pengukuhan')
                    ->get_where('korporasi_ubi_olahan', ['id' => $id])
                    ->row()->sk_pengukuhan;

                if ($old_file) {
                    $file_full_path = $file_path . '/' . $old_file;

                    var_dump($file_full_path);
                    exit();
                    if (file_exists($file_full_path)) {
                        unlink($file_full_path);
                    }
                }
            }

            $file_sk_pengukuhan = single_pdf_upload('sk_pengukuhan', $file_path);

            if (!$file_sk_pengukuhan['status']) {
                echo json_encode([
                    'status' => false,
                    'message' => $file_sk_pengukuhan['info']
                ]);
                exit;
            }

			$sk_pengukuhan = $file_sk_pengukuhan['info'];
        }

		if (!empty($_FILES['sk_terdaftar']['name'])) {
            $this->load->helper('file_upload');
            $file_path = './public/file/sk-terdaftar';

            if ($id != '') {
                $old_file = $this->db->select('sk_terdaftar')
                    ->get_where('korporasi_ubi_olahan', ['id' => $id])
                    ->row()->sk_terdaftar;

                if ($old_file) {
                    $file_full_path = $file_path . '/' . $old_file;

                    var_dump($file_full_path);
                    exit();
                    if (file_exists($file_full_path)) {
                        unlink($file_full_path);
                    }
                }
            }

            $file_sk_terdaftar = single_pdf_upload('sk_terdaftar', $file_path);

            if (!$file_sk_terdaftar['status']) {
                echo json_encode([
                    'status' => false,
                    'message' => $file_sk_terdaftar['info']
                ]);
                exit;
            }

			$sk_terdaftar = $file_sk_terdaftar['info'];
        }

		$data = [
			'id_kecamatan' => $id_kecamatan,
			'id_desa' => $id_desa,
			'nama' => $nama_korporasi_ubi_jalar,
			'brand' => $brand,
			'no_hp' => $no_hp,
			'alamat' => $alamat,
			'koordinat' => $koordinat,
			'ketua' => $ketua,
			'sekretaris' => $sekretaris,
			'bendahara' => $bendahara,
			'status' => $status
		];

		if (!empty($sk_pengukuhan)) {
			$data['sk_pengukuhan'] = $sk_pengukuhan;
			$data['no_sk_pengukuhan'] = $no_sk_pengukuhan;
			$data['exp_sk_pengukuhan'] = $exp_sk_pengukuhan;
		}

		if (!empty($sk_terdaftar)) {
			$data['sk_terdaftar'] = $sk_terdaftar;
			$data['no_sk_terdaftar'] = $no_sk_terdaftar;
			$data['exp_sk_terdaftar'] = $exp_sk_terdaftar;
		}

		if ($id == '') {
			$data['created_by'] = $this->session->userdata('id');
			$data['created_date'] = date('Y-m-d H:i:s');

			$save = $this->db->insert('korporasi_ubi_olahan', $data);
			$message = 'Kelompok Ubi Olahan berhasil disimpan';
		} else {
			$data['updated_by'] = $this->session->userdata('id');
			$data['updated_date'] = date('Y-m-d H:i:s');

			$save = $this->db->update('korporasi_ubi_olahan', $data, ['id' => $id]);
			$message = 'Kelompok Ubi Olahan berhasil diperbaharui';
		}

		if ($save) {
			echo json_encode([
				'status' => true,
				'message' => $message
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Kelompok Ubi Olahan gagal disimpan'
			]);
		}
	}

    public function edit()
    {
        if ($_SESSION['akses']->m_korporasi_ubi_olahan != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->get('id', true);
        $data = $this->db->get_where('korporasi_ubi_olahan', ['id' => $id])->row();

        echo json_encode($data);
    }

    public function delete()
    {
        if ($_SESSION['akses']->m_korporasi_ubi_olahan != 1) {
            $this->session->set_flashdata('message', 'Anda tidak memiliki izin untuk mengakses halaman tersebut');

            redirect('');
        }

        $id = $this->input->post('id', true);

        if ($this->db->delete('korporasi_ubi_olahan', ['id' => $id])) {
            echo json_encode([
                'status' => true,
                'message' => 'Kelompok Ubi Olahan berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Kelompok Ubi Olahan gagal dihapus'
            ]);
        }
    }

    private function validate_request()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = [
			[
                'field' => 'id_kecamatan',
                'label' => 'Kecamatan',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus dipilih',
                ]
            ],
			[
                'field' => 'id_desa',
                'label' => 'Desa',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus dipilih',
                ]
            ],
            [
                'field' => 'nama_korporasi_ubi_jalar',
                'label' => 'Nama Kelompok Ubi Olahan',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '%s harus diisi',
                ]
            ],
			[
                'field' => 'brand',
                'label' => 'Brand',
                'rules' => 'trim|required',
                'errors' => [
					'required' => '%s harus diisi',
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
				'field' => 'ketua',
				'label' => 'Ketua',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'sekretaris',
				'label' => 'Sekretaris',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
				'field' => 'bendahara',
				'label' => 'Bendahara',
				'rules' => 'trim|required',
				'errors' => [
					'required' => '%s harus diisi',
				]
			],
			[
                'field' => 'no_hp',
                'label' => 'Nomor Hp',
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
