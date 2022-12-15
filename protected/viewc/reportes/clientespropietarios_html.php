<?php 
    $id_pro = $data["id_pro"];
    $propietario = $data["propietario"];
?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Clientes de Propietario : <?= $propietario["razon_social"] ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>clientes_propietarios">Clientes por Propietario</a></li>
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
                            <a href="<?= $patch; ?>clientes_propietarios/imprimir/<?= $id_pro; ?>" id="btn-pdf"class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-text-o"></i><br/><span>PDF</span></a>                            
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>C.C. / NIT</th>
                                <th>Contratante</th>
                                <th>C.C.</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["clientes"] as $r) {                               
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['identificacion']; ?></td>
                                    <td><?= $r['nombre']; ?></td>
                                    <td><?= $r['celular']; ?></td>
                                    <td><?= $r['c_nombre']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>C.C. / NIT</th>
                                <th>Contratante</th>
                                <th>C.C.</th>
                                <th>Responsable</th>
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
