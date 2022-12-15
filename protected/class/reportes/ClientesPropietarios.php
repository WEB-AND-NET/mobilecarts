<?php

/**
 * Description of ClientesPropietarios
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ClientesPropietarios extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        $this->SetTitle('Clientes Propietarios');
    }

    function Body($propietario,$clientes) {
//   var_dump($propietario);
//        exit();
        $this->SetFont('Arial', 'B', 10);

//        $this->Cell(80, 35, $this->Image('global/img/logo.png', $this->GetX(), $this->GetY(), 80, 35), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(66, 5, utf8_decode(C_RAZON_SOCIAL), 0, 0, 'L');
        $this->Cell(130, 5, utf8_decode('CLIENTES DE PROPIETARIO'), 0, 1, 'R');
        $this->Cell(66, 5, utf8_decode("NIT ".C_NIT_DIGITO), 0, 0, 'L');
        $this->Cell(130, 5, utf8_decode($propietario["razon_social"]), 0, 1, 'R');
        $this->Cell(66, 5, "", 0, 0, 'L');
        $this->Cell(130, 5,utf8_decode("IDENTIFICACIÓN ").$propietario["identificacion"], 0, 1, 'R');

        $this->Ln(10);
        
        if(count($clientes) < 1){
            $this->Cell(196, 5, utf8_decode("No hay clientes asignados."), 0, 1, 'C');
        }else{
            $this->Cell(25, 5, utf8_decode('C.C. / NIT'), 1, 0, 'C');
            $this->Cell(76, 5, utf8_decode('CONTRATANTE'), 1, 0, 'C');
            $this->Cell(25, 5, utf8_decode('C.C.'), 1, 0, 'C');
            $this->Cell(70, 5, utf8_decode('RESPONSABLE'), 1, 1, 'C');

            $this->SetFont('Arial', '', 8);

            foreach ($clientes as $c) {
                $this->Cell(25, 5, $c["identificacion"], 1, 0, 'C');
                $this->Cell(76, 5, utf8_decode($c["nombre"]), 1, 0, 'C');
                $this->Cell(25, 5,$c["celular"], 1, 0, 'C');
                $this->Cell(70, 5,$c["c_nombre"], 1, 1, 'C');
            }
        }
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}
