<?php

class M_monitoring extends CI_Model {

	function get_all(){
		$this->db->select('*');
        $this->db->from('tbl_monitoring');
        $this->db->order_by('id_monitoring','DESC');
        return $this->db->get()->result();
	}

    public function get_data_header()
    {
        $this->db->select('*');
        $this->db->from('tbl_monitoring');
        $this->db->order_by('id_monitoring','DESC');
        $this->db->limit(1);

        return $this->db->get();
    }

    public function get_status($waktu)
    {
        $this->db->select('*');
        $this->db->from('tbl_monitoring');
        $this->db->where('waktu',$waktu);

        return $this->db->get();
    }
}