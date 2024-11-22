<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataTable extends CI_Model
{
    public function fetch_data($table, $search_by, $keyword, $select, $limit, $offset, $group_by = [], $order_by = [], $join = [], $where = []) {
        $this->_set_datatables_query($table, $search_by, $keyword, $select, $group_by, $order_by, $join, $where);

        $this->db->like($search_by, trim( strtolower($keyword) ));
        $this->db->limit($limit, $offset); 
        
        return $this->db->get()->result();
    }

    private function _set_datatables_query($table, $search_by, $keyword, $select, $group_by, $order_by, $join, $where) {
        $this->db->select($select);
        $this->db->from($table);

        if ($join) {
            foreach ($join as $j) {
                if ($j['direction'] == "") {
                    $this->db->join($j['field'], $j['condition']);
                } else {
                    $this->db->join($j['field'], $j['condition'], $j['direction']);
                }
            }
        }

        if ($where) {
            $this->db->where($where);
        }

        if ($group_by) {
            $this->db->group_by($group_by);
        }

        if ($order_by) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
    }
}