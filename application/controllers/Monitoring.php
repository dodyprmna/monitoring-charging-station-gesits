<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {
	public function __construct() {
        Parent::__construct();
        $this->load->model('M_codeigniter');
        $this->load->model('M_monitoring');
	}

	public function index(){
        
    }

    public function insert()
    {
    	$fk_charging_station    = $this->input->get('id_charging_station');
        // $waktu                  = $this->input->get('waktu');
        $arus                   = $this->input->get('arus');
        $tegangan               = $this->input->get('tegangan');

        $data = array(
            'fk_charging_station'   => $fk_charging_station, 
            // 'waktu'                 => $waktu,
            'arus'                  => $arus,
            'tegangan'              => $tegangan
        );

        // echo $fk_charging_station;
        $insert = $this->M_codeigniter->insert('tbl_monitoring',$data);

        if ($insert) {
            echo "sukses";
        } else {
            echo "gagal";
        }
        
    }
}