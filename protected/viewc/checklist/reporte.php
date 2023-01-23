
<section class="content-header">
    <h1>
        Resumen Checklist Semanal 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>checklist">Checklist</a></li>
        <li class="active">Semanal</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>checklist/reportsemanal" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                
                <!--Placa-->
                <div class="form-group col-xs-12 col-sm-3">
                            <label for="id_vehiculo"><strong>Placa*</strong></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-location-arrow"></i>
                                </div>
                                <select class="form-control select2" id="id_vehiculo" name="id_vehiculo" class="select" required>
                                    <option value="">[Seleccione..]</option>
                                    <?php foreach ($data["vehiculos"] as $v) { ?>
                                        <option id="<?= $v['id']; ?>" name="<?= $v['id']; ?>" value="<?= $v['id']; ?>"><?= $v['placa']; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                <div class="clearfix"></div><br/>

                <div class="col-lg-4">
                    <label id="l_fecha_ultima_pago">Fecha inicio</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right"  id="fechaIni" name="fechaIni" required>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_fecha_ultima_revision">Fecha fin</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right"  id="fechaFin" name="fechaFin" required>
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="submit" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript">

    
    

   

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>propietarios';
    });

</script>
