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
    	$fk_charging_station    = $this->input->get('id_charging_station');
        $arus                   = $this->input->get('arus');
        $tegangan               = $this->input->get('tegangan');
        $daya                   = $this->input->get('daya');
        $biaya                  = $this->input->get('biaya');

        // simpan dalam array
        $data = array(
            'fk_charging_station'   => $fk_charging_station, 
            'arus'                  => $arus,
            'tegangan'              => $tegangan,
            'daya'                  => $daya,
            'biaya'                 => $biaya,
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

        //get jumlah device terdaftar di db?
        $cek = $this->M_codeigniter->get_where('tbl_charging_station',array('id_charging_station' => $id))->num_rows();

        // data scan
        $data_scan = array(
            'fk_charger' => $id, 
        );

        //jika jumlah lebih dari 0 atau terdapat device dengan identitas qrcode yg discan
        if ($cek > 0) {

            //input data scan
            $this->M_codeigniter->insert('tbl_scan',$data_scan);
            $output = array(
                'status' => true,
                'pesan' => 'sukses'
            );
        } else {
            $output = array(
                'status' => false,
                'pesan' => "<div class='col-lg-12'><center><h4>Data tidak ditemukan, silahkan scan ulang dengan qrcode yang benar</h4></center><br><div class='form-group'><button class='btn btn-primary' id='btn-scan' style='width: 100%;'>Scan</button></div></div>"
            );
        }

        echo json_encode($output);
    }


    // fungsi ambil data realtime
    public function get_data_real_time()
    {
        //ambil id dari scan qrcode
        $id = $this->input->post('id');

        //ambil tanggal dan waktu sekarang
        $now = date("Y-m-d H:i:s");

        //ambil data 1 detik terakhir untuk menentukan status charging atau off
        $status = $this->M_monitoring->get_status($id,date('Y-m-d H:i:s',strtotime('-1 seconds',strtotime($now))))->num_rows();
        
        //cek apakah ada data charging station berdasarkan id yg diambil dari scan qrcode ?
        // jika ada, ambil data monitoring charging statiom tsb
        $data = array(
            'monitor'    => $this->M_monitoring->get_by_id($id)->result(),
            'header'     => $this->M_monitoring->get_data_header($id)->row(),
            'lifetime'   => $this->M_codeigniter->get_where('tbl_scan', array('fk_charger' => $id))->num_rows(),
            'status'     => $status,
        );
        
        //set output dengan tampilan detail_monitoring
        $output = $this->load->view('detail_monitoring',$data,true);
        // echo $output dalam bentuk json
        echo json_encode($output);
    }


}