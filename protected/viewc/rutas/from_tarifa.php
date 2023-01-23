<?php $a = $data["ruta"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Tarifas
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>tarifas">Tarifas</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Tarifas</li>
    </ol>
</section>
<br />
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>rutas/tarifas/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_valor">Ruta</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-inr"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre ?>" id="ruta" name="ruta" maxlength="45" disabled="">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <label id="l_id_clase">Clase Vehiculo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-bus"></i>
                        </div>
                        <select class="form-control select2" id="id_clase" name="id_clase" class="select">
                            <option value="">[Seleccione..]</option>
                            <?php
                            foreach ($data["clases"] as $c) {
                            ?>
                                <option value="<?= $c->id ?>"><?= $c->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_valor">Valor</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-usd"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="valor" name="valor" maxlength="15">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_add"></label>
                    <div class="input-group">
                        <button type="button" id="btn-add" class="btn  bg-green">Agregar</button>
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div>
                <div class="box-body">
                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!--<th>&nbsp;</th>-->
                                    <th>Clase Vehiculo</th>
                                    <th>$ Valor</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="render">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <!--<th>&nbsp;</th>-->
                                    <th>Clase Vehiculo</th>
                                    <th>$ Valor</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 col-lg-offset-6">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default col-lg-6 col-lg-12">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right col-lg-6 col-lg-12">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>

            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateAdd() {

        var sErrMsg = "";
        var flag = true;
        //ErrMsg += ($('#id_clase').val() === "" ? '- Debe seleccionar una Ruta.\n' : '');   
        sErrMsg += validateText($('#id_clase').val(), $('#l_id_clase').html(), true);
        sErrMsg += validateNumber($('#valor').val(), $('#l_valor').html(), true);
        if (sErrMsg !== "") {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#ruta').val(), $('#l_id_ruta').html(), true);
        if (sErrMsg !== "") {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $(function() {
        $.post("<?= $patch ?>rutas/tarifas/list", {}, function(data) {
            var html = "";
            $.each(data, function(key, val) {
                var item = '<tr>';
                //                    item += '<td><input class="minimal" name="item" type="radio" value="'+val.id+'" /></td>';
                item += ' <td>' + val.clase + '</td>';
                item += '<td>$&nbsp;' + val.valor + '</td>';
                item += '</tr>';
                html += item;
            });
            $("#render").html(html);
        }, "json");
    });

    $("#btn-add").click(function() {
        if (validateAdd()) {
            var o = {
                id_ruta: $('#id').val(),
                id_clase: $('#id_clase').val(),
                clase: $('#id_clase option:selected').text(),
                valor: $('#valor').val()
            };

            $('#id_clase').val("");
            $('#select2-id_clase-container').text("[Seleccione..]");
            $('#valor').val("");

            $.post("<?= $patch ?>rutas/tarifas/add", o, function(data) {
                console.log(data);
                var html = '';
                $.each(data, function(key, val) {
                    var item = '<tr>';
                    //                        item += '<td><input class="minimal" name="item" type="radio" value="'+val.id+'" /></td>';
                    item += '<td>' + val.clase + '</td>';
                    item += '<td>$&nbsp;' + val.valor + '</td>';
                    item += '</tr>';
                    html += item;
                });
                $("#render").html(html);
            }, "json");
        }
    });

    $('#btn-save').click(function() {
        if (validateForm()) {
            //validar();
            $('#form1').submit();
        }
    });

    function validarID() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>tarifas/validar', {
                ruta: $("#id_ruta option:selected").val()
            },
            function(data) {
                $("#form1").unmask();
                if (data) {
                    alert('La Cedula ya esta Registrada');
                    $('#identificacion').val("");
                } else {}
            });
    }

    $('#btn-cancel').click(function() {
        $.post('<?php echo $data['rootUrl']; ?>rutas/tarifas/clean', {}, function(data) {
            window.location = '<?= $patch; ?>rutas';
        });
    });
</script>