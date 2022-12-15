<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Ordenes de Servicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Ordenes de servicio</li>
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
                            <a href="<?= $patch; ?>ordenes_servicios/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span>Nuevo</span></a>                            
                            <a href="javascript:void(0)" id="btn-cancel" class="btn btn-default btn-md"><i class="fa fa-ban"></i><br/><span>Cancelar</span></a>                            
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Cliente</th>
                                <th>T.Servicio</th>
                                <th>Punto de Origen</th>
                                <th>Direcci&oacute;n</th>
                                <th>Punto de Destino</th>
                                <th>Clase de Vehiculo</th>
                                <th>Placa</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["ordenes"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['cliente']; ?></td>
                                    <td><?= $r['tipo']== "D" ? 'Disponibilidad' : 'Transfers'?> </td>
                                    <td><?= $r['barrio_o']; ?></td>
                                    <td><?= $r['origen']; ?></td>
                                    <td><?= $r['barrio_d']; ?></td>
                                    <td><?= $r['clase_vehiculo']; ?></td>
                                    <td><?= $r['placa']; ?></td>          
                                    <?php                                        
                                        switch ($r['estado']) {
                                            case 'P':
                                                $styl="label label-warning";
                                                $txt = "PENDIENTE";
                                                break;
                                            case 'A':
                                                $styl="label label-default";
                                                $txt = "ASIGNADO";
                                                break;
                                            case 'I':
                                                $styl="label label-primary";
                                                $txt = "ACEPTADO";
                                                break; 
                                            case 'T':
                                                $styl="label label-success";
                                                $txt = "TERMINADO";
                                                break; 
                                            case 'C':
                                                $styl="label label-danger";
                                                $txt = "CANCELADO";
                                                break;   
                                            case 'F':
                                                $styl="label label-success";
                                                $txt = "FACTURADO";
                                                break;     
                                            default:
                                                $txt = "";
                                                break;
                                        } 
                                        echo '<td><span class="label '.$styl.'">'.$txt.'</span></td>';
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Cliente</th>
                                <th>T.Servicio</th>
                                <th>Punto de Origen</th>
                                <th>Direcci&oacute;n</th>
                                <th>Punto de Destino</th>
                                <th>Clase de Vehiculo</th>
                                <th>Placa</th>
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

    $('#btn-cancel').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
        }
        else {
            $.post('<?= $patch ?>ordenes_servicios/cancel', {id_ord : item}, function (data) {
                if(data === "oka"){
                   location.reload();
                }
            });
        }
    });

    $('#btn-find').click(function () {
        $('#form1').submit();
    });
    
</script>
