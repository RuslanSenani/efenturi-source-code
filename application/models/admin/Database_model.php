<?php
class database_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insert($table, $ar)
    {

        if ($this->admin_model->get_admin()) {
            $this->db->insert($table, $ar);
        }
    }


    public function delete($table, $id)
    {
        if ($this->admin_model->get_admin()) {
            if (!is_array($id)) {
                $this->db->where('id', $id)->delete($table);
            } else {
                $this->db->where_in('id', $id)->delete($table);
            }
        }
    }

    public function delete_array($table, $ar = array())
    {
        if ($this->admin_model->get_admin()) {
            $this->db->where($ar)->delete($table);
        }
    }


    public function update($table, $ar, $id)
    {
        $id = explode(',', $id);
        if ($this->admin_model->get_admin()) {
            if (!is_array($id)) {
                $this->db->where('id', $id)->update($table, $ar);
            } else {
                $this->db->where_in('id', $id)->update($table, $ar);
            }
        }
    }

    public function update_image($table, $ar, $id)
    {

        $id = explode(',', $id);
        if ($this->admin_model->get_admin()) {
            if (!is_array($id)) {
                $this->db->where('event_id', $id)->update($table, $ar);
            } else {
                $this->db->where_in('event_id', $id)->update($table, $ar);
            }
        }
    }


    
    public function read($table, $order = array('id', 'desc'), $group = 'id', $ar = array('id!=' => 0))
    {
        if ($this->admin_model->get_admin()) {
            $result = $this->db->where($ar)->order_by($order[0], $order[1])->group_by($group)->get($table)->result_array();
            return $result != null ? $result : array();
        }
    }

    public function read_array($table, $ar, $order = array('id', 'desc'))
    {
        if ($this->admin_model->get_admin()) {
            $result = $this->db->where($ar)->order_by($order[0], $order[1])->get($table)->result_array();
            return $result != null ? $result : array();
        }
    }


    public function read_row($table, $id)
    {
        if ($this->admin_model->get_admin()) {
            $result = null;
            if (!is_array($id)) {
                $result = $this->db->where('id', $id)->get($table)->row_array();
            } else {
                $result = $this->db->where($id)->get($table)->row_array();
            }
            return $result != null ? $result : array();
        }
    }


    public function copy_row($table, $ar, $id_array)
    {
        if ($this->admin_model->get_admin()) {
            $string = implode(',', $ar);
            if (is_array($id_array)) {
                $id = implode(',', $id_array);
            } else {
                $id = $id_array;
            }
            $this->db->query("insert into $table($string) select $string from $table where id in ($id)");
        }
    }


    public function query($sql)
    {
        if ($this->admin_model->get_admin()) {
            $result = $this->db->query($sql)->result_array();
            return $result != null ? $result : array();
        }
    }


    public function query_row($sql)
    {
        if ($this->admin_model->get_admin()) {
            $result = $this->db->query($sql)->row_array();
            return $result != null ? $result : array();
        }
    }


    //admin login
    public function read_row_query($table, $ar)
    {
        $result = $this->db->where($ar)->get($table)->row_array();
        return $result != null ? $result : array();
    }


    public function update_token($token, $id)
    {
        $this->db->where('id', $id)->update('account', array('token' => $token, 'lastlogin' => date('d-m-Y H:i:s')));
    }
}
