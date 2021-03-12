<?php

class front_database_model extends CI_Model
{
    //front database function
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    public function front_read($table, $ar = array('id!=' => 0), $order = array('id', 'desc'), $limit = 1000000)
    {
        $result = $this->db->where($ar)->order_by($order[0], $order[1])->limit($limit)->get($table)->result_array();

        return $result != null ? $result : array();
    }

    public function front_read_row($table, $ar = array())
    {
        $result = $this->db->where($ar)->get($table)->row_array();
        return $result != null ? $result : array();
    }


    public function front_read_in($table, $col, $ar = array(), $where = array())
    {

        $result = $this->db->where($where)->where_in($col, $ar)->get($table)->result_array();
        return $result != null ? $result : array();
    }


    public function front_read_in_row($table, $col, $ar = array(), $where = array())
    {
        $result = $this->db->where_in($col, $ar)->get($table)->row_array();
        return $result != null ? $result : array();
    }


    public function front_query($sql)
    {
        $result = $this->db->query($sql)->result_array();
        return $result != null ? $result : array();
    }

    public function front_query_row($sql)
    {

        $result = $this->db->query($sql)->row_array();

        return $result != null ? $result : array();
    }


    public function front_insert($table, $ar)
    {
        $this->db->insert($table, $ar);
    }

    public function front_update($table, $ar, $ar2)
    {
        $this->db->where($ar2)->update($table, $ar);
    }

    public function front_delete($table, $ar)
    {
        $this->db->where($ar)->delete($table);
    }
}
