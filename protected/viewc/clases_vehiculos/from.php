<?php $a = $data["clasesvehiculo"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Clases de Vehiculos
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>clases_vehiculos">Clases de Vehiculos</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Clases de Vehiculos</li>
    </ol>
</section>
<br/>
<div class="box col-md-10">
    <form id="form1" class="form" action="<?= $patch; ?>clases_vehiculos/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>

                <div class="col-lg-4">
                    <label id="l_nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_vhoran">Valor Hora Normal</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->vhoran; ?>" id="vhoran" name="vhoran" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_vhorae">Valor Hora Extra</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->vhorae; ?>" id="vhorae" name="vhorae" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                
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
<script type="text/javascript">

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateNumber($('#vhoran').val(), $('#l_vhoran').html(), true);
        sErrMsg += validateNumber($('#vhorae').val(), $('#l_vhorae').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clases_vehiculos/validar', {
            nomb: $('#nombre').val(),
            id: $("#id").val()
        },
        function (data) {
            $("#form1").unmask();
            if (data) {
                alert('La clases de Vehiculo ya encuentra Registrado');
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
        window.location = '<?= $patch; ?>clases_vehiculos';
    });

</script>
