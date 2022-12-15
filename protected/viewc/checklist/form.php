<?php
$login = $_SESSION['login'];

?>

<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>clientes/save" method="post" name="form1">
        <div class="box-body">
            <div class="col-xs-12 col-md-12">
                <div class="card">
                    <div class="card-body card-block">
                        <div class="row">
                            <!--Fecha de inspeccion-->
                            <div class="form-group col-xs-6 col-sm-12">
                                <label for="f.inspeccion"><strong>Fecha de inspeccion*</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar-check-o"></i>
                                        </div>
                                        <input type="date" name="fecha_inspeccion" id="f.inspeccion" required>
                                    </div>
                            </div>
                            <!--Km inicial-->
                            <div class="form-group col-xs-6 col-sm-3">
                                <label for="km"><strong>KM inicio*</strong></label>
                                    <div class="input-group">
                                        <input type="number" name="kminicio" id="km" required>
                                    </div>
                            </div>
                            <!--Placa-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="placa"><strong>Placa*</strong></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <select class="form-control select2"  id="placa" name="placa" class="select" multiple="multiple">
                                        <option value="">[Seleccione..]</option>
                                        <?php foreach ($data["vehiculos"] as $v) { ?>
                                            <option id="<?= $v['id']; ?>" name="<?= $v['id']; ?>"  value="<?= $v['id']; ?>"><?= $v['placa']; ?></option>
                                        <?php } ?>
                                            
                                    </select>
                                </div>
                            </div>
                            <!-- Tabla de luces-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <i class="fa fa-lightbulb-o"></i>
                                    <strong>Luces*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Luces Exteriores (direccionales, stop, delanteras)</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="1" 
                                                                id="lucesextok" value="OK">
                                                            <label class="form-check-label" for="lucesextok">OK</label>

                                                            <input class="form-check-input" type="radio" name="1" 
                                                                id="lucesextobs" value="Fallo">
                                                            <label class="form-check-label" for="lucesextobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionluzexterna" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionlucesext" 
                                                        placeholder="Escriba la observacion" id="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Luces internas</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="2" 
                                                                id="lucesokint" value="OK">
                                                            <label class="form-check-label" for="lucesokint">OK</label>
                                                            
                                                            <input class="form-check-input" type="radio" name="2" 
                                                                id="lucesintobs" value="Fallo">
                                                            <label class="form-check-label" for="lucesintobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionluzinterna" style="display:none">
                                                <td colspan="2"> 
                                                    <input type="text" name="observacionlucesint" 
                                                        placeholder="Escriba la observacion" id="2">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Tabla de llantas-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <i class="fa-solid fa-tire"></i>
                                    <strong>Llantas*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Llantas del vehiculo</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="3" 
                                                                id="llantasvehiok" value="OK">
                                                            <label class="form-check-label" for="llantasvehiok">OK</label>

                                                            <input class="form-check-input" type="radio" name="3" 
                                                                id="llantasvehiobs" value="Fallo">
                                                            <label class="form-check-label" for="llantasvehiobs">Observacion</label>
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionllantavehiculo" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionllantasvehiculo" 
                                                        placeholder="Escriba la observacion" id="3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Llanta de repuesto</td>
                                                <td>
                                                    <div class="input-group">
                                                            <input class="form-check-input" type="radio" name="4" 
                                                                id="llantarepuok" value="OK">
                                                            <label class="form-check-label" for="llantarepuok">OK</label>

                                                            <input class="form-check-input" type="radio" name="4" 
                                                                id="llantasrepuobs" value="Fallo">
                                                            <label class="form-check-label" for="llantasrepuobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionllantarepuesto" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionllantasrepuesto" 
                                                        placeholder="Escriba la observacion" id="4">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tabla de niveles-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <i class="fa fa-area-chart"></i>
                                    <strong>Verificacion de niveles*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nivel aceite motor</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="5" 
                                                                id="nivelaceok" value="OK">
                                                            <label class="form-check-label" for="nivelaceok">En nivel</label>
                                                        
                                                            <input class="form-check-input" type="radio" name="5" 
                                                                id="nivelaceobs" value="Fallo">
                                                            <label class="form-check-label" for="nivelaceobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionnivelaceite" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionnivelaceite" 
                                                        placeholder="Escriba la observacion" id="5">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Refrigerante</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="6" 
                                                                id="nivelrefriok" value="OK">
                                                            <label class="form-check-label" for="nivelrefriok">En nivel</label>

                                                            <input class="form-check-input" type="radio" name="6" 
                                                                id="nivelrefriobs" value="Fallo">
                                                            <label class="form-check-label" for="nivelrefriobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionnivelrefrigerante" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionnivelrefrigerante" 
                                                        placeholder="Escriba la observacion" id="6">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Liquido frenos</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="7" 
                                                                id="nivelliqfrenok" value="OK">
                                                            <label class="form-check-label" for="nivelliqfrenok">En nivel</label>

                                                            <input class="form-check-input" type="radio" name="7" 
                                                                id="nivelliqfrenobs" value="Fallo">
                                                            <label class="form-check-label" for="nivelliqfrenobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionnivelliquidofreno" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionnivelliquidofreno" 
                                                        placeholder="Escriba la observacion" id="7">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Direccion(hidraulico)</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="8" 
                                                                id="niveldirok" value="OK">
                                                            <label class="form-check-label" for="niveldirok">En nivel</label>

                                                            <input class="form-check-input" type="radio" name="8" 
                                                                id="niveldirobs" value="Fallo">
                                                            <label class="form-check-label" for="niveldirobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionniveldireccion" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionniveldireccion" 
                                                        placeholder="Escriba la observacion" id="8">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tabla de Motor-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <i class="fa-solid fa-engine"></i>
                                    <strong>Motor*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Correas (Sin roturas, tensionadas)</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="9" 
                                                                id="correasok" value="OK">
                                                            <label class="form-check-label" for="correasok">OK</label>

                                                            <input class="form-check-input" type="radio" name="9" 
                                                                id="correasobs" value="Fallo">
                                                            <label class="form-check-label" for="correasobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacioncorrea" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacioncorrea" 
                                                        placeholder="Escriba la observacion" id="9">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mangueras (sin fugas, sin roces)</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="10" 
                                                                id="mangueraok" value="OK">
                                                            <label class="form-check-label" for="mangueraok">OK</label>

                                                            <input class="form-check-input" type="radio" name="10" 
                                                                id="mangueraobs" value="Fallo">
                                                            <label class="form-check-label" for="mangueraobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionmanguera" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionmanguera" 
                                                        placeholder="Escriba la observacion" id="10">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sin fugas de aceite</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="11" 
                                                                id="fugaaceiteok" value="OK">
                                                            <label class="form-check-label" for="fugaaceiteok">OK</label>

                                                            <input class="form-check-input" type="radio" name="11" 
                                                                id="fugaaceiteobs" value="Fallo">
                                                            <label class="form-check-label" for="fugaaceiteobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionfugaaceite" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionfugaaceite" 
                                                        placeholder="Escriba la observacion" id="11">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sin fugas combustible</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="12" 
                                                                id="fugacombusok" value="OK">
                                                            <label class="form-check-label" for="fugacombusok">OK</label>

                                                            <input class="form-check-input" type="radio" name="12" 
                                                                id="fugacombusobs" value="Fallo">
                                                            <label class="form-check-label" for="fugacombusobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionfugaacombustible" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionfugaacombustible" 
                                                        placeholder="Escriba la observacion" id="12">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sin fuga agua (Refrigerante)</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="13" 
                                                                id="fugaaguaok" value="OK">
                                                            <label class="form-check-label" for="fugaaguaok">OK</label>

                                                            <input class="form-check-input" type="radio" name="13" 
                                                                id="fugaaguaobs" value="Fallo">
                                                            <label class="form-check-label" for="fugaaguaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionfugaagua" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionfugaagua" 
                                                        placeholder="Escriba la observacion" id="13">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tabla de frenos-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <strong>Frenos*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Funcionamiento frenos</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="14" 
                                                                id="funfrenosok" value="OK">
                                                            <label class="form-check-label" for="funfrenosok">OK</label>
                                                            
                                                            <input class="form-check-input" type="radio" name="14" 
                                                                id="funfrenosobs" value="Fallo">
                                                            <label class="form-check-label" for="funfrenosobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionfunfrenos" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionfunfrenos" 
                                                        placeholder="Escriba la observacion" id="14">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Freno emergencia</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="15" 
                                                                id="frenoemergenciaok" value="OK">
                                                            <label class="form-check-label" for="frenoemergenciaok">OK</label>
                                                            
                                                            <input class="form-check-input" type="radio" name="15" 
                                                                id="frenoemergenciaobs" value="Fallo">
                                                            <label class="form-check-label" for="frenoemergenciaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionfrenoemergencia" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionfrenoemergencia" 
                                                        placeholder="Escriba la observacion" id="15">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tabla de otros componentes-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <strong>Otros Componentes*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Direccion</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="16" 
                                                                id="direccionok" value="OK">
                                                            <label class="form-check-label" for="direccionok">OK</label>

                                                            <input class="form-check-input" type="radio" name="16" 
                                                                id="direccionobs" value="Fallo">
                                                            <label class="form-check-label" for="direccionobs">Observacion</label>
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observaciondireccion" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observaciondireccion" 
                                                        placeholder="Escriba la observacion" id="16">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Suspension</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="17" 
                                                                id="suspensionok" value="OK">
                                                            <label class="form-check-label" for="suspensionok">OK</label>

                                                            <input class="form-check-input" type="radio" name="17" 
                                                                id="suspensionobs" value="Fallo">
                                                            <label class="form-check-label" for="suspensionobs">Observacion</label>
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionsuspension" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionsuspension" 
                                                        placeholder="Escriba la observacion" id="17">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Clutch</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="18" 
                                                                id="cluctchok" value="OK">
                                                            <label class="form-check-label" for="cluctchok">OK</label>

                                                            <input class="form-check-input" type="radio" name="18" 
                                                                id="cluctchobs" value="Fallo">
                                                            <label class="form-check-label" for="cluctchobs">Observacion</label>
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacioncluctch" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacioncluctch" 
                                                        placeholder="Escriba la observacion" id="18">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Transmision</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="19" 
                                                                id="transmisionok" value="OK">
                                                            <label class="form-check-label" for="transmisionok">OK</label>

                                                            <input class="form-check-input" type="radio" name="19" 
                                                                id="transmisionobs" value="Fallo">
                                                            <label class="form-check-label" for="transmisionobs">Observacion</label>
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observaciontransmision" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observaciontransmision" 
                                                        placeholder="Escriba la observacion" id="19">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Muelles</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="20" 
                                                                id="muellesok" value="OK">
                                                            <label class="form-check-label" for="muellesok">OK</label>

                                                            <input class="form-check-input" type="radio" name="20" 
                                                                id="muellesobs" value="Fallo">
                                                            <label class="form-check-label" for="muellesobs">Observacion</label>
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionmuelle" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionmuelle" 
                                                        placeholder="Escriba la observacion" id="20">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--tabla Equipo de carretera-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <strong>Equipo Carretera*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Conos</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="33" 
                                                                id="conosok" value="OK">
                                                            <label class="form-check-label" for="conosok">OK</label>

                                                            <input class="form-check-input" type="radio" name="33" 
                                                                id="conosobs" value="Fallo">
                                                            <label class="form-check-label" for="conosobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionconos" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observaciontaco" 
                                                        placeholder="Escriba la observacion" id="36">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Extintor</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="34" 
                                                                id="extintorok" value="OK">
                                                            <label class="form-check-label" for="extintorok">OK</label>

                                                            <input class="form-check-input" type="radio" name="34" 
                                                                id="extintorobs" value="Fallo">
                                                            <label class="form-check-label" for="extintorobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionextintor" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionextintores" 
                                                        placeholder="Escriba la observacion" id="34">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cruceta o llave de copa</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="35" 
                                                                id="crucetaok" value="OK">
                                                            <label class="form-check-label" for="crucetaok">OK</label>

                                                            <input class="form-check-input" type="radio" name="35" 
                                                                id="crucetaobs" value="Fallo">
                                                            <label class="form-check-label" for="crucetaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacioncruceta" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacioncrucetas" 
                                                        placeholder="Escriba la observacion" id="35">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tacos</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="36" 
                                                                id="tacosok" value="OK">
                                                            <label class="form-check-label" for="tacosok">OK</label>

                                                            <input class="form-check-input" type="radio" name="36" 
                                                                id="tacosobs" value="Fallo">
                                                            <label class="form-check-label" for="tacosobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observaciontacos" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observaciontaco" 
                                                        placeholder="Escriba la observacion" id="36">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Señales de carretera</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="37" 
                                                                id="señalesok" value="OK">
                                                            <label class="form-check-label" for="señalesok">OK</label>

                                                            <input class="form-check-input" type="radio" name="37" 
                                                                id="señalesobs" value="Fallo">
                                                            <label class="form-check-label" for="señalesobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionseñales" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionseñale" 
                                                        placeholder="Escriba la observacion" id="37">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Herramienta basica</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="38" 
                                                                id="Herramientaok" value="OK">
                                                            <label class="form-check-label" for="Herramientaok">OK</label>

                                                            <input class="form-check-input" type="radio" name="38" 
                                                                id="Herramientaobs" value="Fallo">
                                                            <label class="form-check-label" for="Herramientaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionherramienta" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionherramientas" 
                                                        placeholder="Escriba la observacion" id="38">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Botiquin</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="39" 
                                                                id="botiquinok" value="OK">
                                                            <label class="form-check-label" for="botiquinok">OK</label>

                                                            <input class="form-check-input" type="radio" name="39" 
                                                                id="botiquinobs" value="Fallo">
                                                            <label class="form-check-label" for="botiquinobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionbotiquin" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionbotiquines" 
                                                        placeholder="Escriba la observacion" id="39">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Linterna</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="40" 
                                                                id="linternaok" value="OK">
                                                            <label class="form-check-label" for="linternaok">OK</label>

                                                            <input class="form-check-input" type="radio" name="40" 
                                                                id="linternaobs" value="Fallo">
                                                            <label class="form-check-label" for="linternaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionlinterna" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionlinternas" 
                                                        placeholder="Escriba la observacion" id="40">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tabla de carroceria-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <strong>Carroceria*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Vidrio frontal, trasero, ventanas</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="21" 
                                                                id="vidriosok" value="OK">
                                                            <label class="form-check-label" for="vidriosok">OK</label>

                                                            <input class="form-check-input" type="radio" name="21" 
                                                                id="vidriosobs" value="Fallo">
                                                            <label class="form-check-label" for="vidriosobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionvidrio" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionvidrios" 
                                                        placeholder="Escriba la observacion" id="21">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cojineria</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="22" 
                                                                id="cojineriaok" value="OK">
                                                            <label class="form-check-label" for="cojineriaok">OK</label>

                                                            <input class="form-check-input" type="radio" name="22" 
                                                                id="cojineriaobs" value="Fallo">
                                                            <label class="form-check-label" for="cojineriaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacioncojineria" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacioncojinerias" 
                                                        placeholder="Escriba la observacion" id="22">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Puertas</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="23" 
                                                                id="puertasok" value="OK">
                                                            <label class="form-check-label" for="puertasok">OK</label>

                                                            <input class="form-check-input" type="radio" name="23" 
                                                                id="puertasobs" value="Fallo">
                                                            <label class="form-check-label" for="puertasobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionpuertas" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionpuerta" 
                                                        placeholder="Escriba la observacion" id="23">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Espejos</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="24" 
                                                                id="espejosok" value="OK">
                                                            <label class="form-check-label" for="espejosok">OK</label>

                                                            <input class="form-check-input" type="radio" name="24" 
                                                                id="espejosobs" value="Fallo">
                                                            <label class="form-check-label" for="espejosobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionespejos" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionespejo" 
                                                        placeholder="Escriba la observacion" id="24">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Plumillas</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="25" 
                                                                id="plumillasok" value="OK">
                                                            <label class="form-check-label" for="plumillasok">OK</label>

                                                            <input class="form-check-input" type="radio" name="25" 
                                                                id="plumillasobs" value="Fallo">
                                                            <label class="form-check-label" for="plumillasobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionplumillas" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionplumilla" 
                                                        placeholder="Escriba la observacion" id="25">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Portaequipaje</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="26" 
                                                                id="portaequipajeok" value="OK">
                                                            <label class="form-check-label" for="portaequipajeok">OK</label>

                                                            <input class="form-check-input" type="radio" name="26" 
                                                                id="portaequipajeobs" value="Fallo">
                                                            <label class="form-check-label" for="portaequipajeobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionportaequipaje" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionportaequipajes" 
                                                        placeholder="Escriba la observacion" id="26">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sin golpes</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="27" 
                                                                id="singolpesok" value="OK">
                                                            <label class="form-check-label" for="singolpesok">OK</label>

                                                            <input class="form-check-input" type="radio" name="27" 
                                                                id="singolpesobs" value="Fallo">
                                                            <label class="form-check-label" for="singolpesobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionsingolpe" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionsingolpes" 
                                                        placeholder="Escriba la observacion" id="27">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Techo</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="28" 
                                                                id="techook" value="OK">
                                                            <label class="form-check-label" for="techook">OK</label>

                                                            <input class="form-check-input" type="radio" name="28" 
                                                                id="techoobs" value="Fallo">
                                                            <label class="form-check-label" for="techoobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observaciontecho" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observaciontechos" 
                                                        placeholder="Escriba la observacion" id="28">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cinturones de seguridad</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="29" 
                                                                id="cinturonesok" value="OK">
                                                            <label class="form-check-label" for="cinturonesok">OK</label>

                                                            <input class="form-check-input" type="radio" name="29" 
                                                                id="cinturonesobs" value="Fallo">
                                                            <label class="form-check-label" for="cinturonesobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacioncinturones" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacioncinturone" 
                                                        placeholder="Escriba la observacion" id="29">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tabla de Sistema electrico y aire acondicionado-->
                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="card">
                                    <strong>Sistema electrico y aire acondicionado*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Baterias/Bornes/cables</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="32" 
                                                                id="bateriaok" value="OK">
                                                            <label class="form-check-label" for="bateriaok">OK</label>

                                                            <input class="form-check-input" type="radio" name="32" 
                                                                id="bateriaobs" value="Fallo">
                                                            <label class="form-check-label" for="bateriaobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionbaterias" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionbateria" 
                                                        placeholder="Escriba la observacion" id="32">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Aire acondicionado/correas</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="33" 
                                                                id="aireaconok" value="OK">
                                                            <label class="form-check-label" for="aireaconok">OK</label>

                                                            <input class="form-check-input" type="radio" name="33" 
                                                                id="aireaconobs" value="Fallo">
                                                            <label class="form-check-label" for="aireaconobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionaireacondicionado" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionaireacondicionados" 
                                                        placeholder="Escriba la observacion" id="33">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Compresor/manguera/poleas</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="34" 
                                                                id="compresorok" value="ok">
                                                            <label class="form-check-label" for="compresorok">OK</label>

                                                            <input class="form-check-input" type="radio" name="34" 
                                                                id="compresorobs" value="Fallo">
                                                            <label class="form-check-label" for="compresorobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacioncompresor" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacioncompresores" 
                                                        placeholder="Escriba la observacion" id="34">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Luces/bombillo/otro</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="35" 
                                                                id="lucesybombillook" value="OK">
                                                            <label class="form-check-label" for="lucesybombillook">OK</label>

                                                            <input class="form-check-input" type="radio" name="35" 
                                                                id="lucesybombilloobs" value="Fallo">
                                                            <label class="form-check-label" for="lucesybombilloobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionlucesybombillos" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionlucesybombillo" 
                                                        placeholder="Escriba la observacion" id="35">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Tabla de Indicadores-->
                            <div class="form-group col-xs-12 col-sm-12">
                                <div class="card">
                                    <strong>Indicadores*</strong>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Odometro, combustible, luces parqueo, check engine, temperatura</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="30" 
                                                                id="medidoresok" value="OK">
                                                            <label class="form-check-label" for="medidoresok">OK</label>

                                                            <input class="form-check-input" type="radio" name="30" 
                                                                id="medidoresobs" value="Fallo">
                                                            <label class="form-check-label" for="medidoresobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionmedidores" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionmedidore" 
                                                        placeholder="Escriba la observacion" id="30">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Otro</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="31" 
                                                                id="otrook" value="OK">
                                                            <label class="form-check-label" for="otrook">OK</label>

                                                            <input class="form-check-input" type="radio" name="31" 
                                                                id="otroobs" value="Fallo">
                                                            <label class="form-check-label" for="otroobs">Observacion</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="observacionotro" style="display:none">
                                                <td colspan="2">
                                                    <input type="text" name="observacionotros" 
                                                        placeholder="Escriba la observacion" id="31">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Fecha de vencimiento botiquin-->
                            <div class="form-group col-xs-6 col-sm-3">
                                <label for="fecha_venci_botiquin"><strong>Fecha vencimiento de Botiquin*</strong></label>
                                <div class="input-group">
                                    <input type="date" name="fecha_venci_botiquin" id="fecha_venci_botiquin" required>
                                </div>
                            </div>
                            <!--Fecha de vencimiento extintor-->
                            <div class="form-group col-xs-6 col-sm-3">
                                <label for="fecha_venci_extintor"><strong>Fecha vencimiento de Extintor*</strong></label>
                                <div class="input-group">
                                    <input type="date" name="fecha_venci_extintor" id="fecha_venci_extintor" required>
                                </div>
                            </div>
                            <!--ultimo engrase-->
                            <div class="form-group col-xs-6 col-sm-3">
                                <label for="fecha_venci_extintor"><strong>Ultimo engrase*</strong></label>
                                <div class="input-group">
                                    <input type="date" name="fecha_venci_extintor" id="fecha_venci_extintor" required>
                                </div>
                            </div>
                            <!--Ultimo lavado-->
                            <div class="form-group col-xs-6 col-sm-3">
                                <label for="fecha_venci_extintor"><strong>Ultimo lavado*</strong></label>
                                <div class="input-group">
                                    <input type="date" name="fecha_venci_extintor" id="fecha_venci_extintor" required>
                                </div>
                            </div>
                            <!--tipo de lavado-->
                            <div class="form-group col-xs-6 col-sm-3">
                                <label for="tipo_lavado"><strong>Tipo de lavado*</strong></label>
                                <select class="form-control select2"  id="tipolavado" name="tipolavado" class="select" multiple="multiple">
                                    <option value="">[Seleccione..]</option>
                                    <option value="AL">Sencillo</option>
                                    <option value="WY">General</option>
                                    <option value="AL">Grafito</option>
                                    <option value="AL">Motor</option>                               
                                </select>
                            </div>

                            <br>
                            <!--boton submit-->
                            <div class="form-group col-xs-6 col-sm-12">
                                <div class="input-group">
                                    <input type="submit" value="Enviar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!--Script lucex externas-->
