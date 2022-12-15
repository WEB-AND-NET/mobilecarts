<?php

/**
 * Description of TarifasCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class TarifasCliente extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        $this->SetTitle('Tarifas Cliente');
    }

    function Body($cliente,$tarifas) {

        $this->SetFont('Arial', 'B', 10);

//        $this->Cell(80, 35, $this->Image('global/img/logo.png', $this->GetX(), $this->GetY(), 80, 35), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(66, 5, utf8_decode(C_RAZON_SOCIAL), 0, 0, 'L');
        $this->Cell(130, 5, utf8_decode('TARIFAS DE CLIENTE'), 0, 1, 'R');
        $this->Cell(66, 5, utf8_decode("NIT ".C_NIT), 0, 0, 'L');
        $this->Cell(130, 5, utf8_decode($cliente["nombre"]), 0, 1, 'R');
        $this->Cell(66, 5, "", 0, 0, 'L');
        $this->Cell(130, 5,utf8_decode("IDENTIFICACIÓN ").$cliente["identificacion"], 0, 1, 'R');
        $this->Cell(66, 5, "", 0, 0, 'L');
        $this->Cell(130, 5, "CONTRATO ".$cliente["numero"], 0, 1, 'R');

        $this->Ln(10);
        
        if(count($tarifas) < 1){
            $this->Cell(196, 5, utf8_decode("No hay tarifas asignadas."), 0, 1, 'C');
        }else{
            $this->Cell(131, 5, utf8_decode('TARIFA'), 1, 0, 'C');
            $this->Cell(40, 5, utf8_decode('CLASE VEHICULO'), 1, 0, 'C');
            $this->Cell(25, 5, utf8_decode('VALOR'), 1, 1, 'C');

            $this->SetFont('Arial', '', 9.5);

            foreach ($tarifas as $t) {
                $this->Cell(131, 5, utf8_decode($t["nombreo"] . " - " . $t["nombred"]), 1, 0, 'C');
                $this->Cell(40, 5, utf8_decode($t["clase"]), 1, 0, 'C');
                $this->Cell(25, 5, "$" . number_format($t["valor"], 2, ".", ","), 1, 1, 'R');
            }
        }
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}
