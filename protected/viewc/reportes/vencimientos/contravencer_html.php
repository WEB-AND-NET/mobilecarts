<?php
$fi = $data["fi"];
$ff = $data["ff"];
?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Vehiculos con Contractual por vencer
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>contravencer">Contractual por Vencer</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls" style="float:right;">
                        <!-- Check all button -->
                        <div class="btn-group">
                            <a href="<?= $patch; ?>contravencer/save/<?= $fi; ?>/<?= $ff; ?>" id="btn-pdf" class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-text-o"></i><br /><span>PDF</span></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Placa</th>
                                    <th>Contractual(Mes/Día/Año)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data["vehiculos"] as $r) {
                                ?>
                                    <tr>
                                        <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                        <td><?= $r['placa']; ?></td>
                                        <td><?= $r['v_contra']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Placa</th>
                                    <th>Contractual(Mes/Día/Año)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?= $patch ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tabledatas").DataTable();
    });
    $('#btn-cancel').click(function() {
        window.location = '<?= $patch; ?>';
    });
</script>