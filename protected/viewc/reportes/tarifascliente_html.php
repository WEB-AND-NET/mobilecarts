<?php 
    $id_cli = $data["id_cli"];
    $cliente = $data["cliente"];
?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Tarifas de Cliente : <?= $cliente["nombre"] ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>tarifas_cliente">Tarifas por Cliente</a></li>
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
                            <a href="<?= $patch; ?>tarifas_cliente/imprimir/<?= $id_cli; ?>" id="btn-pdf"class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-text-o"></i><br/><span>PDF</span></a>                            
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tarifa</th>
                                <th>Clase Vehiculo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["tarifas"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r["nombreo"] . " - " . $r["nombred"]; ?></td>
                                    <td><?= $r['clase']; ?></td>
                                    <td><?= "$" . number_format($r["valor"], 2, ".", ","); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tarifa</th>
                                <th>Clase Vehiculo</th>
                                <th>Valor</th>
                            </tr>
                        </tfoot>
                    </table>
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
    $(function () {
        $("#tabledatas").DataTable();
    });
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>';
    });
</script>
