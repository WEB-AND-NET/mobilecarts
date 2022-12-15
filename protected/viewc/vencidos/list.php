
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                     <div class="container">
                        <fieldset>
                            <legend><h1>Documentos Vencidos</h1><br></legend>
                            <div class="table-responsive">
                              <table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Conductor/vehiculo</th>
                                    <th scope="col">Documentos</th>
                                    <th scope="col">Fecha Vencimiento</th>
                                    <th scope="col">Restantes</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($data['vencidos'] as $v) { ?>
                                      <tr>
                                        <td scope="row"><?php echo $v['conductor'] ?></td>
                                        <td><?php echo $v['documento'] ?></td>
                                        <td><?php echo $v['fecha_vencimiento'] ?></td>
                                        <td><?php echo $v['resto'] ?></td><td>
                                        <?php if($v['resto'] > 0) { ?>
                                          <a href="<?php echo $data['rootUrl'] ?>conductores/documents/<?php echo $v['id_conductor'] ?>" class="btn btn-warning">Editar</a>
                                        <?php } else{ ?>
                                          <a href="<?php echo $data['rootUrl'] ?>conductores/documents/<?php echo $v['id_conductor'] ?>" class="btn btn-danger">Renovar</a>
                                        <?php } ?></td>
                                      </tr>
                                  <?php } ?>
                                  <?php foreach($data['vehiculosv'] as $vv){ ?>
                                    <tr>
                                      <td scope="row"><?php echo $vv['marca'] ?>-<?php echo $vv['razon_social'] ?></td>
                                      <td><?php echo $vv['documento'] ?></td>
                                      <td><?php echo $vv['fecha_vencimiento'] ?></td>
                                      <td><?php echo $vv['resto'] ?></td><td>
                                      <?php if($vv['resto'] > 0) { ?>
                                          <a href="<?php echo $data['rootUrl'] ?>vehiculos_propietario/documentos/<?php echo $vv['id_vehiculo'] ?>" class="btn btn-warning">Editar</a>
                                        <?php } else{ ?>
                                          <a href="<?php echo $data['rootUrl'] ?>vehiculos_propietario/documentos/<?php echo $vv['id_vehiculo'] ?>" class="btn btn-danger">Renovar</a>
                                        <?php } ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </fieldset><hr><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

