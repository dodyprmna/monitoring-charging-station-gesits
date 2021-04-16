<div class="col-lg-12">
    <div class="form-group">
        <button class="btn btn-primary" id="btn-scan" style="width: 100%;">Scan</button>
    </div>
</div>
<div class="col-lg-12">
    <form role="form">
        <div class="form-group input-group">
            <label class="input-group-addon">Charger</label>
            <input type="text" class="form-control" value="<?= $header->nama_charger?>" readonly>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Lifetime</label>
            <input type="text" class="form-control" value="<?= $lifetime?>" readonly>
            <label class="input-group-addon">Kali</label>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Daya</label>
            <input type="text" class="form-control" value="<?= $header->daya?>" readonly>
            <label class="input-group-addon">Watt</label>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Biaya</label>
            <span class="input-group-addon">Rp</span>
            <input type="text" class="form-control" value="<?= number_format($header->biaya,2,',','.');?>" readonly>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon" style="text-align: left;">Status = </label>
            <input type="text" class="form-control"readonly>
            <span class="input-group-addon" style="text-align: center;">
                <?php if($status == 1):?>
                    <span class="badge badge-success">Charging</span>
                <?php else:?>
                    <span class="badge badge-danger" style="background-color: red;">Off</span>
                <?php endif;?>
            </span>
            
        </div>
    </form>
</div>
<div class="col-lg-12">
    <div class="panel panel-default" style="height: 500px;">
        <div class="panel-heading">
            Data Monitoring
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tabel-monitoring">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Arus</th>
                            <th>Tegangan</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nourut = 1;
                        foreach ($monitor as $m) :?>
                        <tr>
                            <td><?php echo $nourut++;?></td>
                            <td><?php echo $m->waktu?></td>
                            <td><?php echo $m->arus?></td>
                            <td><?php echo $m->tegangan?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->

        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>