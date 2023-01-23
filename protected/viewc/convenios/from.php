<?php $a = $data["convenio"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Convenios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>convenios">Convenios</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Convenios</li>
    </ol>
</section>
<br />
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>convenios/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_numero">Número:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->numero; ?>" id="numero" name="numero" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_cedula">NIT:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nit; ?>" id="nit" name="nit" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_nombre">Razón Social</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->razon_social; ?>" id="razon_social" name="razon_social" maxlength="45">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div>
                <br>
                <fieldset>
                    <legend>Vehiculos</legend>
                    <div class="col-lg-4" id="pdestino">
                        <label id="l_conductores">Placa</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2" id="id_list_vehiculo" name="id_list_vehiculo">
                                <option value="">[Seleccione..]</option>
                                <?php foreach ($data["vehiculos"] as $v) { ?>
                                    <option id="<?= $v['id']; ?>" name="<?= $v['id']; ?>" value="<?= $v['id']; ?>"><?= $v['placa']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <br />
                        <button type="button" id="btn-addVehiculo" class="btn btn-primary">Agregar</button>
                    </div>
                    <div class="clearfix"></div>
                    <br /><br />
                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                </tr>
                            </thead>
                            <tbody id="items">
                                <tr>
                                    <td class="ch-message-information" colspan="2">Cargando lista de vehiculos</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>&nbsp;</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
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
    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#numero').val(), $('#l_numero').html(), true);
        sErrMsg += validateText($('#nit').val(), $('#l_nit').html(), true);
        sErrMsg += validateText($('#razon_social').val(), $('#l_razon_social').html(), true);
        if (sErrMsg !== "") {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>convenios/validar', {
                nit: $('#nit').val(),
                id: $("#id").val()
            },
            function(data) {
                $("#form1").unmask();
                if (data) {
                    alert('El NIT ya se encuentra Registrado');
                    $('#nit').val("");
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

    $('#nit').change(function() {
        validarID();
    });


    function validarID() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>convenios/validar', {
                nit: $('#nit').val(),
                id: $("#id").val()
            },
            function(data) {
                $("#form1").unmask();
                if (data) {
                    alert('El NIT ya se encuentra Registrado');
                    $('#nit').val("");
                }
            });
    }

    $('#btn-cancel').click(function() {
        window.location = '<?= $patch; ?>convenios';
    });

    // Cargar todos los vehiculos agregados en la grilla
    function loadItems() {
        $.post('<?= $patch; ?>convenios/load', {}, function(data) {
            $('#items').html(data);
        });
    }

    $('#tabledata').ready(loadItems);

    // Agregar un nuevo vehiculo a la grilla
    function AddVehiculo() {
        $("#form1").mask("Espere...");
        $.post(
            '<?= $patch; ?>convenios/insert_vehiculo', {
                id_vehiculo: $('#id_list_vehiculo').val(),
                placa: $('#id_list_vehiculo option:selected').text()
            },
            function(data) {
                $("#form1").unmask();
                $('#items').html(data);
            }
        );
    }

    $('#btn-addVehiculo').click(AddVehiculo);

    // Eliminar un vehiculo de la grilla
    function delItem(i) {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>convenios/delete_vehiculo', {
            index: i
        }, function(data) {
            $("#form1").unmask();
            $('#items').html(data);
        });
    }
</script>