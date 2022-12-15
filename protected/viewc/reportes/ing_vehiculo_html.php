<?php 
    $id_veh = $data["id_veh"];
    $vehiculo = $data["vehiculo"];
    $fi = $data["fi"];
    $ff = $data["ff"];
?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Ingresos de Vehiculo : <?= $vehiculo["placa"]; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>ing_vehiculo">Ingresos por Vehiculo</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls" style="float:right;">
                        <!-- Check all button -->
                        <div class="btn-group">                           
                            <a href="<?= $patch; ?>ing_vehiculo/imprimir/<?= $id_veh; ?>/<?= $fi; ?>/<?= $ff; ?>" id="btn-pdf"class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-text-o"></i><br/><span>PDF</span></a>                            
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Fecha</th>
                                <th>No. Factura</th>
                                <th>Origen</th>
                                <th>Destino</th>                                  
                                <th>Valor</th>
                                <th>Sobretasa&nbsp;&nbsp;&nbsp;</th>
                                <th>Valor Factura</th>                             
                                <th>Paradas</th>
                                <th>Cliente</th>
                                <th>Centro Costo</th>
                                <th>Responsable</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $patrones = array();
                            $patrones[0] = '[\n|\r|\n\r]';
                            $patrones[1] = '/,,/';
                            $sustituciones = array();
                            $sustituciones[0] = ' ';
                            $sustituciones[1] = ',';
                            foreach ($data["servicios"] as $r) {
                                $total += ($r["valor"]+$r["sobre_tasa"]);
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['fecha']; ?></td>
                                    <td><?= $r['num_fact']; ?></td>
                                    <td><?= $r['barrio_o']; ?></td>
                                    <td><?= $r['barrio_d']; ?></td>
                                    <td><?= "$" . number_format($r["valor"], 2, ".", ","); ?></td>
                                    <td><?= "$" . number_format($r["sobre_tasa"], 2, ".", ","); ?></td>
                                    <td><?= "$" . number_format($r["valor"]+$r["sobre_tasa"], 2, ".", ","); ?></td>
                                    <?php 
                                        $paradas = preg_replace($patrones, $sustituciones, $r['paradas']);
                                        $paradas = trim($paradas, ",");
                                    ?>
                                    <td><?= $paradas; ?></td>
                                    <td><?= $r['cliente']; ?></td>
                                    <td><?= $r['centrocosto']; ?></td>
                                    <td><?= $r['contacto']; ?></td>                                                                        
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                               
                                <th></th>
                                <th style="float: right">Valor Total</th>
                                <th><?= "$" . number_format($total, 2, ".", ","); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                               
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                               
                                <th></th>
                                <th style="float: right">Total Servicios</th>
                                <th><?= count($data["servicios"]) ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?= $patch ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#tabledatas").DataTable();
    });
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>';
    });
</script>
