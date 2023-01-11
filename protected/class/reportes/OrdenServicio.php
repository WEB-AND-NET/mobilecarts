..<?php

/**
 * Description of OrdenServicio
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class OrdenServicio extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        //parent::__construct('L','mm','Letter');
        $this->SetTitle('Orden de Servicio');
    }

    //370x132
    function Body($data) {

        $head = $data["header"];
        $o = $data["orden"];
        $lc = $data["conductores"];
        $oc = $data["ordenesCondu"];
        $pasajeros = $data["pasajeros"];

        //$this->Image('global/img/logo.png', 20 ,10,65 , 27,'PNG');

        $this->SetFont('Arial', 'B', 10);
        //232X54
        $this->SetY(5);
        $this->SetX(5);
        $this->Image('global/img/mintransporte.png', $this->GetX()+20, $this->GetY()+7.5, 80, 20);
        $this->Image('global/img/logo.png', $this->GetX()+100, $this->GetY(), 80, 35);
        $this->Image('global/docs/planillas/qrcodes/QR_' . $o["id"] . '.png', $this->GetX()+180, $this->GetY()+20, 20, 19);

         $this->ln(35);
        //$this->Cell(232, 54, $this->Image(Doo::conf()->APP_URL.'global/img/logo.png', $this->GetX(),$this->GetY()),1,1,'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(196, 5, (' FORMATO ÚNICO DEL EXTRACTO DE CONTRATO DEL SERVICIO PÚBLICO'), 0, 1, 'C');
        $this->Cell(196, 5, ("DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL"), 0, 1, 'C');
        $this->Cell(196, 5, ("EXPEDIDO el " . $o["expedido"]), "LR", 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(196, 5, ($head["header"] . " " . $o["contrato"] . " " . str_pad(substr($o["numero"],-4), 4, "0", STR_PAD_LEFT)), 0, 1, 'C');
        $this->ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(160, 6, "RAZÓN SOCIAL DE LA EMPRESA DE TRANPORTE ESPECIAL:  ".(C_RAZON_SOCIAL), 0, 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 6, "NIT:", 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, C_NIT, 0, 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 6, ("CONTRATO No:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(166, 6, $o["contrato"], 0, 1, 'L');
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 6, ("CONTRATANTE:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(166, 6, $o["cliente"], 0, 1, 'L');
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 6, "NIT:", 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, $o["identificacion"], 0, 1, 'L');
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(38, 6, ("OBJETO CONTRATO:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(166, 6, $o["objetoc"], 0, 1, 'L');
        
        if($pasajeros){
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(24, 6, ("PASAJEROS:"), 0, 0, 'L');
            $pasaje="";
            $this->SetFont('Arial', '', 9);
            foreach ($pasajeros as $pasajero) {
                $pasaje.="(".$pasajero["nombre"] . " - " . $pasajero["cedula"] . ") ";
            }
            $this->Multicell(0, 5, utf8_decode($pasaje), 0, "L");
        }
        
        //$this->multicell(161, 6, ($pasaje), 0, 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, ("ORIGEN-DESTINO:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        //$this->Cell(161, 6, ($o["barrio_o"] . " - " . $o["barrio_d"]), 0, 1, 'L');


        //$this->SetFont('Arial', '', 9);

        //$this->MultiCell(196, 6, ($o["recorrido"] ), 1, 'C', 0);
       if($o["tipo"] !== "T" && $o["tipo"] !== "V"){
           $this->Cell(161, 6, ($o["recorrido"]),0,1,'L');
       }else{
           $this->MultiCell(161, 6, ($o["barrio_o"] . " - " . $o["barrio_d"]).", ".($o["recorrido"]), 0, "L");
            //$this->Cell(161, 6, ($o["barrio_o"] . " - " . $o["barrio_d"]).", ".($o["recorrido"]), 0, 1, 'L');
        }        

        if($o["convenio"])
        {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(70, 6, ("CONVENIO/CONSORCIO/U.TEMPORAL:"), 0, 0, 'L');
            $this->SetFont('Arial', '', 10);
            $this->Cell(126, 6, ($o["convenio"]), 0, 1, 'L');
        }
        if($o["observacion"])
        {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(30, 6, ("OBSERVACIÓN:"), 0, 0, 'L');
            $this->SetFont('Arial', '', 10);
            $this->Cell(126, 6, ($o["observacion"]), 0, 1, 'L');
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(196, 6, ("VIGENCIA DEL CONTRATO"), 0, 1, 'C');
        $this->Cell(66,10, "FECHA INICIAL", 1, 0, 'C');
        $this->SetFont('Arial', '', 8);
        
        $this->SetWidths(array(43.3, 43.3, 43.3));
        $this->SetAligns(array('C', 'C', 'C'));

        $this->Row(array(("DÍA\n" . $o["ini_d"]), ("MES\n" . $o["ini_m"]), ("AÑO\n" . $o["ini_a"])));

        $this->SetFont('Arial', 'B', 9);
        $this->Cell(66, 10, "FECHA VENCIMIENTO", 1, 0, 'C');
        $this->SetFont('Arial', '', 9);
       
        $this->SetWidths(array(43.3, 43.3, 43.3));
        $this->SetAligns(array('C', 'C', 'C'));

        $this->Row(array(("DÍA\n" . $o["fin_d"]), ("MES\n" . $o["fin_m"]), ("AÑO\n" . $o["fin_a"])));

        //**************************************************************
        //VEHICULO
        //**************************************************************

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(196, 6, ("CARACTERÍSTICAS DEL VEHÍCULO"), 0, 1, 'C');
        $this->Cell(49, 6, "PLACA", 1, 0, 'C');
        $this->Cell(49, 6, "MODELO", 1, 0, 'C');
        $this->Cell(49, 6, "MARCA", 1, 0, 'C');
        $this->Cell(49, 6, "CLASE", 1, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(49, 6, ($o["placa"]), 1, 0, 'C');
        $this->Cell(49, 6, ($o["modelo"]), 1, 0, 'C');
        $this->Cell(49, 6, ($o["marca"]), 1, 0, 'C');
        $this->Cell(49, 6, ($o["clase"]), 1, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(98, 6, ("NÚMERO INTERNO"), 1, 0, 'C');
        $this->Cell(98, 6, ("NÚMERO TARJETA DE OPERACIÓN"), 1, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(98, 6, ($o["num_interno"]), 1, 0, 'C');
        $this->Cell(98, 6, ($o["tg_operacion"]), 1, 1, 'C');

        //**************************************************************
        //CONDUCTORES
        //**************************************************************
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, "", 1, 0, 'C');
        $this->Cell(50, 6, "Nombres y Apellidos", 1, 0, 'C');
        $this->Cell(28, 6, ("No. Cédula"), 1, 0, 'C');
        $this->Cell(33, 6, "No. Licencia", 1, 0, 'C');
        $this->Cell(60, 6, "Vigencia", 1, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $i = 1;


        foreach ($lc as $c) {            
            $this->SetWidths(array(25, 50, 28, 33, 60));
            $this->SetAligns(array('C', 'C', 'C', 'C', 'C'));

            $this->Row(array("Conductor $i", ($c["nombre"]." ".$c["apellidos"]), ($c["identificacion"]), ($c["n_licencia"]), ($c["vigencia"])));
            $i++;
        }


        foreach ($oc as $d) {            
            $this->SetWidths(array(25, 50, 28, 33, 60));
            $this->SetAligns(array('C', 'C', 'C', 'C', 'C'));

            $this->Row(array("Conductor $i", ($d["nombre"]." ".$d["apellidos"]), ($d["identificacion"]), ($d["n_licencia"]), ($d["vigencia"])));
            $i++;
        }
        
        //if($pasajeros){
            //$this->SetFont('Arial', 'B', 10);
            //$this->Cell(196, 6, ("PASAJEROS"), 0, 1, 'C');
            
            //$this->Cell(25, 6, "", 1, 0, 'C');
            //$this->Cell(100, 6, "Nombres y Apellidos", 1, 0, 'C');
            //$this->Cell(71, 6, ("No. Cédula"), 1, 1, 'C');
            //$this->SetFont('Arial', '', 10);
            //$i = 1;
            //foreach ($pasajeros as $pasajero) {
                //$this->Cell(25, 6, "Pasajero ".$i, 1, 0, 'C');
                //$this->Cell(100, 6, $pasajero["nombre"], 1, 0, 'C');
                //$this->Cell(71, 6, $pasajero["cedula"], 1, 1, 'C');
                //$i++;
                
           //}
        //}
        

        //**************************************************************
        //RESPONSABLE
        //**************************************************************
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, "", 1, 0, 'C');
        $this->Cell(50, 6, "Nombres y Apellidos", 1, 0, 'C');
        $this->Cell(28, 6, ("No. Cédula"), 1, 0, 'C');
        $this->Cell(33, 6, ("Celular"), 1, 0, 'C');
        $this->Cell(60, 6, ("Dirección"), 1, 1, 'C');
        $this->SetFont('Arial', '', 10);
               
        switch ($o["tipo_cliente"]){
            case "N":               
                $this->SetWidths(array(25, 50, 28, 33, 60));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C'));

                $this->Row(array("Responsable contratante", ($o["cliente"]), $o["identificacion"], $o["celular"], ($o["direccion"])));
                break;
            case "J":                
                $this->SetWidths(array(25, 50, 28, 33, 60));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C'));

                $this->Row(array("Responsable contratante", ($o["c_nombre"]), $o["c_identificacion"], $o["c_telefono"], ($o["c_direccion"])));
                break;
            case "P";                
                $this->SetWidths(array(25, 50, 28, 33, 60));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C'));

                $this->Row(array("Responsable contratante", ($o["r_nombre"]), $o["r_identificacion"], $o["r_celular"], ($o["r_direccion"])));
                break;
            default :
                break;
        }

        $this->ln(0);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(196, 6, "FORMATO UNICO EXTRACTO DE CONTRATO", 1, 1, 'C');
        $this->Ln(0);
        $this->SetFont('Arial', 'B', 9);
                
        $this->SetWidths(array(98, 98));
        $this->SetAligns(array('C', 'C'));
        $this->Row(array(("\n".C_RAZON_SOCIAL."\n ".C_DIR_T." \n Tels ".C_TELS." \n Email: ".C_EMAIL1." \n\n"),  "\n\n\n\n\n\nFirma Digital Ley 527 del 199, decreto 2364 de 2012"));
        $this->Image('global/img/firma.jpg', $this->GetX() + 98 + 12, $this->GetY() - 35, 65, 25);
            
        $this->SetFont('Arial', '', 8);
        $this->Cell(28, 6, ("Verificación Online :"), "LB", 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(168, 6, $data["url"], "BR", 1, 'L', false, $data["url"]);
        
        $this->setMargins(8, 8, 8);
        $this->AddPage();

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(196, 20, (' INSTRUCTIVO PARA LA DETERMINACIÓN DEL NÚMERO CONSECUTIVO DEL FUEC '), 0, 1, 'C');
        $this->ln(0);
        $this->SetFont('Arial', '', 11);
        $this->MultiCell(0, 5, "El contrato Único de Extracto del Contrato 'FUEC' estará constituido por los siguientes números: ", 0, "L");
        $this->ln(8);
        $this->SetXY(14, 40);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 5, "a)  Los tres primeros dígitos de izquierda a derecha corresponderán al código de la Dirección Territorial que otorgo la habilitación o de aquella a la cual se hubiese trasladado la empresa de Servicio Público de Transporte Terrestre Automotor Especial;", 0,"FJ");

        $this->SetXY(25, 60);
        $this->SetFillColor(232, 232, 232);
        $this->SetFont('Arial', '', 10);
        $this->Cell(58,8,"Antioquia - Chocó",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"305",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Huila - Caquetá",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"441",1,1,"C",true);
        $this->SetXY(25, 68);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Atlántico",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"208",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Magdalena",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"247",1,1,"C",true);
        $this->SetXY(25, 76);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Bolívar - San Andrés y Providencia",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"213",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Meta - Vaupés - Vichada",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"550",1,1,"C",true);
        $this->SetXY(25, 84);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Boyacá - Casanare",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"415",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Nariño - Putumayo",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"352",1,1,"C",true);
        $this->SetXY(25, 92);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Caldas",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"317",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"N/Santander - Arauca",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"454",1,1,"C",true);
        $this->SetXY(25, 100);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Cauca",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"319",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Quindío",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"363",1,1,"C",true);
        $this->SetXY(25, 108);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Cesar",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"220",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Risaralda",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"366",1,1,"C",true);
        $this->SetXY(25, 116);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Córdoba - Sucre",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"223",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Santander",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"468",1,1,"C",true);
        $this->SetXY(25, 124);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Cundinamarca",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"425",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Tolima",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"473",1,1,"C",true);
        $this->SetXY(25, 132);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Guajira",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"241",1,0,"C",true);
        $this->SetFillColor(232, 232, 232);
        $this->Cell(58,8,"Valle del Cauca",1,0,"L",true);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(20,8,"376",1,1,"C",true);

        $this->SetXY(15, 150);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 4, "b)  Los cuatro dígitos siguientes señarán el número de resolución mediante la cual se otorgó la habilitación de la Empresa. En caso que la resolución no tenga estos dígitos, los faltantes serán completados con ceros a la izquierda;", 0,"J");
        
        $this->SetXY(15, 165);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 4, "c)  Los dos siguientes dígitos, corresponderán a los dos últimos del año en que la empresa fue habilitada;", 0,"J");

        $this->SetXY(15, 175);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 4, "d)  A continuación, cuatro dígitos que corresponderán al año en el que se expide el extracto del contrato;", 0,"FJ");

        $this->SetXY(15, 185);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 4, "e)  Posteriormente, cuatro dígitos que identifican el número del contrato. La numeración debe ser consecutiva, establecida por cada empresa y continuará con la numeración dada a los contratos de prestación del servicio celebrados para el transporte de estudiantes, empleados, turistas, ususarios del serivicio de salud y grupos específicos de usuarios, en viencia de la Resolución 3068 de 2014.", 0,"J");

        $this->SetXY(15, 205);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 4, "f)  Finalmente, los cuatros últimos dígitos corresponderán al número consecutivo del extracto de contrato que se expida para la ejecución de cada contrato. Se debe expedir un nuevo extracto por vencimiento del plazo inicial del mismo o por cambio del vehículo.", 0,"FJ");

        $this->SetXY(15, 230);
        $this->SetFont('Arial', 'B', 12);
        $this->Multicell(0, 4, "EJEMPLO", 0,"L");

        $this->SetXY(15, 240);
        $this->SetFont('Arial', '', 10);
        $this->Multicell(0, 4, "Empresa habilitada por la Dirección Territorial Cundinamarca en el año 2012, con resolución de habilitación No. 0155, que expide el primer extracto del contrato en el año 2015, del contrato 255. El número del Formato Único de Extracto del Contrato (FUEC) será: 425015512201502550001.", 0,"L");

        if($o["tipo"] == "T"){
            /*
            $this->AddPage();
        
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(196, 5, ("ANEXO"), "LTR", 1, 'C');
            $this->SetFont('Arial', '', 10);
            $this->Cell(196, 5, ($head["header"] . " " . $o["contrato"] . " " . $o["numero"]), "LBR", 1, 'C');
            $t_fuec = '"FUEC"'; 
            //$txt_anexo  = "ANEXO\n\n";
            $txt_anexo  = "\n";
            if($data["aplica_anexo"] == "S"){
                $txt_anexo .= $data["anexo"];
            }else{
                $txt_anexo .= "SEGÚN RESOLUCION 1069 DEL 23 DE ABRIL DEL 2015\n\n";
                $txt_anexo .= "ARTICULO 9. DESCRIPCION DE RECORRIDOS EN EL $t_fuec. SI EN VIRTUD DEL CONTRATO DE SERVICIOS DE TRANSPORTE ESPECIAL, EL VEHICULO DEBE REALIZAR VARIOS DESPLAZAMIENTOS, EL $t_fuec PUEDE CONTENER UN ANEXO QUE DESCRIBA LOS RECORRIDOS DE LOS SERVICIOS CONTRATADOS.";
                $txt_anexo .= "EN EL EVENTO QUE EXISTAN DOS (2) O MAS VIAS PARA EFECTUAR EL DESPLAZAMIENTO, EN EL $t_fuec SE DEBEN INDICARLAS VIAS A UTILIZAR, SEÑALANDO EL ORIGEN, PUNTOS INTERMEDIOS Y EL DESTINO, CASO EN EL CUAL EL VEHICULO PUEDE TRANSITAR POR CUALQUIERA DE ELLAS.\n\n";
                $txt_anexo .= "RECORRIDOS:\n\n\n";
                $txt_anexo .= "ZONA INDUSTRIAL DE MAMONAL, VARIANTE MAMONAL GAMBOTE, TRONCAL DE OCCIDENTE(CALLE 31) POR LOS BARRIOS: LA PRINCESA, BEIRUT 1, SAN FERNANDO, ALAMEDA LA VICTORIA,EL RECREO, LA CONCEPCION,SANTA MONICA, LA PLAZUELA, PROVIDENCIA, SANTA LUCIA, SAN PEDRO, CENTRO COMERCIAL RONDA REAL, CARRETERA LA CORDIALIDAD(TRANSV 53), BOMBA EL AMPARO, LOS ALPES, AV PEDRO DE HEREDIA, LA CASTELLANA, CHIPRE, SAN ANTONIO, LAS GAVIOTAS, CHIQUINQUIRA, VILLA OLIMPICA, OLAYA (CAMINO DEL MEDIO), ARMENIA, AMBERES, ALCIBIA, BAZURTO, LO AMADOR, ESPINAL, TORICES, CHAMBACU, CENTRO( CRA 11, CRA 2, CALLE 39, PLAYA DE LA ARTILLERIA, CALLE 33), AVENIDA SANTANDER, BOCAGRANDE (CRA 1ª, CRA 2ª, CRA 3ª, CRA 4ª, CALLE 4, CALLE 5, CALLE 6, CALLE 7, CALLE 8, CALLE 9, CALLE 10, CALLE 11, CALLE 12, CALLE 13, CALLE 14), LAGUITO (CRA 1ª, DIAGONAL 1), CASTILLOGRANDE (CRA 6,  CRA 7, CRA 8, CRA 9, CRA 10, CRA 11, CRA 12, CRA 13, CRA14,  CALLE 5A, CALLE 6)Y VICEVERSA.\n\n";
                $txt_anexo .= "ZONA INDUSTRIAL DE MAMONAL,TRONCAL DE OCCIDENTE, DIAGONAL 32, TERNERA, EL EDEN CALLE 1ª, EL RECREO (CRA 80A, CRA 80B, CRA 80C, DIAGONAL 31b,  DIAGONAL 31c, DIAGONAL 31d, DIAGONAL 31e, DIAGONAL 31f, DIAGONAL 31h), BARU, LA CONCEPCION, PROVIDENCIA(CRA 71ª, DIAG 34 ), LOS CEREZOS ( TRANSV 52,  DIAG 33), CHAPACUA (TRANSV 71, 71b), LOS ALPES ( TRANSV 71a,TRANSV 71b, TRANSV 71c,  TRANSV 71d), RICAURTE, ESTELA, 13 DE JUNIO (TRANSV 69ª,TRANSV 69b, CALLE 31h, CRA 64, CALLE 31h), GAVIOTAS (TRANSV 60,TRANSV 66,TRANSV 68,TRANSV 69ª,TRANSV 70, TRANSV 70b, CRA 60, CRA 61, DIAG 31e), AV PEDRO ROMERO( CALLE 30, 31D, CALLE 32),CHIQUINQUIRA (CRA 58, CRA 59, CALLE 31b, CALLE 31c),OLAYA (CRA 27ª, CRA 28, OLAYA CRA 29ª, CRA 30, CRA 31, CRA 32, CRA 32ª, CRA 33, CRA 34, CRA 35, CRA 35ª, CRA 36, CRA 36ª, CRA 37, CRA 38, CRA 39, CRA 40, CRA 40ª, CRA 41, CRA 42, CRA 43, CRA 44, CRA 44ª,  CRA 44b, CRA 44c, CRA 44d, CRA 45, CRA 46, CRA 47, CRA 48, CRA 48ª, CRA 48c, CRaA49, CRA 49ª, CRA 49b, CRA 49c, CRA 50, CRA 50ª, CRA 50b, CRA 51, CRA 52, CRA 53, CRA 54, CRA 55, CRA 56, CALLE 31b, CALLE 31c, CALLE 32, CALLE 33, CALLE 34, CALLE 35, CALLE 36, CALLE 37, CALLE 38,  VIA PERIMETRAL), BOSTON, LIBANO, LA MARIA,PARAISO, SAN FRANCISCO CALLE 76,SANTA MARIA, DANIEL LEMAITRE (CALLE 61, CALLE 62, CALLE 63, CALLE 64, CALLE 65, CALLE 67, CALLE 68, CALLE 69, CALLE 70, CRA 13, CALLE 14, CALLE 15, CALLE 16, CALLE 17),  CANAPOTE (CALLE 60, CALLE 61),   TORICES (CRA 11,CRA14,CRA15,CRA16,CRA17,CRA18, CALLE 35, CALLE36, CALLE 39, CALLE 41, CALLE 42, CALLE 43, CALLE 44, CALLE 45, CALLE 46, CALLE 47, CALLE 48, CALLE 49, CALLE 50, CALLE 51, CALLE 52, CALLE 53, CALLE 54, CALLE 55, CALLE 56), CRESPO (CRA 1, CRA 2, CRA 3, CRA 4, CRA 5, CRA 6, CRA 7, CRA 8 CALLE 62, CALLE 63, CALLE 64, CALLE 65, CALLE 66, CALLE 67, CALLE 68, CALLE 69, CALLE 70, CALLE70ª, CALLE 71 AEROPUERTO RAFAEL NUÑEZ), ANILLO VIAL(CARRETERA NACIONAL 90ª), LA BOQUILLA(VIAS INTERNAS, PLAYAS), VIA BARRANQUILLA, VIA MANZANILLO, PONTEZUELA, BAYUNCA Y VICEVERSA.\n\n";
                $txt_anexo .= "ZONA INDUSTRIAL DE MAMONAL, CORREDOR DE CARGA,BELLA VISTA(CALLE 7ª, CRA 57,  CRA 58), EL LIBERTADOR , 20 DE JULIO ( CRA 58ª, CALLE 7ª, CALLE 7C, CALLE 8 ), NUEVO CAMPESTRE (DIAG 28, CALLE 10B, CALLE 11, CALLE 11B, CALLE 12, CRA 56D), EL CAMPESTRE ( CALLE 12, CALLE 14, CALLE15, CALLE 16, CALLE 17, CRA 57D), VISTA HERMOSA ( CRA 57E ,CRA 58, CRA 60, DIAG 29, DIAG 29ª, DIAG 30, DIAG 30ª, CALLE 13B, CALLE 14), SAN PEDRO MARTIR ( CALLE 14, CRA 65ª, CRA66ª, CRA 67, CRA 68ª),  LA VICTORIA (CRA 69, CRA 70), EL CARMELO ( CALLE14, CALLE 14ª, CALLE 15, CALLE 17, CALLE 18, CALLE 19, CRA 61, CRA 61B, CRA62,  CRA 63, CRA 64, CRA 66, CRA 66ª,  CRA 67, CRA 68, CRA 68B, CRA 69, CRA 70, CRA 71,  ),  LOS JARDINES ( CRA 71, CRA 72, CRA 73, CALLE 5, CALLE 7, CALLE 8ª, CALLE 9, CALLE 10, CALE 10B, CALLE 10C, CALLE 10D, CALLE 11, CALLE12, CALLE 13, CALLE 13B, CALLE 14), LA CONSOLATA (CRA 74, CRA 75, CRA 76, CRA 77, CALLE 5, CALLE 6, CALLE 9, CALLE 10, CALLE 11, CALLE 12, CALLE 13, CALLE 14, CALLE 15), VILLA RUBIA ( CARRERA 78B, CARRERA 80B1, CARRERA 80B2), SAN FERNANDO ( CRA 80ª, CRA 80B,  CRA 80C, CRA 80E, CARRERA 80F, CARRERA 81, CARRERA 81ª, CARRERA 81B,CARRERA 81C, CRA 82, CRA 82ª, CRA 82B, CRA 83), SIMON BOLIVAR( CARA 100,CALLE 22ª, CALLE 22B), CALLE 31, ALAMEDA LA VICTORIA(CRA 80, CRA 80ª, CALLE 20, CALLE 22, CALLE22A, CALLE 22B, CALLE 22C), SOCORRO(CRA71, CRA 72, CRA 73, CRA 74, CRA 75, CRA 76, CRA 77, CRA 78, CRA 79, CALLE 21, CALLE 22), BLAS DE LEZO( CRA 66, CRA 66ª, CRA 67,CRA 67ª, CRA 67B, CRA 68, CRA 69, CRA 70, CALLE 21, CALLE 21ª, CALLE22, CALLE 22ª,CALLE 22B, CALLE 23, CALLE 24, CALLE 25, CALLE26, CALLE 26ª, CALLE 27, CALLE 27ª, CALLE 28, CALLE 29, CALLE 29ª, CALLE 30, CALLE 30ª), LA CENTRAL (TRANSV 61, CRA 62, CRA 62ª, CRA 63), LOS CARACOLES ( TRANSV 54, TRANSV 61, TRANSV 62ª, CALLE 21, CALLE 22ª, CALLE 22B), ALMIRANTE COLON (TRANSV 54, CRA 57), CALLE 14, DIAG 30, LOS CORALES(DIAG 31ª, DIAG 31B),  SANTA CLARA ( CALLES INTERNAS), CEBALLOS ( DIAG 27, DIAG 27C, DIAG 28, DIAG 28ª, DIAG, 29, DIAG 29ª, DIAG 29B, DIAG29C, DIAG 29D, DIAG 30), TRANSV 54, ALTO BOSQUE (DIAG 21ª, DIAG 21B, DIAG 21C, DIAG 21D, TRANSV 48, TRANSV 48ª, TRANSV 48B, TRANSV 48C, TRANSV 49, TRANSV 50, TRANSV 51, TRANSV 51ª, TRANSV 51B, TRANSV 52, TRANSV 52ª, TRANSV 52B), TRANSV 45, BOSQUE ( DIAG 20, DIAG 21, DIAG 21ª, DIAG 22, TRANSV 35, TRANSV 36, TRANSV 40, TRANSV 41, TRANSV 42, TRANSV 43, TRANSV 44, TRANSV 44ª, TRANSV 44B, TRANSV 44C, TRANSV 44D, TRANSV 45, TRANSV 45ª, TRTANSV 47ª, TRANSV 48, TRANSV 49, TRANSV 51, TRANSV 52), MARTINEZ MARTELO ( CRA 19, CRA 19ª, CRA 20, DIAG 19ª, DIAG 20, DIAG 21, DIAG 29B, TRANSV 22, TRANSV 23, TRANSV 24, TRANSV 25, TRANSV 26, TRANSV 27, TRANSV 28, TRANSV 29, TRANSV 30, TRANSV 31, TRANSV 33, TRANSV 35, TRANSV 37, TRANSV 37ª), BAZURTO, AV PEDRO DE HEREDIA, BARRIO CHINO (CRA 22, CRA 22ª, CRA 22C, CRA 22D, CRA 23, CRA 24, CRA 25, CRA 25ª, CRA 25B, CRA 25C), PIE DE LA POPA ( CRA 19B , CRA 20, CRA 20ª, CRA 21 , CRA 21ª , CARRERA 21B, CRA 22 , CALLE 29B, CALLE 29C, CALLE 29D , CALLE 29E, CALLE 30), MANGA ( TRANSV 17, CRA 17, CRA 17ª, CRA 18, CRA 18ª, CRA 19, CRA 19ª, CRA 20, CRA 21, CRA 22, CRA 23, CRA 24, CRA 24ª, CRA 25, CRA 26, CALLE 24, CALLE 25, CALLE 26, CALLE 27, CALLE 28, CALLE 29, CALLE 29ª) Y VICEVERSA.\n\n";
                $txt_anexo .= "LAGUITO ( CRA 1ª, DIAG 1), CASTILLOGRANDE ( CRA 6, CRA 7, CRA 8, CRA 9, CRA 10, CRA 11, CRA 12, CRA 13, CRA 14, CALLE 5, CALLE 5ª, CALLE 6), BOCAGRANDE ( CALLE 4, CALLE 5, CALLE 6, CALLE 7, CALLE 8, CALLE 9, CALLE 10, CALLE 11, CALLE 12, CALLE 13, CALLE 14, CALLE 15, CRA 1, CRA 2, CRA 3, CRA 4, CRA 5), CENTRO (AV BLAS DE LEZO, AV VENEZUELA, AV SANTANDER, CALLE 31, CALLE 32, CALLE 33, CALLE 34, CALLE 35, CALLE 36, CALLE 37), SAN DIEGO ( CALLE 38, CALLE 39), CALLE 41, CRA 11, GETSEMANI ( CALLE 24, CALLE 25, CALLE 26, CALLE 27, CALLE 28, CALLE 29, CALLE 30, CALLE 31), PUENTE ROMAN, MANGA (( TRANSV 17, CRA 17, CRA 17ª, CRA 18, CRA 18ª, CRA 19, CRA 19ª, CRA 20, CRA 21, CRA 22, CRA 23, CRA 24, CRA 24ª, CRA 25, CRA 26, CALLE 24, CALLE 25, CALLE 26, CALLE 27, CALLE 28, CALLE 29, CALLE 29ª), BOSQUE ( CALLE 29, TRANSV 27B, DIAG 21), EL PRADO ( CRA 29ª, CRA 29B, TRANSV 31, TRANSV 32, TRANSV 32ª, TRANSV 33, TRANSV 33ª, TRANSV 34, TRANSV 35),   BRUSELAS ( TRANSV 37, TRANSV 38, TRANSV 39, TRANSV 40, TRANSV 42, DIAG 22, DIAG 23, DIAG 24, DIAG 25, DIAG 26, DIAG 26ª),   JUAN XXIII ( TRANSV 42, TRANSV 44, TRANSV 44ª, TRANSV 44C, DIAG 22, DIAG 23, DIAG 24, DIAG 25, DIAG 26, DIAG 26ª, DIAG 26B, DIAG 26C),      PARAGUAY (TRANSV 44C, TRANSV 45ª, DIAG 22, DIAG 23, DIAG 24, DIAG 24ª, DIAG 24B, DIAG 26, DIAG 26ª, DIAG 26B),  AMBERES (CALLE 28, CALLE 29, CALLE 30, AV PEDRO DE HEREDIA, CRA 38, CRA 39, CRA 40, CRA 41, CRA 42, CRA 44),  BARRIO ESPAÑA (CALLE 29, CALLE 30, CALLE 30ª, CALLE 30B,      AV PEDRO DE HEREDIA, CRA 44, CRA 44B, CRA 44C, CRA 44D, CRA 45, CRA 46),        PIEDRA DE BOLIVAR (DIAG 26C, CRA 49B, CRA 49C, CRA 49F),       JUNIN ( CRA44C, CRA 44D, CRA 45, CRA 45ª, CALLE 26C),     CHILE (DIAG 22, DIAG 22ª, DIAG 26ª, TRANSV 47, TRANSV 47D),    LOS CERROS (TRANSV 47, TRANSV 52, DIAG 22, 22ª, 22B), NUEVO BOSQUE  (TRANSV 46, TRANSV 48, TRANSV 48ª,  TRANSV 49, TRANSV 50, TRANSV 51, TRANSV 52, TRANSV 53, TRANSV 54, DIAG 25, DIAG 26, DIAG 26ª, DIAG 27, DIAG 27B, DIAG 28, DIAG 29, DIAG 29ª, DIAG 29B, DIAG 29E, DIAG 30),  ZARAGOCILLA (CALLE 22,  CALLE 23, CALLE 24, CALLE 25, CALLE 26, CALLE 27, CALLE 28, CALLE 30),  EL CAIRO (TRANSV 50, TRANSV 50ª, TRANSV 50B, TRANSV 50C),   LOS EJECUTIVOS (CRA 57ª, CRA 59, CALLE 30, CALLE 30C, CALLE 32),   LOS CALAMARES ( CARA 55, CRA 56, CRA 57, CRA 58, CALLE 25, CALLE 26, CALLE 27, CALLE 29),  LA CAMPIÑA ( TRANSV 47, TRANSV 48, TRANSV 48ª, TRANSV 49, CALLE 20, CALLE 22, CALLE 23ª, CALLE 23,CRA 55, DIAG 30), EL COUNTRY ( DIAG 44, DIAG 45, DIAG 46, DIAG 47, DIAG 48, DIAG 49, DIAG 62, TRANSV 47, TRANSV 48, TRANSV 50, TRANSV 51, TRANSV 53),   LA TRONCAL ( TRANSV 48, TRANSV 49, TRANSV 51, TRANSV 54, DIAG 44, DIAG 45, DIAG 46),   TACARIGUA ( CALLE 30, TRANSV 47, TRANSV 48, TRANSV 50, TRANSV 51, TRANSV 53, TRANSV 54, DIAG 45, DIAG 46, DIAG 47, DIAG 48, DIAG 49, DIAG 62),   LAS DELICIAS ( DIAG 63ª, DIAG 64, DIAG 65, DIAG 66, CALLE 30, TRANSV 50, TRANSV 54),   SAN PEDRO ( CALLE 30, CALLE 31, TRANSV 54, CAR 71),   STA MONICA ( CRA 71, CAR 78, CALLE 28),   LA PLAZUELA ( CRA 78, CRA 79, CRA 80, CALLE 26, 27, 28, 30, 30ª, 31),   CARRETERA DE LA CORDIALIDAD , VILLA ESTRELLA ( 90ª, 91, 91ª, 92, 93, 94, CARRETERA DE LA CORDIALIDAD, CALLE 33, CALLE 34, CALLE 35, CALLE 36, CALLE 37, CALLE 38, CALLE 39, CALLE 40, CALLE 41),  EL POZON ( CRA 82ª, CRA 83ª, CRA 84, CRA 85, CRA 86, CRA 87, CRA 88, CRA 88ª, CRA 88B, CRA 89, CRA 91, CRA 91ª, CRA 92, TRANSV 54, TRANSV 55, TRANSV 56, TRANSV 57, TRANSV 58, TRANSV 59, TRANSV 60, TRANSV 61, TRANSV 62, TRANSV 63, TRANSV 64, TRANSV 65, TRANSV 66, TRANSV 67, TRANSV 67ª, TRANSV 68, TRANSV 69, TRANSV 69ª, TRANSV 69B, TRANSV 70, TRANSV 71, TRANSV 71ª, TRANSV 72, TRANSV 72ª, TRANSV 72B, TRANSV 73, TRANSV 73ª, TRANSV 74, TRANSV 74ª, TRANSV 74B, TRANSV 75, TRANSV 75ª, TRANSV 75B, TRANSV 76, TRANSV 77),   URB PORTAL DE LA CORDIALIDAD,  URB FLOR DEL CAMPO,  URB COLOMBIATON Y VICEVERSA.";
            }      
            //$this->MultiCell(196, 5, ($txt_anexo), 1, 'J');
            */
        }
              
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}