<script>
    var luzextobs = document.getElementById('lucesextobs');
    var luzextok = document.getElementById('lucesextok')
    var luzextobservacion = document.getElementById('observacionluzexterna')

    function updateStatusExt() {
    if (luzextobs.checked) {
        luzextobservacion.style.display = "";
    } else {
        luzextobservacion.style.display = "none";
    }
    }

    luzextobs.addEventListener('change', updateStatusExt)
    luzextok.addEventListener('change', updateStatusExt)
</script>

<!--Script luces internas-->
<script>
    var luzintobs = document.getElementById('lucesintobs');
    var luzintok = document.getElementById('lucesokint')
    var luzintobservacion = document.getElementById('observacionluzinterna')

    function updateStatusInt() {
    if (luzintobs.checked) {
        luzintobservacion.style.display = "";
    } else {
        luzintobservacion.style.display = "none";
    }
    }

    luzintobs.addEventListener('change', updateStatusInt)
    luzintok.addEventListener('change', updateStatusInt)
</script>

<!--Script llantas vehiculo-->
<script>
    var llantasveobs = document.getElementById('llantasvehiobs');
    var llantasveok = document.getElementById('llantasvehiok')
    var llantasvhiculoobservacion = document.getElementById('observacionllantavehiculo')

    function updateStatusLlantasvehiculo() {
    if (llantasveobs.checked) {
        llantasvhiculoobservacion.style.display = "";
    } else {
        llantasvhiculoobservacion.style.display = "none";
    }
    }

    llantasveobs.addEventListener('change', updateStatusLlantasvehiculo)
    llantasveok.addEventListener('change', updateStatusLlantasvehiculo)
