<?php

class M_codeigniter extends CI_Model {

	function get($table){
		return $this->db->get($table);
	}

	function get_where($table, $where){
		return $this->db->get_where($table, $where);
	}
	
	function insert($table, $data){
		$this->db->insert($table, $data);
		if ($this->db->affected_rows() > 0) {
            // return $this->db->insert_id();
            return true;
        } else {
            return false;
        }
	}
}