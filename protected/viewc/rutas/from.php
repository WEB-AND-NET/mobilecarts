<style>
    .ocultar{
        visibility: hidden;
    }
    .aprecer{
        visibility: visible;
    }
</style>
<?php $a = $data["rutas"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Rutas
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>rutas">Rutas</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Rutas</li>
    </ol>
</section>
<br/>
<div class="box">
    <form id="form1" class="form" action="<?= $patch; ?>rutas/save" method="post" name="form1">
        <div class="box-body">
            <fieldset>
                <legend>Informaci&oacute;n General</legend>
                <?php if ($a->id != "") { ?>
                    <div class="col-lg-4">
                        <label id="l_numero">N&uacute;mero</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sort-numeric-asc"></i>
                            </div>
                            <input type="text" class="form-control pull-right" disabled="" value="<?= $a->numero; ?>" id="numero" name="numero" maxlength="10">
                        </div>
                    </div> 
                    <div class="clearfix"></div><br/>
                    <div class="col-lg-4">
                        <label id="l_nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" disabled="" value="<?= $a->nombre; ?>" id="nombre" name="nombre"/>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-4">
                    <label id="l_tipo">Tipo Ruta</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="form-control select2" id="tipo" name="tipo">
                            <option value="">[Seleccione..]</option>
                            <option <?= ($a->tipo == "N" ? 'selected="selected"' : ''); ?> value="N">Natural</option>
                            <option <?= ($a->tipo == "J" ? 'selected="selected"' : ''); ?> value="J">Juridica</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 ocultar" id="contrato" >
                    <label id="l_contrato">Cliente</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <?php include "select.php" ?> 
                    </div>
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-lg-4">
                    <label id="l_id_zona">Zona Origen</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map"></i>
                        </div>
                        <select class="form-control select2" id="zona_origen" name="zona_origen">
                            <option value="">[Seleccione..]</option>
                            <?php foreach ($data["zona"] as $m) { ?>
                                <option <?= ($a->zona_origen == $m->id ? 'selected="selected"' : ''); ?> value="<?= $m->id; ?>"><?= $m->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="nzonaorigen" id="nzonaorigen" value="" />
                </div>
                <div class="col-lg-4">
                    <label id="l_id_zona">Zona Destino</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map"></i>
                        </div>
                        <select class="form-control select2" id="zona_destino" name="zona_destino">
                            <option value="">[Seleccione..]</option>
                            <option value="0">Todos</option>
                            <?php foreach ($data["zona"] as $m) { ?>
                                <option <?= ($a->zona_destino == $m->id ? 'selected="selected"' : ''); ?> value="<?= $m->id; ?>"><?= $m->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="nzonadestino" id="nzonadestino" value="" />
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <label id="l_barrios_origen">Barrios Pertenecientes</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-list"></i>
                        </div>
                        <textarea id="barrios_origen" disabled="" class="form-control pull-right"></textarea>
                    </div>                    
                </div>  
                <div class="col-lg-4">
                    <label id="l_barrios_destino">Barrios Pertenecientes</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-list"></i>
                        </div>
                        <textarea id="barrios_destino" disabled="" class="form-control pull-right"></textarea>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input id="estado" name="estado" type="hidden" value="1" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    
    $(function () {        
        list_barrios($("#zona_origen").val(),"#barrios_origen");
        list_barrios($("#zona_destino").val(),"#barrios_destino");
    });

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar un Tipo de Cliente.\n' : '');
        sErrMsg += ($('#zona_origen').val() === "" ? '- Debe seleccionar una Zona de Origen.\n' : '');
        sErrMsg += ($('#zona_destino').val() === "" ? '- Debe seleccionar una Zona de Destino.\n' : '');
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;
    }
    
    function list_barrios(id,selector){
        $.post('<?= $patch ?>rutas/barrios/list',{id_z : id},function(data){
            $(selector).text(data);
        },"json");
    }

    $("#zona_origen").change(function () {
        var l = $("#zona_origen option:selected").text();
        $("#nzonaorigen").val(l);
        list_barrios($(this).val(),"#barrios_origen");
    });
    
    $("#zona_destino").change(function () {
        var l = $("#zona_destino option:selected").text();
        $("#nzonadestino").val(l);
        if($(this).val() !== "0"){
            list_barrios($(this).val(),"#barrios_destino");
        }else{
            $("#barrios_destino").text("");
        }
    });

    $(validarSelect());

    function validarSelect() {
        if ($('#tipo').val() === 'J') {
            $("#contrato").removeClass('ocultar');
            $("#contrato").addClass('aparecer');

            var tipo = $('#tipo').val();
            $.post('<?= $patch ?>rutas/cargar_cliente', {tipo: tipo, id_contrato: '<?= $a->id_contrato ?>'}, function (data) {
                $("#id_contrato").html(data);
            });

        } else {
            $("#contrato").removeClass('aparecer');
            $("#contrato").addClass('ocultar');
        }

    }

    $('select#tipo').change(function () {
        validarSelect();
    });
    function validar() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>rutas/validar', {
            origen: $("#zona_origen option:selected").val(),
            destino: $("#zona_destino option:selected").val(),
            id: $("#id").val()
        },
                function (data) {
                    $("#form1").unmask();
                    if (data) {
                        alert('La Ruta ya se encuentra registrada');
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
        window.location = '<?= $patch; ?>rutas';
    });

</script>
