<?php

/**
 * Description of Factura
 *
 * Concepto servicio de transporte TRANFER - Código 1002
 * Concepto servicio de transporte DISPONIBILIDAD - Código 1003
 * Fecha de vencimiento luego de expedida 30DIAS
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class Factura extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        //parent::__construct('L','mm','Letter');
        $this->SetTitle('Factura');
    }

    //370x132
    function Body($data) {

//        $h = $data["header"];
        $o = $data["orden"];

        $this->SetFont('Arial', 'B', 10);

        $this->Cell(80, 35, $this->Image('global/img/logo.png', $this->GetX(), $this->GetY(), 80, 35), 0, 1, 'C');

        //$this->Cell(232, 54, $this->Image(Doo::conf()->APP_URL.'global/img/logo.png', $this->GetX(),$this->GetY()),1,1,'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(140, 5, utf8_decode(C_RAZON_SOCIAL), 0, 0, 'L');
        $this->Cell(56, 5, utf8_decode('FACTURA DE VENTA'), 0, 1, 'C');
        $this->Cell(140, 5, utf8_decode("NIT ".C_NIT_DIGITO), 0, 0, 'L');
        $this->Cell(56, 5, utf8_decode('No.MS '.$o["num_fact"]), 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(140, 5, utf8_decode(C_DIR_C), 0, 0, 'L');
        $this->SetFillColor(142, 142, 142);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(28, 5, utf8_decode('Expedida'), 0, 0, 'C', true);
        $this->Cell(28, 5, utf8_decode('Vence'), 0, 1, 'C', true);
        $this->SetFont('Arial', '', 10);
        $this->Cell(140, 5, utf8_decode("Teléfono: ".C_TEL), 0, 0, 'L');
        $this->Cell(28, 5, $o["expedida"], 0, 0, 'C');
        $this->Cell(28, 5, $o["vence"], 0, 1, 'C');
        $this->Cell(196, 5, utf8_decode(C_EMAIL3), 0, 1, 'L');
        //$this->Cell(196, 5, utf8_decode($h["header"]." ".$o["contrato"]." ".$o["numero"]),"LRB",1,'C');  

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 6, utf8_decode("Cliente:"), "LTB", 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(106, 6, utf8_decode($o["cliente"]), "TRB", 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 6, "NIT:", "TB", 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, $o["identificacion"], "TRB", 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 6, utf8_decode("Dirección:"), "LTB", 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(106, 6, $o["direccion"], "TRB", 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 6, "Tel:", "TB", 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, $o["celular"], "TRB", 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 6, utf8_decode("Ciudad:"), "LTB", 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(106, 6, utf8_decode($o["ciudad"]), "TRB", 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 6, "", "TB", 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 6, "", "TRB", 1, 'L');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('Código'), 1, 0, 'L', true);
        $this->Cell(80, 5, utf8_decode('Descripción'), 1, 0, 'C', true);
        $this->Cell(13, 5, utf8_decode('IVA'), 1, 0, 'L', true);
        $this->Cell(13, 5, utf8_decode('Cant'), 1, 0, 'L', true);
        $this->Cell(35, 5, utf8_decode('Valor Unitario'), 1, 0, 'L', true);
        $this->Cell(35, 5, utf8_decode('Valor Total'), 1, 1, 'L', true);

        $x = $this->GetX();
        $y = $this->GetY();
        $this->Rect($x, $y, 0, 156, 'D');
        $this->Rect($x + 196, $y, 0, 156, 'D');
        //$pdf->Rect(0, 0, 210, 100, 'D');
        
/*
 * Funcional 100% comentado por pruebas
 */
