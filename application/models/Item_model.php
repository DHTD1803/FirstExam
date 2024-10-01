<?php

class Item_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_item($param = '') {
        isset($param) && !empty($param) ? $this->db->select($param) : $this->db->select('*');
        return $this->db->get("items")->result_array();
    }

    public function get_item($id = '') {
        isset($id) && !empty($id) ? $this->db->where("id", $id) : $this->db->select("*");
        return $this->db->get("items")->row_array();
    }

    public function get_item_with_conditional($conditional = []) {
        isset($conditional) && !empty($conditional) ? $this->db->where($conditional) : $this->db->select("*");
        return $this->db->get("items")->result_array();
    }

    public function insert_new_item($data) {
        $this->db->insert("items", $data);
        return $this->db->insert_id();
    }
}
