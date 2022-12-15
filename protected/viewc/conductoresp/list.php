<link href="<?= $data['rootUrl'] ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Definici&oacute;n de Conductores Propietarios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $data['rootUrl'] ?>">Inicio</a></li>
        <li class="active">Definici&oacute;n de Conductores Propietarios</li>
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
                            <a href="<?=$data['rootUrl']; ?>conductores/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span>Nuevo</span></a>
                            <a href="<?= $data['rootUrl']; ?>conductores/edit" id="btn-edit"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span>Editar</span></a>
                            <a href="<?= $patch; ?>conductores/documents/view" id="btn-documents"class="btn btn-default btn-md"><i class="fa fa-archive"></i><br/><span>Ver Documentos</span></a> 
                              <a href="<?= $data['rootUrl']; ?>conductoresp/activate" id="btn-activate"class="btn btn-default btn-md"><i class="fa fa-check"></i><br/><span>Activar</span></a>
                            <a href="<?= $data['rootUrl']; ?>conductoresp/deactivate" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-times"></i><br/><span>Desactivar</span></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>                               
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Propietario</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["conductores"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>                                    
                                    <td><?= $r['identificacion']; ?></td>
                                    <td><?= $r['nombre']; ?></td>
                                    <td><?= $r['celular']; ?></td>
                                    <td><?= $r['email']; ?></td>
                                    <td>
                                    <?php                                    
                                        switch($r['tipo']){
                                            case "F":
                                                $txt = "FIJO";
                                                break;
                                            case "A":
                                                $txt = "AFILIADO";
                                                break;
                                            case "C":
                                                $txt = "CONVENIO";
                                                break;
                                            default :
                                                $txt = "";
                                        }                 
                                        echo $txt;
                                    ?>
                                    </td>
                                    <td><?= $r['propietario']; ?></td>
                                    <?php
                                        $txt = "Activo";
                                        $style = "label label-success";
                                        if($r['estado_c_p'] === "I"){
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
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Propietario</th>
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
<script>
 $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function () {
        $("#tabledatas").DataTable();
    });

    $('#btn-documents').click(function (e) {
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
    
    $('#btn-activate').click(function (e) {
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
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-find').click(function () {
        $('#form1').submit();
    });
</script>