<?php

class M_monitoring extends CI_Model {

	function get_all(){
		$this->db->select('*');
        $this->db->from('tbl_monitoring m');
        $this->db->join('tbl_charging_station c','m.fk_charging_station = c.id_charging_station');
        $this->db->order_by('m.id_monitoring','DESC');

        return $this->db->get()->result();
	}

	function get_by_id($id){
		$this->db->select('*');
        $this->db->from('tbl_monitoring m');
        $this->db->join('tbl_charging_station c','m.fk_charging_station = c.id_charging_station');
        $this->db->where('c.id_charging_station',$id);
        $this->db->order_by('m.id_monitoring','DESC');

        return $this->db->get();
	}
}