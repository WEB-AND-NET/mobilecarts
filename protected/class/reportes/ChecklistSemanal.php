<?php

/**
 * Description of ChecklistSemanal
 * 
 * @author Maykel Rhenals  <desarrolladorwebandnet@gmail.com>
 */
class ChecklistSemanal extends FPDF
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

    function Body($datos, $details, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo)
    {
        $ancho = $this->w - 20;

        $c2 = $ancho / 4;

        $this->SetFillColor(191, 191, 191);
        
        
        //fila1

        $this->SetFont('Times','B',8);

        $this->Cell($c2, 5, 'KM INICIAL', '1', 0, 'L', true);

        $this->SetFont('Times','',8);

        $this->Cell($c2, 5, $datos['kmI'], '1', 0, 'L');



        $this->SetFont('Times','B',8);

        $this->Cell($c2, 5, 'KM FINAL', '1', 0, 'L', true);

        $this->SetFont('Times','',8);

        $this->Cell($c2, 5, $datos['kmF'], '1', 1, 'L');

        //fila2

        $this->SetFont('Times','B',8);

        $this->Cell($c2, 5, 'MARCA', 'LRB', 0, 'L', true);

        $this->SetFont('Times','',8);

        $this->Cell($c2, 5, $datos['marca'], 'LRB', 0, 'L');


        $this->SetFont('Times','B',8);

        $this->Cell($c2, 5, 'MODELO', 'LRB', 0, 'L', true);

        $this->SetFont('Times','',8);

        $this->Cell($c2, 5, $datos['modelo'], 'LRB', 1, 'L');


        //---------------------------CONDCUTORES-----------------------------
        $this->Ln(1);
        $this->Cell(0, 5, 'CODUCTORES', 'LT b b b b b b b b b b b bR', 1, 'C', true);

        $this->MultiCell(0, 7, $datos["conductores"], '1', 'J');

        
        $this->Ln(4);
        

        $this->Cell(87, 5, "Elementos de operacion: ", '1', 0, 'C');
        $this->Cell(14, 5, "Lunes", '1', 0, 'C');
        $this->Cell(14, 5, "Martes", '1', 0, 'C');
        $this->Cell(15, 5, "Miercoles", '1', 0, 'C');
        $this->Cell(15, 5, "Jueves", '1', 0, 'C');
        $this->Cell(15, 5, "Viernes", '1', 0, 'C');
        $this->Cell(15, 5, "Sabado", '1', 0, 'C');
        $this->Cell(15, 5, "Domingo", '1', 1, 'C');


        $categoria = "";

        
        foreach ($details as $key) {
            if ($categoria != $key["categoria"]) {
                $categoria = $key["categoria"];
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(0, 5, $categoria, "1", 1, 'C', true);
            }

            $this->SetFont('Arial', '', 8);
            //$this->MultiCellRow(3,70,5,[$key["subcategoria"],$key["estado"],$key["observacion"] ], $this);
            $y1 = $this->GetY();
            $item = $key["subcategoria"];
            $this->Cell(87, 5, $item, '1', 0, 'L');

            //Lunes
            $pos = array_search($item, array_column($lunes, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $lunes[$pos]["estado"];
            }
            $this->Cell(14, 5, $estado, '1', 0, 'C');

            //Martes
            $pos = array_search($item, array_column($martes, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $martes[$pos]["estado"];
            }
            $this->Cell(14, 5, $estado, '1', 0, 'C');

            //Miercoles
            $pos = array_search($item, array_column($miercoles, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $miercoles[$pos]["estado"];
            }
            $this->Cell(15, 5, $estado, '1', 0, 'C');

            //Jueves
            $pos = array_search($item, array_column($jueves, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $jueves[$pos]["estado"];
            }
            $this->Cell(15, 5, $estado, '1', 0, 'C');

            //Viernes
            $pos = array_search($item, array_column($viernes, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $lunes[$pos]["viernes"];
            }
            $this->Cell(15, 5, $estado, '1', 0, 'C');

            //Sabado
            $pos = array_search($item, array_column($sabado, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $sabado[$pos]["estado"];
            }
            $this->Cell(15, 5, $estado, '1', 0, 'C');

            //Domingo
            $pos = array_search($item, array_column($domingo, 'nombre'));
            $estado = "";
            if ($pos > -1) {
                $estado = $domingo[$pos]["estado"];
            }
            $this->Cell(15, 5, $estado, '1', 1, 'C');
        }
        $this->Ln();
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, "Observaciones, comentarios o condiciones inseguras del vehiculo", "1", 1, 'C', true);
        $this->SetFont('Arial', '', 8);
        $union = array_merge(
            array_column($lunes, 'observacion'),
            array_column($martes, 'observacion'),
            array_column($miercoles, 'observacion'),
            array_column($jueves, 'observacion'),
            array_column($viernes, 'observacion'),
            array_column($sabado, 'observacion'),
            array_column($domingo, 'observacion')
        );
        $union = array_filter($union);

        $obs = implode("\n", $union);
        $this->MultiCell(0, 5, $obs, '1', 'J');
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