</script>

<!--Script llantas repuesto-->
<script>
    var llantasreobs = document.getElementById('llantasrepuobs');
    var llantasreok = document.getElementById('llantarepuok')
    var llantasrepuestoobservacion = document.getElementById('observacionllantarepuesto')

    function updateStatusLlantasrepuesto() {
    if (llantasreobs.checked) {
        llantasrepuestoobservacion.style.display = "";
    } else {
        llantasrepuestoobservacion.style.display = "none";
    }
    }

    llantasreobs.addEventListener('change', updateStatusLlantasrepuesto)
    llantasreok.addEventListener('change', updateStatusLlantasrepuesto)
</script>

<!--Script Nivel aceite motor-->
<script>
    var nivelaceiobs = document.getElementById('nivelaceobs');
    var nivelaceiok = document.getElementById('nivelaceok')
    var nivelaceiteobservacion = document.getElementById('observacionnivelaceite')

    function updateStatusnivelaceite() {
    if (nivelaceiobs.checked) {
        nivelaceiteobservacion.style.display = "";
    } else {
        nivelaceiteobservacion.style.display = "none";
    }
    }

    nivelaceiok.addEventListener('change', updateStatusnivelaceite)
    nivelaceiobs.addEventListener('change', updateStatusnivelaceite)
