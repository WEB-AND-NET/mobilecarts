<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        FUEC
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">FUEC</li>
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
                            <!--<a href="<?//= $patch; ?>ordenes_servicios/edit" id="btn-edit"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span>Editar</span></a>-->
                            <a href="<?= $patch; ?>ordenes_servicios/imprimir" id="btn-print"class="btn btn-default btn-md" target="_blank" ><i class="fa fa-print"></i><br/><span>Imprimir</span></a>
                            <!--<a href="<?//= $patch; ?>ordenes_servicios/factura" id="btn-factura"class="btn btn-default btn-md" target="_blank"><i class="fa fa-print"></i><br/><span>Factura</span></a>-->
                            <!--<a href="<?//= $patch; ?>ordenes_servicios/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span>Eliminar</spa></a>-->
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Fecha(Mes/Día/Año)</th>
                                <th>Factura</th>
                                <th>Cliente</th>
                                <th>T.Servicio</th>
                                <th>Punto de Origen</th>
                                <th>Direcci&oacute;n</th>
                                <th>Punto de Destino</th>
                                <th>Clase de Vehiculo</th>
                                <th>Placa</th>                                
                                <th>Conductor</th>
                                <th>Estado</th>
                                <th>Registro(Mes/Día/Año)</th>
                            </tr>
                        </thead>
                        <!--
                        <tbody>
                            <?php /*
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
                            <?php } */ ?>
                        </tbody>
                        -->
                        <!--<tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Fecha(Mes/Día/Año)</th>
                                <th>Cliente</th>
                                <th>T.Servicio</th>
                                <th>Punto de Origen</th>
                                <th>Direcci&oacute;n</th>
                                <th>Punto de Destino</th>
                                <th>Clase de Vehiculo</th>
                                <th>Placa</th>
                                <th>Estado</th>
                            </tr>
                        </tfoot>-->
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
    /*
    $(function () {
        $("#tabledatas").DataTable();
    });
    */
    $(function () {
        
        function loadDataTableOrdenes(){
            $("#tabledatas").DataTable({
    //            "iDisplayLength": 10,
    //            "aLengthMenu": [10, 25, 50, 100],
    //            "sPaginationType": "full_numbers",

                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?= $patch; ?>ordenes_servicios/paginate",
                "sServerMethod": "POST",
                "order": [[ 0, "desc" ]],
                "createdRow": function (row, data, index) { // add radio buttons
                    $('td', row).eq(0).html('<input class="minimal" name="item" type="radio" onchange="doalert(this)" placeholder= "'+data[11]+'" value="' + data[0] + '">'); 
                    var tipo = data[4] == "D" ? 'Disponibilidad' : 'Transfers';
                    $('td', row).eq(3).html(tipo);   
                  
                    switch (data[11]) {
                        case 'P':
                            styl="label label-warning";
                            txt = "PENDIENTE";
                            break;
                        case 'A':
                            styl="label label-default";
                            txt = "ASIGNADO";
                            break;
                        case 'I':
                            styl="label label-primary";
                            txt = "ACEPTADO";
                            break; 
                        case 'T':
                            styl="label label-success";
                            txt = "TERMINADO";
                            break; 
                        case 'C':
                            styl="label label-danger";
                            txt = "CANCELADO";
                            break;   
                        case 'F':
                            styl="label label-success";
                            txt = "FACTURADO";
                            break;     
                        default:
                            styl = "";
                            txt = "";
                            break;
                    } 
                    
                    
                    $('td', row).eq(9).html('<span name="estado" class="label '+styl+'">'+txt+'</span>');  
                },
                "columnDefs": [{
                        "targets": -13,
                        "data": null//,
    //                "defaultContent": "<button>Click!</button>"
    //                    "defaultContent": "<input class='minimal' name='item' type='radio'/>"
                    },{
                        "targets": [ 2,10,12 ],
                        "visible": false
                    }]

    //            "bJQueryUI": true,
    //            "bPaginate": true,
    //            "bSort": false
            });
            
        }
        
        function reloadDataTableOrdenes(){
             $("#tabledatas").dataTable().fnDestroy();
             loadDataTableContactos();
        }
        
        loadDataTableOrdenes();                

    });
    
    function doalert(checkboxElem) {
        if (checkboxElem.checked) {
            const button = document.getElementById('btn-print');
            if(checkboxElem.placeholder == "P")
            {
                
                button.setAttribute('disabled', '');
                 //$('#btn-print').attr("disabled")
                 //$('#btn-print').style.visibility = 'hidden';
                 //$('#btn-print').disabled = true;
            }else{
                 button.removeAttribute('disabled');
            }
        }
    }

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

    $('#btn-print').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            e.preventDefault();
            var action = $(this).attr("href") + "/" + item;            
            window.open(action,'_blank');
        }
    });
    
    $('#btn-factura').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            e.preventDefault();
            var action = $(this).attr("href") + "/" + item;            
            window.open(action,'_blank');
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
