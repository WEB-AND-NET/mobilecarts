<?php
$c = $data["cliente"];
$a = $data["contrato"];
?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Contrato
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>clientes">Clientes</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Contrato</li>
    </ol>
</section>
<br />
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>clientes/contratos/save" method="post" name="form1" enctype="multipart/form-data">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_numero">Contrato No</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->numero; ?>" id="numero" maxlength="20" disabled="">
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>
                <br />
                <div class="col-lg-4">
                    <label id="l_cedula">Identificaci&oacute;n:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $c->identificacion; ?>" id="identificacion" maxlength="20" disabled="">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $c->nombre; ?>" id="nombre" maxlength="45" disabled="">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_tipo_identificacion">Tipo Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $c->tipo == "J" ? "Juridica" : "Natural"; ?>" id="tipo" maxlength="45" disabled="">
                    </div>
                </div>
                <div class="clearfix"></div>
                <br />

                <div class="col-lg-12">
                    <label id="l_objeto">Objeto del Contrato</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <textarea class="form-control pull-right" value="<?= $a->objeto; ?>" id="objeto" maxlength="200"></textarea>
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>
                <br />

                <div class="col-lg-12">
                    <label id="l_archivoFactura">Copia Digital Contrato: </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file"></i>
                        </div>
                        <input name='archivoContrato' class='form-control doc' id="archivoContrato" type='file'>
                    </div>
                </div>
                <input name="archivo" type="hidden" id="archivo" value="<?= $a->archivoContrato ?>" />

                <div class="clearfix"></div>
                <br />

                <div class="clearfix"></div><br />
                <div class="col-lg-6">
                    <label id="l_fecha">Fecha Inicio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $a->fechaIni; ?>" id="fechaIni" name="fechaIni" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <label id="l_fecha_vencimiento">Fecha Fin</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $a->fechaFin; ?>" id="fechaFin" name="fechaFin" />
                    </div>
                </div>

                <div class="clearfix"></div>
                <br />

                <!--  Centro de costo -->
                <fieldset style="display: none" id="contactos">
                    <legend>Ajuste de Tarifas</legend>
                    <div class="col-lg-4">
                        <label id="l_disponibilidad">Disponibilidad</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="disponibilidad" name="disponibilidad" maxlength="15" value="<?= $a->disponibilidad; ?>">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_transfer">Transfers</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="transfer" name="transfer" maxlength="15" value="<?= $a->transfer; ?>">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_parada">Parada</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="parada" name="parada" maxlength="15" value="<?= $a->parada; ?>">
                        </div><!-- /.input group -->
                    </div>
                </fieldset>
                <div class="clearfix"></div><br />
                <fieldset style="display: none">
                    <legend>Tarifas Personalizadas</legend>
                    <div class="table-responsive" style="width: auto;">
                        <table id="tabletarifas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tarifa</th>
                                    <th>Clase Vehiculo</th>
                                    <th>Valor</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="rendertarifas">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tarifa</th>
                                    <th>Clase Vehiculo</th>
                                    <th>Valor</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>


                <fieldset>
                    <legend>VEHÍCULOS ASIGNADOS</legend>
                    <div class="col-lg-4">
                        <label id="l_id_cliente">Cliente</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <select class="form-control select2" id="vehiculo" name="vehiculo">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["vehiculos"] as $ve) { ?>
                                    <option value="<?= $ve["id"]; ?>"><?= $ve["clase"] . "-" . $ve["placa"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <br />
                        <button type="button" id="btn-add-vehiculo" class="btn btn-primary">Agregar</button>
                    </div>


                    <table id="tabla-vehiculos" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>


                </fieldset>
                <!-- Fin centro costo-->
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input name="id_cli" type="hidden" id="id_cli" value="<?= $c->id; ?>" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {



        var table = $('#tabla-vehiculos').DataTable({
            ajax: {
                url: '<?php echo $patch ?>clientes/contratos/vehiculo/get',
                dataSrc: 'data',
                data: {
                    id_cliente: $("#id_cli").val() || 'new'
                }
            },
            columns: [{
                    data: "id"
                },
                {
                    data: "placa"
                },
                {
                    data: "marca"
                },
                {
                    data: "modelo"
                },
                {
                    "data": null,
                    "defaultContent": `
                    <button class='btn btn-danger delete' type='button' name='itemd'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>`
                }

            ]
        });


        $("#btn-add-vehiculo").click(function() {
            let ids = [];
            table.column(0).data().each(function(value, index) {
                ids.push(value);
            });
            if (ids.includes($("#vehiculo").val())) {
                alert("Este vehiculo ya fue agregado")
                return;
            }
            $.post("<?php echo $patch ?>clientes/contratos/vehiculo/add", {
                id_vehiculo: $("#vehiculo").val(),
                id_cliente: $("#id_cli").val()
            }, function(response) {
                table.ajax.reload();
            })
        })


        function loadTablaTarifas() {
            $("#tabletarifas").DataTable({
                //            "iDisplayLength": 10,
                //            "aLengthMenu": [10, 25, 50, 100],
                //            "sPaginationType": "full_numbers",

                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "<?= $patch; ?>clientes/tarifas/paginate/" + ($("#id_cli").val() === "" ? "0" : $("#id_cli").val()),
                "sServerMethod": "POST",
                "createdRow": function(row, data, index) {
                    $('td', row).eq(0).html(data[0]);
                    $('td', row).eq(3).html('<a href="javascript:void(0)" data="' + data[3] + '" action="deactivate" onClick="delItem(' + data[3] + ');"><i style="font-size: 150%;" class="fa fa-trash"></i></a>');
                },
                "columnDefs": [{
                    "targets": -4,
                    "data": null //,
                    //                "defaultContent": "<button>Click!</button>"
                    //                    "defaultContent": "<input class='minimal' name='item' type='radio'/>"
                }]

                //            "bJQueryUI": true,
                //            "bPaginate": true,
                //            "bSort": false
            });

            function updateItem(i) {
                /*$("#form1").mask("Espere...");
                $.post('<? //= $patch; 
                        ?>clientes/contratos/update_tarifa', {index: i,valor :  $('#valor_edit_' + i).val()}, function (data) {
                    $("#form1").unmask();
                    $('#items').html(data);
                });*/
            }

            function delItem(i) {
                $("#form1").mask("Espere...");
                $.post('<?= $patch; ?>clientes/contratos/delete_tarifa', {
                    index: i
                }, function(data) {
                    $("#form1").unmask();
                    //$('#items').html(data);
                    reloadDataTablaTarifas();
                });
            }
            $('#tabletarifas tbody').on('click', 'a', function() {
                switch ($(this).attr("action")) {
                    case "update":
                        updateItem($(this).attr("data"));
                        break;
                    case "deactivate":
                        delItem($(this).attr("data"));
                        break
                }
            });
        }

        function reloadDataTablaTarifas() {
            $("#tabletarifas").dataTable().fnDestroy();
            loadTablaTarifas();
        }

        loadTablaTarifas();
    });

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#numero').val(), $('#l_numero').html(), true);
        //sErrMsg += validateText($('#objeto').val(), $('#l_objeto').html(), true);                        
        sErrMsg += validateNumber($('#disponibilidad').val(), $('#l_disponibilidad').html(), true);
        sErrMsg += validateNumber($('#transfer').val(), $('#l_transfer').html(), true);
        sErrMsg += validateNumber($('#parada').val(), $('#l_parada').html(), true);

        if (sErrMsg !== "") {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function() {
        if (validateForm()) {
            $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function() {
        window.location = '<?= $patch; ?>clientes';
    });

    // Cargar todas las tarifas agregadas en la grilla
    //    function loadItems() {
    //        $.post('<? //= $patch; 
                        ?>clientes/contratos/load_tarifas', {}, function (data) {
    //            $('#items').html(data);
    //        });
    //    }

    //    $('#items').ready(loadItems);
    /*
     * 
     * @param {type} i
     * @returns {undefined}Funcionales se comentar por cambio de carga de la tabla tarifas
     */
    // Eliminar una tarifa de la grilla
    /*
    function updateItem(i) {       
        $("#form1").mask("Espere...");
        $.post('<? //= $patch; 
                ?>clientes/contratos/update_tarifa', {index: i,valor :  $('#valor_edit_' + i).val()}, function (data) {
            $("#form1").unmask();
            $('#items').html(data);
        });
    }

    // Eliminar una tarifa de la grilla
    function delItem(i) {
        $("#form1").mask("Espere...");
        $.post('<? //= $patch; 
                ?>clientes/contratos/delete_tarifa', {index: i}, function (data) {
            $("#form1").unmask();
            $('#items').html(data);
        });
    }
    */
</script>