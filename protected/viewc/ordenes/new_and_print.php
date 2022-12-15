<style type="text/css">
    .nav > li > a:hover,
    .nav > li > a:active,
    .select-activo,
    .nav > li > a:focus{
        background-color: #3276B1 !important;
        color: #fff !important;
    }
    .nav > li.select-inactivo {
        color: #fff !important;
    }
</style>
<?php
$id = "";
if(isset($data["id_orden"])){
    $id = $data["id_orden"];
} 
?>
<section class="content-header">
    <h1>
        <?php echo ($id !== "") ?  "FUEC Registrado Exitosamente" :  "Ocurrio un error. Intentalo nuevamente.." ;?>
        
    </h1>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="" method="" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;margin: 10px;padding: 9px;">                       
                <a href="<?= $patch; ?>ordenes_servicios/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle fa-3x"></i><br/><span>Nuevo</span></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if($id !== ""){ ?>
                    <a href="<?= $patch; ?>ordenes_servicios/imprimir/<?= $id; ?>" id="btn-print"class="btn btn-default btn-md" target="_blank"><i class="fa fa-print fa-3x"></i><br/><span>Imprimir</span></a>
                <?php } ?>                
            </fieldset>
        </div>
    </form>
</div>