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
                    <label id="l_nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="45">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_celular">Celular</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->celular; ?>" id="celular" name="celular" maxlength="20">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>
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
                <div class="col-lg-4">
                    <label id="l_tipo_identificacion">Tipo Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="tipo" name="tipo">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->tipo == "N" ? 'selected="selected"' : ''); ?> value="N">Natural</option>
                            <option <?= ($a->tipo == "J" ? 'selected="selected"' : ''); ?> value="J">Juridica</option>
                        </select>
                    </div>
                </div>
                <!--                <div class="clearfix"></div><br/>
                                <div class="col-lg-4">
                                    <label id="l_password">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" class="form-control pull-right" value="<?php // echo $a->password;    ?>" id="password" name="password" maxlength="10">
                                    </div> /.input group 
                                </div>-->
                <!--                <div class="col-lg-4">
                                    <label id="l_password">Repetir Password</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input type="password" class="form-control pull-right" value="<?php // echo $a->password;    ?>" id="repetir" name="repetir" maxlength="10">
                                    </div> /.input group 
                                </div>-->

                <div class="clearfix"></div>
                <br/>
                <!--  Centro de costo -->
                <fieldset style="display: none" id="contactos">
                    <legend>Centro costo</legend>
                    <div class="col-lg-4">
                        <label id="l_cc_numero">N&uacute;mero</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-desc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="cc_numero" name="cc_numero" maxlength="40">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_cc_nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="cc_nombre" name="cc_nombre" maxlength="45">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label>&nbsp;</label>
                        <div class="input-group">
                            <button type="button"  class="btn bg-blue btn-default" id="add-centrocosto">Agregar</button>
                        </div>
                    </div>
                    <div class="clearfix"></div><br/>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 45%;">N&uacute;mero</th>
                                <th style="width: 45%;">Nombre</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="renderccostos">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 45%;">N&uacute;mero</th>
                                <th style="width: 45%;">Nombre</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </fieldset>
                <div class="clearfix"></div><br/>
                <!-- Fin centro costo-->

                <!-- Seccion para guardar los contactos, a los clientes Juridico -->
                <fieldset style="visibility: hidden;" id="ccosto">
                    <legend>Contactos</legend>
                    <div class="col-lg-4">
                        <label id="l_c_ccosto">Centro Costo</label>
                        <div  class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-users"></i>
                            </div>
                            <select class="form-control select2"  id="c_ccosto" name="c_ccosto">
                                <option value="">[Seleccione..]</option>  
                                <?php foreach ($data["ccostos"] as $cc) { ?>
                                    <option value="<?= $cc['id']; ?>" data_des="<?= $cc['nombre'] ?>" ><?= $cc['numero'] . ' - ' . $cc['nombre']; ?></option>
                                <?php } ?>                                                              
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label id="l_c_identificacion">Identificaci&oacute;n</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_identificacion" name="c_identificacion" maxlength="20">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_c_nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_nombre" name="c_nombre" maxlength="40">
                        </div><!-- /.input group -->
                    </div>                    
                    <div class="clearfix"></div>
                    <div class="col-lg-4">
                        <label id="l_c_cargo">Cargo</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_cargo" name="c_cargo" maxlength="45">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_c_telefono">Tel&eacute;fono</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_telefono" name="c_telefono" maxlength="20">
                        </div><!-- /.input group -->
                    </div>                    
                    <div class="col-lg-4">
                        <label id="l_c_celular">Celular</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_celular" name="c_celular" maxlength="20">
                        </div><!-- /.input group -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4">
                        <label id="l_c_direccion">Direcci&oacute;n</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_direccion" name="c_direccion" maxlength="45">
                        </div><!-- /.input group -->
                    </div>    
                    <div class="col-lg-4">
                        <label id="l_c_email">Email</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="c_email" name="c_email" maxlength="60">
                        </div><!-- /.input group -->
                    </div>    
                    <div class="col-lg-4">
                        <label>&nbsp;</label>
                        <div class="input-group">
                            <button type="button"  class="btn bg-blue btn-default" id="add-contacto">Agregar</button>
                        </div>
                    </div>
                    <div class="clearfix"></div><br/>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Centro Costo</th>
                                <th>Celular</th>
                                <th>Estado</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="rendercontactos">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Centro Costo</th>
                                <th>Celular</th>
                                <th>Estado</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
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

    function changeSelect() {
        if ($('#tipo').val() === 'J') {
            //$("#contactos").css("visibility", "visible");
            $("#ccosto").css("visibility", "visible");

            $("#contactos").css("display", "block");
            //$("#ccosto").css("display", "block");

        } else {
            // $("#ccosto").css("display", "none");
            $("#contactos").css("display", "none");

            $("#ccosto").css("visibility", "hidden");
            //$("#contactos").css("visibility", "hidden");
        }
    }
    $('select#tipo').ready(changeSelect);

    $('select#tipo').change(changeSelect);

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#identificacion').val(), $('#l_cedula').html(), true);
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de Cliente.\n' : '');
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateNumber($('#celular').val(), $('#l_celular').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);

