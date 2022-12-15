<script src="<?= $patch; ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>clientes_propietarios">Clientes por Propietario</a></li>
    </ol>
</section>
<br/><br/>
<div class="box col-md-10">
    <form id="form1" class="form" method="post" action="<?= $patch; ?>clientes_propietarios/html"  name="form1"> <!-- target="_blank" -->
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-3">
                    <label id="l_id_propietario">Propietario</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <select class="form-control select2"  id="id_propietario" name="id_propietario">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["propietarios"] as $c) { ?>
                                <option value="<?= $c->id; ?>"><?= $c->razon_social; ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Imprimir</button>
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
        sErrMsg += validateText($('#id_propietario').val(), $('#l_id_propietario').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function (e) {
        console.log($('#id_cliente').val());
        if (validateForm()) {
            var action = $('#form1').attr("action") + "/" + $('#id_propietario').val();
            $('#form1').attr("action", action);
            $('#form1').submit();
            //location.reload();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>';
    });

</script>
