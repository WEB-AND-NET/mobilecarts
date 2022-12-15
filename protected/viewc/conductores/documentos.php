
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
       Documentos de conductores
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>documentos">  Documentos de conductores</a></li>
        <li class="active"> </li>
    </ol>
</section>
<br/>
<div class="box ">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Información General
                    <div class="box-footer col-lg-2 pull-right">
                         <?php if($data['rol']=="3"){ ?>
                            <a type="button" disabled href="<?= $patch ?>conductores_propietario/updatedocts/<?php echo $data['id'] ?>" id="btn-solicitar-r" class="btn bg-blue right">Solicitar Revision</a>
                           
                        <?php }  ?> 
                        <a type="button" href="<?= $patch ?>conductores" class="btn bg-blue pull-right">Volver</a>
                    </div>
                </legend>
                <?php foreach($data["documentos"] as $documento){ ?>
                   <form data-id="<?= $documento->id ?>" id="f<?= $documento->id ?>" style="padding:20px;" >
                    <fieldset style="width:97%;" id="<?= $documento->nombre; ?>" >
                            <legend ><?php echo $documento->nombre; ?></legend>
                            <div class="col-lg-4" id="dato">
                                <label id="l_tipo">Adjuntar Archivo</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <input name='nombre_documento<?= $documento->id; ?>' class='form-control doc' doc-id='<?= $documento->id; ?>' attr-folder='<?php echo $documento->nombre_carpeta ?>'  type='file' >
                                </div>
                            </div>
                            <div class="col-lg-4" id="dato">
                                <label id="l_tipo">Fecha de Expedición</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <input class="form-control" id="fecha_expedicion" name="fecha_expedicion" type='date' >
                                </div>
                            </div>
                            <?php if($documento->vencimiento != "N") { ?>
                                <div class="col-lg-4" id="dato">
                                    <label id="l_tipo">Fecha de Vencimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-location-arrow"></i>
                                        </div>
                                        <input class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" type='date' >
                                    </div>
                                </div>
                            <?php } ?>
                            <?php foreach($documento->attr as $attrs){ ?>
                                <div class="col-lg-4" id="dato">
                                <label id="l_tipo"><?= $attrs["etiqueta_tag"] ?></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <input class='form-control' name="<?= $attrs["nombre_tag"] ?>" placeholder='<?= $attrs["etiqueta_tag"] ?>' type='<?= $attrs["tipo_tag"]=="texto"? "text" : 'date'  ?>' >
                                </div>
                            </div>
                            <?php } ?>
                        </fieldset>
                   </form><br>
                <?php } ?>
                </fieldset><!-- Fin seccion Contactos de clientes Juridico -->
            </fieldset>
        </div>
</div>

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

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
    
    $(document).ready(function(e){
        var url = "<?php echo $patch; ?>conductores/documents/getDocuments";
        var id = "<?php echo $data['id'] ?>";
        $.post(url,{id},function(response){
           var data = jQuery.parseJSON(response);
           var ancho = data.length;
           for(var i = 0 ; i < ancho ; i++ ){
               if(data[i].resto > 0 && data[i].resto < 30 ){
                    $("form[id=f"+data[i].id_documento+"]").addClass("bg-warning")
               }else if(data[i].resto < 0){
                    $("form[id=f"+data[i].id_documento+"]").addClass("bg-danger")
               }
               $("#f"+data[i].id_documento+" #fecha_expedicion").val(data[i].fecha_expedicion)
               $("#f"+data[i].id_documento+" #fecha_vencimiento").val(data[i].fecha_vencimiento)
               var attr = jQuery.parseJSON(data[i].atributos);
               for(key in attr[0]){
                
                $("input[name="+key+"]").val(attr[0][key])
               }  
               console.log(data[i])          
           }
        })
    })

    $("input[class=form-control]").on('blur',function (e) {
            e.preventDefault();
            $("#btn-solicitar-r").removeAttr('disabled');
            var nombreDoc = $(this.parentElement.parentElement.parentElement).attr('id');
            var idDoc = $(this.parentElement.parentElement.parentElement.parentElement).attr('data-id');
            var datos = "id_documento="+idDoc+"&nombre_documento="+nombreDoc+"&id_conductor=<?php echo $data['id']; ?>&"+$(this.parentElement.parentElement.parentElement.parentElement).serialize();
            saveDoc(datos)    
            
    });

    function saveDoc(datos){
        $.ajax({
            url: "<?php echo $patch; ?>conductores/documents/save",
            type: 'post',
            data: datos,
            success: function(e){
                console.log(e);
            },
            error: function(e){
                console.log("Error: " + e);
            }
        });
    }


    $(".doc").change(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("f"+$(this).attr("doc-id")));
        var datos = "id_documento="+$(this).attr("doc-id")+"&nombre_documento="+$(this).attr("attr-folder")+"&id_conductor=<?php echo $data['id']; ?>";
        saveDoc(datos)

        formData.append("id_c",<?php echo $data['id']; ?>)
        formData.append("id_doc",$(this).attr("doc-id"))
        $.ajax({
            url: "<?= $data["rootUrl"]; ?>conductores/documents/saveAll",
            type: "post",
            dataType: "html",
            data:formData,
            cache: false,
            contentType: false,
            processData: false
        }).success(function (data) { 
            console.log(data);
        });
    })

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>clientesp';
    });

</script>