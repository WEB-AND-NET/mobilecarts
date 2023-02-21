<?php

/**
 * Description of ZonasController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 *         web
 */
class ChecklistController extends DooController
{

    public function beforeRun($resource, $action)
    {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["510"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index()
    {
        $login = $_SESSION['login'];
        $rol = $login->role;
        $query = "SELECT r.id, r.fecha, v.placa, CONCAT(c.nombre, ' ',c.apellidos) AS conductor, IF(rd.id > 0,'Se reportanron fallos', 'Todo OK' ) AS resultado, r.creacion  FROM revision_diara r ";
        $query .= "LEFT JOIN conductores c ON r.id_conductor = c.id ";
        $query .= "LEFT JOIN vehiculos v ON r.id_vehiculo = v.id ";
        $query .= "LEFT JOIN revision_details rd ON rd.id_revision = r.id AND rd.estado LIKE 'Fallo' ";


        $this->data['content'] = 'checklist/list.php';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($rol != "1") {

            $query .= "WHERE c.id = $login->id_usuario ";
            $query .= "GROUP BY r.id";
            $this->data['checklists'] = Doo::db()->query($query)->fetchall();
            $this->renderc('index_propietarios', $this->data, true);
        } else {

            $query .= "GROUP BY r.id";
            $this->data['checklists'] = Doo::db()->query($query)->fetchall();
            $this->renderc('index', $this->data, true);
        }
    }

    public function add()
    {
        #$sql = "SELECT id,nombre,vhoran,vhorae FROM clases_vehiculos where deleted=0";
        #$this->data['clasesvehiculo'] = Doo::db()->query($sql)->fetchAll();
        $login = $_SESSION['login'];
        $rol = $login->role;
        switch ($rol) {
            case "1":
                $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v  WHERE v.deleted=0")->fetchAll();
                break;
            case "3":
                $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v WHERE v.deleted=0 AND v.id_propietario = $login->id_usuario")->fetchAll();
                break;
            case "6":
                $propietario = Doo::db()->query("SELECT id_propietario FROM conductores WHERE id = $login->id_usuario")->fetch();
                $idpro = $propietario["id_propietario"];
                $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v WHERE v.deleted=0 AND v.id_propietario = $idpro")->fetchAll();
                //$this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v INNER JOIN vehiculos_conductores vc ON v.id = vc.id_vehiculo WHERE v.deleted=0 AND vc.id_conductor = $login->id_usuario")->fetchAll();
                break;
        }


        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'checklist/form.php';
        if ($rol != "1") {
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->data['conductore'] = Doo::db()->find("Conductores", array("select" => "id,nombre, apellidos", "asc" => "nombre", 'where' => 'deleted = 0'));
            $this->renderc('index', $this->data, true);
        }
    }

    public function semanal()
    {
        $login = $_SESSION['login'];
        $rol = $login->role;
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'checklist/reporte.php';

        if ($rol != "1") {
            $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v WHERE v.deleted=0 AND v.id_propietario = $login->id_usuario")->fetchAll();
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v  WHERE v.deleted=0")->fetchAll();
            $this->renderc('index', $this->data, true);
        }
    }

    public function lastCheck()
    {
        $id_veh = $_POST["id_veh"];
        Doo::loadModel("RevisionDiara");

        $lastCheck = Doo::db()->query("SELECT venc_botiquin, venc_extintor, ulti_engrase, ulti_lavado, tipo_lavado, MAX(id)  FROM revision_diara  WHERE id_vehiculo=$id_veh")->fetch();
        $RevisionDiara = new RevisionDiara($lastCheck);

        echo json_encode($RevisionDiara);
    }

    public function save()
    {
        $datos = $_POST;
        Doo::loadModel("RevisionDiara");
        Doo::loadModel("RevisionDetails");
        $revisionDiara = new RevisionDiara($_POST);
        $login = $_SESSION['login'];
        $fecha = date_create("$revisionDiara->venc_extintor");
        $now = date_create("now");
        if ($fecha < $now) {
            $revisionDiara->observaciones = "Extintor vencido. ";
        }

        if ($login->role == "1") {
            $revisionDiara->observaciones .= "Realizado por el administrador " . $login->id;
        } else {
            $revisionDiara->id_conductor = $login->id_usuario;
        }
        $idRevision = Doo::db()->Insert($revisionDiara);



        for ($i = 1; $i < 45; $i++) {
            $details = new RevisionDetails();
            $details->id_revision = $idRevision;
            $details->id_subcategoria = $i;

            $details->estado = $datos[$i . ""];
            if ($details->estado != "OK") {
                $details->observacion = $datos["observacion" . $i];
                $details->notificar = '1';
            }
            
            if ($details->id_subcategoria == 44) {
                if ($fecha < $now) {
                    $details->estado = "Fallo";
                    $details->notificar = '1';
                    $details->observacion .= "Extintor vencido";
                }
            }

            Doo::db()->Insert($details);
        }

        return Doo::conf()->APP_URL . "checklist";
    }

    public function report()
    {

        Doo::loadClass("pdf/fpdf");

        Doo::loadClass("reportes/Checklist");

        $id = $this->params['pindex'];

        $revision = Doo::db()->query("SELECT r.*, v.placa, CONCAT(c.nombre, ' ',c.apellidos) AS conductor FROM revision_diara r 
        LEFT JOIN conductores c ON r.id_conductor = c.id 
        LEFT JOIN vehiculos v ON r.id_vehiculo = v.id
        WHERE r.id = $id ")->fetch();

        $details = Doo::db()->query("SELECT rc.nombre AS categoria, rsc.nombre AS subcategoria, rd.estado, rd.observacion FROM revision_details rd 
        LEFT JOIN revision_subcategoria rsc ON rsc.id = rd.id_subcategoria
        LEFT JOIN revision_categoria rc ON rsc.id_categoria = rc.id
        WHERE rd.id_revision = $id ")->fetchAll();

        

        $pdf = new Checklist('P','mm','A4');
        $pdf->id=$revision["id"];
        $pdf->placa=$revision["placa"];
        $pdf->fecha=$revision["fecha"];
        $pdf->AliasNbPages();

        $pdf->AddPage();

        $pdf->SetFont('Times','B',11);

        
        $pdf->Body($revision,$details);


        $pdf->Output();
    }

    public function reportSemanal()
    {
        $datos = $_POST;
        $idVeh = $datos["id_vehiculo"];
        $fechaIni = $datos["fechaIni"];
        $fechaFin = $datos["fechaFin"];

        Doo::loadClass("pdf/fpdf");

        Doo::loadClass("reportes/ChecklistSemanal");       

        $sql = "SELECT r.id, DAYOFWEEK(r.fecha), r.creacion, rsc.nombre, rd.estado, rd.observacion FROM revision_diara r 
        LEFT JOIN revision_details rd ON rd.id_revision = r.id 
        LEFT JOIN revision_subcategoria rsc ON rsc.id = rd.id_subcategoria 
        WHERE r.id_vehiculo = $idVeh AND r.fecha BETWEEN '$fechaIni' AND '$fechaFin'";
        $sqlGroupBy = "GROUP BY DAYOFWEEK(r.fecha), rsc.nombre";

        $lunes =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 2 ".$sqlGroupBy)->fetchAll();
        $martes =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 3 ".$sqlGroupBy)->fetchAll();
        $miercoles =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 4 ".$sqlGroupBy)->fetchAll();
        $jueves =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 5 ".$sqlGroupBy)->fetchAll();
        $viernes =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 6 ".$sqlGroupBy)->fetchAll();
        $sabado =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 7 ".$sqlGroupBy)->fetchAll();
        $domingo =  Doo::db()->query($sql." AND DAYOFWEEK(r.fecha) = 1 ".$sqlGroupBy)->fetchAll();

        $details = Doo::db()->query("SELECT rc.nombre AS categoria, rsc.nombre AS subcategoria FROM  revision_subcategoria rsc 
        LEFT JOIN revision_categoria rc ON rsc.id_categoria = rc.id")->fetchAll();

        $datos = Doo::db()->query("SELECT v.placa, v.modelo, v.marca, GROUP_CONCAT(DISTINCT CONCAT(c.nombre, ' ', c.apellidos) SEPARATOR', ') AS conductores, MIN(r.kilometraje) AS kmI, MAX(r.kilometraje) AS kmF  FROM revision_diara r 
        LEFT JOIN vehiculos v  ON v.id = r.id_vehiculo 
        LEFT JOIN conductores c ON c.id = r.id_conductor 
        WHERE r.id_vehiculo=$idVeh AND r.fecha BETWEEN DATE_ADD('$fechaFin', INTERVAL -6 DAY) AND '$fechaFin'")->fetch();

        $pdf = new ChecklistSemanal('P','mm','A4');
        $pdf->placa=$datos["placa"];
        $pdf->fecha=$fechaIni . " a " .$fechaFin;
        $pdf->AliasNbPages();

        $pdf->AddPage();

        $pdf->SetFont('Times','B',8);

        
        $pdf->Body($datos, $details, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo);


        $pdf->Output();
    }

    public function pendientes(){
        $revision = Doo::db()->query("SELECT r.id, r.fecha, v.placa, CONCAT(c.nombre, ' ',c.apellidos) AS conductor, r.observaciones FROM revision_diara r 
        INNER JOIN revision_details rd ON rd.id_revision = r.id AND rd.notificar = 1
        LEFT JOIN conductores c ON r.id_conductor = c.id 
        LEFT JOIN vehiculos v ON r.id_vehiculo = v.id GROUP BY r.id")->fetchAll();

        echo json_encode($revision);
    }

    public function openNotify(){

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE revision_details SET notificar = 2 WHERE id_revision = '$id' ");

        return Doo::conf()->APP_URL."checklist/report/".$id;    
    }

    public function downloadExcel(){
        
        Doo::loadClass("excel/Classes/PHPExcel");
        $objPHPExcel = new PHPExcel();     
        $objPHPExcel->getActiveSheet()->setShowGridlines(false);  
        $propiedades=$objPHPExcel->getProperties();
        $propiedades->setCreator("Cattivo");
        $propiedades->setLastModifiedBy("Cattivo");
        $propiedades->setTitle("Documento Excel");
        $propiedades->setSubject("Documento Excel");
        $propiedades->setDescription("descripcion del documento");
        $propiedades->setKeywords("Excel Office 2007 openxml php");
        $propiedades->setCategory("Documento Excel");
         // Agregar Informacion
        $page_body=$objPHPExcel->setActiveSheetIndex(0);

        //combinar celdas
        $page_body->mergeCells('A1:B6');
        $page_body->mergeCells('C2:F5');

        //Insertar logo a excel
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('logo');
        $objDrawing->setDescription('logo');
        $objDrawing->setPath('global/img/logo.png');
        $objDrawing->setCoordinates('A1');
        //setOffsetX works properly
        $objDrawing->setOffsetX(5); 
        $objDrawing->setOffsetY(5);                
        //set width, height
        $objDrawing->setWidth(300); 
        $objDrawing->setHeight(100); 
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  

        //Alineacion centrada y negrilla para celda de titulo y fecha
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,

            ),
            'font'  => array(
                'bold'  => true
            )
        );
        $page_body->getStyle('C2')->applyFromArray($style);
        $page_body->getStyle('C2')->getAlignment()->setWrapText(true);

        $today = date('d-m-Y');

        $page_body->setCellValue('C2',"Preoperacional completo\n". $today . "\nCartagena, Colombia");
        
        
        //Color de relleno y negrilla para cabezeras
        $styleArray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '70ad47')
            ),
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF')
            )
        );
        $page_body->getStyle('A7:G7')->applyFromArray($styleArray);

        
        $fila=7;
        $page_body->setCellValue('A'.$fila,"Consecutivo");
       
        $page_body->setCellValue('B'.$fila,"Fecha");
        $page_body->setCellValue('C'.$fila,"Placa");
        $page_body->setCellValue('D'.$fila,"Conductor");
        $page_body->setCellValue('E'.$fila,"Resultado");
        $page_body->setCellValue('F'.$fila,"Creacion");
        $page_body->setCellValue('G'.$fila,"Observaciones");

        $objPHPExcel->getActiveSheet()->setAutoFilter('B7:G7');

        $query = "SELECT r.id, r.fecha, v.placa, CONCAT(c.nombre, ' ',c.apellidos) AS conductor, IF(rd.id > 0,'Se reportanron fallos', 'Todo OK' ) AS resultado, r.creacion, GROUP_CONCAT(rd.observacion SEPARATOR', ') AS obs FROM revision_diara r ";
        $query .= "LEFT JOIN conductores c ON r.id_conductor = c.id ";
        $query .= "LEFT JOIN vehiculos v ON r.id_vehiculo = v.id ";
        $query .= "LEFT JOIN revision_details rd ON rd.id_revision = r.id AND rd.estado LIKE 'Fallo' group by r.id ";
        $entrys= Doo::db()->query($query)->fetchAll();

        //Bordes desde titulos hasta la fila del ultimo registro
        $cant = count($entrys);
        $cant+=7;
        $page_body->getStyle('A7:G'.$cant)->getBorders()->applyFromArray(
            array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                    ),
            )
        );       
        
        
        //$i=0;
        foreach($entrys as $e){
            //$i++;
            $fila++;
            $page_body->setCellValue('A' . $fila, $e['id']);
            $page_body->setCellValue('B' . $fila, $e['fecha']);
            $page_body->setCellValue('C' . $fila, $e['placa']);
            $page_body->setCellValue('D' . $fila, $e['conductor']);
            $page_body->setCellValue('E' . $fila, $e['resultado']);
            $page_body->setCellValue('F' . $fila, $e['creacion']);
            $page_body->setCellValue('G' . $fila, $e['obs']);
        
        }
        //Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Lista');

        //Ajustar ancho de las columna
        foreach(range('A','G') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
        $objPHPExcel->setActiveSheetIndex(0);
        $hoy = date("Y-m-d");  
        // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.        
        header('Content-Type: application/vnd.ms-excel');        
        header('Content-Disposition: attachment;filename="PREOPERACIONAL_'.$hoy.'.xlsx"');//Para descargar en local
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $documentName="PREOPERACIONAL_$hoy.xlsx";
        $objWriter->save('php://output');//Para guardar fuera del servidor 
        return $documentName;

   
    }
}
