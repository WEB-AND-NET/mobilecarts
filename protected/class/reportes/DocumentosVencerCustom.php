<?php

/**
 * Description of Documentos por Vencer
 *
 * @author Web
 */
class DocumentosVencerCustom extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        $this->SetTitle('Documentos por Vencer');
    }
    
    function Body($data) {

        $this->SetFont('Arial', 'B', 10);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(200, 5, utf8_decode("Vehiculos con ". $data['title']." por vencer: "), 0, 1, 'C');
        $this->SetTextColor(255, 0, 21);
        $this->Cell(200, 5, $data["rango"], 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        
        
        $this->Ln();
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, "Placa", 1, 0, 'C');
        $this->Cell(50, 6, utf8_decode($data["title_document"]), 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->ln(6);
        
        $sql = $data["query"];   
        
        $r = Doo::db()->query($sql)->fetchAll();

        foreach ($r as $c) {
            $this->Cell(25, 6, $c["placa"], 1, 0, 'C');
            $this->Cell(50, 6, $c[$data["document"]], 1, 1, 'C');
        }
        
        $this->Ln();
        
        $this->SetFont('Arial', 'B', 10);
        
        $this->Cell(25, 6, "Total", 1, 0, 'C');
        $this->Cell(50, 6, count($r), 1, 1, 'C');
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}
