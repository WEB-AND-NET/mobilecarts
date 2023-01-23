<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Definici&oacute;n de Clientes
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Definici&oacute;n de Clientes</li>
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
                            <a href="<?= $patch; ?>clientes_pro/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br /><span>Nuevo</span></a>
                            <a href="<?= $patch; ?>clientes_pro/edit" id="btn-edit" class="btn btn-default btn-md"><i class="fa fa-edit"></i><br /><span>Editar</span></a>
                            <a href="<?= $patch; ?>clientes/contratos/edit" id="btn-edit-contrato" class="btn btn-default btn-md"><i class="fa fa-file-text-o"></i><br /><span>Contrato</span></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Identificaci&oacute;n</th>
                                    <th>Nombre</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["clientes"] as $r) {  ?>
                                    <tr>
                                        <td><input class="minimal" data-activo="<?= $r['deleted'] ?> " name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                        <td><?= $r['identificacion']; ?></td>
                                        <td><?= $r['nombre']; ?></td>
                                        <td><?= $r['celular']; ?></td>
                                        <td><?= $r['deleted'] . $r['email']; ?></td>
                                        <td><?= $r['tipo'] == "J" ? "Juridica" : "Natural"; ?></td>
                                        <td><?= $r['deleted'] == 0 ? "Activo" : "Inactivo"; ?></td>
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
                                    <th>Estado</th>
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

    $('#btn-edit-contrato').click(function(e) {
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
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-edit-contrato').click(function(e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var activo = $('input[name=item]:checked').attr('data-activo');
            if (activo == 0) {
                var action = $(this).attr("href") + "/" + item;
                $(this).attr("href", action);
                //console.log("inactivo")
                //e.preventDefault();
            } else {
                //console.log("activo")
                alert("El Cliente aun se Encuentra Inactivo");
                e.preventDefault();
            }

        }
    });

    $('#btn-find').click(function() {
        $('#form1').submit();
    });
</script>