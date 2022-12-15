<?php $a = $data["conductores"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Conductores
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>conductores">Conductores</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Conductores</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>conductores/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_tipo_identificacion">Tipo de Documento</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="tipo_identificacion" name="tipo_identificacion" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->tipo_identificacion == "CC" ? 'selected="selected"' : ''); ?> value="CC">Cédula de Ciudadanía</option>
                            <option <?= ($a->tipo_identificacion == "CE" ? 'selected="selected"' : ''); ?> value="CE">Cédula de Extranjería</option>
                            <option <?= ($a->tipo_identificacion == "PA" ? 'selected="selected"' : ''); ?> value="PA">Pasaporte</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_identificacion">Identificaci&oacute;n:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->identificacion; ?>" id="identificacion" name="identificacion" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_nombre">Nombres</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="100">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_apellidos">Apellidos</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->apellidos; ?>" id="apellidos" name="apellidos" maxlength="100">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_estadocv">Estado Civil</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2"  id="estadocv" name="estadocv" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->estadocv == "CA" ? 'selected="selected"' : ''); ?> value="CA">Casado</option>
                            <option <?= ($a->estadocv == "SO" ? 'selected="selected"' : ''); ?> value="SO">Soltero</option>
                            <option <?= ($a->estadocv == "DI" ? 'selected="selected"' : ''); ?> value="DI">Divorciado</option>
                            <option <?= ($a->estadocv == "UL" ? 'selected="selected"' : ''); ?> value="UL">Unión Libre</option>
                            <option <?= ($a->estadocv == "SE" ? 'selected="selected"' : ''); ?> value="SE">Separado</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_genero">Genero</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-venus-mars"></i>
                        </div>
                        <select class="form-control select2"  id="genero" name="genero" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->genero == "FE" ? 'selected="selected"' : ''); ?> value="FE">Femenino</option>
                            <option <?= ($a->genero == "MA" ? 'selected="selected"' : ''); ?> value="MA">Masculino</option>
                            <option <?= ($a->genero == "NB" ? 'selected="selected"' : ''); ?> value="NB">No Binario</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <label id="l_fecha_nac">Fecha Nacimiento</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fecha_nac ?>" id="fecha_nac" name="fecha_nac">
                        </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_grupo_san">Grupo Sanguineo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-tint"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->grupo_san; ?>" id="grupo_san" name="grupo_san" maxlength="25">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_libreta_mil">Libreta Militar</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->libreta_mil; ?>" id="libreta_mil" name="libreta_mil" maxlength="25">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_clase">Clase</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <select class="form-control select2"  id="clase" name="clase" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->clase == "PR" ? 'selected="selected"' : ''); ?> value="PR">Primera</option>
                            <option <?= ($a->clase == "SE" ? 'selected="selected"' : ''); ?> value="SE">Segunda</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_dm">DM</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-question"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->dm; ?>" id="dm" name="dm" maxlength="25">
                    </div><!-- /.input group -->
                </div>                
                <div class="col-lg-4">
                    <label id="l_celular">Celular</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->celular; ?>" id="celular" name="celular" maxlength="25">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_telefono">Telefono</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->telefono; ?>" id="telefono" name="telefono" maxlength="25">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_email">Email</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->email; ?>" id="email" name="email" maxlength="50">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_direccion">Direcci&oacute;n</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->direccion; ?>" id="direccion" name="direccion">
                    </div><!-- /.input group -->
                </div>
                <?php if($data["role"]!=3){ ?>
                <div class="col-lg-4">
                    <label id="l_id_propietario">Propietario</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="id_propietario" name="id_propietario">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["propietarios"] as $m) { ?>
                                <option <?= ($a->id_propietario == $m['id'] ? 'selected="selected"' : ''); ?> value="<?= $m['id'] ?>"><?= $m['razon_social']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php } ?>
                <div class="col-lg-4">
                    <label id="l_tipo">Tipo contrato</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="tipo" name="tipo" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->tipo == "F" ? 'selected="selected"' : ''); ?> value="F">Fijo</option>
                            <option <?= ($a->tipo == "A" ? 'selected="selected"' : ''); ?> value="A">Afiliado</option>
                            <option <?= ($a->tipo == "C" ? 'selected="selected"' : ''); ?> value="C">Convenio</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_niveled">Nivel Educativo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <select class="form-control select2"  id="niveled" name="niveled" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->niveled == "PR" ? 'selected="selected"' : ''); ?> value="PR">Primaria Elemental</option>
                            <option <?= ($a->niveled == "BA" ? 'selected="selected"' : ''); ?> value="BA">Bachiller</option>
                            <option <?= ($a->niveled == "TC" ? 'selected="selected"' : ''); ?> value="TC">Tecnico</option>
                            <option <?= ($a->niveled == "TN" ? 'selected="selected"' : ''); ?> value="TN">Tecnólogo</option>
                            <option <?= ($a->niveled == "PF" ? 'selected="selected"' : ''); ?> value="PF">Profesional</option>
                            <option <?= ($a->niveled == "PT" ? 'selected="selected"' : ''); ?> value="PT">Postgrado</option>
                        </select>
                    </div>
                </div>

                <div class="clearfix"></div>
                <br/>
                <!-- Seccion Licencia del conductor-->
                <fieldset>
                    <legend>Licencia</legend>
                    <div class="col-lg-4">
                        <label id="l_cat_licencia">Categoria</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <select class="form-control select2"  id="cat_licencia" name="cat_licencia" class="select">
                                <option value="">[Seleccione..]</option>
                                <option <?= ($a->cat_licencia == "A1" ? 'selected="selected"' : ''); ?> value="A1">A1</option>
                                <option <?= ($a->cat_licencia == "A2" ? 'selected="selected"' : ''); ?> value="A2">A2</option>
                                <option <?= ($a->cat_licencia == "B1" ? 'selected="selected"' : ''); ?> value="B1">B1</option>
                                <option <?= ($a->cat_licencia == "B2" ? 'selected="selected"' : ''); ?> value="B2">B2</option>
                                <option <?= ($a->cat_licencia == "B3" ? 'selected="selected"' : ''); ?> value="B3">B3</option>
                                <option <?= ($a->cat_licencia == "C1" ? 'selected="selected"' : ''); ?> value="C1">C1</option>
                                <option <?= ($a->cat_licencia == "C2" ? 'selected="selected"' : ''); ?> value="C2">C2</option>
                                <option <?= ($a->cat_licencia == "C3" ? 'selected="selected"' : ''); ?> value="C3">C3</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_licencia">N&uacute;mero de licencia</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->n_licencia; ?>" id="n_licencia" name="n_licencia">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_vigencia">Vigencia</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->vigencia ?>" id="vigencia" name="vigencia">
                        </div><!-- /.input group -->
                    </div>
                </fieldset>
                
                <div class="clearfix"></div>
                <br/>
                <!-- Seccion Licencia del conductor-->
                <fieldset>
                    <legend>Seguridad Social</legend>
                    <div class="col-lg-4">
                        <label id="l_eps">EPS</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->eps; ?>" id="eps" name="eps">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_arl">ARL</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->arl; ?>" id="arl" name="arl">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_fondope">Fondo de Pensiones</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-money"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fondope; ?>" id="fondope" name="fondope">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_fondoce">Fondo de Cesantias</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-money"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fondoce; ?>" id="fondoce" name="fondoce">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_cajacom">Caja de Compensacion</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->cajacom; ?>" id="cajacom" name="cajacom">
                        </div><!-- /.input group -->
                    </div>
                </fieldset>
                <!-- Fin seccion Licencia del conductor -->

                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {
        $('#vigencia').datepicker();
    });
    
    $(function () {
        $('#fecha_nac').datepicker();
    });

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#tipo_identificacion').val(), $('#l_tipo_identificacion').html(), true);
        sErrMsg += validateNumber($('#identificacion').val(), $('#l_identificacion').html(), true);        
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateText($('#apellidos').val(), $('#l_apellidos').html(), true);
        sErrMsg += validateText($('#estadocv').val(), $('#l_estadocv').html(), true);
        sErrMsg += validateText($('#genero').val(), $('#l_genero').html(), true);
        sErrMsg += validateText($('#fecha_nac').val(), $('#l_fecha_nac').html(), true);
        sErrMsg += validateText($('#grupo_san').val(), $('#l_grupo_san').html(), true);
        sErrMsg += validateText($('#libreta_mil').val(), $('#l_libreta_mil').html(), true);
        sErrMsg += validateText($('#clase').val(), $('#l_clase').html(), true);
        sErrMsg += validateText($('#dm').val(), $('#l_dm').html(), true);
        sErrMsg += validateNumber($('#celular').val(), $('#l_celular').html(), true);
        sErrMsg += validateText($('#telefono').val(), $('#l_telefono').html(), true);
        sErrMsg += validateText($('#email').val(), $('#l_email').html(), true);
        sErrMsg += validateText($('#direccion').val(), $('#l_direccion').html(), true);
        sErrMsg += validateText($('#id_propietario').val(), $('#l_id_propietario').html(), true);
        sErrMsg += validateText($('#tipo').val(), $('#l_tipo').html(), true);
        sErrMsg += validateText($('#niveled').val(), $('#l_niveled').html(), true);
        sErrMsg += validateText($('#cat_licencia').val(), $('#l_cat_licencia').html(), true);
        sErrMsg += validateNumber($('#n_licencia').val(), $('#l_n_licencia').html(), true);
        sErrMsg += validateText($('#vigencia').val(), $('#l_vigencia').html(), true);
        sErrMsg += validateText($('#eps').val(), $('#l_eps').html(), true);
        sErrMsg += validateText($('#arl').val(), $('#l_arl').html(), true);
        sErrMsg += validateText($('#fondope').val(), $('#l_fondope').html(), true);
        sErrMsg += validateText($('#fondoce').val(), $('#l_fondoce').html(), true);
        sErrMsg += validateText($('#cajacom').val(), $('#l_cajacom').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>conductores/validar', {
            ced: $('#identificacion').val(),
            id: $("#id").val()
        },
        function (data) {
            $("#form1").unmask();
            if (data) {
                alert('EL Conductores Se encuentra Registrado');
            } else {
                $('#form1').submit();
            }
        }
        );
    }

    $('#btn-save').click(function () {
        if (validateForm()) {
            validar();
        }
    });

    $('#identificacion').change(function () {
        validarID();
    });


    function validarID() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>conductores/validar', {
            ced: $('#identificacion').val(), id: $("#id").val()
        },
        function (data) {
            $("#form1").unmask();
            if (data) {
                alert('La Cedula ya esta Registrada');
                $('#identificacion').val("");
            }
        });
    }
    
    $('#email').change(function () {
        validarEmail();
    });


    function validarEmail() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>conductores/validare', {
            email: $('#email').val(), id: $("#id").val()
        },
        function (data) {
            $("#form1").unmask();
            if (data) {
                alert('El Email ya esta Registrado');
                $('#email').val("");
            }
        });
    }

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>conductores';
    });

</script>
