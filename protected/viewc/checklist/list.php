<link href="<?= $data['rootUrl'] ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Listado de CheckLists
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $data['rootUrl'] ?>">Inicio</a></li>
        <li class="active">CheckLists</li>
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
                            <a href="<?= $patch; ?>checklist/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br /><span>Nuevo</span></a>
                            <a href="<?= $patch; ?>checklist/semanal" id="btn-semanal" class="btn btn-default btn-md"><i class="fa fa-print"></i><br /><span>Reporte</span></a>
                            <a href="<?= $patch; ?>checklist/report" id="btn-report" target="_blank" class="btn btn-default btn-md"><i class="fa fa-archive"></i><br /><span>Ver</span></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive" style="width: auto;">
                        <table id="tabledatas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Numero</th>
                                    <th>Fecha</th>
                                    <th>Placa</th>
                                    <th>Conductor</th>
                                    <th>Resultado</th>
                                    <th>Realizado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data["checklists"] as $r) {
                                ?>
                                    <tr>
                                        <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                        <td><?= $r['id']; ?></td>
                                        <td><?= $r['fecha']; ?></td>
                                        <td><?= $r['placa']; ?></td>
                                        <td><?= $r['conductor']; ?></td>
                                        <?php
                                        $style = "label label-success";
                                        if ($r['resultado'] !== "Todo OK") {
                                            $style = "label label-danger";
                                        }
                                        ?>
                                        <td>
                                            <span class="label <?= $style ?>">
                                                <?= $r['resultado']; ?>
                                            </span>
                                        </td>
                                        <td><?= $r['creacion']; ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Numero</th>
                                    <th>Fecha</th>
                                    <th>Placa</th>
                                    <th>Conductor</th>
                                    <th>Resultado</th>
                                    <th>Realizado</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function() {
        $("#tabledatas").DataTable();
    });

    $('#btn-report').click(function(e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        } else {
            var old = $(this).attr("href");
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
            setTimeout(() => {
                $(this).attr("href", old);
            }, 2000);
        }
    });
</script>