</script>

<!--Script Nivel refrigerante-->
<script>
    var nivelrefobs = document.getElementById('nivelrefriobs');
    var nivelrefok = document.getElementById('nivelrefriok')
    var nivelrefrigeranteobservacion = document.getElementById('observacionnivelrefrigerante')

    function updateStatusnivelrefrigerante() {
    if (nivelrefobs.checked) {
        nivelrefrigeranteobservacion.style.display = "";
    } else {
        nivelrefrigeranteobservacion.style.display = "none";
    }
    }

    nivelrefok.addEventListener('change', updateStatusnivelrefrigerante)
    nivelrefobs.addEventListener('change', updateStatusnivelrefrigerante)
</script>

<!--Script Nivel liquido de freno-->
<script>
    var niveliqfrenobs = document.getElementById('nivelliqfrenobs');
    var niveliqfrenok = document.getElementById('nivelliqfrenok')
    var nivelliquidofrenoobservacion = document.getElementById('observacionnivelliquidofreno')

    function updateStatusnivelliquidofreno() {
    if (niveliqfrenobs.checked) {
        nivelliquidofrenoobservacion.style.display = "";
    } else {
        nivelliquidofrenoobservacion.style.display = "none";
    }
    }

    niveliqfrenok.addEventListener('change', updateStatusnivelliquidofreno)
    niveliqfrenobs.addEventListener('change', updateStatusnivelliquidofreno)
