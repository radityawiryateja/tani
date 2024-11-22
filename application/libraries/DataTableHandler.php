<?php

namespace App\libraries;

defined('BASEPATH') or exit('No direct script access allowed');

class DataTableHandler
{
    private $config;
    private $CI;

    private static $instance;

    public function __construct($config)
    {
        $this->config = $config;
        $this->CI     = &get_instance();
    }

    public static function getInstance($config)
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function load($row_no = 0)
    {
        $this->CI->load->model('utils/DataTable', 'Table');
        $this->CI->load->library('pagination');

        $tabel     = $this->config['table'];
        $select    = $this->config['select'];
        $order_by  = $this->config['order_by'];
        $join      = $this->config['join'];
        $group_by  = $this->config['group_by'];
        $where     = $this->config['where'];
        $limit     = $this->CI->input->post('per_page', true) ?? 10;
        $offset    = $row_no != 0 ? ($row_no - 1) * $limit : $row_no;
        $search_by = $this->CI->input->post('search_by', true);
        $keyword   = $this->CI->input->post('keyword', true);

        $datas = $this->CI->Table->fetch_data($tabel, $search_by, $keyword, $select, $limit, $offset, $group_by, $order_by, $join, $where);

        $this->CI->db->from($tabel);

        if ($join) {
            foreach ($join as $j) {
                if ($j['direction'] == "") {
                    $this->CI->db->join($j['field'], $j['condition']);
                } else {
                    $this->CI->db->join($j['field'], $j['condition'], $j['direction']);
                }
            }
        }

        if ($where) {
            $this->CI->db->where($where);
        }

        if ($group_by) {
            $this->CI->db->group_by($group_by);
        }

        if ($keyword) {
            $this->CI->db->like($search_by, strtolower($keyword));
        }

        $config['base_url']         = $this->config['base_url'];
        $config['total_rows']       = $this->CI->db->get()->num_rows();
        $config['per_page']         = $limit;
        $config['use_page_numbers'] = true;

        $this->CI->pagination->initialize($config);

        $data['pagination'] = $this->CI->pagination->create_links();
        $data['result']     = $datas;
        $data['row']        = $offset;

        return $data;
    }
}
