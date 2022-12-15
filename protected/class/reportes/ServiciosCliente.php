<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ServiciosCliente extends FPDF {

    public function __construct() {
        parent::__construct('L', 'mm', 'a3');
        $this->SetTitle('Servicios Cliente');
    }

    function Body($cliente,$servicios,$fi,$ff) {

        $this->SetFont('Arial', 'B', 10);

//        $this->Cell(80, 35, $this->Image('global/img/logo.png', $this->GetX(), $this->GetY(), 80, 35), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(66, 5, utf8_decode(C_RAZON_SOCIAL), 0, 0, 'L');
        $this->Cell(335, 5, utf8_decode('SERVICIOS DE CLIENTE'), 0, 1, 'R');
        $this->Cell(66, 5, utf8_decode("NIT ".C_NIT_DIGITO), 0, 0, 'L');
        $this->Cell(335, 5, utf8_decode($cliente["nombre"]), 0, 1, 'R');
        $this->Cell(66, 5, "", 0, 0, 'L');
        $this->Cell(335, 5,utf8_decode("IDENTIFICACIÓN ").$cliente["identificacion"], 0, 1, 'R');
        $this->Cell(66, 5, "", 0, 0, 'L');
        $this->Cell(335, 5, "CONTRATO ".$cliente["numero"], 0, 1, 'R');
        $this->Cell(66, 5, "", 0, 0, 'L');
        $this->Cell(335, 5, "DE $fi A $ff", 0, 1, 'R');

        $this->Ln(10);
        $valor = $sobretasa = $total = 0;
        if(count($servicios) < 1){
            $this->Cell(196, 5, utf8_decode("No hay servicios realizados."), 0, 1, 'C');
        }else{      
                
            $this->Cell(30, 5, utf8_decode('FECHA'), 1, 0, 'C');
            $this->Cell(30, 5, utf8_decode('NO. FACTURA'), 1, 0, 'C');
            $this->Cell(50, 5, utf8_decode('ORIGEN'), 1, 0, 'C');
            $this->Cell(50, 5, utf8_decode('DESTINO'), 1, 0, 'C');
            $this->Cell(25, 5, utf8_decode('VALOR'), 1, 0, 'C');
            $this->Cell(30, 5, utf8_decode('SOBRETASA'), 1, 0, 'C');
            $this->Cell(30, 5, utf8_decode('VALOR FACT.'), 1, 0, 'C');
            $this->Cell(45, 5, utf8_decode('PARADAS'), 1, 0, 'C');
            $this->Cell(40, 5, utf8_decode('CENTRO DE COSTO'), 1, 0, 'C');
            $this->Cell(35, 5, utf8_decode('RESPONSABLE'), 1, 0, 'C');
            $this->Cell(35, 5, utf8_decode('VEHICULO'), 1, 1, 'C');

            $this->SetFont('Arial', '', 9);
            
            $this->SetWidths(array(30, 30, 50, 50, 25, 30, 30, 45, 40, 35, 35));
            $this->SetAligns(array('C', 'C', 'C', 'C', 'R'));            
             
            $patrones = array();
            $patrones[0] = '[\n|\r|\n\r]';
            $patrones[1] = '/,,/';
            $sustituciones = array();
            $sustituciones[0] = ' ';
            $sustituciones[1] = ',';
                             
            foreach ($servicios as $t) {
                $valor += $t["valor"];
                $sobretasa += $t["sobre_tasa"];
                $total += ($t["valor"]+$t["sobre_tasa"]);
                $paradas = preg_replace($patrones, $sustituciones, $t['paradas']);
                $paradas = trim($paradas, ",");
                $this->Row(array(
                    utf8_decode($t["fecha"]), utf8_decode($t["num_fact"]), utf8_decode($t["barrio_o"]), 
                    utf8_decode($t["barrio_d"]), "$" . number_format($t["valor"], 2, ".", ","),
                    "$" . number_format($t["sobre_tasa"], 2, ".", ","),  
                    "$" . number_format($t["valor"]+$t["sobre_tasa"], 2, ".", ","), 
                    utf8_decode($paradas),
                    utf8_decode($t["centrocosto"]),utf8_decode($t["contacto"]),utf8_decode($t["placa"])
                ));    
            }

            $this->Cell(160, 5, "", 0, 0, 'C');
            $this->Cell(25, 5,  "$" . number_format($valor, 2, ".", ","), 1, 0, 'R');
            $this->Cell(30, 5,  "$" . number_format($sobretasa, 2, ".", ","), 1, 0, 'R');
            $this->Cell(30, 5,  "$" . number_format($total, 2, ".", ","), 1, 0, 'R');
            
            $this->Ln(10);
            
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(160, 5, "", 0, 0, 'C');
            $this->Cell(55, 5, utf8_decode('VALOR TOTAL'), 1, 0, 'R');
            $this->Cell(30, 5, "$" .number_format($total, 2, ".", ","), 1, 1, 'R');
            $this->Cell(160, 5, "", 0, 0, 'C');
            $this->Cell(55, 5, utf8_decode('TOTAL SERVICIOS'), 1, 0, 'R');
            $this->Cell(30, 5, count($servicios), 1, 1, 'R');
            
        }
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}