</script>

<!--Script Nivel direccion-->
<script>
    var niveldireccobs = document.getElementById('niveldirobs');
    var niveldireccok = document.getElementById('niveldirok')
    var niveldireccionobservacion = document.getElementById('observacionniveldireccion')

    function updateStatusnivelliquidofreno() {
    if (niveldireccobs.checked) {
        niveldireccionobservacion.style.display = "";
    } else {
        niveldireccionobservacion.style.display = "none";
    }
    }

    niveldireccok.addEventListener('change', updateStatusnivelliquidofreno)
    niveldireccobs.addEventListener('change', updateStatusnivelliquidofreno)
</script>

<!--Script correas-->
<script>
    var correasobs = document.getElementById('correasobs');
    var correasok = document.getElementById('correasok')
    var correasobservacion = document.getElementById('observacioncorrea')

    function updateStatuscorreas() {
    if (correasobs.checked) {
        correasobservacion.style.display = "";
    } else {
        correasobservacion.style.display = "none";
    }
    }

    correasok.addEventListener('change', updateStatuscorreas)
    correasobs.addEventListener('change', updateStatuscorreas)
</script>

<!--Script mangueras-->
<script>
    var mangueraobs = document.getElementById('mangueraobs');
    var mangueraok = document.getElementById('mangueraok')
    var manguerasobservacion = document.getElementById('observacionmanguera')

    function updateStatusmangueras() {
    if (mangueraobs.checked) {
        manguerasobservacion.style.display = "";
    } else {
        manguerasobservacion.style.display = "none";
    }
    }

    mangueraok.addEventListener('change', updateStatusmangueras)
    mangueraobs.addEventListener('change', updateStatusmangueras)
</script>

<!--Script sin fuga aceite-->
<script>
    var fugaaceiteobs = document.getElementById('fugaaceiteobs');
    var fugaaceiteok = document.getElementById('fugaaceiteok')
    var fugaaceitesobservacion = document.getElementById('observacionfugaaceite')

    function updateStatusmangueras() {
    if (fugaaceiteobs.checked) {
        fugaaceitesobservacion.style.display = "";
    } else {
        fugaaceitesobservacion.style.display = "none";
    }
    }

    fugaaceiteok.addEventListener('change', updateStatusmangueras)
    fugaaceiteobs.addEventListener('change', updateStatusmangueras)
</script>