//        sErrMsg += validateText($('#password').val(), $('#l_password').html(), true);
//        sErrMsg += ($('#password').val() !== $('#repetir').val() ? '- Las ' + $('#l_password').html() + 's no Coinciden.\n' : '');

        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    // Validacion al momento de agregar centro de costo
    function validateFormCCosto() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#identificacion').val(), $('#l_cedula').html(), true);
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de Cliente.\n' : '');
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateNumber($('#celular').val(), $('#l_celular').html(), true);

        sErrMsg += validateText($('#cc_numero').val(), $('#l_cc_numero').html(), true);
        sErrMsg += validateText($('#cc_nombre').val(), $('#l_cc_nombre').html(), true);

        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

    // Validar la existencia de un centro de costo
    function  AddCCosto() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/validarcosto', 
            {
                //idcliente: $('#identificacion').val(),
                id: $("#id").val(),
                num: $("#cc_numero").val()
            },
            function (data) {
                $("#form1").unmask();
                if (data) {
                    alert('El Centro de costo ya se encuentra registrado');
                } else {
                    $.post('<?= $patch; ?>clientes/savetemporal',
                        {
                            id: $("#id").val(),
                            identificacion: $("#identificacion").val(),
                            nombre: $("#nombre").val(),
                            celular: $("#celular").val(),
                            email: $("#email").val(),
                            tipo: $("#tipo").val(),
                            numero: $('#cc_numero').val(),
                            nombrecc: $('#cc_nombre').val()
                        }, function (response) {     
                            if($("#id").val() === ""){
                                $("#id").val(response.id_cliente);
                            }
                            $("#c_ccosto").empty();
                            $("#c_ccosto").append($('<option>', {
                                value: '',
                                text: '[Seleccione..]'
                            }));
                            $.each(response.ccostos, function (key, val) {
                                $("#c_ccosto").append($('<option>', {
                                    value: val.id,
                                    text: val.nombre + ' - ' + val.numero,
                                    data_des : val.nombre
                                }));
                            });
                        }, "json").done(function(data) {
                            console.log( "cargar ccostos" );
                            cargarCcostos();
                        });
                    
                    $('#cc_numero').val('');
                    $('#cc_nombre').val('');
                }
            }
        );
    }

    // Validacion al momento de agregar contacto
    function validateFormContacto() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#c_ccosto').val(), $('#l_c_ccosto').html(), true);
        sErrMsg += validateText($('#c_identificacion').val(), $('#l_c_identificacion').html(), true);
        sErrMsg += validateText($('#c_nombre').val(), $('#l_c_nombre').html(), true);
        sErrMsg += validateText($('#c_cargo').val(), $('#l_c_cargo').html(), true);
        sErrMsg += validateText($('#c_telefono').val(), $('#l_c_telefono').html(), true);
        sErrMsg += validateText($('#c_celular').val(), $('#l_c_celular').html(), true);
        sErrMsg += validateText($('#c_direccion').val(), $('#l_c_direccion').html(), true);
        sErrMsg += validateText($('#c_email').val(), $('#l_c_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    
    // Agregar un nuevo contacto de costo a la grilla
    function AddContacto() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/getcontactos',
            {c_identificacion: $('#c_identificacion').val(), c_nombre: $('#c_nombre').val(), c_cargo: $('#c_cargo').val(), c_ccosto: $('#c_ccosto').val(), c_ccosto_des: $('#c_ccosto option:selected').attr('data_des'), c_telefono: $('#c_telefono').val(), c_celular: $('#c_celular').val(), c_direccion: $('#c_direccion').val(), c_email: $('#c_email').val()},
            function (data) {
                $("#form1").unmask();
                var html = '';
                $.each(data, function (key, val) {
                    var txt = "Activo";
                    var style = "label label-success";
                    if(val.deleted === '1'){
                       txt = "Inactivo"; 
                       style = "label label-danger";
                    } 
                    var com = "";
                    if(val.id !== ""){
                        com = '<td><span class="label '+style+'">' + txt + '</span></td>'+                            
                        '<td style="text-align: center;">' + ' <a href="javascript:void(0)" onClick="activarContacto('+ val.id +');" >  <i style="font-size: 150%;" class="fa fa-check"></i> </a>' + '</td>'+
                        '<td style="text-align: center;">' + ' <a href="javascript:void(0)" onClick="desactivarContacto('+ val.id +');" >  <i style="font-size: 150%;" class="fa fa-times"></i> </a>' + '</td></tr>' ;                        
                    }else{
                        txt = "Pendiente";
                        com = '<td><span class="label label-warning">' + txt + '</span></td>'+                            
                        '<td style="text-align: center;">' + ' <i style="font-size: 150%;" class="fa fa-ban"></i> ' + '</td>'+
                        '<td style="text-align: center;">' + ' <i style="font-size: 150%;" class="fa fa-ban"></i> ' + '</td></tr>' ;
                    }
                    html += '<tr><td><input class="minimal" name="contacto_item" type="radio" value="' + val.nombre + '" /></td>' +
                            ' <td>' + val.identificacion + '</td>' +
                            ' <td>' + val.nombre + '</td>' +
                            ' <td>' + val.cargo + '</td>' +
                            ' <td>' + val.centrocosto + '</td>' +
                            '<td>' + val.celular + '</td>'+com;
                            
                });
                $('#rendercontactos').html(html);
            }, 'json'
        );
    }
    
    function cargarCcostos(){
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/getccostos',
            {id_c : $("#id").val()},
            function (data) {
                $("#form1").unmask();
                var html = '';
                $.each(data, function (key, val) {
                    html += '<tr>' +
                            '<td>' + val.numero + '</td>' +
                            '<td><input type="text" value="' + val.nombre + '" name="cc_nombre" /></td>'+
                            '<td><span  onclick="delItem('+val.id+')" class="btn bg-red btn-default btn-sm"><i id="delccosto2"  class="fa fa-trash-o"></i></span></td>'+
                            '<td><span  onclick="updateccosto('+val.id+')" dataupdate="'+val.numero+'" class="btn bg-green btn-default btn-sm"><i class="fa fa-refresh"></i></span></td></tr>';
                });
                $('#renderccostos').html(html);
            }, 'json'
        );
    }
    
    function cargarContactos(){
        $.post('<?= $patch; ?>clientes/getcontactos',
            {},
            function (data) {
                $("#form1").unmask();
                var html = '';
                $.each(data, function (key, val) {
                    var txt = "Activo";
                    var style = "label label-success";
                    if(val.deleted === '1'){
                       txt = "Inactivo"; 
                       style = "label label-danger";
                    }
                    html += '<tr><td><input class="minimal" name="contacto_item" type="radio" value="' + val.nombre + '" /></td>' +
                            ' <td>' + val.identificacion + '</td>' +
                            ' <td>' + val.nombre + '</td>' +
                            ' <td>' + val.cargo + '</td>' +
                            ' <td>' + val.centrocosto + '</td>' +
                            '<td>' + val.celular + '</td>' +
                            '<td><span class="label '+style+'">' + txt + '</span></td>'+                            
                            '<td style="text-align: center;">' + ' <a href="javascript:void(0)" onClick="activarContacto('+ val.id +');" >  <i style="font-size: 150%;" class="fa fa-check"></i> </a>' + '</td>'+
                            '<td style="text-align: center;">' + ' <a href="javascript:void(0)" onClick="desactivarContacto('+ val.id +');" >  <i style="font-size: 150%;" class="fa fa-times"></i> </a>' + '</td></tr>' ;                     
                });
                $('#rendercontactos').html(html);
            }, 'json'
        );
    }
    
    function activarContacto(item){        
        $.post('<?= $patch; ?>clientes/activar_contacto',
            { id_contacto : item },
            function (data) {
                //cargarContactos();
            }
        );
    }
    
    function desactivarContacto(item){        
        $.post('<?= $patch; ?>clientes/desactivar_contacto',
            { id_contacto : item },
            function (data) {
                //cargarContactos();
            }
        );        
    }

    $('#renderccostos').ready(cargarCcostos);

    $('#rendercontactos').ready(cargarContactos);

    // Boton para agregar y validar al momento de crear centro de costo
    $('#add-centrocosto').click(function () {
        if (validateFormCCosto()) {
            AddCCosto();
        }
    });
    
    // Eliminar un centro de costo de la grilla
    function delItem(e) {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/deleteitem', {index: e}, function (data) {
            $("#form1").unmask();
            //$('#renderccostos').html(data);            
            if (data) {
                alert('El Centro de costo tiene dependencia no se puede eliminar');
            } else {
                cargarCcostos();
                alert('Eliminacion Correcta');
            }
        }
        );
    }
    
    // Eliminar un centro de costo de la grilla
    function updateItem(e) {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/deleteitem', {index: e}, function (data) {
            $("#form1").unmask();
            //$('#renderccostos').html(data);            
            if (data) {
                alert('El Centro de costo tiene dependencia no se puede eliminar');
            } else {
                cargarCcostos();
                alert('Eliminacion Correcta');
            }
        }
        );
    }

    // Boton para agregar y validar al momento de crear contacto
    $('#add-contacto').click(function () {
        if (validateFormContacto()) {
            //validarContacto();
            
            AddContacto();
            $('#c_ccosto').val('');
            $('#c_identificacion').val('');
            $('#c_nombre').val('');
            $('#c_cargo').val('');
            $('#c_telefono').val('');
            $('#c_celular').val('');
            $('#c_direccion').val('');
            $('#c_email').val('');
        }
    });

    // Cargar todos los centros de costo agregados en la grilla
    function loadItems() {
        $.post('<?= $patch; ?>clientes/load', {}, function (data) {
            $('#items').html(data);
        });
    }

    $('#items').ready(loadItems);

    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/validar', 
            {
                tipo: "NJ", ced: $('#identificacion').val(), id: $("#id").val()
            },
            function (data) {
                $("#form1").unmask();
                if (data) {
                    alert('EL Cliente Se encuentra Registrado');
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

    $('#identificacion').change(function () {
        validarID();
    });


    function validarID() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/validar', 
            {
                tipo: "NJ", ced: $('#identificacion').val(), id: $("#id").val()
            },
            function (data) {
                $("#form1").unmask();
                if (data) {
                    alert('La Cedula ya esta Registrada');
                    $('#identificacion').val("");
                } else {
                }
            }
        );
    }

    $('#btn-cancel').click(function () {
        $.post('<?= $patch; ?>clientes/clean', {}, function (data) {
            window.location = '<?= $patch; ?>clientes';
        });
    });
    
</script>
