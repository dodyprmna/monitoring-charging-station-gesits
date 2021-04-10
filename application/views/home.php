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
                
                $("#btn-scan").hide();
                camScanner();

                $(document).on("click", "#btn-scan", function () {
                    location.reload();
                });
            });

            function camScanner() {
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),mirror: false, });
                scanner.addListener('scan', function (content) {

                    var sound = document.getElementById("sound");
                    sound.play();

                    var getDataRealtime = setInterval(function (){ 
                            $.ajax({
                                url: "Monitoring/get_data_real_time",
                                type: "post",
                                dataType: "json",
                                data: {id : content},
                                success: function (data) {
                                    $("#data-monitoring").html(data);
                                    $('#tabel-monitoring').dataTable({
                                        searching: false,
                                        scrollY : '370px',
                                        paging: false,
                                        info: false
                                    });
                                    scanner.stop();
                                    $("#data-scanner").hide();
                                },
                            });
                    }, 1000);
                    
                });
                Instascan.Camera.getCameras().then(function (cameras) {
                    if (cameras.length > 0) {
                        if (cameras[1]) {
                            scanner.start(cameras[1]);
                        } else {
                            scanner.start(cameras[0]);
                        }
                    
                    } else {
                    console.error('No cameras found.');
                    }
                }).catch(function (e) {
                    console.error(e);
                });
            }
        </script>

    </body>
</html>
