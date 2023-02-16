<?php

/**
 * Description of Mantenimiento
 * 
 * @author Maykel Rhenals  <desarrolladorwebandnet@gmail.com>
 */
class Mantenimiento extends FPDF
{

    public $id = "";

    // Cabecera de página

    function Header()
    {

        // Ancho de linea

        $this->SetLineWidth(.4);

        // Arial bold 15

        $this->SetFont('Arial', 'B', 11);

        // Título

        $this->Cell(129, 13, "MANTENIMIENTO $this->id ", 'LTR', 1, 'C');

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

    function Body($mant, $details)
    {
        $this->SetLineWidth(.4);

        //--------------------------------Informacion general--------------------------------------

        $this->SetFillColor(191, 191, 191);

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(0, 5, 'INFORMACIÓN GENERAL', 1, 1, 'C', true);

        $ancho = $this->w - 20;

        $c3 = $ancho / 6;
        $c2 = $ancho / 4;

        //fila1

        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c3, 5, 'TIPO', 'LB', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c3, 5, $mant['tipo'], 'RB', 0, 'L');



        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c3, 5, 'FECHA', 'B', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c3, 5, $mant['fecha'], 'RB', 0, 'L');



        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c3, 5, 'KILOMETRAJE', 'B', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c3, 5, $mant['km'], 'RB', 1, 'L');

        //fila2

        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c3, 5, 'PLACA', 'LB', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c3, 5, $mant['placa'], 'RB', 0, 'L');



        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c3, 5, 'COSTO TOTAL', 'B', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c3, 5, number_format($mant['costoTotal'], 0) . '$', 'RB', 0, 'L');



        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c3, 5, 'PRE-OPERACIONAL', 'B', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c3, 5, $mant['preoperacional'], 'RB', 1, 'L');

        //fila3

        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c2, 5, 'FECHA CREACIÓN', 'LB', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c2, 5, $mant['fechaCreacion'], 'RB', 0, 'L');



        $this->SetFont('Arial', 'B', 8);

        $this->Cell($c2, 5, 'FECHA CIERRE', 'B', 0, 'L');

        $this->SetFont('Arial', '', 8);

        $this->Cell($c2, 5, $mant['fechaCierre'], 'RB', 1, 'L');



        //-------------------------------------DESCRIPCIÓN------------------------------------
        $this->LN(5);

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(0, 5, 'DESCRIPCIÓN', 1, 1, 'C', true);

        $this->SetFont('Arial', '', 8);

        $this->MultiCell(0, 9, $mant["descripcion"], '1', 'J');

        //-------------------------------------ACTIVIDADES--------------------------------------

        $this->Ln(5);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, "ACTIVIDADES", "1", 1, 'C', true);

        $this->Cell(90, 5, "Nombre", 'LRB', 0, 'C');
        $this->Cell(20, 5,  "Costo", 'RB', 0, 'C');
        $this->Cell(0, 5, "Anotacion", 'RB', 1, 'C');



        foreach ($details as $key) {

            $this->SetFont('Arial', '', 8);

            $y1 = $this->GetY();
            $this->Cell(90, 5, $key["nombre"], '0', 0, 'L');
            $this->Cell(20, 5,  number_format($key["costo"], 0) . '$', '0', 0, 'C');
            $this->MultiCell(0, 5, $key["anotacion"], '0', 'J');
            $y2 = $this->GetY();
            $x1 = $this->GetX();
            #line x
            $this->Line($x1, $y2, $x1 + 190, $y2);

            if ($y1 < $y2) {
                #line y1
                $this->Line($x1, $y1, $x1, $y2);
                #line y2
                $this->Line($x1 + 90, $y1, $x1 + 90, $y2);
                #line y3
                $this->Line($x1 + 110, $y1, $x1 + 110, $y2);
                #line y4
                $this->Line($x1 + 190, $y1, $x1 + 190, $y2);
            } else {
                #line x
                $this->Line($x1, $y2 - 5, $x1 + 190, $y2 - 5);
                #line y1
                $this->Line($x1, $y2 - 5, $x1, $y2);
                #line y2
                $this->Line($x1 + 90, $y2 - 5, $x1 + 90, $y2);
                #line y3
                $this->Line($x1 + 110, $y2 - 5, $x1 + 110, $y2);
                #line y4
                $this->Line($x1 + 190, $y2 - 5, $x1 + 190, $y2);
            }
        }

        //-------------------------------------FACTURA------------------------------------
        $this->LN(5);

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(0, 5, 'FACTURA', 1, 1, 'C', true);

        $x = $this->GetX();

        $y = $this->GetY();


        if ($mant["archivoFactura"] != "") {
            $this->LN(5);
            $this->Image("documentacion/FacturasMantenimientos/" . $mant["archivoFactura"], null, null, $ancho);
            $this->AddPage();
        }


        //-------------------------------------EVIDENCIAS--------------------------------------

        $this->Ln(10);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, "EVIDENCIAS FOTOGRÁFICAS", "1", 1, 'C', true);

        if ($mant["fotos"] != "") {
            $fotos = explode("*", $mant["fotos"]);
            foreach ($fotos as $key) {
                $this->LN(5);
                $this->Image("documentacion/EvidenciaMantenimientos/" . $key, null, null, $ancho);
            }
        }
    }

    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
