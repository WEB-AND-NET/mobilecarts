<?php $a = $data["tarifa_custom"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Tarifas Personalizada
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>tarifas">Tarifas</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Tarifas Personalizada</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>tarifas/save_custom" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>   
                <div class="col-lg-4" id="porigen" style="display: block;">
                    <label id="l_id_cliente">Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2"  id="id_cliente" name="id_cliente" class="select">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["clientes"] as $c) { ?>
                                <option value="<?= $c->id; ?>"><?= $c->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_id_clase_vehiculo">Clase Vehiculo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="id_clase_vehiculo" name="id_clase_vehiculo">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["clases_v"] as $c) { ?>
                                <option value="<?= $c->id; ?>"><?= $c->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_valor">Valor</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="valor" name="valor" maxlength="15">
                    </div><!-- /.input group -->
                </div>  
                <div class="clearfix"></div>                
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default col-lg-6 col-lg-12">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right col-lg-6 col-lg-12">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input name="id_tarifa" type="hidden" id="id_tarifa" value="<?= $a->id_tarifa; ?>" />
                    <!--<input id="deleted" name="deleted" type="hidden" value="0" />-->
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
        sErrMsg += validateText($('#id_cliente').val(), $('#l_id_cliente').html(), true);
        sErrMsg += validateText($('#id_clase_vehiculo').val(), $('#l_id_clase_vehiculo').html(), true);
        sErrMsg += validateNumber($('#valor').val(), $('#l_valor').html(), true);
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
        window.location = '<?= $patch; ?>tarifas';
    });

</script>
