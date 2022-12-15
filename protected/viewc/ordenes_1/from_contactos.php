<style type="text/css">
    .nav > li > a:hover,
    .nav > li > a:active,
    .select-activo,
    .nav > li > a:focus{
        background-color: #3276B1 !important;
        color: #fff !important;
    }
    .nav > li.select-inactivo {
        color: #fff !important;
    }
</style>
<?php 
$a = $data["ordenes"]; 
$tipo_cliente = "J";
$id_cliente = $data["id_cliente"]; 
$id_contacto = $data["id_contacto"]; 

//$this->data['id_cliente'] = $con["id_cliente"];
//$this->data['tipo_cliente'] = $cli["tipo"];   
//$this->data['id_centrocosto'] = $con["id_centrocosto"];
//$this->data['centrocosto'] = $con["centrocosto"];
//$this->data['id_contacto'] = $con["id"];
//$this->data['contacto'] = $con["nombre"];
?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de FUEC
    </h1>
    <br/>
    C.Costo : <?= $data['centrocosto']; ?> - Saldo Actual : $<?= number_format($data['saldo']); ?> - Cliente : <?= $data['cliente']; ?>
</section>
<br/>
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
                    <div class="clearfix"></div><br/>
                <?php } ?>  

                <div class="col-lg-4">
                    <label id="l_tipo">Tipo Servicio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-arrows-alt"></i>
                        </div>
                        <select class="form-control select2"  id="tipo" name="tipo">
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
                        <input type="text" class="form-control pull-right" value="<?= $a->origen; ?>" id="origen" name="origen" maxlength="100">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>
                <div class="clearfix"></div><br/>
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
                <!-- Seccion para cuando tipo de orden es Disponibilidad -->

                <div class="col-lg-4" id="hora" style="display: none;">
                    <label id="l_nhora">N° Hora</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nhora ?>" id="nhora" name="nhora" maxlength="2"/>
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
                        <select class="form-control select2"  id="barrio_o" name="barrio_o" class="select">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["barrio_o"] as $b) { ?>
                                <option <?= ($b->id == $a->barrio_o ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div id="saltolinea" style="display: none;" class="clearfix"></div><br/>

                <div class="col-lg-4" id="pdestino" style="display: block;">
                    <label id="l_barrio_d">Punto Destino</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2"  id="barrio_d" name="barrio_d" class="select">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["barrio_o"] as $b) { ?>
                                <option <?= ($b->id == $a->barrio_o ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
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
                        <input type="text" class="form-control pull-right" value="<?= $a->n_pasajero ?>" id="n_pasajero" name="n_pasajero" maxlength="3"/>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_objetoc">Objeto contrato:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <!--<input type="text" class="form-control pull-right" value="<?//= $a->objetoc; ?>" id="objetoc" name="objetoc" maxlength="45">-->
                        <select class="form-control select2"  id="objetoc" name="objetoc">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["objetos_contrato"] as $oc) { ?>
                                <option <?= ($oc["nombre"] == $a->objetoc ? 'selected="selected"' : ''); ?> value="<?= $oc["nombre"]; ?>" ><?= $oc["nombre"]; ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-lg-12">
                    <label id="l_recorrido">Recorrido:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->recorrido; ?>" id="recorrido" name="recorrido" maxlength="200">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-lg-12">
                    <label id="l_observacion">Observaciones:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->observacion; ?>" id="observacion" name="observacion" maxlength="500">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>
                <fieldset class="col-lg-4">
                    <div class="col-lg-12" style="border:1px solid #ddd;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tipos de Vehiculos</h3>
                        </div>
                        <div class="box-body no-padding">
                            <ul id="ul_clase_veh" class="nav nav-pills nav-stacked">
                                <?php foreach ($data["clases_v"] as $vh) { ?>
                                    <li id="<?= $vh->id; ?>" <?= $a->clase_vehiculo == $vh->id ? 'class="select-activo"' : 'class="select-inactivo"' ?> >
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
                    <legend>Valores</legend>                                        
                    <div class="col-lg-6">
                        <label id="l_valor">Valor:</label>
                        <div class="input-group">
                            <span style="border:0px;font-size: 25px;" class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="input-precios form-control pull-right" maxlength="15"  id="valor" name="valor" value="<?= $a->valor == "" ? '0' : $a->valor ?>" readonly="">
                        </div><!-- /.input group -->                   
                    </div> 
                    <div class="col-lg-6">
                        <label id="l_sobre_tasa">Sobre Tasas:</label>
                        <div class="input-group">
                            <span style="border:0px;font-size: 25px;" class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="input-precios form-control pull-right" maxlength="15" id="sobre_tasa" name="sobre_tasa" value="<?= $a->sobre_tasa == "" ? '0' : $a->sobre_tasa ?>">
                            <input type="hidden" id="sobre_tasa_edit" value="<?= $a->sobre_tasa == "" ? '0' : $a->sobre_tasa ?>">
                        </div><!-- /.input group -->                   
                    </div> 
                    <div class="clearfix"></div><br/><br/>
                    <div class="col-lg-6 pull-right" >
                        <label id="l_nombre">Total:</label>
                        <div class="input-group">
                            <label class="form-control pull-right" id="total">$ 0.00</label>
                        </div><!-- /.input group -->                   
                    </div> 


                </fieldset>               
                <div class="clearfix"></div>
                <div id="renderparadas" style="display: block;">
                    <div class="col-lg-4" id="paradas">
                        <label id="l_barrios">Paradas</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2"  id="barrios" name="barrios">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["barrio_o"] as $c) { ?>
                                    <option id="<?= $c->id; ?>" name="<?= $c->id; ?>"  value="<?= $c->id; ?>"><?= $c->nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <br/>
                        <button type="button" id="btn-addParada" class="btn btn-primary">Agregar</button>
                    </div>
                    <div class="clearfix"></div>
                    <br/><br/>
                    <table id="tabledatas2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody id="items2">
                            <tr><td class="ch-message-information" colspan="5">Cargando lista de Paradas</td></tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="clase_vehiculo" type="hidden" id="clase_vehiculo" value="<?= $a->clase_vehiculo; ?>" />
                    <input name="id_cliente" type="hidden" id="id_cliente" value="<?= $id_cliente; ?>"  />
                    <input name="tipo_cliente" type="hidden" id="tipo_cliente" value="<?= $tipo_cliente; ?>"  />
                    <input name="id_contacto" type="hidden" id="id_contacto" value="<?= $id_contacto; ?>"  />
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<!--<script src="<?//= $patch; ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
<link rel="stylesheet" href="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?= $patch; ?>global/css/jquery-ui-timepicker-addon.css"/>
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

    $('select#tipo').change(changeSelect);
    $('select#tipo').ready(changeSelect);

    function calcularTotal() {
        var v = parseFloat($("#valor").val());
        var s = parseFloat($("#sobre_tasa").val());
        $("#total").html(accounting.formatMoney(v + s));
       
        if( (v + s) >=  0){ //25000
            $('#renderparadas').css("display", "block");
        }else{
            $('#renderparadas').css("display", "none");
        }
    }

    $(function () {
        $('#sobre_tasa').bind('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z\-+*/,.]+$");//new RegExp("^[a-zA-Z]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
        /*
         $("#clase_vehiculo").ready(function(){            
         calcularPrecio($("#clase_vehiculo").val());
         });*/
        $("#valor").ready(calcularTotal);
        $("#sobre_tasa").ready(calcularTotal);

        $("#valor").keyup(calcularTotal);
        $("#sobre_tasa").keyup(calcularTotal);


        //$('#fecha').datepicker();
        //console.log('<?//= $a->id_vehiculo ?>');
        //$(".inp_cal" ).each(function( index ) {
        //console.log( index + ": " + $( this ).attr("id") );
        //$(this).datetimepicker({timeOnlyTitle: 'Hora3', timeText: 'Hora', hourText: 'Horas', minuteText: 'Minutos', secondText: 'Segundos', currentText: 'Ahora', closeText: 'Cerrar', dateFormat: "yy-mm-dd", timeFormat: "HH:mm:ss"});
        //$(this).datetimepicker({minDateTime: getManana(),maxDateTime: getFinMes(),timeOnlyTitle: 'Hora3', timeText: 'Hora', hourText: 'Horas', minuteText: 'Minutos', secondText: 'Segundos', currentText: 'Ahora', closeText: 'Cerrar', dateFormat: "yy-mm-dd", timeFormat: "hh:mm:ss tt"});
        //});
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
        
        $("#fecha").change(function () {
            var a_fecha_inicial = $("#fecha").val().split("-",3);
            var fecha_inicial = new Date(a_fecha_inicial[0], a_fecha_inicial[1] - 1, a_fecha_inicial[2].split(" ",1));
            var a_fecha_final = $("#fecha_final").val().split("-",3);
            var fecha_final = new Date(a_fecha_final[0], a_fecha_final[1] - 1, a_fecha_final[2]);
            
            if( (fecha_final) < (fecha_inicial)){
                $("#fecha").val("");
                alert("La fecha inicial no puede ser posterior que la final");
            }
        });
        
        $("#fecha_final").change(function(){
            var a_fecha_inicial = $("#fecha").val().split("-",3);
            
            //console.log(a_fecha_inicial);
            var fecha_inicial = new Date(a_fecha_inicial[0], a_fecha_inicial[1] - 1, a_fecha_inicial[2].split(" ",1));
            var a_fecha_final = $("#fecha_final").val().split("-",3);
            var fecha_final = new Date(a_fecha_final[0], a_fecha_final[1] - 1, a_fecha_final[2]);
            
            if( (fecha_final) < (fecha_inicial)){
                $("#fecha_final").val("");
                alert("La fecha final no puede ser anterior a la fecha inicial");
            }
        });
        
    });
    /*
     function findClientes(id_tipo){
     $.post('<?//= $patch ?>ordenes_servicios/cargarcl', { id_tipo : id_tipo}, function(data){
     console.log(data);
     });
     }
     
     $('select#id_vehiculo').ready(findVehiculo);
     
     $('select#id_vehiculo').change(findVehiculo);*/

    function findClaseVehiculos(idCl) {
        $.post('<?= $patch ?>ordenes_servicios/cargarvh', {id_cl: idCl, id_vh: '<?= $a->id_vehiculo ?>'}, function (data) {
            $("#id_vehiculo").html(data);
            /*
             $('select#id_vehiculo option').each(function(){
             if($(this).val() === '<?//= $a->id_vehiculo ?>')
             $('select#id_vehiculo').val('<?//= $a->id_vehiculo ?>');
             });*/
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
            $.post('<?= $patch ?>ordenes_servicios/cargar_contacto', {id_client: id_client, id_contact: id_contact}, function (data) {
                $("#id_contacto").html(data);
            });
        }

    }

    $('#id_cliente').change(changeCliente);

    $('#id_cliente').ready(changeCliente);

    //$('#clase_vehiculo').ready($('#clase_vehiculo').val() !== '' ? findClaseVehiculos($('#clase_vehiculo').val()) : null);

    $("#ul_clase_veh li").click(function () {
    
        if (validateForm2($(this).attr("id"))) {
            $("#ul_clase_veh li").each(function (index) {
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

            calcularPrecio(idCl);
            findClaseVehiculos(idCl);
        }        
        else{
            $("#ul_clase_veh li").each(function (index) {
                $(this).removeClass('select-activo');
                $(this).addClass('select-inactivo');
            });
            $("#clase_vehiculo").val("");
            var v = parseFloat($("#valor").val());
            if(v > 0){
                $("#valor").val("0");
                calcularTotal();
            }                        
        }
    });

    // Calcular valor de total a cobrar al cambiar el numero de las horas
    $("#nhora").keyup(function () {
        var idCl = $('#clase_vehiculo').val();
        if (idCl !== "") {
            calcularPrecio(idCl);
        }
    });

    function findVehiculo() {
        var plac = $('#id_vehiculo').val();

        $.post('<?= $patch ?>ordenes_servicios/cargarcondu', {id_condu: plac}, function (data) {
            $('#identificacion').val(data.identificacion);
            $('#nombre').val(data.nombre);
        }, "json");
    }

    function calcularPrecio(idCl) {
        var send = {};
        if ($('#tipo').val() === 'D') {
            send = {id_cli: $('#id_cliente').val(), tipo: $('#tipo').val(), nhora: $('#nhora').val(), cl: idCl};
//            alert(send.tipo+" - "+send.nhora+" - "+idCl);
        } else {
            send = {tipo: $('#tipo').val(), id_cli: $('#id_cliente').val(), b1: $('#barrio_o').val(), b2: $('#barrio_d').val(), cl: idCl};
        }
        $.post('<?= $patch ?>ordenes_servicios/valor', send, function (data) {
            $('#valor').val(data.valor);
            console.log(data);
            calcularTotal();
        }, "json");
    }

    $('select#id_vehiculo').ready(findVehiculo);

    $('select#id_vehiculo').change(findVehiculo);

    
    // Boton para agregar Parada
    $('#btn-addParada').click(function () {
        addParada();
    });
    
    function addParada(){
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>ordenes_servicios/getitems2', {
            id_cli : $('#id_cliente').val(),
            id_barrio : $('#barrios option:selected').val(),
            nombre: $('#barrios option:selected').text()            
        },
            function (data) {
                $("#form1").unmask();
                $('#items2').html(data);
            }
        );
    }
    
    // Cargar todos las paradas agregadas en la grilla
    function loadItems2() {
        $.post('<?= $patch; ?>ordenes_servicios/load2', {}, function (data) {
            $('#items2').html(data);
        });
    }
    
    $('#items2').ready(loadItems2);
    
    // Eliminar un conductor de la grilla
    function delItem2(i) {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>ordenes_servicios/delete2', {index: i}, function (data) {
            $("#form1").unmask();
            $('#items2').html(data);
        });
    }

    function validateForm() {

        var sErrMsg = "";
        var flag = true;

        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de servicio.\n' : '');
        if ($('#tipo').val() !== "D") {
            sErrMsg += validateText($('#barrio_o').val(), $('#l_barrio_o').html(), true);
            sErrMsg += validateText($('#barrio_d').val(), $('#l_barrio_d').html(), true);
        }
        if ($('#tipo').val() === "D") {
            sErrMsg += validateNumber($('#nhora').val(), $('#l_nhora').html(), true);
        }
        sErrMsg += validateNumber($('#n_pasajero').val(), $('#l_n_pasajero').html(), true);
        sErrMsg += ($('#objetoc').val() === "" ? '- Debe seleccionar Un Objeto de Contrato.\n' : '');

        sErrMsg += validateText($('#origen').val(), $('#l_origen').html(), true);
        sErrMsg += validateText($('#id_cliente').val(), $('#l_id_cliente').html(), true);
        if ($('#id_cliente option:selected').attr("dataone") === "J") {
            sErrMsg += ($('#id_contacto').val() === "0" ? '- Debe seleccionar Un Contacto.\n' : '');
        }
        sErrMsg += validateText($('#fecha').val(), $('#l_fecha').html(), true);
        sErrMsg += validateText($('#clase_vehiculo').val(), 'Tipo de Vehiculo', true);
        sErrMsg += validateNumber($('#sobre_tasa').val(), $('#l_sobre_tasa').html(), true);
        //sErrMsg += validateText($('#id_vehiculo').val(), 'Placa', true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    // Validar al momento de seleccionar clases de vehiculos que los P.origen, P.destino... y demas este seleccionados
    function validateForm2(id_clase) {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de servicio.\n' : '');

        if ($('#tipo').val() === "T") {
            sErrMsg += validateText($('#barrio_o').val(), $('#l_barrio_o').html(), true);
            sErrMsg += validateText($('#barrio_d').val(), $('#l_barrio_d').html(), true);
            sErrMsg += validateText($('#id_cliente').val(), $('#l_id_cliente').html(), true);
//            if( ! (id_clase === "1" || id_clase === "5" || id_clase === "6" || id_clase === "7") ){
//                sErrMsg += "Tipo de vehiculo no disponible para Transfers.";
//            }
        } else if ($('#tipo').val() === "D") {
            sErrMsg += validateNumber($('#nhora').val(), $('#l_nhora').html(), true);
        }
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }    

    $('#btn-save').click(function () {
        if (validateForm()) {
            $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function () {
        $.post('<?= $patch; ?>ordenes_servicios/clean', {}, function(data) {
            window.location = '<?= $patch; ?>ordenes_servicios';
        });        
    });

</script>                  
