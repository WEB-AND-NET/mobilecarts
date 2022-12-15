<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?= $hoy = date("Y-m-d");?>

<section class="content-header">
    <h1>
        Lista de Mantenimientos de <?php echo $data['vehiculo']->placa; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>/vehiculos">Vehiculos</a></li>
        <li class="active">Lista de Mantenimientos</li>
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
                        <a href="<?= $patch; ?>mantenimientos/add/<?php echo $data['id']?>" id="btn-new"class="btn btn-default btn-md"><i class="fa fa-archive"></i><br/><span>Nuevo</span></a>
                            <a href="<?= $patch; ?>mantenimientos/edit" id="btn-edit" class="btn btn-default btn-md"><i class="fa fa-edit"></i><br /><span>Editar</span></a>
                            <a href="<?= $patch; ?>mantenimientos/finish"  id="btn-finish" class="btn btn-default btn-md"><i class="fa fa-check-square-o"></i><br /><span>Finalizar</spa></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tipo</th>
                                <th>Prog. fecha</th>
                                <th>Prog. Km</th>
                                <th>Factura</th>
                                <th>Fecha finalizacion</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["mantenimientos"] as $r) {
                            ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?php switch ($r['tipo']){ case "PRE": echo "Preventivo"; break; case "COR": echo "Correctivo"; break; case "EVO": echo "Evolutivo"; break; case "ADA": echo "Adaptativo"; break; case "OTR": echo "Otro"; break; default: echo $r['tipo']; break;} ?></td>
                                    <td><?= $r['fecha']; ?></td>
                                    <td><?= $r['km']; ?></td>
                                    <td><a target="_blank" href="<?php echo $data['rootUrl'] ?>documentacion/FacturasMantenimientos/<?php echo $r['archivoFactura'] != "" ? $r['archivoFactura'] : "NA.JPG" ?>">Ver</a></td>
                                    <td><?= $r['fechaCierre']; ?></td>
                                    <td style="background-color: <?= $r['estado'] == 'T' ? 'green;'  : ($r['fecha'] < $hoy  ? 'red;' : '#fcaf5d;');?> color: white;"><?= $r['estado'] == 'P' ? 'Programado' : 'Terminado'; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tipo</th>
                                <th>Programado</th>
                                <th>Factura</th>
                                <th>Fecha finalizacion</th>
                                <th>Estado</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>

<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function() {
        $("#tabledatas").DataTable();
    });

    $('#btn-edit').click(function(e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-finish').click(function(e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-find').click(function() {
        $('#form1').submit();
    });
</script>