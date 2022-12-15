<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Definici&oacute;n de Tarifas
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Definici&oacute;n de Tarifas</li>
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
                            <!--<a href="<?= $patch; ?>tarifas/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span>Nuevo</span></a>-->
                            <a href="<?= $patch; ?>tarifas/edit" id="btn-edit"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span>Editar</span></a>
                            <a href="<?= $patch; ?>tarifas/custom" id="btn-custom"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span>Asignar a Cliente</span></a>
                            <!--<a href="<?= $patch; ?>tarifas/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span>Eliminar</spa></a>-->
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <!--<th>Zona origen</th>-->
                                <th>Barrio origen</th>
                                <!--<th>Zona destino</th>-->
                                <th>Barrio destino</th>
                                <th>$ Valor</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <!--<th>Zona origen</th>-->
                                <th>Barrio origen</th>
                                <!--<th>Zona destino</th>-->
                                <th>Barrio destino</th>
                                <th>$ Valor</th>
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
        $("#tabledatas").DataTable({
//            "iDisplayLength": 10,
//            "aLengthMenu": [10, 25, 50, 100],
//            "sPaginationType": "full_numbers",

            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?= $patch; ?>tarifas/paginate",
            "sServerMethod": "POST",
//            "createdRow": function ( row, data, index ) {
//                if ( data[5].replace(/[\$,]/g, '') * 1 > 150000 ) {
//                    $('td', row).eq(5).addClass('highlight');
//                }
//            },
            "createdRow": function (row, data, index) { // add radio buttons
                $('td', row).eq(0).html('<input class="minimal" name="item" type="radio" value="' + data[0] + '">');
            },
            "columnDefs": [{
                    "targets": -4,
                    "data": null//,
//                "defaultContent": "<button>Click!</button>"
//                    "defaultContent": "<input class='minimal' name='item' type='radio'/>"
                }]

//            "bJQueryUI": true,
//            "bPaginate": true,
//            "bSort": false
        });

        $('#tabledatas tbody').on('click', 'button', function () {
            var data = table.row($(this).parents('tr')).data();
            alert(data[0] + "'s salary is: " + data[ 3 ]);
    });
    });

    $('#btn-edit').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });
    
    $('#btn-custom').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });
    
    /*
    $('#btn-delete').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });*/

    $('#btn-find').click(function () {
        $('#form1').submit();
    });
</script>