<!--Script sin fuga combustible-->
<script>
    var fugacombusobs = document.getElementById('fugacombusobs');
    var fugacombusok = document.getElementById('fugacombusok')
    var fugacombustibleobservacion = document.getElementById('observacionfugaacombustible')

    function updateStatuscombustible() {
    if (fugacombusobs.checked) {
        fugacombustibleobservacion.style.display = "";
    } else {
        fugacombustibleobservacion.style.display = "none";
    }
    }

    fugacombusok.addEventListener('change', updateStatuscombustible)
    fugacombusobs.addEventListener('change', updateStatuscombustible)
</script>

<!--Script sin fuga agua-->
<script>
    var fugaaguaobs = document.getElementById('fugaaguaobs');
    var fugaaguaok = document.getElementById('fugaaguaok')
    var fugaaaguaobservacion = document.getElementById('observacionfugaagua')

    function updateStatusaguas() {
    if (fugaaguaobs.checked) {
        fugaaaguaobservacion.style.display = "";
    } else {
        fugaaaguaobservacion.style.display = "none";
    }
    }

    fugaaguaok.addEventListener('change', updateStatusaguas)
    fugaaguaobs.addEventListener('change', updateStatusaguas)
</script>

<!--Script funcionamiento frenos-->
<script>
    var funfrenosobs = document.getElementById('funfrenosobs');
    var funfrenosok = document.getElementById('funfrenosok')
    var funfrenosobservacion = document.getElementById('observacionfunfrenos')

    function updateStatusfunfrenos() {
    if (funfrenosobs.checked) {
        funfrenosobservacion.style.display = "";
    } else {
        funfrenosobservacion.style.display = "none";
    }
    }

    funfrenosok.addEventListener('change', updateStatusfunfrenos)
    funfrenosobs.addEventListener('change', updateStatusfunfrenos)
</script>

<!--Script freno emergencia-->
<script>
    var frenoemergenciaobs = document.getElementById('frenoemergenciaobs');
    var frenoemergenciaok = document.getElementById('frenoemergenciaok')
    var frenoemergenciaobservacion = document.getElementById('observacionfrenoemergencia')

    function updateStatusfrenoemergencia() {
    if (frenoemergenciaobs.checked) {
        frenoemergenciaobservacion.style.display = "";
    } else {
        frenoemergenciaobservacion.style.display = "none";
    }
    }

    frenoemergenciaok.addEventListener('change', updateStatusfrenoemergencia)
    frenoemergenciaobs.addEventListener('change', updateStatusfrenoemergencia)
</script>

<!--Script Direccion-->
<script>
    var direccionobs = document.getElementById('direccionobs');
    var direccionok = document.getElementById('direccionok')
    var observaciondireccion = document.getElementById('observaciondireccion')

    function updateStatusdireccion() {
    if (direccionobs.checked) {
        observaciondireccion.style.display = "";
    } else {
        observaciondireccion.style.display = "none";
    }
    }

    direccionok.addEventListener('change', updateStatusdireccion)
    direccionobs.addEventListener('change', updateStatusdireccion)
</script>

<!--Script Suspension-->
<script>
    var suspensionobs = document.getElementById('suspensionobs');
    var suspensionok = document.getElementById('suspensionok')
    var observacionsuspension = document.getElementById('observacionsuspension')

    function updateStatussuspension() {
    if (suspensionobs.checked) {
        observacionsuspension.style.display = "";
    } else {
        observacionsuspension.style.display = "none";
    }
    }

    suspensionok.addEventListener('change', updateStatussuspension)
    suspensionobs.addEventListener('change', updateStatussuspension)
</script>

<!--Script clutch-->
<script>
    var cluctchobs = document.getElementById('cluctchobs');
    var cluctchok = document.getElementById('cluctchok')
    var observacioncluctch = document.getElementById('observacioncluctch')

    function updateStatusclutch() {
    if (cluctchobs.checked) {
        observacioncluctch.style.display = "";
    } else {
        observacioncluctch.style.display = "none";
    }
    }

    cluctchok.addEventListener('change', updateStatusclutch)
    cluctchobs.addEventListener('change', updateStatusclutch)
</script>

<!--Script Transmision-->
<script>
    var transmisionobs = document.getElementById('transmisionobs');
    var transmisionok = document.getElementById('transmisionok')
    var observaciontransmision = document.getElementById('observaciontransmision')

    function updateStatustransmision() {
    if (transmisionobs.checked) {
        observaciontransmision.style.display = "";
    } else {
        observaciontransmision.style.display = "none";
    }
    }

    transmisionok.addEventListener('change', updateStatustransmision)
    transmisionobs.addEventListener('change', updateStatustransmision)
</script>

<!--Script muelles-->
<script>
    var muellesobs = document.getElementById('muellesobs');
    var muellesok = document.getElementById('muellesok')
    var observacionmuelle = document.getElementById('observacionmuelle')

    function updateStatusmuelles() {
    if (muellesobs.checked) {
        observacionmuelle.style.display = "";
    } else {
        observacionmuelle.style.display = "none";
    }
    }

    muellesok.addEventListener('change', updateStatusmuelles)
    muellesobs.addEventListener('change', updateStatusmuelles)
</script>

<!--Script Vidirios-->
<script>
    var vidriosobs = document.getElementById('vidriosobs');
    var vidriosok = document.getElementById('vidriosok')
    var observacionvidrio = document.getElementById('observacionvidrio')

    function updateStatusvidrios() {
    if (vidriosobs.checked) {
        observacionvidrio.style.display = "";
    } else {
        observacionvidrio.style.display = "none";
    }
    }

    vidriosok.addEventListener('change', updateStatusvidrios)
    vidriosobs.addEventListener('change', updateStatusvidrios)
</script>

<!--Script Cojineria-->
<script>
    var cojineriaobs = document.getElementById('cojineriaobs');
    var cojineriaok = document.getElementById('cojineriaok')
    var observacioncojineria = document.getElementById('observacioncojineria')

    function updateStatuscojineria() {
    if (cojineriaobs.checked) {
        observacioncojineria.style.display = "";
    } else {
        observacioncojineria.style.display = "none";
    }
    }

    cojineriaok.addEventListener('change', updateStatuscojineria)
    cojineriaobs.addEventListener('change', updateStatuscojineria)
