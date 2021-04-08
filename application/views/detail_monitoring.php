<div class="col-lg-12">
    <div class="form-group">
        <button class="btn btn-primary" id="btn-scan" style="width: 100%;">Scan</button>
    </div>
</div>
<div class="col-lg-12">
    <form role="form">
        <div class="form-group input-group">
            <label class="input-group-addon">Lifetime = </label>
            <input type="text" class="form-control" value="" readonly>
            <label class="input-group-addon">Kali</label>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Presentase Baterai = </label>
            <input type="text" class="form-control" value="" readonly>
            <label class="input-group-addon">%</label>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Daya = </label>
            <input type="text" class="form-control" value="<?= $header->daya?>" readonly>
            <label class="input-group-addon">Watt</label>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Biaya = </label>
            <span class="input-group-addon">Rp</span>
            <input type="text" class="form-control" value="" readonly>
            <span class="input-group-addon">.00</span>
        </div>
        <div class="form-group input-group">
            <label class="input-group-addon">Status = </label>
            <input type="text" class="form-control" value="" readonly>

        </div>
    </form>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Data Monitoring
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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