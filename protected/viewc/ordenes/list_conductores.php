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
                            <a href="<?= $patch; ?>ordenes_servicios/imprimir" id="btn-print" class="btn btn-default btn-md" target="_blank"><i class="fa fa-print"></i><br /><span>Imprimir</span></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive" style="width: auto;">
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

        function loadDataTableOrdenes() {
            $("#tabledatas").DataTable({

                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?= $patch; ?>ordenes_servicios/paginate",
                "sServerMethod": "POST",
                "order": [
                    [0, "desc"]
                ],
                "createdRow": function(row, data, index) { // add radio buttons
                    $('td', row).eq(0).html('<input class="minimal" name="item" type="radio" onchange="doalert(this)" placeholder= "' + data[11] + '" value="' + data[0] + '">');
                    var tipo = data[4] == "D" ? 'Disponibilidad' : 'Transfers';
                    $('td', row).eq(3).html(tipo);

                    switch (data[11]) {
                        case 'P':
                            styl = "label label-warning";
                            txt = "PENDIENTE";
                            break;
                        case 'A':
                            styl = "label label-default";
                            txt = "ASIGNADO";
                            break;
                        case 'I':
                            styl = "label label-primary";
                            txt = "ACEPTADO";
                            break;
                        case 'T':
                            styl = "label label-success";
                            txt = "TERMINADO";
                            break;
                        case 'C':
                            styl = "label label-danger";
                            txt = "CANCELADO";
                            break;
                        case 'F':
                            styl = "label label-success";
                            txt = "FACTURADO";
                            break;
                        default:
                            styl = "";
                            txt = "";
                            break;
                    }


                    $('td', row).eq(9).html('<span name="estado" class="label ' + styl + '">' + txt + '</span>');
                },
                "columnDefs": [{
                    "targets": -13,
                    "data": null
                }, {
                    "targets": [2, 10, 12],
                    "visible": false
                }]

            });

        }

        function reloadDataTableOrdenes() {
            $("#tabledatas").dataTable().fnDestroy();
            loadDataTableContactos();
        }

        loadDataTableOrdenes();

    });

    function doalert(checkboxElem) {
        if (checkboxElem.checked) {
            const button = document.getElementById('btn-print');
            if (checkboxElem.placeholder == "P") {

                button.setAttribute('disabled', '');
            } else {
                button.removeAttribute('disabled');
            }
        }
    }

    $('#btn-print').click(function(e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            e.preventDefault();
            var action = $(this).attr("href") + "/" + item;
            window.open(action, '_blank');
        }
    });

    $('#btn-find').click(function() {
        $('#form1').submit();
    });
</script>