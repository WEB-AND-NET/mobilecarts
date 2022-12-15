<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Definici&oacute;n de Vehiculos
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Definici&oacute;n de Vehiculos</li>
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
                            <a href="<?= $patch; ?>vehiculos_propietario/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span>Nuevo</span></a>
                            <a href="<?= $patch; ?>vehiculos_propietario/edit" id="btn-edit"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span>Editar</span></a>
                            <a href="<?= $patch; ?>vehiculos_propietario/documentos" id="btn-docs" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span>Documentos</spa></a>
                            <a href="<?= $patch; ?>vehiculos_propietario/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span>Eliminar</spa></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Placa</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Clase</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["vehiculos"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['placa']; ?></td>
                                    <td><?= $r['modelo']; ?></td>
                                    <td><?= $r['marca']; ?></td>
                                    <td><?= $r['clase']; ?></td>
                                    <?php
                                        $txt = "Activo";
                                        $style = "label label-success";
                                        if($r['estado'] === "D"){
                                          $txt = "Inactivo"; 
                                          $style = "label label-danger";
                                        }
                                    ?>
                                    <td><span class="label <?= $style ?>"><?= $txt ?></span></td>  
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Placa</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Clase</th>
                                <th>Estado</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?php $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function () {
        $("#tabledatas").DataTable();
    });

    $('#btn-edit').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });
    $('#btn-docs').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-delete').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            if(confirm("¿Esta seguro de eliminar?")){
                var action = $(this).attr("href") + "/" + item;
                $(this).attr("href", action);
            }else{
                e.preventDefault();
            }
        }
    });

    $('#btn-find').click(function () {
        $('#form1').submit();
    });
    
</script>