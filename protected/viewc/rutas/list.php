<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Definici&oacute;n de Rutas
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Definici&oacute;n de Rutas</li>
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
                            <a href="<?= $patch; ?>rutas/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br /><span>Nuevo</span></a>
                            <a href="<?= $patch; ?>rutas/edit" id="btn-edit" class="btn btn-default btn-md"><i class="fa fa-edit"></i><br /><span>Editar</span></a>
                            <a href="<?= $patch; ?>rutas/tarifas" id="btn-tar" class="btn btn-default btn-md"><i class="fa fa-money"></i><br /><span>Tarifas</span></a>
                            <a href="<?= $patch; ?>rutas/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br /><span>Eliminar</spa></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Numero</th>
                                    <th>Nombre</th>
                                    <th>Zona Origen</th>
                                    <th>Zona Destino</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data["rutas"] as $r) {
                                ?>
                                    <tr>
                                        <td><input class="minimal" name="item" type="radio" value="<?php echo $r['id']; ?>" /></td>
                                        <td><?php echo $r['numero']; ?></td>
                                        <td><?php echo $r['nombre']; ?></td>
                                        <td><?php echo $r['Zona_origen']; ?></td>
                                        <td><?php echo $r['Zona_destino']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Numero</th>
                                    <th>Nombre</th>
                                    <th>Zona Origen</th>
                                    <th>Zona Destino</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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

    $('#btn-tar').click(function(e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-delete').click(function(e) {
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