</script>

<!--Script Puertas-->
<script>
    var puertasobs = document.getElementById('puertasobs');
    var puertasok = document.getElementById('puertasok')
    var observacionpuertas = document.getElementById('observacionpuertas')

    function updateStatuspuertas() {
    if (puertasobs.checked) {
        observacionpuertas.style.display = "";
    } else {
        observacionpuertas.style.display = "none";
    }
    }

    puertasok.addEventListener('change', updateStatuspuertas)
    puertasobs.addEventListener('change', updateStatuspuertas)
</script>

<!--Script Espejos-->
<script>
    var espejosobs = document.getElementById('espejosobs');
    var espejosok = document.getElementById('espejosok')
    var observacionespejos = document.getElementById('observacionespejos')

    function updateStatusespejos() {
    if (espejosobs.checked) {
        observacionespejos.style.display = "";
    } else {
        observacionespejos.style.display = "none";
    }
    }

    espejosok.addEventListener('change', updateStatusespejos)
    espejosobs.addEventListener('change', updateStatusespejos)
</script>

<!--Script Plumillas-->
<script>
    var plumillasobs = document.getElementById('plumillasobs');
    var plumillasok = document.getElementById('plumillasok')
    var observacionplumillas = document.getElementById('observacionplumillas')

    function updateStatusplumillas() {
    if (plumillasobs.checked) {
        observacionplumillas.style.display = "";
    } else {
        observacionplumillas.style.display = "none";
    }
    }

    plumillasok.addEventListener('change', updateStatusplumillas)
    plumillasobs.addEventListener('change', updateStatusplumillas)
</script>

<!--Script Portaequipaje-->
<script>
    var portaequipajeobs = document.getElementById('portaequipajeobs');
    var portaequipajeok = document.getElementById('portaequipajeok')
    var observacionportaequipaje = document.getElementById('observacionportaequipaje')

    function updateStatusportaequipaje() {
    if (portaequipajeobs.checked) {
        observacionportaequipaje.style.display = "";
    } else {
        observacionportaequipaje.style.display = "none";
    }
    }

    portaequipajeok.addEventListener('change', updateStatusportaequipaje)
    portaequipajeobs.addEventListener('change', updateStatusportaequipaje)
</script>

<!--Script Singolpes-->
<script>
    var singolpesobs = document.getElementById('singolpesobs');
    var singolpesok = document.getElementById('singolpesok')
    var observacionsingolpe = document.getElementById('observacionsingolpe')

    function updateStatussingolpe() {
    if (singolpesobs.checked) {
        observacionsingolpe.style.display = "";
    } else {
        observacionsingolpe.style.display = "none";
    }
    }

    singolpesok.addEventListener('change', updateStatussingolpe)
    singolpesobs.addEventListener('change', updateStatussingolpe)
</script>

<!--Script Techo-->
<script>
    var techoobs = document.getElementById('techoobs');
    var techook = document.getElementById('techook')
    var observaciontecho = document.getElementById('observaciontecho')

    function updateStatustecho() {
    if (techoobs.checked) {
        observaciontecho.style.display = "";
    } else {
        observaciontecho.style.display = "none";
    }
    }

    techook.addEventListener('change', updateStatustecho)
    techoobs.addEventListener('change', updateStatustecho)
</script>

<!--Script Cinturones de seguridad-->
<script>
    var cinturonesobs = document.getElementById('cinturonesobs');
    var cinturonesok = document.getElementById('cinturonesok')
    var observacioncinturones = document.getElementById('observacioncinturones')

    function updateStatuscinturon() {
    if (cinturonesobs.checked) {
        observacioncinturones.style.display = "";
    } else {
        observacioncinturones.style.display = "none";
    }
    }

    cinturonesok.addEventListener('change', updateStatuscinturon)
    cinturonesobs.addEventListener('change', updateStatuscinturon)
</script>

<!--Script Medidores-->
<script>
    var medidoresobs = document.getElementById('medidoresobs');
    var medidoresok = document.getElementById('medidoresok')
    var observacionmedidores = document.getElementById('observacionmedidores')

    function updateStatusmedidores() {
    if (medidoresobs.checked) {
        observacionmedidores.style.display = "";
    } else {
        observacionmedidores.style.display = "none";
    }
    }

    medidoresok.addEventListener('change', updateStatusmedidores)
    medidoresobs.addEventListener('change', updateStatusmedidores)
</script>

<!--Script Otro-->
<script>
    var otroobs = document.getElementById('otroobs');
    var otrook = document.getElementById('otrook')
    var observacionotro = document.getElementById('observacionotro')

    function updateStatusotro() {
    if (otroobs.checked) {
        observacionotro.style.display = "";
    } else {
        observacionotro.style.display = "none";
    }
    }

    otrook.addEventListener('change', updateStatusotro)
    otroobs.addEventListener('change', updateStatusotro)
</script>

 <!--Script Bateria-->
 <script>
    var bateriaobs = document.getElementById('bateriaobs');
    var bateriaok = document.getElementById('bateriaok')
    var observacionbaterias = document.getElementById('observacionbaterias')

    function updateStatusbateria() {
    if (bateriaobs.checked) {
        observacionbaterias.style.display = "";
    } else {
        observacionbaterias.style.display = "none";
    }
    }

    bateriaok.addEventListener('change', updateStatusbateria)
    bateriaobs.addEventListener('change', updateStatusbateria)
</script>

<!--Script Aire acondicionado-->
<script>
    var aireaconobs = document.getElementById('aireaconobs');
    var aireaconok = document.getElementById('aireaconok')
    var observacionaireacondicionado = document.getElementById('observacionaireacondicionado')

    function updateStatusaireacondicionado() {
    if (aireaconobs.checked) {
        observacionaireacondicionado.style.display = "";
    } else {
        observacionaireacondicionado.style.display = "none";
    }
    }

    aireaconok.addEventListener('change', updateStatusaireacondicionado)
    aireaconobs.addEventListener('change', updateStatusaireacondicionado)
