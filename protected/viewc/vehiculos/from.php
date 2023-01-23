<link href="<?= $patch; ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["vehiculos"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Vehiculos
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>vehiculos">Vehiculos</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Vehiculos</li>
    </ol>
</section>
<br />
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>vehiculos/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_placa">Placa:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->placa; ?>" id="placa" name="placa" maxlength="20">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_num_interno">No. Interno</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->num_interno; ?>" id="num_interno" name="num_interno">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_tg_operacion">No. Tarjeta operaci&oacute;n</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->tg_operacion; ?>" id="tg_operacion" name="tg_operacion">
                    </div>
                </div>
                <div class="clearfix"></div>
                <br />

                <div class="col-lg-4">
                    <label id="l_v_tg_operacion">Vecimiento Tarjeta operaci&oacute;n</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->v_tg_operacion; ?>" id="v_tg_operacion" name="v_tg_operacion">
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_id_propietario">Afiliado</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="id_propietario" name="id_propietario">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["propietario"] as $m) { ?>
                                <option <?= ($a->id_propietario == $m->id ? 'selected="selected"' : ''); ?> value="<?= $m->id; ?>"><?= $m->razon_social; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_id_convenio">Convenio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="id_convenio" name="id_convenio">
                            <option value="0">[No aplica..]</option>
                            <?php foreach ($data["convenios"] as $c) { ?>
                                <option <?= ($a->id_convenio == $c->id ? 'selected="selected"' : ''); ?> value="<?= $c->id; ?>"><?= $c->razon_social; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="clearfix"></div><br />

                <div class="col-lg-4">
                    <label id="l_soat">SOAT</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->soat; ?>" id="soat" name="soat" maxlength="10">
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_tecnomecanica">Tecno Mecanica</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->tecnomecanica; ?>" id="tecnomecanica" name="tecnomecanica">
                    </div>
                </div>


                <div class="clearfix"></div><br />


                <!-- ----------------------------------------LICENCIA TRANSITO ----------------------------------------------- -->
                <fieldset>
                    <legend>Licencia de Tránsito</legend>

                    <div class="col-lg-4">
                        <label id="l_n_contra">No. Licencia de Tránsito</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-list-ol"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->numLicTran; ?>" id="numLicTran" name="numLicTran">
                        </div>
                    </div>



                    <div class="col-lg-4">
                        <label id="l_capacidad">Capacidad de pasajeros</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="number" class="form-control pull-right" value="<?= $a->capacidad; ?>" id="capacidad" name="capacidad">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_servicio">Servicio</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <select class="form-control select2" id="servicio" name="servicio">
                                <option value="" selected="">-- Seleccione --</option>
                                <option value="PARTICULAR" <?= $a->servicio == 'PARTICULAR' ? 'selected' : ''; ?>>PARTICULAR</option>
                                <option value="PÚBLICO" <?= $a->servicio == 'PÚBLICO' ? 'selected' : ''; ?>>PÚBLICO</option>
                                <option value="DIPLOMÁTICO" <?= $a->servicio == 'DIPLOMÁTICO' ? 'selected' : ''; ?>>DIPLOMÁTICO</option>
                                <option value="OFICIAL" <?= $a->servicio == 'OFICIAL' ? 'selected' : ''; ?>>OFICIAL</option>
                                <option value="ESPECIAL RNMA" <?= $a->servicio == 'ESPECIAL RNMA' ? 'selected' : ''; ?>>ESPECIAL RNMA</option>

                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div><br />

                    <div class="col-lg-4">
                        <label id="l_marca">Marca</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->marca; ?>" id="marca" name="marca">
                        </div><!-- /.input group -->
                    </div>



                    <div class="col-lg-4">
                        <label id="l_linea">Linea</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->linea; ?>" id="linea" name="linea" maxlength="20">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_modelo">Modelo</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="number" class="form-control pull-right" value="<?= $a->modelo; ?>" id="modelo" name="modelo">
                        </div><!-- /.input group -->
                    </div>

                    <div class="clearfix"></div>
                    <br />

                    <div class="col-lg-4">
                        <label id="l_id_clase">Clase de Vehiculo</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <select class="form-control select2" id="id_clase" name="id_clase">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["clases"] as $c) { ?>
                                    <option <?= ($a->id_clase == $c->id ? 'selected="selected"' : ''); ?> value="<?= $c->id; ?>"><?= $c->nombre; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_tipoCarroceria">Tipo Carroceria</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->tipoCarroceria; ?>" id="tipoCarroceria" name="tipoCarroceria" maxlength="20">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_color">Color</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->color; ?>" id="color" name="color" maxlength="20">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br />

                    <div class="col-lg-4">
                        <label id="l_combustible">Combustible</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>

                            <select class="form-control select2" id="combustible" name="combustible">
                                <option value="" selected="">-- Seleccione --</option>
                                <option value="GASOLINA">GASOLINA</option>
                                <option value="GNV">GNV</option>
                                <option value="DIESEL">DIESEL</option>
                                <option value="GAS GASOL">GAS GASOL</option>
                                <option value="ELECTRICO">ELECTRICO</option>
                                <option value="HIDROGENO">HIDROGENO</option>
                                <option value="ETANOL">ETANOL</option>
                                <option value="BIODIESEL">BIODIESEL</option>
                                <option value="GLP">GLP</option>
                                <option value="GASO ELEC">GASO ELEC</option>
                                <option value="DIES ELEC">DIES ELEC</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_cilindraje">Cilindraje</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="number" class="form-control pull-right" value="<?= $a->cilindraje; ?>" id="cilindraje" name="cilindraje" maxlength="20">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_potencia">Potencia</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="number" class="form-control pull-right" value="<?= $a->potencia; ?>" id="potencia" name="potencia" maxlength="20">
                        </div>
                    </div>

                    <div class="clearfix"></div><br />

                    <div class="col-lg-4">
                        <label id="l_puertas">Puertas</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="number" class="form-control pull-right" value="<?= $a->puertas; ?>" id="puertas" name="puertas">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_motor">No. Motor</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->motor; ?>" id="motor" name="motor" maxlength="20">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label id="l_chasis">No. Chasis</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->chasis; ?>" id="chasis" name="chasis" maxlength="20">
                        </div>
                    </div>

                    <div class="clearfix"></div><br />

                    <div class="col-lg-3">
                        <label id="l_numSerie">No. Serie</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->numSerie; ?>" id="numSerie" name="numSerie" maxlength="20">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label id="l_vin">VIN</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->vin; ?>" id="vin" name="vin" maxlength="20">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label id="l_fechaMatricula">Fecha Matrícula</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fechaMatricula; ?>" id="fechaMatricula" name="fechaMatricula">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label id="l_fechaExpeLic">Fecha Expe. Licencia</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->fechaExpeLic; ?>" id="fechaExpeLic" name="fechaExpeLic">
                        </div>
                    </div>

                    <div class="clearfix"></div><br />

                </fieldset>

                <div class="clearfix"></div><br />

                <!-- <fieldset>
                    <legend>Polizas</legend>
                    <div class="col-lg-3">
                        <label id="l_n_contra">No. Contractual</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->n_contra; ?>" id="n_contra" name="n_contra">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label id="l_v_contra">Vencimiento Contractual</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->v_contra; ?>" id="v_contra" name="v_contra">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label id="l_n_extra">No. Extractual</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->n_extra; ?>" id="n_extra" name="n_extra">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label id="l_v_extra">Vencimiento Extractual</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->v_extra; ?>" id="v_extra" name="v_extra">
                        </div>
                    </div>

                    <div class="clearfix"></div> <br />

                    <div class="col-lg-3">
                        <label id="l_n_todo">No. Todo Riesgo</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->n_todo; ?>" id="n_todo" name="n_todo">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label id="l_v_todo">Vencimiento Todo Riesgo</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->v_todo; ?>" id="v_todo" name="v_todo">
                        </div>
                    </div>
                </fieldset> -->
                <div class="clearfix"></div>
                <br />
                <fieldset>
                    <legend>Conductores</legend>
                    <div class="col-lg-4">
                        <label id="l_id_propietario">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <select class="form-control select2" id="id_conductor" name="id_conductor">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["conductore"] as $c) { ?>
                                    <option value="<?= $c->id; ?>"><?= $c->nombre . ' ' . $c->apellidos; ?></option>
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
                </fieldset>
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
<script src="<?= $patch; ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch; ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch; ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('#soat').datepicker();
        $('#tecnomecanica').datepicker();
        $('#v_tg_operacion').datepicker();
        $('#v_contra').datepicker();
        $('#v_extra').datepicker();
        $('#v_todo').datepicker();
        $('#fechaMatricula').datepicker();
        $('#fechaExpeLic').datepicker();
    });

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
        sErrMsg += ($('#id_conductor').val() === "" ? '- Debe seleccionar Un Conductor.\n' : '');
        if (sErrMsg !== "") {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

    // Validar si un conductor ya se encuentra registrado 
    function validarConductor() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>vehiculos/validarConductores', {
                id_conductor: $('#id_conductor').val()
            },
            function(data) {
                $("#form1").unmask();
                if (data) {
                    alert('El Conductor ' + $('#id_conductor option:selected').text() + ' ya se encuentra registrado ..');
                } else {
                    AddItemE();
                }
            }
        );
    }

    // Agregar un nuevo conductor a la grilla
    function AddItemE() {
        $("#form1").mask("Espere...");
        $.post(
            '<?= $patch; ?>vehiculos/getitems', {
                id_cond: $('#id_conductor').val()
            },
            function(data) {
                $("#form1").unmask();
                $('#items').html(data);
            }
        );
    }

    // Cargar todos los conductores agregados en la grilla
    function loadItems() {
        $.post('<?= $patch; ?>vehiculos/load', {}, function(data) {
            $('#items').html(data);
        });
    }

    $('#items').ready(loadItems);

    // Eliminar un conductor de la grilla
    function delItem(i) {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>vehiculos/delete', {
            index: i
        }, function(data) {
            $("#form1").unmask();
            $('#items').html(data);
        });
    }




    function validateForm() {

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#placa').val(), $('#l_placa').html(), true);
        sErrMsg += validateText($('#modelo').val(), $('#l_modelo').html(), true);
        sErrMsg += validateText($('#marca').val(), $('#l_marca').html(), true);
        sErrMsg += validateText($('#id_clase').val(), $('#l_id_clase').html(), true);
        sErrMsg += validateText($('#num_interno').val(), $('#l_num_interno').html(), true);
        sErrMsg += validateText($('#tg_operacion').val(), $('#l_tg_operacion').html(), true);
        sErrMsg += validateText($('#num_interno').val(), $('#l_num_interno').html(), true);
        sErrMsg += ($('#id_propietario').val() === "" ? '- Debe seleccionar un Propietario.\n' : '');
        sErrMsg += validateNumber($('#capacidad').val(), $('#l_capacidad').html(), true);
        // sErrMsg += validateText($('#soat').val(), $('#l_soat').html(), true);
        // sErrMsg += validateText($('#tecnomecanica').val(), $('#l_tecnomecanica').html(), true);
        // sErrMsg += validateText($('#n_contra').val(), $('#l_n_contra').html(), true);
        // sErrMsg += validateText($('#v_contra').val(), $('#l_v_contra').html(), true);
        // sErrMsg += validateText($('#n_extra').val(), $('#l_n_extra').html(), true);
        // sErrMsg += validateText($('#v_extra').val(), $('#l_v_extra').html(), true);
        // sErrMsg += validateText($('#v_tg_operacion').val(), $('#l_v_tg_operacion').html(), true);
        //sErrMsg += validateText($('#n_todo').val(), $('#l_n_todo').html(), true);
        //sErrMsg += validateText($('#v_todo').val(), $('#l_v_todo').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "") {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>vehiculos/validar', {
                plac: $('#placa').val(),
                id: $("#id").val()
            },
            function(data) {
                $("#form1").unmask();
                if (data) {
                    alert('EL Vehiculo Se encuentra Registrado');
                } else {
                    $('#form1').submit();
                }
            }
        );
    }

    $('#btn-save').click(function() {
        if (validateForm()) {
            validar();
        }
    });

    $('#identificacion').change(function() {
        validarID();
    });

    $('#btn-cancel').click(function() {
        $.post('<?= $patch; ?>vehiculos/clean', {}, function(data) {
            window.location = '<?= $patch; ?>vehiculos';
        });
    });
</script>