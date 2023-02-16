<link href="<?= $patch; ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["mantenimiento"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Nuevo' : 'Actualizar'); ?> Mantenimiento
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>vehiculos">Vehiculos</a></li>
        <li><a href="<?= $patch ?>mantenimientos">Mantenimientos</a></li>
        <li class="active"><?= ($a->id == "" ? 'Nuevo' : 'Actualizar'); ?> Mantenimiento</li>
    </ol>
</section>
<br />

<form id="form1" class="form" action="<?= $patch; ?>mantenimientos/save" method="post" name="form1"
    enctype="multipart/form-data">
    <div class="box ">
        <div class="box-body">
            <fieldset>
                <legend>&nbsp;&nbsp;Informaci&oacute;n General</legend>


                <div class="col-lg-4">
                    <label id="l_tipo">Tipo:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-list-ol"></i>

                        </div>
                        <select name="tipo" id="tipo" class="form-control select2">

                            <option value="PRE" <?= $a->tipo == 'PRE' ? 'selected' : ''; ?>>Preventivo</option>
                            <option value="COR" <?= $a->tipo == 'COR' ? 'selected' : ''; ?>>Correctivo</option>
                            <option value="EVO" <?= $a->tipo == 'EVO' ? 'selected' : ''; ?>>Evolutivo</option>
                            <option value="ADA" <?= $a->tipo == 'ADA' ? 'selected' : ''; ?>>Adaptativo</option>
                            <option value="OTR" <?= $a->tipo == 'OTR' ? 'selected' : ''; ?>>Otro</option>

                        </select>


                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_fecha">Fecha</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $a->fecha; ?>" id="fecha"
                            name="fecha">
                    </div>
                </div>


                <div class="col-lg-4">
                    <label id="l_km">Kilometraje</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cog"></i>
                        </div>
                        <input type="number" class="form-control pull-right" value="<?= $a->km; ?>" id="km" name="km">
                    </div>
                </div>

                <div class="clearfix"></div>
                <br />

                <!--Placa-->
                <div class="form-group col-xs-12 col-sm-3">
                    <label for="vehiculoId"><strong>Placa*</strong></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2" id="vehiculoId" name="vehiculoId" class="select" required>
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["vehiculos"] as $v) { ?>
                            <option <?= ($v['id'] == $a->vehiculoId ? 'selected="selected"' : ''); ?> value="<?= $v['id']; ?>">
                                <?= $v['placa']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>


                <div class="col-lg-3">
                    <label id="l_costoTotal">Costo Total</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input type="number" class="form-control pull-right" value="<?= $a->costoTotal; ?>"
                            id="costoTotal" name="costoTotal">
                    </div>
                </div>


                <div class="col-lg-3">
                    <label id="l_archivoFactura">Copia Digital Factura</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file"></i>
                        </div>
                        <input name='archivoFactura' class='form-control doc' id="archivoFactura" type='file' accept="image/*" onchange="return fileValidation1()">
                    </div>
                </div>


                <div class="col-lg-3">
                    <label id="l_preoperacional">Preoperacional</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <input type="number" class="form-control pull-right" value="<?= $a->preoperacional; ?>"
                            id="preoperacional" name="preoperacional">
                    </div>
                </div>

                <div class="clearfix"></div>
                <br />


                <div class="col-lg-8">
                    <label id="l_descripcion">Descripcion</label>
                    <textarea class="form-control" rows="3" id="descripcion"
                        name="descripcion"><?= $a->descripcion; ?></textarea>
                </div>

                <div class="clearfix"></div>
                <br />

            </fieldset>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <fieldset>
                <legend>&nbsp;&nbsp;Actividades</legend>


                <div class="col-lg-4">
                    <label id="l_archivoFactura">Actividad</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-list-ol"></i>
                        </span>
                        <select class=" select2" style="width: 100%;" id="id_actividad" name="id_actividad">
                            <?php foreach ($data["actividades"] as $c) { ?>
                            <option value="<?= $c->id; ?>"><?= $c->nombre; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_costo">Costo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <input type="number" class="form-control pull-right" id="costo" name="costo">
                    </div>
                </div>


                <div class="col-lg-4">
                    <label id="l_anotaciones">Anotaciones</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-addon">
                            <i class="fa fa-align-left"></i>
                        </div>
                        <input name='anotaciones' class='form-control doc' id="anotaciones" type='text'>
                        <span class="input-group-btn">
                            <button type="button" id="btn-addActivity" class="btn btn-info btn-flat">Añadir</button>
                        </span>
                    </div>
                </div>


                <div class="clearfix"></div>
                <br />

                <div class="table-responsive" style="width: auto;">
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Actividad</th>
                                <th scope="col">Anotaciones</th>
                                <th scope="col">Costo</th>
                            </tr>
                        </thead>
                        <tbody id="items">
                            <tr>
                                <td class="ch-message-information" colspan="5">Cargando lista de actividades</td>
                            </tr>




                        </tbody>

                    </table>
                </div>
            </fieldset>

            <div class="box-footer col-lg-2 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />

                <input name="archivo" type="hidden" id="archivo" value="<?= $a->archivoFactura ?>" />

            </div>
        </div>
    </div>

</form>





<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script type="text/javascript">
function validateForm() {

    var sErrMsg = "";
    var flag = true;

    sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar un Tipo.\n' : '');
    sErrMsg += validateText($('#fecha').val(), $('#l_fecha').html(), true);
    sErrMsg += validateNumber($('#km').val(), $('#l_km').html(), true);
    sErrMsg += validateText($('#descripcion').val(), $('#l_descripcion').html(), true);
    sErrMsg += validateNumber($('#costoTotal').val(), $('#l_costoTotal').html(), true);


    if (sErrMsg !== "") {
        alert(sErrMsg);
        flag = false;
    }

    return flag;

}

// Cargar todos los conductores agregados en la grilla
function loadItems() {
    $.post('<?= $patch; ?>mantenimientos/loadItem', {}, function(data) {
        $('#items').html(data);
    });
}

$('#items').ready(loadItems);


// Boton para agregar actividad
$('#btn-addActivity').click(function() {
    AddItemE();
});

// Agregar una nueva actividad a la grilla
function AddItemE() {
    $("#form1").mask("Espere...");
    $.post(
        '<?= $patch; ?>mantenimientos/addItem', {
            id: $('#id_actividad').val(),
            anotacion: $('#anotaciones').val(),
            costo: $('#costo').val()
        },
        function(data) {
            $("#form1").unmask();
            $('#items').html(data);
            $('#anotaciones').val("");
            $('#costo').val("");
        }
    );
}

// Eliminar un conductor de la grilla
function delItem(i) {
    $("#form1").mask("Espere...");
    $.post('<?= $patch; ?>mantenimientos/deleteItem', {
        index: i
    }, function(data) {
        $("#form1").unmask();
        $('#items').html(data);
    });
}

$('#btn-save').click(function() {
    if (validateForm()) {
        $('#form1').submit();
    }
});

$('#btn-cancel').click(function() {
    $.post('<?= $patch; ?>vehiculos/clean', {}, function(data) {
        window.location = '<?= $patch; ?>mantenimientos';
    });
});

function fileValidation1() {
    var fileInput =
        document.getElementById('archivoFactura');
    var list = fileInput.files;


    // Allowing file type
    var allowedExtensions =
        /^image./i;

    var fileType = list[0].type;
    if (!allowedExtensions.exec(fileType)) {
        alert('Solo se permiten imagenes.');
        fileInput.value = '';
        return false;
    }

}

</script>