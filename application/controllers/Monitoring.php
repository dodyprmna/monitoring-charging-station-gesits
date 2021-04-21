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


    //fungsi insert data dari kontroller ke database
    public function insert()
    {
        //ambil data dari kontroler
        $arus                   = $this->input->get('arus');
        $tegangan               = $this->input->get('tegangan');
        $daya                   = $this->input->get('daya');
        $kwh                    = $this->input->get('kwh');
        $biaya                  = $this->input->get('biaya');

        // simpan dalam array
        $data = array(
            'arus'                  => $arus,
            'tegangan'              => $tegangan,
            'daya'                  => $daya,
            'biaya'                 => $biaya,
            'kwh'                   => $kwh
        );

        //input data ke database tbl_monitoring
        $insert = $this->M_codeigniter->insert('tbl_monitoring',$data);

        // jika berhasil input tampikan pesan sukses
        if ($insert) {
            echo "sukses";
        } else {
            echo "gagal";
        }        
    }

    public function scan()
    {
        // get id dari scan
        $id = $this->input->post('id');

        // data scan
        $data_scan = array(
            'kode_baterai' => $id, 
        );

        $insert = $this->M_codeigniter->insert('tbl_scan',$data_scan);
        //jika berhasil insert data scan
        if ($insert > 0) {

            //set output
            $output = array(
                'status' => true,
                'pesan' => 'sukses'
            );
        } else {
            $output = array(
                'status' => false,
                'pesan' => "<div class='col-lg-12'><center><h4>Gagal</h4></center></div></div>"
            );
        }

        echo json_encode($output);
    }


    // fungsi ambil data realtime
    public function get_data_real_time()
    {
        //ambil tanggal dan waktu sekarang
        $now = date("Y-m-d H:i:s");

        //ambil data 1 detik terakhir untuk menentukan status charging atau off
        $status = $this->M_monitoring->get_status(date('Y-m-d H:i:s',strtotime('-1 seconds',strtotime($now))))->num_rows();
        
        // simpan data yang akan ditampilkan dalam bentuk array
        $data = array(
            'monitor'    => $this->M_monitoring->get_all(),
            'header'     => $this->M_monitoring->get_data_header()->row(),
            'lifetime'   => $this->db->get('tbl_scan')->num_rows(),
            'status'     => $status,
        );
        
        //set output dengan tampilan detail_monitoring
        $output = $this->load->view('detail_monitoring',$data,true);
        // echo $output dalam bentuk json
        echo json_encode($output);
    }


}