//        $codigo = $o["tipo"] === "T" ? "1002" : "1003";
//        $concepto = $o["tipo"] === "T" ? "Servicio de transporte TRANSFER" : "Servicio de Transporte DISPONIBILIDAD";
//
//        $cant = 1;
//        $valor = $cant * $o["valor"] + $o["valor_paradas"];
//        $iva = 0;
//        $viva = $valor * $iva;
//        $valor_total = $valor + $viva;
//
//
//        $this->SetFont('Arial', '', 10);
//        $this->Cell(20, 5, $codigo, 0, 0, 'L');
//        $this->Cell(80, 5, utf8_decode($concepto), 0, 0, 'C');
//        $this->Cell(13, 5, $iva . "%", 0, 0, 'R');
//        $this->Cell(13, 5, $cant, 0, 0, 'R');
//        $this->Cell(35, 5, "$" . number_format($valor, 2, '.', ','), 0, 0, 'R');
//        $this->Cell(35, 5, "$" . number_format($valor_total, 2, '.', ','), 0, 1, 'R');
//
//        $this->SetY(227);
//        $this->SetFont('Arial', 'B', 10);
//        $this->Cell(116, 5, " Sub Total", 1, 0, 'R');
//        $this->Cell(80, 5, "$" . number_format($valor, 2, '.', ','), 1, 1, 'R');
//        $this->Cell(116, 5, "Total Factura", 1, 0, 'R');
//        $this->Cell(80, 5, "$" . number_format($valor_total, 2, '.', ','), 1, 1, 'R');
//        $this->SetFont('Arial', '', 10);
//        Doo::loadClass("ConvertirNumero");
//        $cn = new ConvertirNumero();
//        $this->Cell(196, 5, "Son : " . $cn->convertir($valor_total) . " PESOS M/L", "T", 1, 'L');
//        $this->Cell(196, 5, $concepto, "", 0, 'L');
        /*
         * 
         */
        
        /*
         * Bloque en validación, precio base, descuento de precio base, y precio de paradas se muestra por separado.
         */
        
        foreach ($data["items"] as $i){
            $codigo = $o["tipo"] === "T" ? "1002" : "1003";
            $concepto = $o["tipo"] === "T" ? "Servicio de transporte TRANSFER" : "Servicio de Transporte DISPONIBILIDAD";

//            $cant = 1;
//            $valor = $cant * $o["valor"] + $o["valor_paradas"];
//            $iva = 0;
//            $viva = $valor * $iva;
//            $valor_total = $valor + $viva;
            
            $cant = 1;
            $valor = $cant * $i["precio"] ;
            $iva = 0;
            $viva = $valor * $iva;
            $valor_total = $valor + $viva; //+ $i["valor_desc"] + $o["valor_paradas"]


            $this->SetFont('Arial', '', 10);
            $this->Cell(20, 5, $codigo, 0, 0, 'L');
            $this->Cell(80, 5, utf8_decode($concepto), 0, 0, 'L');
            $this->Cell(13, 5, $iva . "%", 0, 0, 'R');
            $this->Cell(13, 5, $cant, 0, 0, 'R');
            $this->Cell(35, 5, "$" . number_format($valor, 2, '.', ','), 0, 0, 'R');
            $this->Cell(35, 5, "$" . number_format($valor_total, 2, '.', ','), 0, 1, 'R');
            
//            $this->SetFont('Arial', '', 10);
//            $this->Cell(20, 5, $codigo, 0, 0, 'L');
//            $this->Cell(80, 5, utf8_decode("Descuento ".$i["porc_desc"]), 0, 0, 'L');
//            $this->Cell(13, 5, $iva . "%", 0, 0, 'R');
//            $this->Cell(13, 5, $cant, 0, 0, 'R');
//            $this->Cell(35, 5, "$" . number_format($i["valor_desc"], 2, '.', ','), 0, 0, 'R');
//            $this->Cell(35, 5, "$" . number_format($i["valor_desc"], 2, '.', ','), 0, 1, 'R');
            
            if($o["valor_paradas"] > 0){
                $this->SetFont('Arial', '', 10);
                $this->Cell(20, 5, "", 0, 0, 'L');
                $this->Cell(80, 5, utf8_decode("Sobretasa por parada "), 0, 0, 'L');
                $this->Cell(13, 5, $iva . "%", 0, 0, 'R');
                $this->Cell(13, 5, $cant, 0, 0, 'R');
                $this->Cell(35, 5, "$" . number_format($o["valor_paradas"], 2, '.', ','), 0, 0, 'R');
                $this->Cell(35, 5, "$" . number_format($o["valor_paradas"], 2, '.', ','), 0, 1, 'R');
            }
        }        
        
        /*
         *  Fin de bloque en validación
         */

        $this->SetY(222);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(116, 5, " Sub Total", 1, 0, 'R');
        $subtotal = $valor_total + $o["valor_paradas"];
        $valor_total = $valor =  $valor + $i["valor_desc"] + $o["valor_paradas"];
        $this->Cell(80, 5, "$" . number_format($subtotal, 2, '.', ','), 1, 1, 'R');
        
        $this->Cell(116, 5, "Descuento", 1, 0, 'R');
        $this->Cell(80, 5, "$" . number_format($i["valor_desc"], 2, '.', ','), 1, 1, 'R');
                
        $this->Cell(116, 5, "Total Factura", 1, 0, 'R');
        $this->Cell(80, 5, "$" . number_format($valor_total, 2, '.', ','), 1, 1, 'R');
        $this->SetFont('Arial', '', 10);
        Doo::loadClass("ConvertirNumero");
        $cn = new ConvertirNumero();
        $this->Cell(196, 5, "Son : " . $cn->convertir($valor_total) . " PESOS M/L", "T", 1, 'L');
        $this->Cell(196, 5, $concepto, "", 0, 'L');
    }

    function Footer() {
        $this->SetY(-30);
        $this->SetFont('Arial', '', 10);
        $this->Cell(196, 5, utf8_decode('RESOLUCIÓN DIAN 60000096188 DE 2015-11-19 Tipo 02 factura por computador'), "LTR", 1, 'L');
        $this->Cell(196, 5, utf8_decode(C_RAANGO), "LR", 1, 'L');
        $this->Cell(196, 5, utf8_decode(C_CUENTA), "LR", 1, 'L');
        $this->Cell(196, 5, utf8_decode(''), "LR", 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(98, 5, utf8_decode('Firma y Sello del Cliente:  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _'), "LB", 0, 'L');
        $this->Cell(98, 5, utf8_decode('Fecha Recibido:  _ _ _ _ _ _ _ _ _ _'), "LBR", 1, 'L');
    }

}
