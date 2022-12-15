<script src="<?= $patch; ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>ser_cliente">Servicios por Cliente</a></li>
    </ol>
</section>
<br/><br/>
<div class="box col-md-10">
    <form id="form1" class="form" method="post" action="<?= $patch; ?>ser_cliente/html"  name="form1"><!-- target="_blank" -->
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_id_cliente">Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <select class="form-control select2"  id="id_cliente" name="id_cliente">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["clientes"] as $c) { ?>
                                <option value="<?= $c->id; ?>" dataone="<?= $c->tipo ?>"><?= $c->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_fecha_inicial">Fecha Inicio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="fecha_inicial" name="fecha_inicial" readonly="" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_fecha_final">Fecha Fin</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="fecha_final" name="fecha_final" readonly="" />
                    </div>
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
<link rel="stylesheet" href="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.css"/>
<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?= $patch; ?>global/css/jquery-ui-timepicker-addon.css"/>

<script type="text/javascript" src="<?= $patch; ?>global/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
    
    var options = {
        timeOnlyTitle: 'Hora',
        timeText: 'Hora',
        hourText: 'Horas',
        minuteText: 'Minutos',
        secondText: 'Segundos',
        currentText: 'Ahora',
        closeText: 'Cerrar',
        dateFormat: "yy-mm-dd"
    };
        
    $('#fecha_inicial').datepicker(options);
    $('#fecha_final').datepicker(options); 

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#id_cliente').val(), $('#l_id_cliente').html(), true);
        sErrMsg += validateText($('#fecha_inicial').val(), $('#l_fecha_inicial').html(), true);
        sErrMsg += validateText($('#fecha_final').val(), $('#l_fecha_final').html(), true);
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
            var action = $('#form1').attr("action") + "/" + $('#id_cliente').val()+ "/" + $('#fecha_inicial').val()+ "/" + $('#fecha_final').val();
            $('#form1').attr("action", action);
            $('#form1').submit();
            //location.reload();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>';
    });

</script>
