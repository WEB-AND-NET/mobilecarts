<?php $a = $data["clientes"]; ?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Clientes
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>clientes">Clientes</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Clientes</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>clientes/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Contratante</legend>
                <div class="col-lg-4">
                    <label id="l_id_propietario">Propietario</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="id_propietario" name="id_propietario">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["propietarios"] as $m) { ?>
                                <option value="<?= $m->id; ?>"><?= $m->razon_social; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_cedula">C.C. / NIT:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->identificacion; ?>" id="identificacion" name="identificacion" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_nombre">Nombre / Raz&oacute;n Social</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="45">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-lg-4">
                    <label id="l_celular">Celular</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->celular; ?>" id="celular" name="celular" maxlength="20">
                    </div><!-- /.input group -->
                </div>                
                <div class="col-lg-4">
                    <label id="l_direccion">Direcci&oacute;n</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->direccion; ?>" id="direccion" name="direccion" maxlength="70">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_email">Email</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->email; ?>" id="email" name="email" maxlength="60">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4" style="visibility: hidden">
                    <label id="l_tipo_identificacion">Tipo Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <input type="hidden" class="form-control pull-right" value="P" id="tipo" name="tipo" maxlength="1">                   
                    </div>
                </div>

                <div class="clearfix"></div>
                <br />

                <!-- Seccion para guardar responsable -->
                <fieldset>
                    <legend>Responsable</legend>
                    <div class="col-lg-4">
                        <label id="l_c_identificacion">Identificaci&oacute;n</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_identificacion; ?>" id="c_identificacion" name="c_identificacion" maxlength="20">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_c_nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_nombre; ?>" id="c_nombre" name="c_nombre" maxlength="40">
                        </div><!-- /.input group -->
                    </div>    
                    <div class="col-lg-4">
                        <label id="l_c_celular">Celular</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_celular; ?>" id="c_celular" name="c_celular" maxlength="20">
                        </div><!-- /.input group -->
                    </div>
                    <div class="clearfix"></div>                                        
                    <div class="col-lg-4">
                        <label id="l_c_direccion">Direcci&oacute;n</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_direccion; ?>" id="c_direccion" name="c_direccion" maxlength="45">
                        </div><!-- /.input group -->
                    </div> 
                </fieldset>
                <!-- Fin seccion Contactos de clientes Juridico -->


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
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#id_propietario').val(), $('#l_id_propietario').html(), true);
        sErrMsg += validateText($('#identificacion').val(), $('#l_cedula').html(), true);
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de Cliente.\n' : '');
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateNumber($('#celular').val(), $('#l_celular').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);

        sErrMsg += validateText($('#c_identificacion').val(), $('#l_c_identificacion').html() + " del Responsable", true);
        sErrMsg += validateText($('#c_nombre').val(), $('#l_c_nombre').html() + " del Responsable", true);
        sErrMsg += validateText($('#c_celular').val(), $('#l_c_celular').html() + " del Responsable", true);
        sErrMsg += validateText($('#c_direccion').val(), $('#l_c_direccion').html() + " del Responsable", true);

        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

//    function validar() {
//        $("#form1").mask("Espere...");
//        $.post('<?//= $patch; ?>clientes/validar', 
//            {
//                tipo: "P", ced: $('#identificacion').val(), id: $("#id").val()
//            },
//            function (data) {
//                $("#form1").unmask();
//                if (data) {
//                    alert('EL Cliente Se encuentra Registrado');
//                } else {
//                    $('#form1').submit();
//                }
//            }
//        );
//    }

    $('#btn-save').click(function () {
        if (validateForm()) {
//            validar();
            $('#form1').submit();
        }
    });

//    $('#identificacion').change(function () {
//        validarID();
//    });


//    function validarID() {
//        $("#form1").mask("Espere...");
//        $.post('<?//= $patch; ?>clientes/validar', 
//            {
//                tipo: "P", ced: $('#identificacion').val(), id: $("#id").val()
//            },
//            function (data) {
//                $("#form1").unmask();
//                if (data) {
//                    alert('La Cedula ya esta Registrada');
//                    $('#identificacion').val("");
//                } else {
//                }        
//            }
//        );
//    }

    $('#btn-cancel').click(function () {
        $.post('<?= $patch; ?>clientes/clean', {}, function (data) {
            window.location = '<?= $patch; ?>clientes';
        });
    });

</script>