</script>

<!--Script Compresor-->
<script>
    var compresorobs = document.getElementById('compresorobs');
    var compresorok = document.getElementById('compresorok')
    var observacioncompresor = document.getElementById('observacioncompresor')

    function updateStatusotro() {
    if (compresorobs.checked) {
        observacioncompresor.style.display = "";
    } else {
        observacioncompresor.style.display = "none";
    }
    }

    compresorok.addEventListener('change', updateStatusotro)
    compresorobs.addEventListener('change', updateStatusotro)
</script>

<!--Script luces y bombillos-->
<script>
    var lucesybombilloobs = document.getElementById('lucesybombilloobs');
    var lucesybombillook = document.getElementById('lucesybombillook')
    var observacionlucesybombillos = document.getElementById('observacionlucesybombillos')

    function updateStatuslucesybombillos() {
    if (lucesybombilloobs.checked) {
        observacionlucesybombillos.style.display = "";
    } else {
        observacionlucesybombillos.style.display = "none";
    }
    }

    lucesybombillook.addEventListener('change', updateStatuslucesybombillos)
    lucesybombilloobs.addEventListener('change', updateStatuslucesybombillos)
</script>

<!--Script Conos-->
<script>
    var conosobs = document.getElementById('conosobs');
    var conosok = document.getElementById('conosok')
    var observacionconos = document.getElementById('observacionconos')

    function updateStatusconos() {
    if (conosobs.checked) {
        observacionconos.style.display = "";
    } else {
        observacionconos.style.display = "none";
    }
    }

    conosok.addEventListener('change', updateStatusconos)
    conosobs.addEventListener('change', updateStatusconos)
</script>

<!--Script Extintor-->
<script>
    var extintorobs = document.getElementById('extintorobs');
    var extintorok = document.getElementById('extintorok')
    var observacionextintor = document.getElementById('observacionextintor')

    function updateStatusextintor() {
    if (extintorobs.checked) {
        observacionextintor.style.display = "";
    } else {
        observacionextintor.style.display = "none";
    }
    }

    extintorok.addEventListener('change', updateStatusextintor)
    extintorobs.addEventListener('change', updateStatusextintor)
</script>

<!--Script Cruceta-->
<script>
    var crucetaobs = document.getElementById('crucetaobs');
    var crucetaok = document.getElementById('crucetaok')
    var observacioncruceta = document.getElementById('observacioncruceta')

    function updateStatuscruceta() {
    if (crucetaobs.checked) {
        observacioncruceta.style.display = "";
    } else {
        observacioncruceta.style.display = "none";
    }
    }

    crucetaok.addEventListener('change', updateStatuscruceta)
    crucetaobs.addEventListener('change', updateStatuscruceta)
</script>

<!--Script Cruceta-->
<script>
    var crucetaobs = document.getElementById('crucetaobs');
    var crucetaok = document.getElementById('crucetaok')
    var observacioncruceta = document.getElementById('observacioncruceta')

    function updateStatuscruceta() {
    if (crucetaobs.checked) {
        observacioncruceta.style.display = "";
    } else {
        observacioncruceta.style.display = "none";
    }
    }

    crucetaok.addEventListener('change', updateStatuscruceta)
    crucetaobs.addEventListener('change', updateStatuscruceta)
</script>

<!--Script Tacos-->
<script>
    var tacosobs = document.getElementById('tacosobs');
    var tacosok = document.getElementById('tacosok')
    var observaciontacos = document.getElementById('observaciontacos')

    function updateStatustacos() {
    if (tacosobs.checked) {
        observaciontacos.style.display = "";
    } else {
        observaciontacos.style.display = "none";
    }
    }

    tacosok.addEventListener('change', updateStatustacos)
    tacosobs.addEventListener('change', updateStatustacos)
</script>

<!--Script Señales de transito-->
<script>
    var señalesobs = document.getElementById('señalesobs');
    var señalesok = document.getElementById('señalesok')
    var observacionseñales = document.getElementById('observacionseñales')

    function updateStatusseñales() {
    if (señalesobs.checked) {
        observacionseñales.style.display = "";
    } else {
        observacionseñales.style.display = "none";
    }
    }

    señalesok.addEventListener('change', updateStatusseñales)
    señalesobs.addEventListener('change', updateStatusseñales)
</script>

<!--Script Herramientas basica-->
<script>
    var Herramientaobs = document.getElementById('Herramientaobs');
    var Herramientaok = document.getElementById('Herramientaok')
    var observacionherramienta = document.getElementById('observacionherramienta')

    function updateStatusherramientas() {
    if (Herramientaobs.checked) {
        observacionherramienta.style.display = "";
    } else {
        observacionherramienta.style.display = "none";
    }
    }

    Herramientaok.addEventListener('change', updateStatusherramientas)
    Herramientaobs.addEventListener('change', updateStatusherramientas)
</script>

<!--Script Botiquin-->
<script>
    var botiquinobs = document.getElementById('botiquinobs');
    var botiquinok = document.getElementById('botiquinok')
    var observacionbotiquin = document.getElementById('observacionbotiquin')

    function updateStatusbotiquin() {
    if (botiquinobs.checked) {
        observacionbotiquin.style.display = "";
    } else {
        observacionbotiquin.style.display = "none";
    }
    }

    botiquinok.addEventListener('change', updateStatusbotiquin)
    botiquinobs.addEventListener('change', updateStatusbotiquin)
</script>

<!--Script Linterna-->
<script>
    var linternaobs = document.getElementById('linternaobs');
    var linternaok = document.getElementById('linternaok')
    var observacionlinterna = document.getElementById('observacionlinterna')

    function updateStatuslinterna() {
    if (linternaobs.checked) {
        observacionlinterna.style.display = "";
    } else {
        observacionlinterna.style.display = "none";
    }
    }

    linternaok.addEventListener('change', updateStatuslinterna)
    linternaobs.addEventListener('change', updateStatuslinterna)
</script>