<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Monitoring Charging Station</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('assets/css/metisMenu.min.css')?>" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="<?php echo base_url('assets/css/dataTables/dataTables.bootstrap.css')?>" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?php echo base_url('assets/css/dataTables/dataTables.responsive.css')?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('assets/css/startmin.css')?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand">Monitoring Charging Station</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Monitoring')?>"><i class="fa fa-search fa-fw"></i> Scan QR</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Monitoring Daya <i>Charging Station</i>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <audio src="<?= base_url('assets/audio/beep.mp3')?>" id="sound"></audio>
                    <div class="row" id="data-scanner">
                        <div class="col-lg-12" align="center">
                            <video id="preview" width="320" height="320"></video>
                        </div>
                    </div>
                    <div class="row" id="data-monitoring">
                        
                    </div>
                    <!-- /.row -->
                    
                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('assets/js/metisMenu.min.js')?>"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/dataTables/dataTables.bootstrap.min.js')?>"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('assets/js/startmin.js')?>"></script>

        <!-- instascan -->
        <script src="<?php echo base_url('assets/js/instascan.min.js')?>"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->

        <script>

            $(document).ready(function () {
                
                // ketika membuka halaman ini
                // otomatis akan menyembunyikan tombol scan dan menjalankan fungsi camScanner
                $("#btn-scan").hide();
                camScanner();

                // ketika btn-scan di clik akan menjalankan fungsi dibawah
                $(document).on("click", "#btn-scan", function () {
                    location.reload();
                });
            });

            // fungsi camScanner
            function camScanner() {

                // variabel scanner untuk menjalankan scanner pada documen dengan id preview
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),mirror: false, });

                // scan qr code untuk menangkap isi qrcode yg disimpan dalam content
                scanner.addListener('scan', function (content) {

                    // menjalankan bunyi beep
                    var sound = document.getElementById("sound");
                    sound.play();

                    // insert data scan
                    $.ajax({
                        url: "Monitoring/scan",
                        type: "post",
                        dataType: "json",
                        data: {id : content},

                        //ketika sukses, menjalankan fungsi dibawah
                        success: function (data) {
                            // jika status berhasil
                            // menjalankan ajax request dengan interval 1 detik

                            if(data.status){
                                setInterval(function (){ 
                                        $.ajax({
                                            url: "Monitoring/get_data_real_time",
                                            type: "post",
                                            dataType: "json",
                                            data: {id : content},

                                            //ketika sukses, menjalankan fungsi dibawah
                                            success: function (data) {
                                                // set document id data-monitoring dengan data
                                                // data dikirim dari controller Monitoring/get_data_real_time dalam bentuk json
                                                $("#data-monitoring").html(data);

                                                //dataTables
                                                $('#tabel-monitoring').dataTable({
                                                    searching: false,
                                                    scrollY : '370px',
                                                    paging: false,
                                                    info: false
                                                });

                                                // menonaktifkan scanner dan menyembunyikannya
                                                scanner.stop();
                                                $("#data-scanner").hide();
                                            },
                                        });
                                }, 1000);
                            }else{
                                // jika gagal
                                // menampilkan pesan
                                $("#data-monitoring").html(data.pesan);
                                // menutup scanner
                                scanner.stop();
                                $("#data-scanner").hide();
                            }
                        },
                    });
                });

                // get camera
                Instascan.Camera.getCameras().then(function (cameras) {

                    // apakah diperangkat ini terdapat kamera?
                    if (cameras.length > 0) {
                        // jika iya
                        // cek apakah ada kamera ke 2 (kamera belakang)
                        // jika ada start kamera belakang
                        if (cameras[1]) {
                            scanner.start(cameras[1]);
                        } else {
                            // jika tidak start kamera depan/ webcam laptop
                            scanner.start(cameras[0]);
                        }
                    
                    } else {
                        // jika tidak ada kamera sama sekali, menampilkan error
                        console.error('No cameras found.');
                    }
                }).catch(function (e) {
                    console.error(e);
                });
            }
        </script>

    </body>
</html>
