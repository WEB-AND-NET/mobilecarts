<?php $a = $data["documentos"]; ?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Documentos
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>documentos">Documentos</a></li>
        <li class="active"><?= ($a->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Documentos</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>documentos/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Información General</legend>

                    <div class="col-lg-4">
                        <label id="l_nombre">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="45">
                        </div><!-- /.input group -->
                    </div>

                    <div class="col-lg-4" id="pvence">
                        <label id="l_se_vence">Se vence?</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2"  id="vencimiento" name="vencimiento">
                                <option  <?=  $a->vencimiento=='S' ? 'selected': ''; ?>  value="S">SI</option>
                                <option  <?=  $a->vencimiento=='N' ? 'selected': ''; ?> value="N">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4" id="ptipo">
                        <label id="l_tipo">Tipo de Documento</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2"  id="tipo" name="tipo">
                                <option  <?=  $a->tipo=='CR' ? 'selected': ''; ?>  value="CR">Conductores</option>
                                <option  <?=  $a->tipo=='CE' ? 'selected': ''; ?> value="CE">Clientes</option>
                                <option  <?=  $a->tipo=='VE' ? 'selected': ''; ?> value="VE">Vehiculo</option>
                                <option  <?=  $a->tipo=='FVE' ? 'selected': ''; ?> value="VE">Foto Vehiculo</option>
                            </select>
                        </div>
                    </div>


                </fieldset>

                <fieldset>
                    <legend>Atributos</legend>
                    <div class="col-lg-4">
                        <label id="l_nombre_attr">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right"  id="nombre_tag" name="nombre_tag">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_tag">Etiqueta</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right"  id="etiqueta_tag" name="etiqueta_tag">
                        </div><!-- /.input group -->
                    </div>

                    <div class="col-lg-4" id="dato">
                        <label id="l_tipo">Tipo de dato</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <select class="form-control select2"  id="tipo_tag" name="tipo_tag">
                                <option  value="fecha">Fecha</option>
                                <option  value="texto">Texto</option>
                            </select>
                        </div>
                    </div>

                     <div class="clearfix"></div><br>
                    <div class="box-footer col-lg-2 pull-right">
                        <button type="button" id="btn-save-attr" class="btn  bg-green pull-right">Insertar</button>
                    </div>

                    
                    <table id='databables' class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            
                                <th>Nombre</th>
                                <th>Etiqueta</th>
                                <th>Tipo</th>
                                <th></th>
                                
                            </tr>
                        </thead>
                    </table>

                    
                </fieldset>
                <!-- Fin seccion Contactos de clientes Juridico -->


                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="1" />
                    <input id="attr" name="attr" type="hidden" value="<?//= $a->attr ?>" />
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

var table = $('#databables').DataTable({
        ajax:{
            url:"<?php echo $patch ?>documentos/getAtributes",
            dataSrc:'data'
        },
        columns:[ 
            { data: "nombre_tag" } ,
            { data: "etiqueta_tag" },
            { data: "tipo_tag" },
            {
                "data": null,
                "defaultContent": "<input class='btn btn-danger' value='Delete' type='button' name='items'>"
            }
        ]
    });

    $("#btn-save-attr").click(function(){
        var nombre_tag=$("#nombre_tag").val();
        var etiqueta_tag=$("#etiqueta_tag").val();
        var tipo_tag=$("#tipo_tag").val();
        data={
            nombre_tag,
            etiqueta_tag,
            tipo_tag,
        }
        $.post("<?php echo $patch ?>documentos/setAtributes",data,function(e){
            console.log(e);
              fetchData()
        }) 
        table.ajax.reload();
     
    })
    function  fetchData(){
        var len=table.rows().data().length;
        cadena="[";
        for (let index = 0; index < len; index++) {
            cadena+=JSON.stringify(table.rows().data()[index]);
            var pass = len-index;
            if(len > 1 && pass!=1 ){
                cadena+=','
            }
        }
        cadena+="]";
            $("#attr").val(cadena)
    }
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html() , true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    $('#btn-save').click(function () {
        fetchData()
        if (validateForm()) {
            
           $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>clientesp';
    });



    

   

 

 

</script>
