<?php

/**
 * Description of Checklist
 * 
 * @author Maykel Rhenals  <desarrolladorwebandnet@gmail.com>
 */
class Checklist extends FPDF
{

    public $placa = "";
    public $fecha = "";
    // Cabecera de página

    function Header()
    {

        // Ancho de linea

        $this->SetLineWidth(.4);

        // Arial bold 15

        $this->SetFont('Arial', 'B', 11);

        // Título

        $this->Cell(129, 13, "CHECKLIST $this->fecha VEHICULO $this->placa ", 'LTR', 1, 'C');

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(129, 3, 'AGUAS & AGUAS & CIA LTDA', 'LR', 1, 'C');

        $this->SetFont('Arial', '', 8);

        $this->Cell(129, 5, 'NIT 830.090.037-8', 'LRB', 1, 'C');

        // Logo

        $this->Image('global/img/logo.jpeg', 154, 11, 28);

        $x = $this->GetX();

        $y = $this->GetY();

        $this->Rect($x + 129, 10, 61, 21);

        // Salto de línea

        $this->Ln(5);
    }

    function Body($revision, $details)
    {
        $this->Cell(25, 9, "Conductor: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->Cell(155, 9, $revision["conductor"], '0', 1, 'L');

        $this->SetFont('Times', 'B', 11);
        $this->Cell(25, 9, "Kilometraje: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->Cell(40, 9, $revision["kilometraje"], '0', 0, 'L');

        $this->SetFont('Times', 'B', 11);
        $this->Cell(40, 9, "Vencimiento Botiquin: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->Cell(25, 9, $revision["venc_botiquin"], '0', 1, 'L');

        $this->SetFont('Times', 'B', 11);
        $this->Cell(40, 9, "Vencimiento Extintor: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->Cell(25, 9, $revision["venc_extintor"], '0', 0, 'L');

        $this->SetFont('Times', 'B', 11);
        $this->Cell(29, 9, "Ultimo engrase: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->Cell(25, 9, $revision["ulti_engrase"], '0', 1, 'L');

        $this->SetFont('Times', 'B', 11);
        $this->Cell(30, 9, "Ultimo lavado: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->Cell(35, 9, $revision["ulti_lavado"], '0', 0, 'L');

        $this->SetFont('Times', 'B', 11);
        $this->Cell(29, 9, "Tipo de lavado: ", '0', 0, 'L');
        $this->SetFont('Times', '', 11);
        $this->MultiCell(0, 9, $revision["tipo_lavado"], '0', 'J');

        $categoria = "";

        $this->SetFillColor(191, 191, 191);
        foreach ($details as $key) {
            if ($categoria != $key["categoria"]) {
                $this->Ln();
                $categoria = $key["categoria"];
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(0, 5, $categoria, "1", 1, 'C', true);
            }

            $this->SetFont('Arial', '', 8);
            //$this->MultiCellRow(3,70,5,[$key["subcategoria"],$key["estado"],$key["observacion"] ], $this);
            $y1 = $this->GetY();
            $this->Cell(90, 5, $key["subcategoria"], '0', 0, 'L');
            $this->Cell(20, 5, $key["estado"], '0', 0, 'C');
            $this->MultiCell(0, 5, $key["observacion"], '0', 'J');
            $y2 = $this->GetY();
            $x1= $this->GetX();
            #line x
            $this->Line($x1, $y2,$x1+190, $y2);
            
            if($y1< $y2){
            #line y1
            $this->Line($x1, $y1,$x1, $y2);          
            #line y2
            $this->Line($x1+90, $y1,$x1+90, $y2);
            #line y3
            $this->Line($x1+110, $y1,$x1+110, $y2);
            #line y4
            $this->Line($x1+190, $y1,$x1+190, $y2);
            }
            else
            {
                #line x
            $this->Line($x1, $y2-5,$x1+190, $y2-5);
                #line y1
            $this->Line($x1, $y2-5,$x1, $y2);          
            #line y2
            $this->Line($x1+90, $y2-5,$x1+90, $y2);
            #line y3
            $this->Line($x1+110, $y2-5,$x1+110, $y2);
            #line y4
            $this->Line($x1+190, $y2-5,$x1+190, $y2);
            }
        }
    }

    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function MultiCellRow($cells, $width, $height, $data, $pdf)
    {
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $maxheight = 0;

        for ($i = 0; $i < $cells; $i++) {
            $pdf->MultiCell($width, $height, $data[$i]);
            if ($pdf->GetY() - $y > $maxheight) $maxheight = $pdf->GetY() - $y;
            $pdf->SetXY($x + ($width * ($i + 1)), $y);
        }

        for ($i = 0; $i < $cells + 1; $i++) {
            $pdf->Line($x + $width * $i, $y, $x + $width * $i, $y + $maxheight);
        }

        $pdf->Line($x, $y, $x + $width * $cells, $y);
        $pdf->Line($x, $y + $maxheight, $x + $width * $cells, $y + $maxheight);
    }
}
