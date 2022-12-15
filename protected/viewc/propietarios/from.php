<?php $a = $data["propietarios"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Afiliados
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>propietarios">Afiliados</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Afiliados</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>propietarios/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>
                <div class="col-lg-4">
                    <label id="l_cedula">Identificaci&oacute;n:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->identificacion; ?>" id="identificacion" name="identificacion" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_razon_social">Nombre / Raz&oacute;n social</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->razon_social; ?>" id="razon_social" name="razon_social" maxlength="100">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_telefono">T&eacute;lefono</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->telefono; ?>" id="telefono" name="telefono">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_celular">Celular</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->celular; ?>" id="celular" name="celular" maxlength="25">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_email">Email</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->email; ?>" id="email" name="email" maxlength="50">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_tipo_propietario">Tipo Afiliados</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="tipo" name="tipo" class="select">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->tipo == "N" ? 'selected="selected"' : ''); ?> value="N">Natural</option>
                            <option <?= ($a->tipo == "J" ? 'selected="selected"' : ''); ?> value="J">Juridica</option>
                        </select>
                    </div>
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
        sErrMsg += validateNumber($('#identificacion').val(), $('#l_cedula').html(), true);
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de Propietario.\n' : '');
        sErrMsg += validateText($('#razon_social').val(), $('#l_razon_social').html(), true);
        sErrMsg += validateNumber($('#celular').val(), $('#l_celular').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
          alert(sErrMsg);
          flag = false;
        }

        return flag;

    }
    
    function validar() {
      $("#form1").mask("Espere...");
      $.post('<?= $patch; ?>propietarios/validar', {
        ced: $('#identificacion').val(),
        id: $("#id").val()
      },
      function(data) {
        $("#form1").unmask();
        if (data) {
          alert('EL Propietario Se encuentra Registrado');
        } else {
          $('#form1').submit();
        }
      }
    );
    }

    $('#btn-save').click(function() {
    if (validateForm()) {
      validar();
    }
    });

    $('#identificacion').change(function() {
        validarID();
    });


    function validarID() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>propietarios/validar', {
          ced: $('#identificacion').val(), id: $("#id").val()
        },
        function(data) {
          $("#form1").unmask();
          if (data) {
            alert('La Identificación ya esta Registrada');
            $('#identificacion').val("");
          } else {
          }
        });
    }

    $('#btn-cancel').click(function() {
        window.location = '<?= $patch; ?>propietarios';
    });

</script>
