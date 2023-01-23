<?php
$id_cli = $data["id_cli"];
$cliente = $data["cliente"];
$fi = $data["fi"];
$ff = $data["ff"];
?>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Servicios de Cliente : <?= $cliente["nombre"] ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>ser_cliente">Servicios por Cliente</a></li>
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
                            <a href="<?= $patch; ?>ser_cliente/imprimir/<?= $id_cli; ?>/<?= $fi; ?>/<?= $ff; ?>" id="btn-pdf" class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-text-o"></i><br /><span>PDF</span></a>
                        </div>
                        <div class="btn-group">
                            <a href="<?= $patch; ?>ser_cliente/imprimirv2/<?= $id_cli; ?>/<?= $fi; ?>/<?= $ff; ?>" id="btn-pdf" class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-text-o"></i><br /><span>PDF Alternativo</span></a>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Fecha</th>
                                    <th>No. Factura</th>
                                    <th>Origen</th>
                                    <th>Dirección</th>
                                    <th>Destino</th>
                                    <th>Valor</th>
                                    <th>Sobretasa&nbsp;&nbsp;&nbsp;</th>
                                    <th>Valor Factura</th>
                                    <th>Paradas</th>
                                    <th>Centro Costo</th>
                                    <th>Responsable</th>
                                    <th>Vehiculo</th>
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
                                    $total += ($r["valor"] + $r["sobre_tasa"]);
                                ?>
                                    <tr>
                                        <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                        <td><?= $r['fecha']; ?></td>
                                        <td><?= $r['num_fact']; ?></td>
                                        <td><?= $r['barrio_o']; ?></td>
                                        <td><?= $r['origen']; ?></td>
                                        <td><?= $r['barrio_d']; ?></td>
                                        <td><?= "$" . number_format($r["valor"], 2, ".", ","); ?></td>
                                        <td><?= "$" . number_format($r["sobre_tasa"], 2, ".", ","); ?></td>
                                        <td><?= "$" . number_format($r["valor"] + $r["sobre_tasa"], 2, ".", ","); ?></td>
                                        <?php
                                        $paradas = preg_replace($patrones, $sustituciones, $r['paradas']);
                                        $paradas = trim($paradas, ",");
                                        ?>
                                        <td><?= $paradas; ?></td>
                                        <td><?= $r['centrocosto']; ?></td>
                                        <td><?= $r['contacto']; ?></td>
                                        <td><?= $r['placa']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="float: right">Total Servicios</th>
                                    <th><?= count($data["servicios"]) ?></th>
                                    <th style="float: right">Valor Total</th>
                                    <th><?= "$" . number_format($total, 2, ".", ","); ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?= $patch ?>global/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<!-- <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js" type="text/javascript"></script> -->
<!-- <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js" type="text/javascript"></script> -->
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js " type="text/javascript"></script>

<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tabledatas").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o">&acute;Excel</i>', //text: '<i class="fa fa-file-excel-o">&acute;Excel</i>',
                    titleAttr: 'Excel',
                    exportOptions: {
                        modifier: {
                            //page: 'current'
                        }
                    },
                    footer: true,
                    filename: 'ServiciosCliente_<?= $id_cli; ?>'
                }]
            }

        );
    });
    $('#btn-cancel').click(function() {
        window.location = '<?= $patch; ?>';
    });
</script>