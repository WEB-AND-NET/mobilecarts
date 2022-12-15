<!DOCTYPE html>
<?php
$data = $data["fuec"];
$h = $data["header"];
$o = $data["orden"];
$lc = $data["conductores"];
$oc = $data["ordenesCondu"];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Verificar FUEC -  <?= C_TITLE; ?></title>
        <meta name="viewport" content="width=device-width"/>
    </head>

    <body topmargin="0" leftmargin="0" rightmargin="0" style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:13px; color:rgba(51,51,51,1)">

        <div style="height:40px; background: #00a65a; width:100%; text-align:center; 
                    line-height:40PX; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:rgba(255,255,255,1); font-size:18px; text-shadow:rgba(255,255,255,1) 0PX 0PX 2PX">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="left" style="padding-left:13px"></td>
                    <td align="center"><?= C_TITLE_MAYUS; ?> - FUEC</td>
                    <td align="right" style="padding-right:5px">
                    </td>
                </tr>
            </table>

        </div>

        <CENTER>

            <img src="../img/lookj021.png" />

            <DIV style=" width: auto; padding:10PX; background:rgba(204,204,204,0.5)">

                <DIV style="background: rgba(255,255,204,0.5); border: rgba(204,204,204,1) solid 1px; border-radius:1px; 
                    padding:3px; color:rgba(0,0,0,1)">
                    <b style="font-size:16px">VERIFICACION ONLINE "FUEC"</b><br />
                    <!--FECHA EXPEDICION-->
                    <span style=" font-weight:bold; color: rgba(51,51,51,1)"> EXPEDIDO el:<br />
                        <?= $o["expedido"]; ?>      
                    </span>

                    <div style="font-size:16px; font-weight:bold">#
                        <span title="Direccion Territorial"><?= $h["territorial"]; ?></span>
                        <span title="Res. Habilitación Empresa"><?= $h["resolucion_hab"]; ?></span>
                        <span title="Año Habilitación"><?= $h["ano_hab"]; ?></span>
                        <span title="Año que se Expide el Extracto">
                            <?= $h["ano_actual"]; ?>        
                        </span>
                        <span title="Numero Consecutivo Extracto Contrato" >
                            <?= $o["contrato"]; ?>         <input type="hidden" value="<?= $o["contrato"]; ?> " id="plla_" />
                        </span>
                        <span title="Numero Contrato" style="color: rgba(255,0,0,1)">
                            <?= $o["numero"]; ?>         
                        </span>
                        
                    </div>
                </DIV>


                <DIV style="background:rgba(255,255,255,1); border: rgba(204,204,204,1) solid 1px; border-radius:0px 0px 5px 5px; padding:3px"><table width="100%">
                        <tr>
                            <td><b>RAZON SOCIAL:</b><BR />
                                <span style="color: rgba(0,51,204,1)"><?= C_RAZON_SOCIAL; ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td><b>NIT:</b><br />
                                <span style="color: rgba(0,51,204,1)"><?= C_NIT; ?><br /><br /></td>
                        </tr>
                        <tr>
                            <td><b>CONTRATO:</b> 
                                <?= $o["contrato"]; ?>        
                            </td>
                        </tr>
                        <tr>
                            <td><b>Contratante:</b><BR />
                                <?= utf8_decode($o["cliente"]); ?><br />
                                <B>Nit:</B><br />
                                <?= $o["identificacion"]; ?>        
                            </td>
                        </tr>
                        <tr>
                            <td><b>Objeto Contrato:</b><br />
                               <?= utf8_decode($o["objetoc"]); ?>        </td>
                        </tr>
                        <TR height="8PX"></TR>
                        <tr>
                            <td><b>RECORRIDO:</b><br />
                                <?= utf8_decode($o["recorrido"]) ; ?>        
                            </td>
                        </tr>
                        <TR height="8PX"></TR>
                        <tr>
                            <td>
                                <b>CONSORCIO / U.TEMP CON:</b><br />

                            </td>
                        </tr>
                        <TR height="8PX"></TR>
                        <tr>
                            <td><b>VIGENCIA CONTRATO:</b><br />
                                <b>Inicia:</b> &nbsp;&nbsp;&nbsp;  <?= $o["inicial"]; ?>  <BR />
                                <b>Termina:</b>  <?= $o["final"]; ?>       </td>
                        </tr>
                    </table>
                </DIV>
                <br />  
                <DIV style="background:rgba(255,255,255,1); border: rgba(204,204,204,1) solid 1px; border-radius:5px; padding:3px">
                    <table width="100%">
                        <tr>
                            <td><b>CARACTERISTICA VEHICULO:</b><br />
                                <b>Placa:</b> &nbsp;&nbsp; <?= $o["placa"]; ?><BR />
                                <b>Modelo:</b> <?= $o["modelo"]; ?><br />
                                <b>Marca:</b> &nbsp;&nbsp;<?= $o["marca"]; ?><BR />
                                <b>Clase:</b> &nbsp;&nbsp;&nbsp;<?= $o["clase"]; ?><br />
                                <b>No. Interno:</b>
                                <b><font color='#0033CC'><?= $o["num_interno"]; ?></font><br />
                                <b>Tjta Operación:</b> 
                                <b><font color='#0033CC'><?= $o["tg_operacion"]; ?></font>        
                            </td>
                        </tr>
                    </table>
                </DIV>
                <br />  
                <DIV style="background:rgba(255,255,255,1); border: rgba(204,204,204,1) solid 1px; border-radius:5px; padding:3px">
                    <table width="100%">
                        <tr>
                            <td><b>CONDUCTORES:</b><br />
                                <br />
                                <?php
                                $i = 1;
                                foreach ($lc as $c) {
                                ?>
                                    <b>Conductor <?= $i; ?>:</b><br />
                                    <?= utf8_decode($c["nombre"]); ?><br />
                                    <b>No. Cédula:</b> &nbsp; <?= utf8_decode($c["identificacion"]); ?><br />
                                    <b>No.Licencia:</b>&nbsp;&nbsp;<?= utf8_decode($c["n_licencia"]); ?><br />
                                    <b>Vigencia:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= utf8_decode($c["vigencia"]); ?><br /><br />                                                                          
                                <?php
                                $i++;
                                }
                                ?> 
                                    <?php
                                foreach ($oc as $cn) {
                                ?>
                                    <b>Conductor <?= $i; ?>:</b><br />
                                    <?= utf8_decode($cn["nombre"]); ?><br />
                                    <b>No. Cédula:</b> &nbsp; <?= utf8_decode($cn["identificacion"]); ?><br />
                                    <b>No.Licencia:</b>&nbsp;&nbsp;<?= utf8_decode($cn["n_licencia"]); ?><br />
                                    <b>Vigencia:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= utf8_decode($cn["vigencia"]); ?><br /><br />                                                                          
                                <?php
                                $i++;
                                }
                                ?>  
                            </td>
                        </tr>
                    </table>
                </DIV>
                <br />   
                <DIV style="background:rgba(255,255,255,1); border: rgba(204,204,204,1) solid 1px; border-radius:5px; padding:3px">    
                    <table width="100%">
                        <tr>
                            <td><b>RESPONSABLE CONTRATO:</b><br />
                                
                                <?php 
                                switch ($o["tipo_cliente"]){
                                    case "N":
                                ?>
                                        <b>Nombre:</b><br />
                                        <?= utf8_decode($o["cliente"]); ?><BR />
                                        <b>Cedula:</b> &nbsp;&nbsp; <?= $o["identificacion"]; ?><br />
                                        <b>Celular:</b> <?= $o["celular"]; ?><br />
                                        <b>Dir:</b> <?= utf8_decode($o["direccion"]); ?>  
                                <?php 
                                    break;
                                    case "J":
                                ?>
                                        <b>Nombre:</b><br />
                                        <?= utf8_decode($o["c_nombre"]); ?><BR />
                                        <b>Cedula:</b> &nbsp;&nbsp; <?= $o["c_identificacion"]; ?><br />
                                        <b>Celular:</b> <?= $o["c_telefono"]; ?><br />
                                        <b>Dir:</b> <?= utf8_decode($o["c_direccion"]); ?>   
                                <?php 
                                    break;
                                    case "P":
                                ?>
                                        <b>Nombre:</b><br />
                                        <?= utf8_decode($o["r_nombre"]); ?><BR />
                                        <b>Cedula:</b> &nbsp;&nbsp; <?= $o["r_identificacion"]; ?><br />
                                        <b>Celular:</b> <?= $o["r_celular"]; ?><br />
                                        <b>Dir:</b> <?= utf8_decode($o["r_direccion"]); ?>   
                                <?php 
                                    break;
                                    default :
                                ?>
                                <?php 
                                    break;
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </DIV>
                <br /> 
                <DIV style="background:rgba(255,255,255,1); border: rgba(204,204,204,1) solid 1px; border-radius:5px; padding:3px">    <table width="100%">
                        <tr>
                            <td>
                                <B>EMPRESA:</B><BR /> 
                                <?= C_RAZON_SOCIAL; ?>, <?= C_DIR; ?> <br>Tels <?= C_TELS; ?> <br>Email: <?= C_EMAIL1; ?>         </td>
                        </tr>
                        <TR height="8PX"></TR>
                    </table>
                </DIV>
                <br />
                <img src="../img/trasmovil_png.png" width="180">
                <br />
                Copyright &copy; 2016 <a href="http://webandnet.us">Web And Net S.A.S.</a>&nbsp;All rights reserved.
            </DIV>
        </CENTER>
    </body>
</html>
