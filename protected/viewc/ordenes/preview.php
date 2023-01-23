<style type="text/css">
    .nav>li>a:hover,
    .nav>li>a:active,
    .select-activo,
    .nav>li>a:focus {
        background-color: #3276B1 !important;
        color: #fff !important;
    }

    .nav>li.select-inactivo {
        color: #fff !important;
    }
</style>
<?php $a = $data["ordenes"]; ?>
<section class="content-header">
    <h1>
        Informaci&oacute;n de Ordenes de servicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>ordenes_servicios">Ordenes Servicio</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Ordenes Servicio</li>
    </ol>
</section>
<br />
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>ordenes_servicios/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n Basica</legend>
                <div class="col-lg-4">
                    <label id="l_numero">N&uacute;mero Planilla:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->numero; ?>" id="numero" name="numero" maxlength="4" disabled="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_numero">N&uacute;mero Factura:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->num_fact; ?>" id="num_fact" name="num_fact" maxlength="4" disabled="">
                    </div>
                </div>
                <div class="clearfix"></div><br />


                <div class="col-lg-4">
                    <label id="l_tipo">Tipo Servicio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-arrows-alt"></i>
                        </div>
                        <select class="form-control select2" id="tipo" name="tipo" disabled="">
                            <option value="">[Seleccione..]</option>
                            <option <?= $a->tipo == "T" ? 'selected="selected"' : '' ?> value="T">Transfers</option>
                            <option <?= $a->tipo == "D" ? 'selected="selected"' : '' ?> value="D">Disponibilidad</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_origen">Direcci&oacute;n:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->origen; ?>" id="origen" name="origen" maxlength="100" disabled="">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_id_cliente">Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2" id="id_cliente" name="id_cliente" disabled="">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["clientes"] as $c) { ?>
                                <option <?= ($c->id == $a->id_cliente ? 'selected="selected"' : ''); ?> value="<?= $c->id; ?>" dataone="<?= $c->tipo ?>"><?= $c->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br />
                <div class="col-lg-4" id="id_contactos" style="display: none;">
                    <label id="l_id_contacto">Contactos</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </div>
                        <?php include "select_contacto.php" ?>
                    </div>
                </div>
                <div class="clearfix"></div><br />
                <div class="col-lg-4">
                    <label id="l_fecha">Fecha Inicio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->fecha; ?>" id="fecha" name="fecha" disabled="" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_fecha_vencimiento">Fecha Vencimiento</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->fecha_final; ?>" id="fecha_final" name="fecha_final" disabled="" />
                    </div>
                </div>
                <!-- Seccion para cuando tipo de orden es Disponibilidad -->

                <div class="col-lg-4" id="hora" style="display: none;">
                    <label id="l_nhora">N° Hora</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nhora ?>" id="nhora" name="nhora" maxlength="2" disabled="" />
                    </div>
                </div>
                <!-- Fin seccion disponibilidad-->

                <!-- Seccion para Tipo servicio Transfer -->
                <div class="col-lg-4" id="porigen" style="display: block;">
                    <label id="l_barrio_o">Punto Origen</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2" id="barrio_o" name="barrio_o" class="select" disabled="">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["barrio_o"] as $b) { ?>
                                <option <?= ($b->id == $a->barrio_o ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div id="saltolinea" style="display: none;" class="clearfix"></div><br />

                <div class="col-lg-4" id="pdestino" style="display: block;">
                    <label id="l_barrio_d">Punto Destino</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2" id="barrio_d" name="barrio_d" class="select" disabled="">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["barrio_o"] as $b) { ?>
                                <option <?= ($b->id == $a->barrio_d ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- Fin seccion para Tipo servicio Transfer -->
                <div class="col-lg-4" id="hora">
                    <label id="l_n_pasajero">N° de pasajero</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->n_pasajero ?>" id="n_pasajero" name="n_pasajero" maxlength="3" disabled="" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_objetoc">Objeto contrato:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <!--<input type="text" class="form-control pull-right" value="<? //= $a->objetoc; 
                                                                                        ?>" id="objetoc" name="objetoc" maxlength="45">-->
                        <select class="form-control select2" id="objetoc" name="objetoc" disabled="">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["objetos_contrato"] as $oc) { ?>
                                <option <?= ($oc["nombre"] == $a->objetoc ? 'selected="selected"' : ''); ?> value="<?= $oc["nombre"]; ?>"><?= $oc["nombre"]; ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br />
                <div class="col-lg-12">
                    <label id="l_recorrido">Recorrido:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->recorrido; ?>" id="recorrido" name="recorrido" maxlength="500" disabled="">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br />
                <div class="col-lg-12">
                    <label id="l_observacion">Observaciones:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->observacion; ?>" id="observacion" name="observacion" maxlength="500" disabled="">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br />
                <fieldset class="col-lg-4">
                    <div class="col-lg-12" style="border:1px solid #ddd;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tipos de Vehiculos</h3>
                        </div>
                        <div class="box-body no-padding">
                            <ul id="ul_clase_veh" class="nav nav-pills nav-stacked">
                                <?php foreach ($data["clases_v"] as $vh) { ?>
                                    <li id="<?= $vh->id; ?>" <?= $a->clase_vehiculo == $vh->id ? 'class="select-activo"' : 'class="select-inactivo"' ?>>
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-car"></i>
                                            <?= $vh->nombre ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </fieldset>
                <fieldset class="col-lg-8">
                    <legend>Especificar Vehiculos</legend>
                    <div class="col-lg-6">
                        <label id="l_id_vehiculo">Buscar Placa</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </div>
                            <?php include "select.php" ?>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <div class="col-lg-6">
                        <label id="l_identificacion">Identificacion:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="identificacion" name="identificacion" maxlength="300" disabled="">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-6">
                        <label id="l_nombre">Nombre:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="nombre" name="nombre" maxlength="300" disabled="">
                        </div><!-- /.input group -->
                    </div>
                    <div class="clearfix"></div><br /><br />
                    <div class="col-lg-6">
                        <label id="l_valor">Valor:</label>
                        <div class="input-group">
                            <span style="border:0px;font-size: 25px;" class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="input-precios form-control pull-right" maxlength="15" id="valor" name="valor" value="<?= $a->valor == "" ? '0' : $a->valor ?>" disabled="">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-6">
                        <label id="l_sobre_tasa">Sobre Tasas:</label>
                        <div class="input-group">
                            <span style="border:0px;font-size: 25px;" class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="input-precios form-control pull-right" maxlength="15" id="sobre_tasa" name="sobre_tasa" value="<?= $a->sobre_tasa == "" ? '0' : $a->sobre_tasa ?>" disabled="">
                            <input type="hidden" id="sobre_tasa_edit" value="<?= $a->sobre_tasa == "" ? '0' : $a->sobre_tasa ?>">
                        </div><!-- /.input group -->
                    </div>
                    <div class="clearfix"></div><br /><br />
                    <div class="col-lg-6 pull-right">
                        <label id="l_nombre">Total:</label>
                        <div class="input-group">
                            <label class="form-control pull-right" id="total">$ 0.00</label>
                        </div><!-- /.input group -->
                    </div>


                </fieldset>
                <div class="clearfix"></div><br />
                <div id="renderconductores" style="display: block;">
                    <div class="col-lg-4" id="pdestino">
                        <label id="l_conductores">Conductores</label>
                        <div class="table-responsive" style="width: auto;">
                            <table id="tabledatas" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id="items">
                                    <tr>
                                        <td class="ch-message-information" colspan="5">Cargando lista de conductores</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="renderparadas" style="display: block;">
                    <div class="col-lg-4" id="paradas">
                        <label id="l_barrios">Paradas</label>
                        <div class="table-responsive" style="width: auto;">
                            <table id="tabledatas2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody id="items2">
                                    <tr>
                                        <td class="ch-message-information" colspan="5">Cargando lista de Paradas</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <!--<button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>-->
                    <input name="clase_vehiculo" type="hidden" id="clase_vehiculo" value="<?= $a->clase_vehiculo; ?>" />
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input name="id_conductor" type="hidden" id="id_conductor" value="<?= $a->id_conductor; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<link rel="stylesheet" href="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.css" />
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?= $patch; ?>global/css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/util_fecha.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript">
    function changeSelect() {
        if ($('#tipo').val() === 'D') {
            $("#hora").css("display", "block");
            $("#porigen").css("display", "none");
            $("#pdestino").css("display", "none");

            if ($('#id').val() === '') {
                $("#valor").val(0);
                $("#total").html(accounting.formatMoney(0));
            }
            calcularPrecio($("#clase_vehiculo").val());
        } else {
            $("#saltolinea").css("display", "block");
            $("#hora").css("display", "none");
            $("#porigen").css("display", "block");
            $("#pdestino").css("display", "block");

            if ($('#id').val() === '') {
                $("#nhora").val("");
            }

            $("#valor").val(0);
            $("#total").html(accounting.formatMoney(0));
            calcularPrecio($("#clase_vehiculo").val());
        }
    }

    $('select#tipo').ready(changeSelect);

    function calcularTotal() {
        var v = parseFloat($("#valor").val());
        var s = parseFloat($("#sobre_tasa").val());
        $("#total").html(accounting.formatMoney(v + s));

        if ((v + s) >= 0) {
            $('#renderparadas').css("display", "block");
        } else {
            $('#renderparadas').css("display", "none");
        }
    }

    function findClaseVehiculos(idCl) {
        $.post('<?= $patch ?>ordenes_servicios/cargarvh', {
            id_cl: idCl,
            id_vh: '<?= $a->id_vehiculo ?>'
        }, function(data) {
            $("#id_vehiculo").html(data);
        });
    }

    function changeCliente() {
        var id_client = $('#id_cliente').val();
        var id_contact = '<?= $a->id_contacto ?>';
        var tipo = $('#id_cliente option:selected').attr("dataone");

        if (tipo === "J") {
            $("#id_contactos").css("display", "block");
        } else {
            $("#id_contactos").css("display", "none");

        }

        if (tipo === "J") {
            $.post('<?= $patch ?>ordenes_servicios/cargar_contacto', {
                id_client: id_client,
                id_contact: id_contact
            }, function(data) {
                $("#id_contacto").html(data);
            });
        }

    }

    $('#id_cliente').change(changeCliente);

    $('#id_cliente').ready(changeCliente);

    $("#ul_clase_veh li").click(function() {
        $("#ul_clase_veh li").each(function(index) {
            $(this).removeClass('select-activo');
            $(this).addClass('select-inactivo');
        });
        $("#clase_vehiculo").val("");
    });

    function findVehiculo() {
        var id_veh = $('#id_vehiculo').val();
        var id_con = $('#id_vehiculo option:selected').attr("data_id_con");
        $("#id_conductor").val(id_con);
        $.post('<?= $patch ?>ordenes_servicios/cargarcondu', {
            id_veh: id_veh,
            id_con: id_con
        }, function(data) {
            $('#identificacion').val(data.identificacion);
            $('#nombre').val(data.nombre);
        }, "json");
    }

    function calcularPrecio(idCl) {
        var send = {};
        if ($('#tipo').val() === 'D') {
            send = {
                id_cli: $('#id_cliente').val(),
                tipo: $('#tipo').val(),
                nhora: $('#nhora').val(),
                cl: idCl
            };
            //            alert(send.tipo+" - "+send.nhora+" - "+idCl);
        } else {
            send = {
                tipo: $('#tipo').val(),
                id_cli: $('#id_cliente').val(),
                b1: $('#barrio_o').val(),
                b2: $('#barrio_d').val(),
                cl: idCl
            };
        }
        $.post('<?= $patch ?>ordenes_servicios/valor', send, function(data) {
            $('#valor').val(data.valor);
            console.log(data);
            calcularTotal();
        }, "json");
    }

    $('select#id_vehiculo').ready(findVehiculo);

    //$('select#id_vehiculo').change(findVehiculo);

    // Cargar todos los conductores agregados en la grilla
    function loadItems() {
        $.post('<?= $patch; ?>ordenes_servicios/load', {}, function(data) {
            $('#items').html(data);
        });
    }

    // Cargar todos las paradas agregadas en la grilla
    function loadItems2() {
        $.post('<?= $patch; ?>ordenes_servicios/load2', {}, function(data) {
            $('#items2').html(data);
        });
    }

    $('#items').ready(loadItems);

    $('#items2').ready(loadItems2);

    // Eliminar un conductor de la grilla
    function delItem(i) {}

    // Eliminar una parada de la grilla
    function delItem2(i) {}

    $('#btn-cancel').click(function() {
        $.post('<?= $patch; ?>ordenes_servicios/clean', {}, function(data) {
            window.location = '<?= $patch; ?>ordenes_servicios';
        });
    });
</script>