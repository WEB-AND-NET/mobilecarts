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
<?php $r = $data["propietarios"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de FUEC
    </h1>
    <!--
    <ol class="breadcrumb">
        <li><a href="<? //= $patch 
                        ?>">Inicio</a></li>
        <li><a href="<? //= $patch 
                        ?>ordenes_servicios">Ordenes Servicio</a></li>
        <li class="active"><? //= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); 
                            ?> de FUEC</li>
    </ol>
    -->
</section>
<br />
<?php if ($r['valido'] == "NO") { ?>
    <div class="box ">
        <div class="box-body">
            <div style="padding: 10%; text-align: center;">
                <span style="font-size: 115px; color: #eee;">
                    <i class="fa fa-ban"></i>
                    <div class="clearfix"></div>
                    <p style="font-size: 24px; color: #3d3d3d;">Lo sentimos actualmente no puede solicitar extractos de contrato ya que su rodamiento se encuentra vencido..<br /> Por Favor.. Comunicarse con administraci&oacute;n</p>
                </span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="box ">
        <form id="form1" class="form" action="<?= $patch; ?>ordenes_servicios/save" method="post" name="form1">
            <div class="box-body">
                <fieldset style="width:97%;">
                    <legend>Informaci&oacute;n Basica</legend>
                    <?php
                    if ($a->id !== null) {
                    ?>
                        <div class="col-lg-4">
                            <label id="l_numero">N&uacute;mero Planilla:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-hashtag"></i>
                                </div>
                                <input type="text" class="form-control pull-right" value="<?= $a->numero; ?>" id="numero" name="numero" maxlength="4">
                            </div><!-- /.input group -->
                        </div>
                        <div class="clearfix"></div><br />
                    <?php } ?>
                    <div class="col-lg-4">
                        <label id="l_tipo">Tipo Servicio</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-arrows-alt"></i>
                            </div>
                            <select class="form-control select2" id="tipo" name="tipo">
                                <option value="">[Seleccione..]</option>
                                <option <?= $a->tipo == "C" ? 'selected="selected"' : '' ?> value="C">City Tours</option>
                                <option <?= $a->tipo == "D" ? 'selected="selected"' : '' ?> value="D">Disponibilidad</option>
                                <option <?= $a->tipo == "R" ? 'selected="selected"' : '' ?> value="R">Recorridos</option>
                                <option <?= $a->tipo == "T" ? 'selected="selected"' : '' ?> value="T">Transfers</option>
                                <option <?= $a->tipo == "V" ? 'selected="selected"' : '' ?> value="V">Viajes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label id="l_id_cliente">Cliente</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <select class="form-control select2" id="id_cliente" name="id_cliente">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["clientes"] as $c) { ?>
                                    <option <?= ($c->id == $a->id_cliente ? 'selected="selected"' : ''); ?> value="<?= $c->id; ?>" dataone="<?= $c->tipo ?>"><?= $c->nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_origen">Direcci&oacute;n:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->origen; ?>" id="origen" name="origen" maxlength="100">
                        </div><!-- /.input group -->
                    </div>

                    <!-- <div class="col-lg-4" id="id_contactos" style="display: none;">
                        <label id="l_id_contacto">Contactos</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </div>
                            <?php //include "select_contacto.php" 
                            ?>
                        </div>
                    </div> -->

                    <div class="clearfix"></div><br />

                    <div class="col-lg-4">
                        <label id="l_fecha">Fecha Inicio</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fecha; ?>" id="fecha" name="fecha" readonly="" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label id="l_fecha_vencimiento">Fecha Vencimiento</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fecha_final; ?>" id="fecha_final" name="fecha_final" readonly="" />
                        </div>
                    </div>

                    <div class="col-lg-4" id="hora">
                        <label id="l_n_pasajero">N° de pasajero</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->n_pasajero ?>" id="n_pasajero" name="n_pasajero" maxlength="3" />
                        </div>
                    </div>

                    <div class="clearfix"></div><br />

                    <!-- Seccion para Tipo servicio Transfer -->
                    <div class="col-lg-4" id="porigen">
                        <label id="l_barrio_o">Punto Origen</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2" id="barrio_o" name="barrio_o" class="select">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["barrio_o"] as $b) { ?>
                                    <option <?= ($b->id == $a->barrio_o ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4" id="pdestino">
                        <label id="l_barrio_d">Punto Destino</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2" id="barrio_d" name="barrio_d" class="select">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["barrio_o"] as $b) { ?>
                                    <option <?= ($b->id == $a->barrio_d ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
                                <?php } ?>
                            </select>
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
                            <select class="form-control select2" id="objetoc" name="objetoc">
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
                            <input type="text" class="form-control pull-right" value="<?= $a->recorrido; ?>" id="recorrido" name="recorrido" maxlength="500">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-12">
                        <label id="l_observacion">Observaciones:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-hashtag"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->observacion; ?>" id="observacion" name="observacion" maxlength="500">
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
                                <?php include "selectp.php" ?>
                            </div>
                        </div>
                        <div class="clearfix"></div><br />
                        <div class="col-lg-6">
                            <label id="l_identificacion">Identificacion:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="identificacion" name="identificacion" maxlength="300">
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-lg-6">
                            <label id="l_nombre">Nombre:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="nombre" name="nombre" maxlength="300">
                            </div><!-- /.input group -->
                        </div>




                    </fieldset>
                    <div class="clearfix"></div><br />
                    <div id="renderconductores" style="display: block;">
                        <div class="col-lg-4" id="pdestino">
                            <label id="l_conductores">Conductores</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-location-arrow"></i>
                                </div>
                                <select class="form-control select2" id="id_list_conductor" name="id_list_conductor">
                                    <option value="">[Seleccione..]</option>
                                    <?php foreach ($data["conductores"] as $c) { ?>
                                        <option id="<?= $c->id; ?>" name="<?= $c->id; ?>" value="<?= $c->id; ?>"><?= $c->nombre; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <br />
                            <button type="button" id="btn-addConduct" class="btn btn-primary">Agregar</button>
                        </div>
                        <div class="clearfix"></div>
                        <br /><br />
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
                    <div class="clearfix"></div>

                    <?php include 'pasajeros.php'; ?>

                    <div class="clearfix"></div>

                    <div class="box-footer col-lg-2 pull-right">
                        <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                        <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                        <input name="clase_vehiculo" type="hidden" id="clase_vehiculo" value="<?= $a->clase_vehiculo; ?>" />
                        <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                        <input id="deleted" name="deleted" type="hidden" value="0" />

                    </div>
                </fieldset>
            </div>
        </form>
    </div>
<?php } ?>


<!-- Modal -->
<div class="modal fade " id="modalDocumentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Información acerca la documentacion faltante del vehículo</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>Documento</th>
                        <th>Estado</th>
                        <th>Fecha Vencimiento</th>
                        <th>Observacion</th>
                    </tr>
                    <tbody id="info"></tbody>
                </table>
                <blockquote> Nota: Para crear documentos es necesario estar con todos los papeles en regla. </blockquote>
            </div>
            <div class="clearfix"></div>
            <br /><br />
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--<script src="<? //= $patch; 
                    ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
<link rel="stylesheet" href="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.css" />
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?= $patch; ?>global/css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/util_fecha.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#items').ready(loadItems);
        $(function() {
            var options = {
                minDateTime: getHoy(),
                maxDateTime: getFinMes(),
                timeOnlyTitle: 'Hora3',
                timeText: 'Hora',
                hourText: 'Horas',
                minuteText: 'Minutos',
                secondText: 'Segundos',
                currentText: 'Ahora',
                closeText: 'Cerrar',
                dateFormat: "yy-mm-dd",
                //12 horas
                //timeFormat: "hh:mm:ss tt"
                //24 horas
                timeFormat: "HH:mm:ss"

            };
            $('#fecha').datetimepicker(options);

            var options2 = {
                minDate: getHoy(),
                maxDate: getFinMes(),
                timeOnlyTitle: 'Hora3',
                timeText: 'Hora',
                hourText: 'Horas',
                minuteText: 'Minutos',
                secondText: 'Segundos',
                currentText: 'Ahora',
                closeText: 'Cerrar',
                dateFormat: "yy-mm-dd",
                //12 horas
                //timeFormat: "hh:mm:ss tt"
                //24 horas
                timeFormat: "HH:mm:ss"
            };

            $('#fecha_final').datepicker(options2);


            $("#fecha").change(function() {
                var a_fecha_inicial = $("#fecha").val().split("-", 3);
                var fecha_inicial = new Date(a_fecha_inicial[0], a_fecha_inicial[1] - 1, a_fecha_inicial[2].split(" ", 1));
                var a_fecha_final = $("#fecha_final").val().split("-", 3);
                var fecha_final = new Date(a_fecha_final[0], a_fecha_final[1] - 1, a_fecha_final[2]);

                if ((fecha_final) < (fecha_inicial)) {
                    $("#fecha").val("");
                    alert("La fecha inicial no puede ser posterior que la final");
                }
            });

            $("#fecha_final").change(function() {
                var a_fecha_inicial = $("#fecha").val().split("-", 3);

                //console.log(a_fecha_inicial);
                var fecha_inicial = new Date(a_fecha_inicial[0], a_fecha_inicial[1] - 1, a_fecha_inicial[2].split(" ", 1));
                var a_fecha_final = $("#fecha_final").val().split("-", 3);
                var fecha_final = new Date(a_fecha_final[0], a_fecha_final[1] - 1, a_fecha_final[2]);

                if ((fecha_final) < (fecha_inicial)) {
                    $("#fecha_final").val("");
                    alert("La fecha final no puede ser anterior a la fecha inicial");
                }
            });

            $("select#id_vehiculo").change(function() {
                //if ($("select#id_vehiculo option:selected").attr("data-valido") === "A") {
                    let message = "";
                    $.post('<?= $patch; ?>vehiculos/documents/getDocumentosVencidos', {
                        id_vehiculo: $('#id_vehiculo').val()
                    }, function(data) {
                        let html = "<tr>";
                        let open = false;
                        data.forEach(function(docu) {
                            if (docu.estado == 'I') {
                                open = true;
                                html += `
                        <td>${ docu.tipo}</td>
                        <td>${ docu.estado == "I"  ? "Inactivo" : "Activo" }</td>
                        <td>${ docu.fecha_vencimiento}</td>
                        `;

                                if (docu.estado == "I" && docu.fecha_vencimiento != null) {
                                    html += `<td>No ha sido aprobado</td>`
                                };
                                if (docu.estado == "I" && docu.fecha_vencimiento == null) {
                                    html += `<td>No ha sido subido</td>`
                                };


                                html += `</tr>`
                            } else {

                                if (docu.fecha_vencimiento != null) {
                                    var fecha = new Date();
                                    const vence = new Date(docu.fecha_vencimiento);
                                    if (fecha > vence) {
                                        open = true;
                                        html += `
                                <td>${ docu.tipo}</td>
                                <td>${ docu.estado == "I"  ? "Inactivo" : "Activo" }</td>
                                <td>${ docu.fecha_vencimiento}</td>
                                `;
                                        html += `<td>Se encuentra vencido</td>`
                                        html += `</tr>`

                                    };
                                };
                            }

                        })
                        $("#info").html(html)
                        if (open) {
                            $("#modalDocumentos").modal('show');
                            $('#id_vehiculo').val("");
                            $('#clase_vehiculo').val("");
                            $('#select2-id_vehiculo-container').html('');
                            $('select#id_vehiculo').val('0');
                            $('#identificacion').val('');
                            $('#nombre').val('');
                        } else {
                            var clase = $('#id_vehiculo option:selected').attr("dataClase");
                            $('#clase_vehiculo').val(clase);
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
                    }, 'Json');
                // } else {
                //     $('#id_vehiculo').val("");
                //     $('#clase_vehiculo').val("");
                //     alert("El vehiculo se encuentra bloqueado por la administración.");
                // }
                /*
         
            alert("El vehiculo se encuentra bloqueado por la administración, por favor actualize los documentos.");*/
            });
        });


        $('select#tipo').change(changeSelect);
        $('select#tipo').ready(changeSelect);

        //cambia los campos segun el tipo de servicio
        function changeSelect() {
            if ($('#tipo').val() === 'T' || $('#tipo').val() === 'V') {
                $("#porigen").css("display", "block");
                $("#pdestino").css("display", "block");
            } else {
                $("#porigen").css("display", "none");
                $("#pdestino").css("display", "none");
            }
        }

        // $('#id_cliente').change(changeCliente);

        // $('#id_cliente').ready(changeCliente);

        // //Mostras contactos al cambiar el cliente
        // function changeCliente() {

        // }

        $("#ul_clase_veh li").click(function() {


            $("#ul_clase_veh li").each(function(index) {
                $(this).removeClass('select-activo');
                $(this).addClass('select-inactivo');
            });

            $(this).removeClass('select-inactivo');
            $(this).addClass('select-activo');

            var idCl = $(this).attr("id");
            $("#clase_vehiculo").val(idCl);
            $('#select2-id_vehiculo-container').html('');
            $('select#id_vehiculo').val('0');
            $('#identificacion').val('');
            $('#nombre').val('');

            findClaseVehiculos(idCl);

        });

        function findClaseVehiculos(idCl) {
            $.post('<?= $patch ?>ordenes_servicios/cargarvh', {
                id_cl: idCl,
                id_vh: '<?= $a->id_vehiculo ?>'
            }, function(data) {
                $("#id_vehiculo").html(data);
            });
        }

        function validateForm() {

            var sErrMsg = "";
            var flag = true;

            sErrMsg += validateText($('#id_vehiculo').val(), $('#l_id_vehiculo').html(), true);
            sErrMsg += validateText($('#id_cliente').val(), $('#l_id_cliente').html(), true);
            sErrMsg += validateText($('#fecha').val(), $('#l_fecha').html(), true);
            sErrMsg += validateText($('#fecha_final').val(), $('#l_fecha_vencimiento').html(), true);
            if ($('#tipo').val() === "T" || $('#tipo').val() === "V") {
                sErrMsg += validateText($('#barrio_o').val(), $('#l_barrio_o').html(), true);
                sErrMsg += validateText($('#barrio_d').val(), $('#l_barrio_d').html(), true);
            }
            sErrMsg += validateText($('#origen').val(), $('#l_origen').html(), true);
            sErrMsg += ($('#objetoc').val() === "" ? '- Debe seleccionar Un Objeto de Contrato.\n' : '');
            sErrMsg += validateText($('#recorrido').val(), $('#l_recorrido').html(), true);
            sErrMsg += ($('#id_vehiculo').val() === "" ? '- Debe seleccionar Un Vehiculo.\n' : '');
            sErrMsg += validateText($('#clase_vehiculo').val(), 'Tipo de Vehiculo', true);
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
            $.post('<?= $patch; ?>ordenes_servicios/clean', {}, function(data) {
                window.location = '<?= $patch; ?>ordenes_servicios';
            });
        });



        // Cargar todos los conductores agregados en la grilla
        function loadItems() {
            $.post('<?= $patch; ?>ordenes_servicios/load', {}, function(data) {
                $('#items').html(data);
            });
        }

        // Boton para agregar y validar al momento de selecconar un conductor
        $('#btn-addConduct').click(function() {
            if (validateFormConductor()) {
                validarConductor();
            }
        });


        // Validacion al momento de seleccionar un conductor en select
        function validateFormConductor() {
            var sErrMsg = "";
            var flag = true;
            sErrMsg += ($('#id_list_conductor').val() === "" ? '- Debe seleccionar Un Conductor.\n' : '');
            if (sErrMsg !== "") {
                alert(sErrMsg);
                flag = false;
            }
            return flag;
        }

        // Agregar un nuevo conductor a la grilla
        function AddItemE() {
            $("#form1").mask("Espere...");
            $.post(
                '<?= $patch; ?>ordenes_servicios/getitems', {
                    id_cond: $('#id_list_conductor').val()
                },
                function(data) {
                    $("#form1").unmask();
                    $('#items').html(data);
                }
            );
        }

        // Validar si un conductor ya se encuentra registrado 
        function validarConductor() {
            //alert( $('#id_list_conductor').val()  );
            $("#form1").mask("Espere...");
            $.post('<?= $patch; ?>ordenes_servicios/validarConductores', {
                    id_conductor: $('#id_list_conductor').val()
                },
                function(data) {
                    $("#form1").unmask();
                    if (data) {
                        alert('El Conductor ' + $('#id_list_conductor option:selected').text() + ' ya se encuentra registrado ..');
                    } else {
                        AddItemE();
                    }
                }
            );
        }


    });

    // Eliminar un conductor de la grilla
    function delItem(i) {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>ordenes_servicios/delete', {
            index: i
        }, function(data) {
            $("#form1").unmask();
            $('#items').html(data);
        });
    }
</script>