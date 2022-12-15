<?php

/**
 * Description of Documentos por Vencer
 *
 * @author Web
 */
class DocumentosVencer extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        //parent::__construct('L','mm','Letter');
        $this->SetTitle('Documentos por Vencer');
    }
    
    //370x132
    function Body($fecha, $meses) {
        //$this->Image('global/img/logo.png', 20 ,10,65 , 27,'PNG');

        $this->SetFont('Arial', 'B', 10);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(200, 5, utf8_decode('Vehiculos con documentos Vencidos y Proximos a vencer: '), 0, 1, 'C');
        $this->SetTextColor(255, 0, 21);
        $this->Cell(200, 5, $fecha, 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        
        $this->Ln();
        
        $this->Cell(25, 6, "Vencido", 0, 0, 'C');
        $c1 = 232;
        $c2 = 92;
        $c3 = 102;
        $this->SetFillColor($c1, $c2, $c3);
        $this->Cell(19, 6, " ", 1, 0, 'C',true);
        $c1 = 255;
        $c2 = 255;
        $c3 = 255;
        $this->SetFillColor($c1, $c2, $c3);
        $this->Cell(25, 6, "Por Vencer", 0, 0, 'C');
        $c1 = 242;
        $c2 = 255;
        $c3 = 5;
        $this->SetFillColor($c1, $c2, $c3);
        $this->Cell(19, 6, " ", 1, 0, 'C',true);
        $c1 = 255;
        $c2 = 255;
        $c3 = 255;
        $this->SetFillColor($c1, $c2, $c3);
        $this->Cell(25, 6, "No Aplica", 0, 0, 'C');
        $c1 = 255;
        $c2 = 255;
        $c3 = 255;
        $this->SetFillColor($c1, $c2, $c3);
        $this->Cell(19, 6, " ", 1, 1, 'C',true);
        
        $this->Ln();
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(19, 6, "Placa", 1, 0, 'C');
//        $this->Cell(43, 6, "Propietario", 1, 0, 'C');
        $this->Cell(30, 6, "Soat", 1, 0, 'C');
        $this->Cell(30, 6, "Tecnomecanica", 1, 0, 'C');
        $this->Cell(30, 6, "Contractual", 1, 0, 'C');
        $this->Cell(30, 6, "Extractual", 1, 0, 'C');
        $this->Cell(30, 6, "Todo Riesgo", 1, 0, 'C');
        $this->Cell(31, 6, "Tarjeta Operacion", 1, 0, 'C');
        $this->SetFont('Arial', '', 10);
        $this->ln(6);
//        $sql = "SELECT v.id,  v.placa,
//                IF (v.soat <= CURDATE() || v.soat BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,'Vencido','Proximos') AS v_soat,
//                IF (v.soat <= CURDATE() || v.soat BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,v.`soat`,DATE_ADD(v.soat,INTERVAL $meses MONTH)) AS f_soat,
//
//                IF (v.tecnomecanica <= CURDATE() || v.tecnomecanica BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,'Vencido','Proximos') AS v_tecnomecanica,
//                IF (v.tecnomecanica <= CURDATE() || v.tecnomecanica BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,v.tecnomecanica,DATE_ADD(v.tecnomecanica,INTERVAL $meses MONTH)) AS f_tecnomecanica,
//
//                IF (v.v_contra <= CURDATE() || v.v_contra BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,'Vencido','Proximos') AS v_contra,
//                IF (v.v_contra <= CURDATE() || v.v_contra BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,v.v_contra,DATE_ADD(v.v_contra,INTERVAL $meses MONTH)) AS f_contra,
//
//                IF (v.v_extra <= CURDATE() || v.v_extra BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,'Vencido','Proximos') AS v_extra,
//                IF (v.v_extra <= CURDATE() || v.v_extra BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,v.v_extra,DATE_ADD(v.v_extra,INTERVAL $meses MONTH)) AS f_extra,
//
//                IF (v.v_todo <= CURDATE() || v.v_todo BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,'Vencido','Proximos') AS v_todo,
//                IF (v.v_todo <= CURDATE() || v.v_todo BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,v.v_todo,DATE_ADD(v.v_todo,INTERVAL $meses MONTH)) AS f_todo,
//
//                IF (v.v_tg_operacion <= CURDATE() || v.v_tg_operacion BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,'Vencido','Proximos') AS v_operacion,
//                IF (v.v_tg_operacion <= CURDATE() || v.v_tg_operacion BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)  ,v.v_tg_operacion,DATE_ADD(v.v_tg_operacion,INTERVAL $meses MONTH)) AS f_operacion
//
//
//                FROM vehiculos v INNER JOIN propietarios p
//                ON (v.`id_propietario` = p.`id`)
//                WHERE
//                v.soat BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH) OR
//                v.tecnomecanica BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH) OR
//                v.v_contra BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH) OR
//                v.v_extra BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH) OR
//                v.v_tg_operacion BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH) OR
//                v.v_todo BETWEEN '$fecha' AND DATE_ADD('$fecha',INTERVAL $meses MONTH)";
        
//        $sql = "SELECT id,placa,
//                soat AS f_soat,IF (soat <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Vencido','Proximos') AS v_soat,
//                tecnomecanica AS f_tecnomecanica,IF (tecnomecanica <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Vencido','Proximos') AS v_tecnomecanica,
//                v_contra AS f_contra,IF (v_contra <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Vencido','Proximos') AS v_contra,
//                v_extra AS f_extra,IF (v_extra <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Vencido','Proximos') AS v_extra,
//                v_todo AS f_todo,IF (v_todo <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Vencido','Proximos') AS v_todo,
//                v_tg_operacion AS f_operacion,IF (v_tg_operacion <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Vencido','Proximos') AS v_operacion
//
//                FROM vehiculos WHERE 
//                soat < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
//                tecnomecanica < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
//                v_contra < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
//                v_extra < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
//                v_tg_operacion < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
//                v_todo < DATE_ADD(CURDATE(),INTERVAL $meses MONTH)
//                AND
//                deleted = 0";
        
        $sql = "SELECT id,placa,
                soat AS f_soat,IF (soat <= CURDATE(),'Vencido',IF (soat <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_soat,
                tecnomecanica AS f_tecnomecanica,IF (tecnomecanica <= CURDATE(),'Vencido',IF (tecnomecanica <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_tecnomecanica,
                v_contra AS f_contra,IF (v_contra <= CURDATE(),'Vencido',IF (v_contra <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_contra,
                v_extra AS f_extra,IF (v_extra <= CURDATE(),'Vencido',IF (v_extra <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_extra,
                v_tg_operacion AS f_operacion,IF (v_tg_operacion <= CURDATE(),'Vencido',IF (v_tg_operacion <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_operacion,
                v_todo AS f_todo,IF (v_todo <= CURDATE(),'Vencido',IF (v_todo <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_todo

                FROM vehiculos WHERE 
                soat < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                tecnomecanica < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_contra < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_extra < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_tg_operacion < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_todo < DATE_ADD(CURDATE(),INTERVAL $meses MONTH)
                AND
                deleted = 0";   
        
        $r = Doo::db()->query($sql)->fetchAll();

        $i = 1;
        foreach ($r as $c) {

            $this->Cell(19, 6, $c["placa"], 1, 0, 'C');
            
            switch ($c["v_soat"]) {
                case "Vencido":
                    $c1 = 232;
                    $c2 = 92;
                    $c3 = 102;
                    break;
                case "Proximos":
                    $c1 = 242;
                    $c2 = 255;
                    $c3 = 5;
                    break;
                default:
                    $c1 = 255;
                    $c2 = 255;
                    $c3 = 255;
                    break;
            }

            $this->SetFillColor($c1, $c2, $c3);

            $this->Cell(30, 6, utf8_decode($c["f_soat"]), 1, 0, 'C', true);



            switch ($c["v_tecnomecanica"]) {
                case "Vencido":
                    $c1 = 232;
                    $c2 = 92;
                    $c3 = 102;
                    break;
                case "Proximos":
                    $c1 = 242;
                    $c2 = 255;
                    $c3 = 5;
                    break;
                default:
                    $c1 = 255;
                    $c2 = 255;
                    $c3 = 255;
                    break;
            }
            $this->SetFillColor($c1, $c2, $c3);
//            $this->MultiCell(28, $h, utf8_decode($c["v_tecnomecanica"]), 1, 'C', 'true');
            $this->Cell(30, 6, utf8_decode($c["f_tecnomecanica"]), 1, 0, 'C', true);

            switch ($c["v_contra"]) {
                case "Vencido":
                    $c1 = 232;
                    $c2 = 92;
                    $c3 = 102;
                    break;
                case "Proximos":
                    $c1 = 242;
                    $c2 = 255;
                    $c3 = 5;
                    break;
                default:
                    $c1 = 255;
                    $c2 = 255;
                    $c3 = 255;
                    break;
            }
            $this->SetFillColor($c1, $c2, $c3);

            $this->Cell(30, 6, utf8_decode($c["f_contra"]), 1, 0, 'C', true);

            switch ($c["v_extra"]) {
                case "Vencido":
                    $c1 = 232;
                    $c2 = 92;
                    $c3 = 102;
                    break;
                case "Proximos":
                    $c1 = 242;
                    $c2 = 255;
                    $c3 = 5;
                    break;
                default:
                    $c1 = 255;
                    $c2 = 255;
                    $c3 = 255;
                    break;
            }
            $this->SetFillColor($c1, $c2, $c3);

            $this->Cell(30, 6, utf8_decode($c["f_extra"]), 1, 0, 'C', true);

            switch ($c["v_todo"]) {
                case "Vencido":
                    $c1 = 232;
                    $c2 = 92;
                    $c3 = 102;
                    break;
                case "Proximos":
                    $c1 = 242;
                    $c2 = 255;
                    $c3 = 5;
                    break;
                default:
                    $c1 = 255;
                    $c2 = 255;
                    $c3 = 255;
                    break;
            }
            $this->SetFillColor($c1, $c2, $c3);
            $this->Cell(30, 6, utf8_decode($c["f_todo"]), 1, 0, 'C', true);

            switch ($c["v_operacion"]) {
                case "Vencido":
                    $c1 = 232;
                    $c2 = 92;
                    $c3 = 102;
                    break;
                case "Proximos":
                    $c1 = 242;
                    $c2 = 255;
                    $c3 = 5;
                    break;
                default:
                    $c1 = 255;
                    $c2 = 255;
                    $c3 = 255;
                    break;
            }
            $this->SetFillColor($c1, $c2, $c3);
            $this->Cell(31, 6, utf8_decode($c["f_operacion"]), 1, 0, 'C', true);

            $this->ln(6);
//            

            $i++;
        }
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}
