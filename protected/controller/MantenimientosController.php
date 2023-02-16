<?php
class MantenimientosController extends DooController
{

    public function beforeRun($resource, $action)
    {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["204"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index()
    {
        $id = $this->params['pindex'];
        $this->data['id'] = $id;
        $sql = "SELECT m.id, v.placa, m.tipo, fecha, CONCAT(km,' Km') AS km, archivoFactura, fechaCierre, m.estado, descripcion FROM mantenimiento m
        LEFT JOIN vehiculos v ON v.id = m.vehiculoId
        ORDER BY m.id DESC";

        $this->data['mantenimientos'] = Doo::db()->query("$sql")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'mantenimientos/list.php';

        $this->renderc('index', $this->data, true);
    }

    public function add()
    {



        Doo::loadModel("Mantenimiento");
        Doo::loadModel("Mttosactividades");
        $m = new Mantenimiento();

        $this->clean();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['mantenimiento'] = $m;
        $this->data['mttact'] = array();
        $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v  WHERE v.deleted=0")->fetchAll();
        $this->data['actividades'] = Doo::db()->find("Actividades", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'mantenimientos/form.php';
        $this->renderc('index', $this->data);
    }


    public function edit()
    {

        $id = $this->params["pindex"];

        Doo::loadModel("Mantenimiento");
        $this->clean();

        $sql = "SELECT * FROM mantenimiento 
        WHERE id = $id";

        $m = new Mantenimiento(Doo::db()->query("$sql")->fetch());
        $idVehiculo = $m->vehiculoId;

        $query = "SELECT mt.id, mt.actividadId, mt.anotacion, mt.costo, a.nombre FROM mttosactividades mt 
        LEFT JOIN actividades a ON mt.actividadId = a.id 
        WHERE mt.mantenimientoId = '$id'";

        $listActividad = Doo::db()->query($query)->fetchAll();
        $_SESSION["list_actividad"] = serialize($listActividad);

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['idVehiculo'] = $idVehiculo;
        $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v  WHERE v.deleted=0")->fetchAll();
        $this->data['mantenimiento'] = $m;
        $this->data['mttact'] = $listActividad;
        $this->data['actividades'] = Doo::db()->find("Actividades", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'mantenimientos/form.php';
        $this->renderc('index', $this->data);
    }

    public function finish()
    {

        $id = $this->params["pindex"];

        Doo::loadModel("Mantenimiento");
        $this->clean();

        $sql = "SELECT * FROM mantenimiento 
        WHERE id = $id";

        $m = new Mantenimiento(Doo::db()->query("$sql")->fetch());
        if ($m->estado == "T") {
            return Doo::conf()->APP_URL . "mantenimientos";
        }

        $idVehiculo = $m->vehiculoId;

        $query = "SELECT mt.id, mt.actividadId, mt.anotacion, mt.costo, a.nombre FROM mttosactividades mt 
        LEFT JOIN actividades a ON mt.actividadId = a.id 
        WHERE mt.mantenimientoId = '$id'";

        $listActividad = Doo::db()->query($query)->fetchAll();
        $_SESSION["list_actividad"] = serialize($listActividad);

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['idVehiculo'] = $idVehiculo;
        $this->data['mantenimiento'] = $m;
        $this->data['actividades'] = Doo::db()->find("Actividades", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'mantenimientos/terminar.php';
        $this->renderc('index', $this->data);
    }

    public function reportes()
    {
        $login = $_SESSION['login'];
        $rol = $login->role;
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'mantenimientos/reportes.php';

        if ($rol != "1") {
            $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v WHERE v.deleted=0 AND v.id_propietario = $login->id_usuario")->fetchAll();
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->data['vehiculos'] = Doo::db()->query("SELECT v.id,v.placa FROM vehiculos v  WHERE v.deleted=0")->fetchAll();
            $this->renderc('index', $this->data, true);
        }
    }

    public function save()
    {
        Doo::loadModel("Mantenimiento");
        Doo::loadHelper('DooFile');

        $mantenimiento = new Mantenimiento($_POST);

        if ($mantenimiento->id == "") {
            $mantenimiento->id = Null;
        }

        if ($mantenimiento->id == Null) {
            $mantenimiento->estado = 'P';
            $mantenimiento->id = Doo::db()->Insert($mantenimiento);
            if ($_FILES["archivoFactura"]["name"] != "") {
                $name = $_FILES["archivoFactura"]["name"];
                $gd2 = new DooFile();
                $ext = end((explode(".", $name)));

                $img = $gd2->upload(Doo::conf()->DOC . 'FacturasMantenimientos/', "archivoFactura", "Factura" . $mantenimiento->id);
                $name = "Factura" . $mantenimiento->id . '.' . $ext;
                $mantenimiento->archivoFactura = $name;
                Doo::db()->Update($mantenimiento);
            }
        } else {



            if ($_FILES["archivoFactura"]["name"] != "") {
                $name = $_FILES["archivoFactura"]["name"];
                $gd2 = new DooFile();
                $ext = end((explode(".", $name)));

                $img = $gd2->upload(Doo::conf()->DOC . 'FacturasMantenimientos/', "archivoFactura", "Factura" . $mantenimiento->id);
                $name = "Factura" . $mantenimiento->id . '.' . $ext;
                $mantenimiento->archivoFactura = $name;
            } else {
                $mantenimiento->archivoFactura = $_POST["archivo"];
            }

            Doo::db()->Update($mantenimiento);
        }

        $this->saveItems($mantenimiento->id);

        return Doo::conf()->APP_URL . "mantenimientos";
    }

    public function saveItems($id_veh)
    {
        Doo::loadModel("Mttosactividades");
        //Elimina las actividades del mantenimiento
        if (isset($_SESSION["list_actividad_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_actividad_del"]);
            foreach ($itemsBorrar as $i) {
                if ($i['id'] != "")
                    Doo::db()->query("DELETE FROM mttosactividades WHERE id =?", array($i['id']));
            }
            $_SESSION["list_actividad_del"] = null;
        }
        // Guardar las actividades del mantenimiento                
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
            foreach ($array as $item) {
                $rp = new Mttosactividades($item);
                if (isset($rp->id) && !empty($rp->id)) {
                } else {
                    $rp->id = null;
                    $rp->mantenimientoId = $id_veh;
                    Doo::db()->insert($rp);
                }
            }
            $_SESSION["list_actividad"] = null;
        }
    }

    public function Savefinish()
    {
        Doo::loadHelper('DooFile');
        Doo::loadModel("Mantenimiento");
        $mantenimiento = new Mantenimiento($_POST);


        $mantenimiento->estado = 'T';
        $mantenimiento->fechaCierre = Date("Y-m-d H:i:s");



        if ($_FILES["fotos"]["name"]) {
            $gd2 = new DooFile();

            $img = $gd2->upload(Doo::conf()->DOC . 'EvidenciaMantenimientos/', "fotos", "Evidencia" . $mantenimiento->id);
            $mantenimiento->fotos = implode("*", $img);
        }

        if ($_FILES["archivoFactura"]["name"] != "") {
            $gd2 = new DooFile();

            $img = $gd2->upload(Doo::conf()->DOC . 'FacturasMantenimientos/', "archivoFactura", "Factura" . $mantenimiento->id);

            $mantenimiento->archivoFactura = $img;
            Doo::db()->Update($mantenimiento);
        } else if ($mantenimiento->archivoFactura == "") {
            $mantenimiento->archivoFactura = $_POST["archivo"];
        }



        Doo::db()->Update($mantenimiento);


        if ($mantenimiento->tipo === "PRE") {
            $rs = Doo::db()->query("SELECT proxMantMeses AS fm, kmMatenimiento as km FROM parametros")->fetch();
            $meses = $rs['fm'];
            $km = $rs['km'];

            $actual = date_create();
            $str = $mantenimiento->fecha . "";

            $fecha =  date_create($str);
            $diff = date_diff($actual, $fecha, false);

            $dias = $meses * 30;

            if ($diff->d < 15) {
                date_add($fecha, date_interval_create_from_date_string("$dias days"));
            }


            $newMantenimiento = new Mantenimiento($mantenimiento);
            $newMantenimiento->id = null;
            $newMantenimiento->km += $km;
            $newMantenimiento->fecha = $fecha->format('Y-m-d');
            $newMantenimiento->estado = 'P';
            $newMantenimiento->fechaCierre = null;
            $newMantenimiento->fotos = "";
            $newMantenimiento->archivoFactura="";


            $newMantenimiento->id = Doo::db()->Insert($newMantenimiento);
            $this->reprogramacionSaveItems($newMantenimiento->id);
        }

        $this->saveItems($mantenimiento->id);

        return Doo::conf()->APP_URL . "mantenimientos";
    }

    public function reprogramacionSaveItems($id_mant)
    {
        Doo::loadModel("Mttosactividades");
        // Guardar las copia de las actividades del mantenimiento anterior
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
            foreach ($array as $item) {
                $rp = new Mttosactividades($item);

                $rp->id = null;
                $rp->mantenimientoId = $id_mant;
                Doo::db()->insert($rp);
            }
        }
    }

    function load()
    {
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
        } else {
            $array = null;
        }
        $this->data['mttact'] = $array;
        $this->renderc("mantenimientos/items", $this->data, true);
    }

    public function insert()
    {
        Doo::loadModel("Mttosactividades");
        $act = new Mttosactividades($_POST);

        $id = $_POST["id"];

        $rs = Doo::db()->query("SELECT id, nombre FROM actividades WHERE id = $id")->fetch();

        $response = array('id' => '', 'nombre' => $rs['nombre'], 'actividadId' => $rs['id'], 'costo' => $act->costo, 'anotacion' => $act->anotacion);

        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
            $array[] = $response;
        } else {
            $array[] = $response;
        }
        $_SESSION["list_actividad"] = serialize($array);

        $this->data['mttact'] = $array;

        $this->renderc("mantenimientos/items", $this->data, true);
    }

    function delete()
    {
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
        }

        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_actividad_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_actividad_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }

