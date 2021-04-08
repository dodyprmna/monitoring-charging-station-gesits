<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {
	public function __construct() {
        Parent::__construct();
        $this->load->model('M_codeigniter');
        $this->load->model('M_monitoring');
	}

	public function index(){
        $this->load->view('home');
    }

    public function insert()
    {
        //ambil data dari kontroler
    	$fk_charging_station    = $this->input->get('id_charging_station');
        $arus                   = $this->input->get('arus');
        $tegangan               = $this->input->get('tegangan');
        $daya                   = $this->input->get('daya');
        $biaya                  = $this->input->get('biaya');
        $lifetime               = $this->input->get('lifetime');

        $data = array(
            'fk_charging_station'   => $fk_charging_station, 
            'arus'                  => $arus,
            'tegangan'              => $tegangan,
            'daya'                  => $daya,
            'biaya'                 => $biaya,
            'lifetime'              => $lifetime
        );

        //input data ke database
        $insert = $this->M_codeigniter->insert('tbl_monitoring',$data);

        // jika berhasil input tampikan pesan sukses
        if ($insert) {
            echo "sukses";
        } else {
            echo "gagal";
        }        
    }

    public function get_data_real_time()
    {
        $id = $this->input->post('id');
        $data = array(
            'monitor'    => $this->M_monitoring->get_by_id($id)->result(),
            'header'     => $this->M_monitoring->get_data_header($id)->row()
        );

        $output = $this->load->view('detail_monitoring',$data,true);

        echo json_encode($output);
    }


}