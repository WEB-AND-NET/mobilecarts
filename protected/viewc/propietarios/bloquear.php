<?php $a = $data["propietarios"]; ?>
<section class="content-header">
    <h1>
        Bloqueo de Afiliados
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>propietarios">Afiliados</a></li>
        <li class="active">Bloqueo de Afiliados</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>propietarios/savebloqueo" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_pago">Bloqueo por Pago:</label> <input id="pago_estado" name="pago_estado" type="checkbox" value="D" <?= $a->pago_estado == "D" ? 'checked=checked' : ''  ?>/>
                </div>
                <div class="col-lg-4">
                    <label id="l_revision">Revisi&oacute;n t&eacute;cnica no satisfactoria:</label> <input id="revision_estado" name="revision_estado" type="checkbox" value="D"  <?= $a->revision_estado == "D" ? 'checked=checked' : ''  ?>/>
                </div>
                <div class="clearfix"></div><br/>

                <div class="col-lg-4">
                    <label id="l_fecha_ultima_pago">Fecha &Uacute;ltima de pago:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->pago_fecha; ?>" id="pago_fecha" name="pago_fecha">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_fecha_ultima_revision">Fecha &Uacute;ltima de Revisi&oacute;n t&eacute;cnica :</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->revision_fecha; ?>" id="revision_fecha" name="revision_fecha">
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
<script src="<?= $patch ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {
        $('#pago_fecha').datepicker();
        $('#revision_fecha').datepicker();
    });
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
//        if ($('input[type=checkbox]:checked').length !== 0) {
//            if ($('#pago_estado').is(':checked')) {
                sErrMsg += validateText($('#pago_fecha').val(), $("#l_fecha_ultima_pago").html(), true);
//            }

//            if ($('#revision_estado').is(':checked')) {
                sErrMsg += validateText($('#revision_fecha').val(), $("#l_fecha_ultima_revision").html(), true);
//            }
            if (sErrMsg !== "")
            {
                alert(sErrMsg);
                flag = false;
            }
            return flag;

//        } else {
//            alert('Debe seleccionar al menos un valor');
//        }
    }

    $('#btn-save').click(function () {
        if (validateForm()) {
            $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>propietarios';
    });

</script>
