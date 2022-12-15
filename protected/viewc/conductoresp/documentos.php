<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Documentos de <?php echo $data['conductor'][0]->nombre; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Documentos de <?php echo $data['conductor'][0]->nombre; ?></li>
    </ol>
</section>



<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Rechazo de Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form i>
                <input type="text" id="id_doc_r" hidden>
                <div class="form-group">
                    <label for="documento_r">Tipo de Documento</label>
                    <input type="text" class="form-control" id="documento_r" placeholder="Documento">
                    <small id="emailHelp" class="form-text text-muted">Informe del tipo de documento que rechazo, y sus razones</small>
                </div>
                <div class="form-group">
                    <label for="comentario_r">Comentario y/o Razones</label>
                    <input type="text" class="form-control" id="comentario_r" placeholder="Comentarios">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="notitify">
                    <label class="form-check-label" for="exampleCheck1">Mandar Notificacion</label>
                </div><br>
                <button type="submit" class="btn btn-primary float-right" id="env-rechazo">Enviar</button>
            </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls" style="float:right;">
                        <!-- Check all button -->
                        <div class="btn-group">
                            <a href="<?= $patch; ?>conductores/documents/<?php echo $data['id']?>" id="btn-documents"class="btn btn-default btn-md"><i class="fa fa-archive"></i><br/><span>Editar Documentos</span></a>
                            <a href="#" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span>Eliminar</span></a>
                            <button type="button" id="btn-rechazar" class="btn btn-default btn-md" data-toggle="modal"><i class="fa fa-minus-circle"></i><br/><span>Rechazar Documento</span></button>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>  
                                <th> Tipo Documento</th>
                                <th> Fecha Expedicion</th>
                                <th> Fecha de Vencimiento</th>
                                <th> Documento </th>
                                <th> Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["documentos"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" data-documento="<?= $r['tipo']; ?>" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['tipo']; ?></td>
                                    <td><?= $r['fecha_expedicion']; ?></td>
                                    <td><?= $r['fecha_vencimiento']; ?></td>
                                    <td><? echo $r['nombre_documento']; ?><?= isset(explode('.',$r['nombre_documento'])[1])  ? '' : '.pdf' ?> <a target="_blank" href="<?php echo $data['rootUrl'] ?>documentacion/<?php echo $r['nombre_carpeta'] ?>/<?php echo $r['nombre_documento']?><?= isset(explode('.',$r['nombre_documento'])[1])  ? '' : '.pdf' ?>">Ver</a> </td>
                                    
                                        <?php
                                        $txt = "Activo";
                                        $style = "label label-success";
                                        if($r['estado'] === "I"){
                                          $txt = "Inactivo"; 
                                          $style = "label label-danger";
                                        }
                                    ?>
                                    <td><span class="label <?= $style ?>"><?= $txt ?></span></td>
                                </tr>
                                    <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>  
                                <th> Tipo Documento</th>
                                <th> Fecha Expedicion</th>
                                <th> Fecha de Vencimiento</th>
                                <th> Documento </th>
                                <th> Estado </th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function () {
        $("#tabledatas").DataTable();
    });
   
    $('#btn-rechazar').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un Documento');
            $("#exampleModalLong").modal("close");
        }
        else {
            $("#id_doc_r").val(item);
            $("#documento_r").val($('input[name=item]:checked').attr('data-documento'));
            $("#exampleModalLong").modal("show")
        }
    });

    $("#env-rechazo").click(function(e){
        e.preventDefault()
        var url = "<?php echo Doo::conf()->APP_URL?>conductores/documents/rechazar";
        var id_doc = $("#id_doc_r").val()
        var id_conductor = "<?php echo $data['conductor'][0]->id ?>";
        var documento = $("#documento_r").val()
        var comentario = $("#comentario_r").val()
        var notify = $("#notitify")[0].checked ? "1" : "0";
        $.post(url,{id_doc,id_conductor, documento,comentario,notify},function(res){
            location.href = "<?php echo Doo::conf()->APP_URL?>conductores/documents/view/"+id_conductor;
            //console.log(res);
        })
    })

</script>
