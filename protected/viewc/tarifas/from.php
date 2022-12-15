<?php $a = $data["tarifas"]; ?>
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
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>tarifas/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>   
                <div class="col-lg-4" id="porigen" style="display: block;">
                    <label id="l_id_o">Punto Origen</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2"  id="id_o" name="id_o" class="select" disabled="">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["barrios"] as $b) { ?>
                                <option <?= ($b->id == $a->id_o ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4" id="porigen" style="display: block;">
                    <label id="l_id_d">Punto Destino</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <select class="form-control select2"  id="id_d" name="id_d" class="select" disabled="">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["barrios"] as $b) { ?>
                                <option <?= ($b->id == $a->id_d ? 'selected="selected"' : ''); ?> value="<?= $b->id; ?>"><?= $b->nombre; ?></option>
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
                        <input type="text" class="form-control pull-right" value="<?= $a->valor; ?>" id="valor" name="valor" maxlength="15" >
                    </div><!-- /.input group -->
                </div> 
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <label id="l_aplica_anexo">Personalizar anexo:</label> <input id="aplica_anexo" name="aplica_anexo" type="checkbox" value="S"  <?= $a->aplica_anexo == "S" ? 'checked=checked' : '' ?>/>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <label id="l_anexo">Anexo</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <textarea class="form-control pull-right" id="anexo" name="anexo" style="height: 200px" readonly="" ><?= utf8_decode($a->anexo); ?></textarea>
                    </div><!-- /.input group -->
                </div> 
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
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
    
    $("#aplica_anexo").click(function(){
        if($(this).is(":checked")){
            $("#anexo").removeAttr("readonly");
        }else{
            $("#anexo").attr("readonly","");
        }
        console.log($("#anexo").val());
    });

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateNumber($('#valor').val(), $('#l_valor').html(), true);
        if($("#aplica_anexo").is(":checked")){
            sErrMsg += validateText($('#anexo').val(), $('#l_anexo').html(), true);
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

//    function validarID() {
//        $("#form1").mask("Espere...");
//        $.post('<?//= $patch; ?>tarifas/validar', {
//           id_o: $( "#id_o option:selected" ).val(),
//           id_d: $( "#id_d option:selected" ).val()
//        },
//        function (data) {
//            $("#form1").unmask();
//            if (data) {
//                alert('La Tarifa ya esta Registrada');               
//            } else {
//            }
//        });
//    }


    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>tarifas';
    });

</script>
