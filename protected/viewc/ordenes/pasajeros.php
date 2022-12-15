<div id="renderPasajeros" style="display: block;">
    <div class="col-lg-4" id="conytainerpasajeros">
            <label id="l_pasajeros">Pasajeros</label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-location-arrow"></i>
            </div>
            <select class="form-control select2"  id="pasajeros" name="pasajeros">
               
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <br/>
        <button type="button" id="btn-addPasajero" class="btn btn-primary">Agregar</button>
        <button type="button" id="btn-addOpenModalRegistart" data-toggle="modal" data-target="#modalAddPasajeros" class="btn btn-success">Registrar Pasajero</button>
    </div>
    <div class="clearfix"></div>
    <br/><br/>
    <table id="tablaPasajeros" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Numero de Cedula</th>
                <th></th>
            </tr>
        </thead>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAddPasajeros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registar Pasajeros</h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
            <label id="l_origen">Nombre</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-arrows-alt"></i>
                </div>
                <input type="text" class="form-control pull-right" autocomplete="off" value="" id="nombre_pasajero" name="nombre_pasajero" maxlength="100">
            </div><!-- /.input group -->
        </div>
        <div class="col-lg-12">
            <label id="l_id_cliente">Cedula</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                </div>
                <input type="text" class="form-control pull-right" autocomplete="off" value="" id="cedula" name="cedula" maxlength="100">
            </div>
        </div>
      </div>
       <div class="clearfix"></div>
    <br/><br/>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btn-save-pasajero" class="btn btn-primary">Guardar Pasajero</button>
      </div>
    </div>
  </div>
</div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">


    
    
    
    
    

 // Validacion al momento de seleccionar un conductor en select
    function validateFormPasajero() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += ($('#cedula').val() === "" ? '- Ingresar Cedula del pasajero.\n' : '');
        sErrMsg += ($('#nombre_pasajero').val() === "" ? '- Ingresar Nombre del pasajero.\n' : '');
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    
    
    function validatePasajero() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += ($('#pasajeros').val() == "" ? '- Seleccione un pasajero.\n' : '');
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    
    

   
    
    $(document).ready(function(){
        
        
        
         
    $('#pasajeros').select2({
        ajax:{
            url:'<?php echo $patch ?>pasajeros/getPasajeros',
            dataType: 'json',
            data:function(params){
                var query={
                    search:params.term,
                }
                return  query;
            },
            processResults:function(data){
                if(data){
                    return{
                        results: $.map(data.item,function(item){

                            return{
                                text:item.nombre,
                                id:item.id,
                            }
                        })
                    }
                }else{
                    return{
                        results:null
                    }
                }
            }
        }
    });//end od search category
    
    
    
        var table = $('#tablaPasajeros').DataTable({
            ajax:{
                url:'<?php echo $patch ?>pasajeros/list',
                dataSrc:'data',
                data:{
                    id_orden: $("#id").val() || 'new'
                }
            },
            columns:[ 
                { data: "id"} ,
                { data: "nombre"} ,
                { data: "cedula" },
                {
                    "data": null,
                    "defaultContent": `
                    <button class='btn btn-danger delete' type='button' name='itemd'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>`
                }
    
            ]
        });
        
        $('#tablaPasajeros tbody').on( 'click', 'button.delete', function () {
            var data = table.row( $(this).parents('tr') );
            $.post("<?php echo $patch ?>pasajeros/remove",{index:data.index()},function(response){table.ajax.reload();})
        });
        
        
        $("#btn-save-pasajero").click(function(){
            if(validateFormPasajero()){
               $.post('<?= $patch ?>pasajeros/save', {cedula: $("#cedula").val(), nombre: $("#nombre_pasajero").val() }, function (data) {
                    $("#cedula").val("")
                    $("#nombre_pasajero").val("")
                    $("#modalAddPasajeros").modal('hide')
                }); 
            }
        })
    
    
        $("#btn-addPasajero").click(function(){
            let ids = [];
            table.column( 0 ).data().each( function ( value, index ) {
                ids.push(value);
            });
            if(ids.includes($("#pasajeros").val())){
                alert("Este pasajero ya fue agregado")
                return;
            }
            if(validatePasajero()){
               $.post('<?= $patch ?>pasajeros/insert', {id: $("#pasajeros").val(), }, function (data) {
                    $("#pasajeros").val("")
                    table.ajax.reload();
                }); 
            }
        })
    })
    

            
</script>