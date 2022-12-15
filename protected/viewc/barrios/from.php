<?php $a = $data["barrios"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Barrios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>barrios">Barrios</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Barrios</li>
    </ol>
</section>
<br/>
<div class="box col-md-10">
    <form id="form1" class="form" action="<?= $patch; ?>barrios/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                
                <div class="col-lg-4">
                    <label id="l_id_zona">Zona</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="id_zona" name="id_zona">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["zona"] as $m) { ?>
                                <option <?= ($a->id_zona == $m["id"] ? 'selected="selected"' : ''); ?> value="<?= $m["id"]; ?>"><?= $m["nombre"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <label id="l_nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="45">
                    </div><!-- /.input group -->
                </div>
                
                <div class="clearfix"></div>

                <div class="box-footer col-lg-2 col-lg-offset-6">
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
<script type="text/javascript">

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += ($('#id_zona').val() === "" ? '- Debe seleccionar una Zona.\n' : '');
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>barrios/validar', {
            nomb: $('#nombre').val(),
            id: $("#id").val()
        },
        function (data) {
            $("#form1").unmask();
            if (data) {
                alert('EL Barrio Se encuentra Registrado');
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


    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>barrios';
    });

</script>
