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
<?php $a = $data["ordenes"]; ?>
<?php $r = $data["propietarios"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de FUEC
    </h1>
    <!--
    <ol class="breadcrumb">
        <li><a href="<?//= $patch ?>">Inicio</a></li>
        <li><a href="<?//= $patch ?>ordenes_servicios">Ordenes Servicio</a></li>
        <li class="active"><?//= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de FUEC</li>
    </ol>
    -->
</section>
<br/>
<?php if ($r['valido'] == "NO") { ?>
    <div class="box ">
        <div class="box-body">
            <div style="padding: 10%; text-align: center;">
                <span style="font-size: 115px; color: #eee;">
                    <i class="fa fa-ban"></i><div class="clearfix"></div>
                    <p style="font-size: 24px; color: #3d3d3d;">Lo Sentimos Actualmente no tienes Permiso para realizar esta operacion..<br/> Por Favor.. Comunicarse con administraci&oacute;n</p>
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
                        <div class="clearfix"></div><br/>
                    <?php } ?>                      
                    <div class="col-lg-4">
                        <label id="l_id_cliente">Cliente</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <select class="form-control select2"  id="id_cliente" name="id_cliente">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["clientes"] as $c) { ?>
                                    <option <?= ($c->id == $a->id_cliente ? 'selected="selected"' : ''); ?> value="<?= $c->id; ?>" dataone="<?= $c->tipo ?>"><?= $c->nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
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
                    
                    <div  class="clearfix"></div><br/>
                    
                    <!-- Seccion para Tipo servicio Transfer -->
                    <div class="col-lg-4" id="porigen">
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

                    <div class="col-lg-4" id="pdestino">
                        <label id="l_barrio_d">Punto Destino</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2"  id="barrio_d" name="barrio_d" class="select">
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
                            <input type="text" class="form-control pull-right" value="<?= $a->recorrido; ?>" id="recorrido" name="recorrido" maxlength="500">
                        </div><!-- /.input group -->
                    </div>
                    <div class="clearfix"></div><br/>

                    <fieldset class="col-lg-8">
                        <legend>Especificar Vehiculos</legend>                    
                        <div class="col-lg-6">
                            <label id="l_id_vehiculo">Buscar Placa</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </div>
                                <select class="form-control select2"  id="id_vehiculo" name="id_vehiculo">
                                    <option value="">[Seleccione..]</option>
                                    <?php foreach ($data["vehiculos"] as $vhc) {
                                        ?>                                    
                                        <option 
                                            dataClase="<?= $vhc['id_clase'] ?>" 
                                            <?= ($vhc['id'] == $a->id_vehiculo ? 'selected="selected"' : ''); ?> 
                                            data-valido="<?= $vhc['estado'] ?>" 
                                            value="<?= $vhc['id']; ?>"
                                            data-f_soat="<?= $vhc['f_soat'] ?>" 
                                            data-f_tecnomecanica="<?= $vhc['f_tecnomecanica'] ?>" 
                                            data-f_contra="<?= $vhc['f_contra'] ?>" 
                                            data-f_extra="<?= $vhc['f_extra'] ?>" 
                                            data-f_operacion="<?= $vhc['f_operacion'] ?>" 
                                        >
                                            <?= $vhc['placa'] ?>
                                        </option>
                                    <?php } ?>
                                </select>                         
                            </div>
                        </div>
                        <div class="clearfix"></div><br/>
                    </fieldset>
                    <div class="clearfix"></div>
                    <div class="box-footer col-lg-2 pull-right">
                        <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                        <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                        <input name="clase_vehiculo" type="hidden" id="clase_vehiculo" value="<?= $a->clase_vehiculo; ?>"  />
                        <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                        <input id="deleted" name="deleted" type="hidden" value="0" />
                    </div>
                </fieldset>
            </div>
        </form>
    </div>
<?php } ?>
<!--<script src="<?//= $patch; ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
<link rel="stylesheet" href="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?= $patch; ?>global/css/jquery-ui-timepicker-addon.css"/>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/util_fecha.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        
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
        
        $("select#id_vehiculo").change(function () {
            if($("select#id_vehiculo option:selected").attr("data-valido") === undefined){
                $('#id_vehiculo').val("");
                $('#clase_vehiculo').val("");
            }else{
                if($("select#id_vehiculo option:selected").attr("data-valido") === "Valido"){
                    var a_f_soat = $("select#id_vehiculo option:selected").attr("data-f_soat").split("-",3);
                    var a_f_tecnomecanica = $("select#id_vehiculo option:selected").attr("data-f_tecnomecanica").split("-",3);
                    var a_f_contra = $("select#id_vehiculo option:selected").attr("data-f_contra").split("-",3);
                    var a_f_extra = $("select#id_vehiculo option:selected").attr("data-f_extra").split("-",3);
                    var a_f_operacion = $("select#id_vehiculo option:selected").attr("data-f_operacion").split("-",3);
                    
                    var a_fecha_final = $("#fecha_final").val().split("-",3);
                    var fecha_final = new Date(a_fecha_final[0], a_fecha_final[1] - 1, a_fecha_final[2]);
                    
                    var f_soat = new Date(a_f_soat[0], a_f_soat[1] - 1, a_f_soat[2]);
                    var f_tecnomecanica = new Date(a_f_tecnomecanica[0], a_f_tecnomecanica[1] - 1, a_f_tecnomecanica[2]);
                    var f_contra = new Date(a_f_contra[0], a_f_contra[1] - 1, a_f_contra[2]);
                    var f_extra = new Date(a_f_extra[0], a_f_extra[1] - 1, a_f_extra[2]);
                    var f_operacion = new Date(a_f_operacion[0], a_f_operacion[1] - 1, a_f_operacion[2]);
                    
                    if( (fecha_final > f_soat) || (fecha_final > f_tecnomecanica) || (fecha_final > f_contra) || (fecha_final > f_extra) || (fecha_final > f_operacion) ){
                        $('#id_vehiculo').val("");
                        $('#clase_vehiculo').val("");
                        alert("El vehiculo no puede ser asignado a la fecha "+$("#fecha_final").val()+", por favor, intente con una anterior a esta y actualize los documentos.");                        
                    }else{
//                        console.log(f_soat + "<->" + f_tecnomecanica + "<->" + f_contra + "<->" + f_extra + "<->" + f_operacion);
                        var clase = $('#id_vehiculo option:selected').attr("dataClase");
                        $('#clase_vehiculo').val(clase);
                    }                                      
                }else{
                    $('#id_vehiculo').val("");
                    $('#clase_vehiculo').val("");
                    alert("El vehiculo se encuentra bloqueado por la administración, por favor actualize los documentos.");
                }
            }                                  
        });
    });

    $(function () {        
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
    });

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        
        sErrMsg += validateText($('#id_cliente').val(), $('#l_id_cliente').html(), true);
        sErrMsg += validateText($('#fecha').val(), $('#l_fecha').html(), true);
        sErrMsg += validateText($('#fecha_final').val(), $('#l_fecha_vencimiento').html(), true);
        sErrMsg += validateText($('#barrio_o').val(), $('#l_barrio_o').html(), true);
        sErrMsg += validateText($('#barrio_d').val(), $('#l_barrio_d').html(), true);    
        sErrMsg += ($('#objetoc').val() === "" ? '- Debe seleccionar Un Objeto de Contrato.\n' : '');
        sErrMsg += validateText($('#recorrido').val(), $('#l_recorrido').html(), true);            
        sErrMsg += ($('#id_vehiculo').val() === "" ? '- Debe seleccionar Un Vehiculo.\n' : '');
        
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
