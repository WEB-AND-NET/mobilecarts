<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Definici&oacute;n de Afiliados
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Definici&oacute;n de Afiliados</li>
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
                            <a href="<?= $patch; ?>propietarios/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span>Nuevo</span></a>
                            <a href="<?= $patch; ?>propietarios/edit" id="btn-edit"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span>Editar</span></a>
                            <a href="<?= $patch; ?>propietarios/activar" id="btn-activar" class="btn btn-default btn-md"><i class="fa fa-check"></i><br/><span>Activar</span></a>
                            <a href="<?= $patch; ?>propietarios/desactivar" id="btn-desactivar" class="btn btn-default btn-md"><i class="fa fa-check"></i><br/><span>Desactivar</span></a>
                            <a href="<?= $patch; ?>propietarios/bloquear" id="btn-bloqueo" class="btn btn-default btn-md"><i class="fa fa-ban"></i><br/><span>Bloquear</span></a>
                            <!--<a href="<?//= $patch; ?>propietarios/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span>Eliminar</spa></a>-->
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Razon Social</th>
                                <th>T&eacute;lefono</th>
                                <th>Email</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["propietarios"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?php echo $r['id']; ?>" /></td>
                                    <td><?php echo $r['identificacion']; ?></td>
                                    <td><?php echo $r['razon_social']; ?></td>
                                    <td><?php echo $r['telefono']; ?></td>
                                    <td><?php echo $r['email']; ?></td>
                                    <?php                                     
                                        if($r['estado']=="H"){
                                            $styl="label label-success";
                                            $estado="Habilitado";
                                            if ($r['valido']=="NO"){
                                                $styl="label label-warning";
                                                $estado="Bloqueado";
                                            }
                                        }else{
                                            $styl="label label-danger";
                                            $estado="Deshabilitado";
                                        } 
                                       echo '<td><span class="label '.$styl.'">'.$estado.'</span></td>'; 
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Razon Social</th>
                                <th>T&eacute;lefono</th>
                                <th>Email</th>
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
    
    $('#btn-activar').click(function (e) {
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
    
    $('#btn-desactivar').click(function (e) {
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

//    $('#btn-delete').click(function (e) {
//        item = $('input[name=item]:checked').attr('value');
//        if (!item) {
//            alert('Debe seleccionar un item');
//            e.preventDefault();
//        }
//        else {
//            var action = $(this).attr("href") + "/" + item;
//            $(this).attr("href", action);
//        }
//    });
    
    $('#btn-bloqueo').click(function (e) {
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
    

    $('#btn-find').click(function () {
        $('#form1').submit();
    });
</script>
