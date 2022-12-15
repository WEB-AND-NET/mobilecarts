<script src="<?= $patch; ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>documentovencer">Documentos por Vencer</a></li>
    </ol>
</section>
<br/><br/>
<div class="box col-md-10">
    <form id="form1" class="form" method="post" action="<?= $patch; ?>documentovencer/list"  name="form1"><!-- target="_blank" -->
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
<!--                <div class="col-lg-4">
                    <label id="l_rfecha">Rango de Fecha</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right"  id="rfecha" name="rfecha">
                    </div> /.input group 
                </div>-->
                <div class="col-lg-3">
                    <label id="l_nombre">Rango de Meses Proximos Vencer</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <select class="form-control select2" id="meses" name="meses">
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?php echo $i ?>"> <?php echo $i ?> </option>
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

//    $(function () {
//        $('#rfecha').datepicker({
//            format: "yyyy-mm-dd"
//        });
//    });

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        //sErrMsg += validateText($('#rfecha').val(), $('#l_rfecha').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }


    $('#btn-save').click(function (e) {
        if (validateForm()) {
            //var action = $('#form1').attr("action") + "/" + $('#rfecha').val() + "/" + $('#meses').val();
            var action = $('#form1').attr("action") + "/" + $('#meses').val();
            $('#form1').attr("action", action);
            $('#form1').submit();
            //location.reload();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>';
    });

</script>