        $_SESSION["list_actividad_del"] = serialize($itemsBorrar);
        $_SESSION["list_actividad"] = serialize($array);
        $this->data['mttact'] = $array;
        $this->renderc("mantenimientos/items", $this->data, true);
    }

    function clean()
    {
        if (isset($_SESSION["list_actividad"])) {
            $_SESSION["list_actividad"] = null;
        }
        if (isset($_SESSION["list_actividad_del"])) {
            $_SESSION["list_actividad_del"] = null;
        }
    }

    function vencimientos()
    {
        $rs = Doo::db()->query("SELECT diasNotifyMante AS dv, kmNotify as kn FROM parametros")->fetch();
        $dias = $rs['dv'];
        $km = $rs['kn'];

        $mat1 = Doo::db()->query("SELECT 'Fecha' as tipo, m.fecha as info, v.placa, m.descripcion, '' as proximo FROM mantenimiento m LEFT JOIN vehiculos v ON v.id = m.vehiculoId 
        WHERE m.estado ='P' AND DATEDIFF(m.fecha,NOW()) <= $dias")->fetchAll();

        $mat2 = Doo::db()->query("SELECT 'Kilometraje' as tipo, CONCAT(m.km,' Km') as info, v.placa, m.descripcion, CONCAT(rd.kilometraje,' Km de ') as proximo FROM mantenimiento m 
        LEFT JOIN vehiculos v  ON v.id = m.vehiculoId  
        LEFT JOIN revision_diara rd ON rd.id_vehiculo = v.id AND rd.id = (SELECT MAX(id) FROM revision_diara WHERE id_vehiculo = v.id) 
        WHERE m.estado = 'P' AND (m.km - rd.kilometraje) <= $km ")->fetchAll();

        $res = array_merge($mat1, $mat2);


        echo json_encode($res);
    }

    public function reporteDiario()
    {
        $fechaIni =$_POST["fechaIni"];
        $fechaFin =$_POST["fechaFin"];
        $id_vehiculo =$_POST["id_vehiculo"];

        $andWhere="";
        if ($id_vehiculo>0)
        {
            $andWhere ="AND m.vehiculoId = $id_vehiculo";
        }

        
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

        $page_body->setCellValue('C2',"Listado de mantenimientos\n". $fechaIni . " - ". $fechaFin . "\nCartagena, Colombia");
        
        
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
        $page_body->getStyle('A7:M7')->applyFromArray($styleArray);

        
        $fila=7;
        $page_body->setCellValue('A'.$fila,"Mantenimiento");
        $page_body->setCellValue('B'.$fila,"Preoperacional");
        $page_body->setCellValue('C'.$fila,"Tipo Mantenimiento");
        $page_body->setCellValue('D'.$fila,"Placa");
        $page_body->setCellValue('E'.$fila,"Fecha");
        $page_body->setCellValue('F'.$fila,"Kilometraje");
        $page_body->setCellValue('G'.$fila,"Costo Total");
        $page_body->setCellValue('H'.$fila,"Descripción");
        $page_body->setCellValue('I'.$fila,"Fecha Creación");
        $page_body->setCellValue('J'.$fila,"Fecha Cierre");
        $page_body->setCellValue('K'.$fila,"Actividades");
        $page_body->setCellValue('L'.$fila,"Costo actividades");
        $page_body->setCellValue('M'.$fila,"Anotaciones");

        $objPHPExcel->getActiveSheet()->setAutoFilter('B7:M7');

        $query = "SELECT m.id, m.preoperacional, tipoMantenimiento(m.tipo) AS tipo, v.placa, m.fecha, m.km, m.costoTotal, m.descripcion, m.fechaCreacion, m.fechaCierre,
        GROUP_CONCAT(a.nombre SEPARATOR', ') AS actividades, SUM(ma.costo) AS totalAct, GROUP_CONCAT(ma.anotacion SEPARATOR', ') AS anotaciones
        FROM mantenimiento m
        LEFT JOIN vehiculos v ON v.id = m.vehiculoId
        LEFT JOIN mttosactividades ma ON ma.mantenimientoId = m.id
        LEFT JOIN actividades a ON a.id = ma.actividadId 
        WHERE m.fechaCreacion BETWEEN '$fechaIni 00:00:00' AND '$fechaFin 23:59:59' $andWhere GROUP BY m.id ";
        $entrys = Doo::db()->query($query)->fetchAll();

        //Bordes desde titulos hasta la fila del ultimo registro
        $cant = count($entrys);
        $cant += 7;
        $page_body->getStyle('A7:M'.$cant)->getBorders()->applyFromArray(
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
            $page_body->setCellValue('B' . $fila, $e['preoperacional']);
            $page_body->setCellValue('C' . $fila, $e['tipo']);
            $page_body->setCellValue('D' . $fila, $e['placa']);
            $page_body->setCellValue('E' . $fila, $e['fecha']);
            $page_body->setCellValue('F' . $fila, $e['km']);
            $page_body->setCellValue('G' . $fila, $e['costoTotal']);
            $page_body->setCellValue('H' . $fila, $e['descripcion']);
            $page_body->setCellValue('I' . $fila, $e['fechaCreacion']);
            $page_body->setCellValue('J' . $fila, $e['fechaCierre']);
            $page_body->setCellValue('K' . $fila, $e['actividades']);
            $page_body->setCellValue('L' . $fila, $e['totalAct']);
            $page_body->setCellValue('M' . $fila, $e['anotaciones']);
        
        }
        //Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Lista');

        //Ajustar ancho de las columna
        foreach(range('A','M') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
        $objPHPExcel->setActiveSheetIndex(0);  
        // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.        
        header('Content-Type: application/vnd.ms-excel');        
        header('Content-Disposition: attachment;filename="MANTENIMIENTOS_'.$fechaIni.'_'.$fechaFin.'.xlsx"');//Para descargar en local
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $documentName="MANTENIMIENTOS_'.$fechaIni.'_'.$fechaFin.'xlsx";
        $objWriter->save('php://output');//Para guardar fuera del servidor 
        return $documentName;

   
    }

    public function verPdf()
    {

        Doo::loadClass("pdf/fpdf");

        Doo::loadClass("reportes/Mantenimiento");

        $id = $this->params['pindex'];

        $mantenimiento = Doo::db()->query("SELECT m.preoperacional, tipoMantenimiento(m.tipo) AS tipo, v.placa, m.fecha, m.km, m.costoTotal, m.descripcion, m.fechaCreacion, m.fechaCierre, m.archivoFactura, m.fotos
        FROM mantenimiento m
        LEFT JOIN vehiculos v ON v.id = m.vehiculoId
        WHERE m.id= $id ")->fetch();

        $details = Doo::db()->query("SELECT a.nombre, ma.costo, ma.anotacion FROM mttosactividades ma
        LEFT JOIN actividades a ON a.id = ma.actividadId 
        WHERE ma.mantenimientoId = $id ")->fetchAll();

        

        $pdf = new Mantenimiento('P','mm','A4');
        $pdf->id=$id;
        ;
        $pdf->AliasNbPages();

        $pdf->AddPage();

        $pdf->SetFont('Times','B',11);

        
        $pdf->Body($mantenimiento,$details);


        $pdf->Output();
    }
}
