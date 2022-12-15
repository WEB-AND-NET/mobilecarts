<?php

/**
 * Description of Documentos por Vencer
 *
 * @author Web
 */
class ServiciosRealizados extends FPDF {

    public function __construct() {
        parent::__construct('P', 'mm', 'Letter');
        //parent::__construct('L','mm','Letter');
        $this->SetTitle('Servicios Realizados');
    }

    //370x132
    function Body() {
        
        $this->SetFont('Arial', 'B', 10);
        
        $this->Cell(200, 6, "Servicios Realizados", "0", 0, 'C');
        $this->ln(15);
        
        $sql = "SELECT o.numero, cl.nombre AS cliente, o.recorrido, o.n_pasajero, o.valor, cv.nombre AS clase_vehiculo, o.tipo, v.`placa`, o.fecha 
        FROM ordenes_servicios o 
        INNER JOIN  vehiculos v 
        ON (o.`id_vehiculo` = v.`id`)
        INNER JOIN clases_vehiculos cv
        ON (o.`clase_vehiculo` = cv.`id`)
        INNER JOIN clientes cl
        ON (o.`id_cliente` = cl.id )
        WHERE o.estado = 'P' AND o.id_usuario = 7";
        $r = Doo::db()->query($sql)->fetchAll();
        $i = 1;
        
        foreach ($r as $c) {

            $this->SetFont('Arial', 'B', 10);
            $this->Cell(200, 5, utf8_decode($c["cliente"]), "LTR", 1, 'C');
            $this->SetTextColor(255, 0, 21);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(20, 6, "Numero", 1, 0, 'C');
            $this->Cell(23, 6, utf8_decode("N° Pasajero"), 1, 0, 'C');
            $this->Cell(40, 6, "Clase de Vehiculo", 1, 0, 'C');
            $this->Cell(25, 6, "Placa", 1, 0, 'C');
            $this->Cell(30, 6, "Fecha", 1, 0, 'C');
            $this->Cell(30, 6, "Tipo", 1, 0, 'C');
            $this->Cell(32, 6, "Valor", 1, 0, 'C');
           
            $this->ln(6);
//          $date = ;
            $date = date_create($c["fecha"]);
            if ($c["tipo"] == "T") {
                $t = "Transfers";
            } else {
                $t = "Disponibilidad";
            }
            $this->Cell(20, 6, utf8_decode($c["numero"]), 1, 0, 'C');
            $this->Cell(23, 6, utf8_decode($c["n_pasajero"]), 1, 0, 'C');
            $this->Cell(40, 6, utf8_decode($c["clase_vehiculo"]), 1, 0, 'C');
            $this->Cell(25, 6, utf8_decode($c["placa"]), 1, 0, 'C');
            $this->Cell(30, 6, utf8_decode(date_format($date, 'Y-m-d')), 1, 0, 'C');
            $this->Cell(30, 6, utf8_decode($t), 1, 0, 'C');
            $this->Cell(32, 6, utf8_decode($c["valor"]), 1, 1, 'C');
            $this->MultiCell(200, 6, "Recorrido: " . $c["recorrido"], 1, 'C', 0);
            $this->SetFont('Arial', '', 10);
            $this->ln(8);
            $i++;
        }
    }

}
