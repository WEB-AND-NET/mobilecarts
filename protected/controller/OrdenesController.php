<?php

/**
 * Description of OrdenesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class OrdenesController extends DooController {
 public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["101"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

  
    
    public function index() {
        $login = $_SESSION['login'];
        $rol = $login->role;
        $tipo = $login->tipo;
        /*$join = "";
        if ($rol != "1") {
            if($rol == "4"){
                $id_usuario = "AND o.id_cliente=$login->id_usuario";
            }else{
                $id_usuario = "AND o.id_usuario=$login->id";
            }            
        } else {
            $join = " INNER JOIN usuarios u ON (o.id_usuario = u.id)";
            $id_usuario = "AND (u.tipo = 'A' OR u.tipo = 'C' OR u.tipo = 'CO') AND c.tipo != 'P'";
        }

        $sql = "SELECT o.id,c.nombre AS cliente, b1.nombre AS barrio_o, o.origen,o.tipo,
        b2.nombre AS barrio_d, o.destino,cv.nombre AS clase_vehiculo,
        v.placa AS placa, o.estado, date_format(o.fecha,'%m/%d/%Y, %r') AS fecha FROM ordenes_servicios o
        INNER JOIN clientes c ON (o.id_cliente=c.id)
        LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
        INNER JOIN clases_vehiculos cv ON (o.clase_vehiculo=cv.id)
        LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
        LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
        $join
        WHERE o.deleted=0 $id_usuario ORDER BY o.created_at DESC ";
        //echo $sql;
        //exit();
        $this->data['ordenes'] = Doo::db()->query($sql)->fetchAll();*/

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if ($rol != "1" && $tipo != "A") {
            if($rol == "3"){
                $_SESSION["list_conduct"] = serialize(array());
                if (isset($_SESSION["list_conduct"])) {
                    $_SESSION["list_conduct"] = null;
                }
                $this->data['content'] = 'ordenes/list_propietarios.php';
                $this->renderc('index_propietarios', $this->data, true);
                //return Doo::conf()->APP_URL . "ordenes/add";
            }  
            if($rol == "4"){
                $this->data['content'] = 'ordenes/list_clientes.php';
                
                $rsvalor = Doo::db()->query("SELECT SUM(valor+sobre_tasa) AS valor FROM ordenes_servicios WHERE id_cliente = ".$login->id_usuario." AND deleted = 0 AND estado = 'F' AND YEAR(fecha) = YEAR(NOW()) AND MONTH(fecha)=MONTH (NOW());")->fetch();
                $this->data['saldo'] = $rsvalor["valor"];
                
                $this->renderc('index_clientes', $this->data, true);
                //return Doo::conf()->APP_URL . "ordenes/add";
            }  
            if($rol == "5"){
                $id_usuario = $login->id_usuario;
                $this->data['content'] = 'ordenes/list_contactos.php';
                
                 $con = Doo::db()->query("SELECT c.id_cliente,cc.nombre AS centrocosto FROM contactos c inner join centros_costos cc ON (c.id_centrocosto = cc.id) where c.id=$id_usuario")->fetch();
                $cli = Doo::db()->query("SELECT nombre FROM clientes WHERE id=".$con["id_cliente"])->fetch();  
                $rsvalor = Doo::db()->query("SELECT SUM(valor+sobre_tasa) AS valor FROM ordenes_servicios WHERE id_cliente = ".$con["id_cliente"]." AND id_contacto = ".$id_usuario." AND deleted = 0 AND estado = 'F' AND YEAR(fecha) = YEAR(NOW()) AND MONTH(fecha)=MONTH (NOW());")->fetch();     

                $this->data['cliente'] = $cli["nombre"];  
                $this->data['centrocosto'] = $con["centrocosto"];
                $this->data['saldo'] = $rsvalor["valor"];
           
                $this->renderc('index_clientes', $this->data, true);
                //return Doo::conf()->APP_URL . "ordenes/add";
            }  
        } else {

            // Creacion de seccion para agregar conductores
            $_SESSION["list_conduct"] = serialize(array());
            if (isset($_SESSION["list_conduct"])) {
                $_SESSION["list_conduct"] = null;
            }

            $this->data['content'] = 'ordenes/list.php';
            $this->renderc('index', $this->data, true);
        }
    }
    
    public function paginate (){
        $login = $_SESSION['login'];
        $rol = $login->role;
        $tipo = $login->tipo;
        if ($rol != "1" && $tipo != "A") {
            if($rol == "4"){
                $id_usuario = "AND id_cliente=$login->id_usuario";
            }else{
                $id_usuario = "AND id_usuario=$login->id";
            }            
        } else {
            $id_usuario = "AND (u_tipo = 'A' OR u_tipo = 'C' OR u_tipo = 'CO' OR u_tipo = 'P') ";
        }
       
        /*
        $sql = "SELECT o.id,c.nombre AS cliente, b1.nombre AS barrio_o, o.origen,o.tipo,
        b2.nombre AS barrio_d, o.destino,cv.nombre AS clase_vehiculo,
        v.placa AS placa, o.estado, date_format(o.fecha,'%m/%d/%Y, %r') AS fecha FROM ordenes_servicios o
        INNER JOIN clientes c ON (o.id_cliente=c.id)
        LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
        INNER JOIN clases_vehiculos cv ON (o.clase_vehiculo=cv.id)
        LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
        LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
        $join
        WHERE o.deleted=0 $id_usuario ORDER BY o.created_at DESC ";
        */
            
        //$sql = "SELECT * FROM view_ordenes_servicios 
        //WHERE deleted=0 $id_usuario ORDER BY created_at DESC LIMIT 100";
        
        //SELECT id,fecha,cliente,tipo,barrio_o,origen,barrio_d,clase_vehiculo,placa,estado FROM view_ordenes_servicios
        $aColumns = array('id','fecha', 'factura', 'cliente', 'tipo', 'barrio_o', 'origen', 'barrio_d', 'clase_vehiculo', 'placa', 'conductor', 'estado', 'created_at' );

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "view_ordenes_servicios ";

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
		//$sLimit = "LIMIT ".mysql_real_escape_string( $_POST['iDisplayStart'] ).", ".
			//mysql_real_escape_string( $_POST['iDisplayLength'] );
            $sLimit = "LIMIT " . $_POST['iDisplayStart'] . ", " .
                    $_POST['iDisplayLength'];
        }

        /*
         * Ordering
         */
        $sOrder = "ORDER BY";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    if(intval($_POST['iSortCol_' . $i]) !== 4){
                        $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
                        " . $_POST['sSortDir_' . $i] . ", ";                    
                    }else{
                        $sOrder .= "created_at" . "
				 	" . $_POST['sSortDir_' . $i] . ", ";
                    }
                    //Codigo original
                    //$sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
                        //" . $_POST['sSortDir_' . $i] . ", ";   
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        //custom code
        //else{
            //$sOrder = "ORDER BY c.nombre ASC";
        //}

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "WHERE deleted=0 $id_usuario ";
        if ($_POST['sSearch'] != "") {
            //$sWhere = "WHERE c.id_cliente = $id AND (";
            $sWhere = "WHERE deleted=0 $id_usuario AND (";

            $trozos = explode(" ", $_POST['sSearch']);
            $numero = count($trozos);
            if ($numero == 1) {
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $_POST['sSearch'] . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
            } else {
                //WHERE MATCH ( TITULO, DESARROLLO ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50";
                //este va    $sWhere = " WHERE ( MATCH (nombreo, nombred) AGAINST ('".$_POST['sSearch']."') ";
                //                    for ( $i=0 ; $i<count($aColumns) ; $i++ )
                //                    {
                //                            $sWhere .= $aColumns[$i]." LIKE '%". $_POST['sSearch'] ."%' OR ";
                //                    }
                //                    echo $sWhere;
                //                    exit();

                for ($e = 0; $e < count($trozos); $e++) {
                    if ($trozos[$e] != "") {
                        $sWhere .= " ( ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= $aColumns[$i] . " LIKE '%" . $trozos[$e] . "%' OR ";
                        }
                        $sWhere = substr_replace($sWhere, "", -3);
                        if (isset($trozos[$e + 1])) {
                            $trozos[$e + 1] != "" ? $sWhere .= " ) AND " : $sWhere .= " ) ";
                        } else {
                            $sWhere .= " ) ";
                        }
                    }
                }
            }



            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if ($_POST['bSearchable_' . $i] == "true" && $_POST['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    //$sWhere = "WHERE c.id_cliente = $id ";
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $_POST['sSearch_' . $i] . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit ";
        //echo($sQuery);
        //exit($sQuery);
        $tarifas = Doo::db()->query($sQuery)->fetchAll();

       //$total = Doo::db()->query("SELECT count(id) AS total FROM $sTable $sWhere")->fetch();        
       //$nTotal = $total["total"];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(" . $sIndexColumn . ") AS total 
		FROM $sTable $sWhere ";
       
        $total = Doo::db()->query($sQuery)->fetch();
        $iTotal = $total["total"];


        $aaData = array();
        //$aColumns = array('id', 'fecha', 'cliente', 'tipo', 'barrio_o', 'origen', 'barrio_d', 'clase_vehiculo', 'placa', 'estado', 'created_at' );
        foreach ($tarifas as $row) {
            $aaData[] = array(
                $row['id'],                
                $row['fecha'],
                $row['factura'],
                $row['cliente'],
                $row['tipo'],
                $row['barrio_o'],
                $row['origen'],
                $row['barrio_d'],
                $row['clase_vehiculo'],
                $row['placa'],
                $row['conductor'],
                $row['estado'],
                $row['created_at']
            );
        }

        $aa = array(
            'sEcho' => $_POST['sEcho'],
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => $aaData);

        echo json_encode($aa);
    }

    public function add() {
        Doo::loadModel("OrdenesServicios");
        $login = $_SESSION['login'];
        $rol = $login->role;
        $tipo = $login->tipo;
        $id_usuario = $login->id_usuario;

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ordenes'] = new OrdenesServicios();

        $this->data["rol"] = $rol;
        $this->data['barrio_o'] = Doo::db()->find("Barrios", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['clases_v'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['vehiculos'] = array();
        $this->data['objetos_contrato'] = Doo::db()->query("SELECT nombre FROM objetos_contrato")->fetchAll();

        if ($rol != "1" && $tipo != "A") {                                   
            if($rol == "3"){
                $query = "SELECT id, pago_estado, revision_estado,DATE_ADD(revision_fecha,INTERVAL 2 MONTH) AS fecha_vc_revision, ";
                $query .= "DATE_ADD(`pago_fecha`,INTERVAL 1 MONTH) AS fecha_vc_pago,IF( CURDATE() > DATE_ADD(pago_fecha,INTERVAL 1 MONTH) || ";
                $query .= "CURDATE() > DATE_ADD(revision_fecha,INTERVAL 2 MONTH) || pago_estado ='D' || revision_estado ='D', 'NO' , 'SI') AS valido ";
                $query .= "FROM propietarios WHERE deleted=0 AND id = $login->id_usuario ORDER BY razon_social ASC";
                
                $this->data['propietarios'] = Doo::db()->query($query)->fetch();

                $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre,tipo", "where" => "deleted=0 AND id_usuario=$login->id_usuario", "asc" => "nombre"));
                $this->data['conductores'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "where" => "deleted=0 AND id_propietario = '$login->id_usuario'", "asc" => "nombre"));                
                
                
                $this->data['content'] = 'ordenes/from_propietarios.php';
                $this->renderc('index_propietarios', $this->data, true);
            }  
            if($rol == "4"){
                $rs = Doo::db()->query("SELECT id,tipo,tipo_tarifa FROM clientes WHERE id=$id_usuario")->fetch();
                //$rsvalor = Doo::db()->query("SELECT SUM(valor+sobre_tasa) AS valor FROM ordenes_servicios WHERE id_cliente = ".$id_usuario." AND deleted = 0 AND estado = 'F';")->fetch();         
                                                 
                $this->data['tipo_tarifa'] = $rs["tipo_tarifa"];  
                $this->data['tipo_cliente'] = $rs['tipo'];
                $this->data['id_cliente'] = $id_usuario;
                //$this->data['saldo'] = $rsvalor["valor"];
                $qrutas = "SELECT DISTINCT tt.id_o,tt.nombreo,tt.id_d,tt.nombred
                FROM tarifas_transfers_custom ttc 
                INNER JOIN tarifas_transfers tt ON (tt.id = ttc.id_tarifa)
                WHERE ttc.id_cliente = ".$id_usuario;
                
                $this->data['rutas'] = Doo::db()->query($qrutas)->fetchAll();
                $this->data['content'] = 'ordenes/from_clientes.php';                
                $this->renderc('index_clientes', $this->data, true);
            }   
            if($rol == "5"){
                $con = Doo::db()->query("SELECT c.id,c.id_cliente,c.id_centrocosto,cc.nombre AS centrocosto,c.identificacion,c.nombre FROM contactos c inner join centros_costos cc ON (c.id_centrocosto = cc.id) where c.id=$id_usuario")->fetch();
                $cli = Doo::db()->query("SELECT id,nombre,tipo,tipo_tarifa FROM clientes WHERE id=".$con["id_cliente"])->fetch();  
                $rsvalor = Doo::db()->query("SELECT SUM(valor+sobre_tasa) AS valor FROM ordenes_servicios WHERE id_cliente = ".$con["id_cliente"]." AND id_contacto = ".$id_usuario." AND deleted = 0 AND estado = 'F';")->fetch();                          
                $this->data['id_cliente'] = $con["id_cliente"];
                $this->data['tipo_cliente'] = $cli["tipo"];  
                $this->data['tipo_tarifa'] = $cli["tipo_tarifa"];  
                $this->data['cliente'] = $cli["nombre"];  
                $this->data['id_centrocosto'] = $con["id_centrocosto"];
                $this->data['centrocosto'] = $con["centrocosto"];
                $this->data['id_contacto'] = $con["id"];
                $this->data['contacto'] = $con["nombre"];
                //$this->data['saldo'] = $rsvalor["valor"];
                
                $qrutas = "SELECT DISTINCT tt.id_o,tt.nombreo,tt.id_d,tt.nombred
                FROM tarifas_transfers_custom ttc 
                INNER JOIN tarifas_transfers tt ON (tt.id = ttc.id_tarifa)
                WHERE ttc.id_cliente = ".$con["id_cliente"];
                $this->data['rutas'] = Doo::db()->query($qrutas)->fetchAll();
                $this->data['content'] = 'ordenes/from_contactos.php';                                                             
                $this->renderc('index_clientes', $this->data, true);
            } 
        } else {
            $this->data['conductores'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));                
            $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre,tipo", "where" => "deleted=0 AND tipo != 'P'", "asc" => "nombre"));
            
            $this->data['content'] = 'ordenes/from.php';
            $this->renderc('index', $this->data, true);
        }
    }

    public function edit() {
        $id = $this->params["pindex"];
        $login = $_SESSION['login'];
        $rol = $login->role;
        $tipo = $login->tipo;
        $id_usuario = $login->id_usuario;
        $ordenes = Doo::db()->find("OrdenesServicios", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ordenes'] = $ordenes;
        $this->data['barrio_o'] = Doo::db()->find("Barrios", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['clases_v'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre,tipo", "where" => "deleted=0 AND tipo != 'P'", "asc" => "nombre"));
        $this->data['conductores'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['objetos_contrato'] = Doo::db()->query("SELECT nombre FROM objetos_contrato")->fetchAll();
        if ($rol != "1" && $tipo != "A") {
            if($rol == "3" || $rol == "4" || $rol == "5"){
                return Doo::conf()->APP_URL . "ordenes_servicios";
            }                                  
        } else {
            $this->data["selected"] = $ordenes->id_vehiculo;
            $inc_con = "";
            if($ordenes->id_conductor != null && $ordenes->id_conductor != "" && $ordenes->id_conductor != 0)
                $this->data["selected_cond"] = $ordenes->id_conductor;
            //$this->data['vehiculos'] = Doo::db()->query("SELECT id,placa,marca,modelo FROM vehiculos WHERE id_clase=$ordenes->clase_vehiculo")->fetchAll();
            $q = "SELECT v.id, v.placa, v.marca, v.modelo, c.id AS id_c, c.nombre
                      FROM conductores c 
                      INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor)
                      INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo)
                      WHERE v.id_clase = $ordenes->clase_vehiculo AND c.estado = 'D' AND vc.deleted = 0 
                      ORDER BY v.placa,c.nombre ASC";
        
            $this->data['vehiculos'] =  Doo::db()->query($q)->fetchAll();

            $query = "SELECT oc.id,c.id AS id_conductor,c.nombre,c.celular,c.direccion,c.email 
            FROM conductores c 
            INNER JOIN ordenes_conductores oc ON(c.id = oc.id_conductor) 
            WHERE oc.deleted=0 AND oc.id_servicio = '$id'";

            $list_conduct = Doo::db()->query($query)->fetchAll();
            $_SESSION["list_conduct"] = serialize($list_conduct);
            
            $query2 = "SELECT op.id,op.id_barrio,b.nombre,op.valor
            FROM barrios b 
            INNER JOIN ordenes_paradas op ON(b.id = op.id_barrio) 
            WHERE op.deleted=0 AND op.id_servicio = '$id'";

            $list_paradas = Doo::db()->query($query2)->fetchAll();
            $_SESSION["list_paradas"] = serialize($list_paradas);

            $this->data['content'] = 'ordenes/from.php';
            $this->renderc('index', $this->data, true);
        }
    }

    public function preview() {
        $id = $this->params["pindex"];
        $login = $_SESSION['login'];
        $rol = $login->role;
        $id_usuario = $login->id_usuario;
        $ordenes = Doo::db()->find("OrdenesServicios", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ordenes'] = $ordenes;
        $this->data['barrio_o'] = Doo::db()->find("Barrios", array("select" => "id,nombre", 'where' => 'id = ? or id = ?', 'param' => array($ordenes->barrio_o,$ordenes->barrio_d) ));
        $this->data['clases_v'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre,tipo", "where" => "deleted=0 AND tipo != 'P' AND id = ?", "asc" => "nombre", 'param' => array($ordenes->id_cliente) ));
        $this->data['conductores'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['objetos_contrato'] = Doo::db()->query("SELECT nombre FROM objetos_contrato")->fetchAll();
        if ( $rol == "4" && $rol == "5") {
            return Doo::conf()->APP_URL . "ordenes_servicios";                               
        } else {
            $this->data["selected"] = $ordenes->id_vehiculo;
            $inc_con = "";
            if($ordenes->id_conductor != null && $ordenes->id_conductor != "" && $ordenes->id_conductor != 0)
                $this->data["selected_cond"] = $ordenes->id_conductor;
            $q = "SELECT v.id, v.placa, v.marca, v.modelo, c.id AS id_c, c.nombre
                      FROM conductores c 
                      INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor)
                      INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo)
                      WHERE v.id_clase = $ordenes->clase_vehiculo AND c.estado = 'D' AND vc.deleted = 0 
                      ORDER BY v.placa,c.nombre ASC";
        
            $this->data['vehiculos'] =  Doo::db()->query($q)->fetchAll();

            $query = "SELECT oc.id,c.id AS id_conductor,c.nombre,c.celular,c.direccion,c.email 
            FROM conductores c 
            INNER JOIN ordenes_conductores oc ON(c.id = oc.id_conductor) 
            WHERE oc.deleted=0 AND oc.id_servicio = '$id'";

            $list_conduct = Doo::db()->query($query)->fetchAll();
            $_SESSION["list_conduct"] = serialize($list_conduct);
            
            $query2 = "SELECT op.id,op.id_barrio,b.nombre,op.valor
            FROM barrios b 
            INNER JOIN ordenes_paradas op ON(b.id = op.id_barrio) 
            WHERE op.deleted=0 AND op.id_servicio = '$id'";

            $list_paradas = Doo::db()->query($query2)->fetchAll();
            $_SESSION["list_paradas"] = serialize($list_paradas);

            $this->data['content'] = 'ordenes/preview.php';
            $this->renderc('index', $this->data, true);
        }
    }

    // Metodos para cargar los conductores
    function load() {
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
        } else {
            $array = null;
        }
        $this->data['items'] = $array;
        $this->renderc("ordenes/items", $this->data, true);
    }
    
    // Metodos para cargar las paradas
    function load_paradas() {
        if (isset($_SESSION["list_paradas"])) {
            $array = unserialize($_SESSION["list_paradas"]);
        } else {
            $array = null;
        }
        $this->data['items'] = $array;
        $this->renderc("ordenes/items_paradas", $this->data, true);
    }

    function clean() {
        if (isset($_SESSION["list_conduct"])) {
            $_SESSION["list_conduct"] = null;
        }
        if (isset($_SESSION["list_conduct_del"])) {
            $_SESSION["list_conduct_del"] = null;
        }
        
        if (isset($_SESSION["list_paradas"])) {
            $_SESSION["list_paradas"] = null;
        }
        if (isset($_SESSION["list_paradas_del"])) {
            $_SESSION["list_paradas_del"] = null;
        }
        
        if (isset($_SESSION["pasajeros"])) {
            $_SESSION["pasajeros"] = null;
        }
        
        
    }

    public function validarConductor() {
        $id_conductor = $_POST["id_conductor"];

        $val = false;
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
            foreach ($array as $item) {
                if ($item['id_conductor'] == $id_conductor) {
                    $val = true;
                }
            }
        }
        echo $val;
    }

    public function insert() {
        Doo::loadModel("Conductores");
        $rp = new Conductores($_POST);

        $id = $_POST["id_cond"];

        $rs = Doo::db()->query("SELECT id, nombre, celular, direccion, email FROM conductores WHERE id= $id")->fetch();
        $response = array('id' => '', 'id_conductor' => $rs['id'], 'nombre' => $rs['nombre'], 'celular' => $rs['celular'], 'direccion' => $rs['direccion'], 'email' => $rs['email']);

        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
            $array[] = $response;
        } else {
            $array[] = $response;
        }
        $_SESSION["list_conduct"] = serialize($array);

        $this->data['items'] = $array;

        $this->renderc("ordenes/items", $this->data, true);
    }
    
    public function insert_parada() {
        //Doo::loadModel("Conductores");
        //$rp = new Conductores($_POST);
        
        $id_cli = $_POST["id_cli"];
        $id = $_POST["id_barrio"];
        $nombre= $_POST["nombre"];

        //$rs = Doo::db()->query("SELECT id, nombre, celular, direccion, email FROM conductores WHERE id= $id")->fetch();
        //$response = array('id' => '', 'id_conductor' => $rs['id'], 'nombre' => $rs['nombre'], 'celular' => $rs['celular'], 'direccion' => $rs['direccion'], 'email' => $rs['email']);
        $rs = Doo::db()->query("SELECT valor_parada('S', ".$id_cli.") AS valor_parada;")->fetch();
        $response = array('id' => '', 'id_barrio' => $id, 'valor' => $rs["valor_parada"], 'nombre' => $nombre);
        if (isset($_SESSION["list_paradas"])) {
            $array = unserialize($_SESSION["list_paradas"]);
            if(count($array) < 3 ){
                $array[] = $response;
            }
        } else {
            $array[] = $response;
        }
        $_SESSION["list_paradas"] = serialize($array);

        $this->data['items'] = $array;

        $this->renderc("ordenes/items_paradas", $this->data, true);
    }

    function delete() {
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
        }
        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_conduct_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_conduct_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }
        $_SESSION["list_conduct_del"] = serialize($itemsBorrar);
        $_SESSION["list_conduct"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("ordenes/items", $this->data, true);
    }
    
    function delete_parada() {
        if (isset($_SESSION["list_paradas"])) {
            $array = unserialize($_SESSION["list_paradas"]);
        }
        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_paradas_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_paradas_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }
        $_SESSION["list_paradas_del"] = serialize($itemsBorrar);
        $_SESSION["list_paradas"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("ordenes/items_paradas", $this->data, true);
    }

    // Fin Metodos agregacion conductores


    public function save() {
        Doo::loadModel("OrdenesServicios");
        $ordenes = new OrdenesServicios($_POST);
        $login = $_SESSION['login'];
        $id_usuario = $login->id;
        $rol = $login->role;
        $tipo = $login->tipo;

        if ($ordenes->id == "") {
            $ordenes->id = Null;
        }
        $ordenes->deleted = "0";
        if ($ordenes->id_vehiculo == "") {
            $ordenes->id_vehiculo = 0;
        }
        
        if ($rol != "1" && $tipo != "A") {
            if($rol == "3"){
                
                $ordenes->nhora = 0;
            }
            if($rol == "4"){
                //$ordenes->origen = '';
                $ordenes->nhora = 0;
            }               
        }

        if ($ordenes->id == Null) {
            if ($ordenes->tipo != "T" && $ordenes->tipo != "V" ) {
                $ordenes->barrio_o = "0";
                $ordenes->barrio_d = "0";
            } else if ($ordenes->tipo == "T" || $ordenes->tipo == "V") {
                $ordenes->nhora = "0";
            }
            $ordenes->id_usuario = $id_usuario;
            $ordenes->fecha_inicial = $_POST["fecha"];
            $ordenes->fecha_final = (new DateTime($_POST["fecha_final"]))->format('Y-m-d');
            $ordenes->created_at = date('Y-m-d H:i:s');
            $ordenes->updated_at = date('Y-m-d H:i:s');
            if($ordenes->id_vehiculo != 0 and $rol != "3"){
                $ordenes->estado = "A";
            }else{
                $ordenes->estado = "P";
            }
            
            $ordenes->id = Doo::db()->Insert($ordenes);
            if($rol == "3"){   // || $rol == "4" || $rol == "5"
                $propietario = Doo::db()->query("SELECT * FROM `propietarios` WHERE `id` = '$id_usuario'")->fetch();
                Doo::loadModel("Notificaciones");
                $notify = new Notificaciones();
                $notify->id = null;
                $notify->id_vehiculo  = $ordenes->id_vehiculo;
                $notify->id_propietario = $id_usuario;
                $notify->tipo = "SF";
                $mensaje = "EL AFILIADO ".$propietario['razon_social']." ESTA SOLICITANDO LA APROBACION DE UNA FUEC";
                $notify->mensaje = $mensaje;
                Doo::db()->insert($notify);
                $this->saveItems($ordenes->id); 
                $this->saveItems2($ordenes->id);
                $this->savePasajeros($ordenes->id);
                $this->clean();
                return Doo::conf()->APP_URL . "ordenes";
            }
        } else {
            if ($ordenes->tipo != "T" && $ordenes->tipo != "V") {
                $ordenes->barrio_o = "0";
                $ordenes->barrio_d = "0";
            }
            $ordenes->fecha_inicial = $_POST["fecha"];
            $ordenes->fecha_final = (new DateTime($_POST["fecha_final"]))->format('Y-m-d');
            $ordenes->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($ordenes);
        }
        
        $this->saveItems($ordenes->id);        
        $this->saveItems2($ordenes->id);
        $this->savePasajeros($ordenes->id);
        $this->clean();

        return Doo::conf()->APP_URL . "ordenes";
    }
    
    public function savePasajeros($id_srv){
        Doo::db()->query("DELETE FROM `pasajeros_orden` WHERE `id_orden` = '$id_srv'");
        if (isset($_SESSION["pasajeros"])) {
            $array = unserialize($_SESSION["pasajeros"]);
            Doo::loadModel("PasajerosOrden");
            foreach ($array as $a) {
                $po = new PasajerosOrden();
                $po->id_pasajero =$a["id"];
                $po->id_orden = $id_srv;
                Doo::db()->insert($po);
            }
        }
    }

    public function saveItems($id_srv) {
        Doo::loadModel("OrdenesConductores");
        //Elimina los conductores del vehiculo
        if (isset($_SESSION["list_conduct_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_conduct_del"]);
            foreach ($itemsBorrar as $i) {
                //$eliminar = true;
                //if ($rp->id == $i['id']) {
                //    $eliminar = false;
                //}
                //if ($eliminar) {
                Doo::db()->query("UPDATE ordenes_conductores SET deleted=1 WHERE id=?", array($i['id']));
                //}
            }
            $_SESSION["list_conduct_del"] = null;
        }
        ///Gurdar SIII
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
            Doo::loadModel("OrdenesConductores");

            foreach ($array as $a) {
                if ($a['id'] == '') {
                    $s = new OrdenesConductores();
                    $s->id = null;
                    $s->id_conductor = $a["id_conductor"];
                    $s->id_servicio = $id_srv;
                    $s->deleted = 0;
                    $s->created_at = date('Y-m-d H:i:s');
                    $s->updated_at = date('Y-m-d H:i:s');
                    Doo::db()->insert($s);
                }
            }
        }
    }
    
    public function saveItems2($id_srv){
         Doo::loadModel("OrdenesParadas");
        //Elimina los conductores del vehiculo
        
        if (isset($_SESSION["list_paradas_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_paradas_del"]);
            foreach ($itemsBorrar as $i) {
                //$eliminar = true;
                //if ($rp->id == $i['id']) {
                //    $eliminar = false;
                //}
                //if ($eliminar) {
                Doo::db()->query("UPDATE ordenes_paradas SET deleted=1 WHERE id=?", array($i['id']));
                //}
            }
            $_SESSION["list_paradas_del"] = null;
        }
        ///Gurdar SIII
        if (isset($_SESSION["list_paradas"])) {
            $array = unserialize($_SESSION["list_paradas"]);
            Doo::loadModel("OrdenesParadas");

            foreach ($array as $a) {
                if ($a['id'] == '') {
                    $s = new OrdenesParadas();
                    $s->id = null;                   
                    $s->id_servicio = $id_srv;
                    $s->id_barrio = $a["id_barrio"];
                    $s->valor = $a["valor"];
                    $s->deleted = 0;
                    $s->created_at = date('Y-m-d H:i:s');
                    $s->updated_at = date('Y-m-d H:i:s');
                    Doo::db()->insert($s);
                }
            }
        }
    }
    
    public function new_add_print(){
        $id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        //$id = $_GET["id_registro"];
        $this->data['id_orden'] = $id;
        $this->data['content'] = 'ordenes/new_and_print.php';
        $this->renderc('index_propietarios', $this->data, true);
    } 

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE ordenes_servicios SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "ordenes_servicios";
    }
    
    public function aprobar() {
        $id = $this->params["pindex"];
        
        Doo::db()->query("UPDATE ordenes_servicios SET estado='A' WHERE id=? AND estado = 'P'", array($id));
        return Doo::conf()->APP_URL . "ordenes_servicios";
    }


    public function cargar_vehiculo() {

        $login = $_SESSION['login'];
        $rol = $login->role;

        $id_cla = $_POST["id_cl"];
        $id_veh = $_POST["id_vh"];

        //$r = Doo::db()->query("SELECT id,placa,marca,modelo FROM vehiculos WHERE id_clase=$id_cla")->fetchAll();
        if ($rol == "3") {
            $qp = "SELECT v.id,v.placa,id_clase, v.marca, v.modelo, c.id AS id_c, c.nombre, soat AS f_soat,
            IF (soat <= CURDATE(),'Vencido','Valido') AS v_soat, tecnomecanica AS f_tecnomecanica,
            IF (tecnomecanica <= CURDATE(),'Vencido','Valido') AS v_tecnomecanica, v_contra AS f_contra,
            IF (v_contra <= CURDATE(),'Vencido','Valido') AS v_contra, v_extra AS f_extra,
            IF (v_extra <= CURDATE(),'Vencido','Valido') AS v_extra, v_tg_operacion AS f_operacion,
            IF (v_tg_operacion <= CURDATE(),'Vencido','Valido') AS v_operacion,
            IF( soat <= CURDATE() OR tecnomecanica <= CURDATE() OR v_contra <= CURDATE() OR v_extra <= CURDATE() OR v_tg_operacion <= CURDATE(), 'Vencido', 'Valido' ) AS vigente, v.estado 
            FROM vehiculos v 
            INNER JOIN vehiculos_conductores vc ON (v.id = vc.id_vehiculo)
            INNER JOIN conductores c  ON (c.id = vc.id_conductor)
            WHERE v.id_clase = $id_cla AND v.id_propietario = $login->id_usuario; AND v.deleted = 0
            ORDER BY v.placa,c.nombre ASC";
            $r = Doo::db()->query($qp)->fetchAll();
        } else {
            $query = "SELECT v.id, v.placa, v.marca, v.modelo, c.id AS id_c, c.nombre, soat AS f_soat,
            IF (soat <= CURDATE(),'Vencido','Valido') AS v_soat, tecnomecanica AS f_tecnomecanica,
            IF (tecnomecanica <= CURDATE(),'Vencido','Valido') AS v_tecnomecanica, v_contra AS f_contra,
            IF (v_contra <= CURDATE(),'Vencido','Valido') AS v_contra, v_extra AS f_extra,
            IF (v_extra <= CURDATE(),'Vencido','Valido') AS v_extra, v_tg_operacion AS f_operacion,
            IF (v_tg_operacion <= CURDATE(),'Vencido','Valido') AS v_operacion,
            IF( soat <= CURDATE() OR tecnomecanica <= CURDATE() OR v_contra <= CURDATE() OR v_extra <= CURDATE() OR v_tg_operacion <= CURDATE(), 'Vencido', 'Valido' ) AS vigente, v.estado 
                  FROM conductores c 
                  INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor)
                  INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo)
                  WHERE v.id_clase = $id_cla AND c.estado = 'D' AND vc.deleted = 0 
                  ORDER BY v.placa,c.nombre ASC";

            $r =  Doo::db()->query($query)->fetchAll();
        }
        
        $this->data["vehiculos"] = $r;
        $this->data["rol"] = $rol;
        $this->data["selected"] = $id_veh;

        if ($rol == "3") {
            $this->renderc("ordenes/selectp", $this->data, true);
        } else {
            $this->renderc("ordenes/select", $this->data, true);
        }
    }
    
    public function cargar_vehiculoP() {
        $id_cli = $_POST["id_cliente"];
        $id_veh = $_POST["id_vh"];

        //$r = Doo::db()->query("SELECT id,placa,marca,modelo FROM vehiculos WHERE id_clase=$id_cla")->fetchAll();
        if ($id_cli!="")
        {
        $query = "SELECT v.id, v.placa, v.marca, v.modelo, c.id AS id_c, c.nombre
                  FROM conductores c 
                  INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor)
                  INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo)
                  INNER JOIN cliente_vehiculos cv ON (v.id = cv.id_vehiculo)
                  WHERE cv.id_cliente = $id_cli AND c.estado = 'D' AND vc.deleted = 0 
                  ORDER BY v.placa,c.nombre ASC";
        
        $r =  Doo::db()->query($query)->fetchAll();
        
        $this->data["vehiculos2"] = $r;
        }
        $this->data["selected"] = $id_veh;
        $this->renderc("ordenes/select", $this->data, true);
    }

    public function cargar_conductores() {
        $id_veh = $_POST["id_veh"];        
        $id_con = $_POST["id_con"];

        $r = Doo::db()->query("SELECT vc.id,c.identificacion, c.nombre, c.celular FROM vehiculos_conductores vc
        INNER JOIN conductores c
        ON (vc.`id_conductor`=c.`id`)
        WHERE vc.deleted = 0 AND id_vehiculo =$id_veh AND id_conductor = $id_con")->fetch();

        echo json_encode($r);
    }

    public function cargar_contacto() {
        $id = $_POST["id_client"];
        $id_c = $_POST["id_contact"];
        $r = Doo::db()->query("SELECT c.id,c.nombre FROM contactos c INNER JOIN clientes cl
        ON (c.id_cliente=cl.id)
        WHERE cl.`id`=$id")->fetchAll();
        $this->data["c_selected"] = $id_c;
        $this->data["contacto"] = $r;
        $this->renderc("ordenes/select_contacto", $this->data, true);
    }

    public function validar() {
        $identificacion = $_POST["ced"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from clientes where identificacion = '$identificacion' AND id <> '$id'")->rowCount();
        if ($count1 > 0)
            echo true;
        else
            echo false;
    }
    


    public function cargar_asignar() {

        $id = filter_input(INPUT_POST, "id_orden");

        $query = "SELECT o.id,c.nombre AS cliente,o.origen AS direccion,";
        $query.= "b1.nombre AS b_origen,b2.nombre AS b_destino,o.clase_vehiculo AS id_clase,";
        $query.= "cv.nombre AS clase,o.fecha FROM ordenes_servicios o INNER JOIN clientes c ";
        $query.= "ON (c.id = o.id_cliente)  LEFT JOIN barrios b1 ON (b1.id = o.barrio_o) ";
        $query.= "LEFT JOIN barrios b2 ON (b2.id = o.barrio_d) INNER JOIN ";
        $query.= "clases_vehiculos cv ON (cv.id = o.clase_vehiculo) ";
        $query.= "WHERE o.id = '$id'";

        $o = Doo::db()->query($query)->fetch();
        
        
        $id_clase = $o["id_clase"];

        /*
          $query2 = "SELECT c.id,v.id AS id_v,c.nombre FROM conductores c INNER JOIN vehiculos_conductores vc ";
          $query2.= "ON(c.id = vc.id_conductor) INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo) ";
          $query2.= "WHERE vc.deleted=0 AND v.id_clase = '$id_clase'";
         */
        $query2 = "call conductores_distancia($id)";

        $conductores = Doo::db()->query($query2)->fetchAll();
        //var_dump($conductores);

        $response = array();
        $response['orden'] = $o;
        $response['conductores'] = $conductores;

        echo json_encode($response);
    }
    
    public function cargar_cancelar() {

        $id = filter_input(INPUT_POST, "id_orden");
        $query = "SELECT o.id,c.nombre AS cliente,o.origen AS direccion,";
        $query.= "b1.nombre AS b_origen,b2.nombre AS b_destino,o.clase_vehiculo AS id_clase,";
        $query.= "cv.nombre AS clase,o.fecha,d.identificacion AS d_identificacion,";
        $query.= "d.nombre AS d_nombre, v.placa FROM ordenes_servicios o INNER JOIN clientes c ";
        $query.= "ON (c.id = o.id_cliente)  LEFT JOIN barrios b1 ON (b1.id = o.barrio_o) ";
        $query.= "LEFT JOIN barrios b2 ON (b2.id = o.barrio_d) INNER JOIN ";
        $query.= "clases_vehiculos cv ON (cv.id = o.clase_vehiculo) ";
        $query.= "LEFT JOIN conductores d ON d.id = o.id_conductor ";
        $query.= "LEFT JOIN vehiculos v ON v.id = o.id_vehiculo ";
        $query.= "WHERE o.id = '$id'";

        $o = Doo::db()->query($query)->fetch();

        $response = array();
        $response['orden'] = $o;
        echo json_encode($response);
    }

    public function cargar_conductor() {

        $id = filter_input(INPUT_POST, "id_con");
        $id_veh = filter_input(INPUT_POST, "id_veh");

        $query = "SELECT c.identificacion,c.nombre,v.placa FROM conductores c ";
        $query.= "INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor) ";
        $query.= "INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo) WHERE c.id = '$id' AND v.id = '$id_veh'";

        $c = Doo::db()->query($query)->fetch();

        $response = array();
        $response['conductor'] = $c;

        echo json_encode($response);
    }

    public function save_asignar() {

        $id_ord = filter_input(INPUT_POST, "id_ord");
        $id_con = filter_input(INPUT_POST, "id_con");
        $id_veh = filter_input(INPUT_POST, "id_veh");

        $fec = date('Y-m-d H:i:s');

        $q1 = "UPDATE ordenes_servicios SET id_vehiculo='$id_veh', id_conductor='$id_con',";
        $q1.= "estado='A', updated_at='$fec' WHERE id='$id_ord'";

        Doo::db()->query($q1);

        $this->enviar($id_ord);
        $this->enviarAsignacion($id_ord, $id_con, $id_veh);

        echo 'oka';
    }
    
    public function save_cancelar() {

        $id_ord = filter_input(INPUT_POST, "id_ord");

        $fec = date('Y-m-d H:i:s');

        $q1 = "UPDATE ordenes_servicios SET estado='C', updated_at='$fec' WHERE id='$id_ord'";

        Doo::db()->query($q1);

        echo 'oka';
    }

    public function dataPlanilla($id) {
        //$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $q = 'SELECT CONCAT("# ",territorial," ",resolucion_hab," ",ano_hab," ",ano_actual) AS header FROM parametros WHERE id = 1';//,anexo
        $header = Doo::db()->query($q)->fetch();

        $q1 = "SELECT o.id,o.tipo,o.numero,o.objetoc,o.recorrido,co.numero AS contrato,o.id_cliente,c.tipo AS tipo_cliente,c.identificacion,c.nombre AS cliente,c.celular,c.direccion,con.identificacion AS c_identificacion,
            c.c_identificacion AS r_identificacion,c.c_nombre AS r_nombre,c.c_celular AS r_celular,c.c_direccion AS r_direccion,
            con.nombre AS c_nombre,con.telefono AS c_telefono,con.direccion AS c_direccion,o.origen,o.destino,b1.nombre AS barrio_o,
            b2.nombre AS barrio_d,v.id AS id_vehiculo,v.placa,v.modelo,v.marca,cv.nombre AS clase,cvenio.razon_social AS convenio,v.num_interno,v.tg_operacion,o.fecha,
            date_format(o.fecha_inicial,'%d') AS ini_d,date_format(o.fecha_inicial,'%m') AS ini_m,date_format(o.fecha_inicial,'%Y') AS ini_a,
            date_format(o.fecha_final,'%d') AS fin_d,date_format(o.fecha_final,'%m') AS fin_m,date_format(o.fecha_final,'%Y') AS fin_a,
            date_format(o.fecha,'%d de %M del %Y, Hora %r') AS expedido, o.observacion
            FROM ordenes_servicios o
            INNER JOIN clientes c ON (o.id_cliente = c.id)
            LEFT JOIN contactos con ON (con.id = o.id_contacto)
            INNER JOIN contratos co ON (c.id = co.id_cliente)
            LEFT JOIN vehiculos v ON (o.id_vehiculo = v.id)
            LEFT JOIN convenios cvenio ON (v.id_convenio = cvenio.id)
            LEFT JOIN clases_vehiculos cv ON (cv.id = v.id_clase)
            LEFT JOIN barrios b1 ON (o.barrio_o = b1.id)
            LEFT JOIN barrios b2 ON (o.barrio_d = b2.id)
            WHERE o.id = '$id';";
        //exit($q1);
        Doo::db()->query("SET lc_time_names = 'es_CO';");
        $orden = Doo::db()->query($q1)->fetch();

        if (isset($orden["id_vehiculo"])) {
            $q2 = "SELECT c.nombre, c.apellidos,c.identificacion,c.n_licencia,c.vigencia,c.email FROM conductores c ";
            $q2.= "INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor) INNER JOIN vehiculos v ";
            $q2.= "ON (v.id = vc.id_vehiculo) WHERE vc.deleted = 0 AND v.id = '" . $orden["id_vehiculo"] . "'";
            $conductores = Doo::db()->query($q2)->fetchAll();
        } else {
            $conductores = array();
        }

        $q3 = "SELECT oc.id,c.id AS id_conductor,c.identificacion,c.nombre, c.apellidos, c.n_licencia,c.vigencia
        FROM conductores c 
        INNER JOIN ordenes_conductores oc ON(c.id = oc.id_conductor) 
        WHERE oc.deleted=0 AND oc.id_servicio = $id";
        $ordenesCondu = Doo::db()->query($q3)->fetchAll();
        
        $q4 = "SELECT t.aplica_anexo,t.anexo FROM tarifas_transfers t 
        INNER JOIN ordenes_servicios o ON ((t.id_o = o.barrio_o AND t.id_d = o.barrio_d) OR (t.id_d = o.barrio_o AND t.id_o = o.barrio_d))
        WHERE  o.id = $id LIMIT 1";
        $anexo = Doo::db()->query($q4)->fetch();

        $pasajeros = Doo::db()->query("SELECT * FROM `pasajeros` WHERE id IN (SELECT id_pasajero FROM pasajeros_orden where id_orden = '$id')")->fetchAll();
        $data = array();
        
        $data["header"] = $header;
        $data["orden"] = $orden;
        $data["conductores"] = $conductores;
        $data["ordenesCondu"] = $ordenesCondu;
        $data["aplica_anexo"] = $anexo["aplica_anexo"];
        $data["anexo"] = $anexo["anexo"];
        $data["pasajeros"] = $pasajeros;
        //var_dump($data);
        //exit();
        return $data;
    }
    
    public function cancel(){
        $id_ord = filter_input(INPUT_POST, "id_ord");
        //$id_ord = $this->params["pindex"];      
        $fec = date('Y-m-d H:i:s');
        $q1 = "UPDATE ordenes_servicios SET estado='K', updated_at='$fec' WHERE id='$id_ord'";
        //echo $q1;
        Doo::db()->query($q1);
        $this->enviarCancelacion($id_ord);
        echo 'oka';
    }

    public function imprimir() {
        ob_start();
        $id = $this->params["pindex"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/OrdenServicio");
        $pdf = new OrdenServicio();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $url = $this->generarQR($id);
        $data = $this->dataPlanilla($id);
        $data["url"] = $url;
        $pdf->body($data);
        ob_end_clean();
        $pdf->Output("OrdenServicio$id.pdf", "I");
    }

    public function dataFactura($id) {
        //$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        $o = Doo::db()->query("SELECT fecha_fact,num_fact FROM ordenes_servicios WHERE id = '$id';")->fetch();   
        if($o["num_fact"] == "" || $o["num_fact"] == NULL || $o["num_fact"] == "0000"){
            $fec = date('Y-m-d');
            $rs = Doo::db()->query("SELECT cons_factura+1 AS c FROM parametros")->fetch();
            $num = $rs['c'];
            Doo::db()->query("UPDATE ordenes_servicios SET fecha_fact=?,num_fact=?,estado='F' WHERE id=?", array($fec, $num, $id));
            Doo::db()->query("UPDATE parametros SET cons_factura=cons_factura+1");
        }  

//        $q = 'SELECT CONCAT("# ",territorial," ",resolucion_hab," ",ano_hab," ",ano_actual) AS header FROM parametros WHERE id = 1';
//        $header = Doo::db()->query($q)->fetch();

        $q1 = "SELECT o.id,o.tipo,o.numero,o.objetoc,o.recorrido,co.numero AS contrato,o.id_cliente,c.tipo AS tipo_cliente,c.identificacion,o.barrio_o,o.barrio_d,o.clase_vehiculo,o.nhora,
        c.nombre AS cliente,c.celular,c.direccion,o.fecha,o.fecha_inicial,o.fecha_final,o.fecha_fact,o.num_fact,
        DATE_FORMAT(o.fecha_fact,'%Y/%m/%d') as expedida,DATE_FORMAT(DATE_ADD(o.fecha_fact,INTERVAL 30 DAY),'%Y/%m/%d') as vence,'".C_CIUDAD."' as ciudad,o.valor,SUM(op.valor) AS valor_paradas
        FROM ordenes_servicios o
        INNER JOIN clientes c ON (o.id_cliente = c.id)
        LEFT JOIN contactos con ON (con.id = o.id_contacto)
        INNER JOIN contratos co ON (c.id = co.id_cliente)       
        INNER JOIN ordenes_paradas op ON(o.id = op.id_servicio) 
        WHERE o.id = '$id' AND op.deleted = 0;";
        //exit($q1);
        Doo::db()->query("SET lc_time_names = 'es_CO';");
        $orden = Doo::db()->query($q1)->fetch();
          
        /*
         * 
         */
        
        $h = $orden["nhora"];
        $cn = $ce = 0;
        $b = 8;
        $t = 1;
        if ($h <= $b) {
            $cn = $b;
        } else {
            $ce = $h % $b;
            if ($ce <= 4) {
                $cn = $h - $ce;
                $t = $cn / $b;
            } else {
                $cn = $h - $ce + $b;
                $ce = 0;
                $t = $cn / $b;
            }
        }
        
        if($orden["tipo"] === "T" || $orden["tipo"] === "V"){
            $query = 'SELECT tarifa_transfer("S",'.$orden["id_cliente"].','.$orden["barrio_o"].', '.$orden["barrio_d"].', '.$orden["clase_vehiculo"].') AS valor,';  
            $query .='tarifa_transfer("N",'.$orden["id_cliente"].','.$orden["barrio_o"].', '.$orden["barrio_d"].', '.$orden["clase_vehiculo"].') AS valoro ,';          
             //$query .='ABS(transfer) AS porc_desc FROM contratos where id_cliente = '.$orden["id_cliente"].';';
            $query .='transfer AS porc_desc FROM contratos where id_cliente = '.$orden["id_cliente"].';';           
        }else{
            $query = 'SELECT tarifa_disponibilidad("S",'.$orden["id_cliente"].', '.$orden["clase_vehiculo"].', '.$cn.', '.$ce.') AS valor,';  
            $query .='tarifa_disponibilidad("N",'.$orden["id_cliente"].', '.$orden["clase_vehiculo"].', '.$cn.', '.$ce.') AS valoro ,';          
            //$query .='ABS(disponibilidad) AS porc_desc FROM contratos where id_cliente = '.$orden["id_cliente"].';';
            $query .='disponibilidad AS porc_desc FROM contratos where id_cliente = '.$orden["id_cliente"].';';
        }
        //exit($query);
        $rs = Doo::db()->query($query)->fetch();
        $valor_sin = $rs["valoro"];
        $valor_con = $rs["valor"];
        $porc_desc = $rs["porc_desc"];
        $valor_desc = $valor_sin * ($porc_desc/100);
        $items = array();
        $items[] = array("precio" => $valor_sin,"porc_desc" => $porc_desc,"valor_desc" => $valor_desc,"valor" => $valor_con);
//        exit($valor_sin . " -> ".$porc_desc." (".$valor_desc.") = ".$valor_con);
        /*
         * 
         */
        
        

        $data = array();
//        $data["header"] = $header;
        $data["orden"] = $orden;
        $data["items"] = $items;
        //var_dump($data);
        //exit();
        return $data;
    }

    public function factura() {
        $id = $this->params["pindex"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/Factura");
        $pdf = new Factura();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $data = $this->dataFactura($id);
        $pdf->body($data);
        $pdf->Output("Factura$id.pdf", "I");
    }

    public function generarQR($id) {
        Doo::loadClass("phpqrcode/phpqrcode");

        //$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . './docs/planillas/qrcodes' . DIRECTORY_SEPARATOR;
        $PNG_TEMP_DIR = 'global/docs/planillas/qrcodes' . DIRECTORY_SEPARATOR;
        //exit($PNG_TEMP_DIR);
        if (!file_exists($PNG_TEMP_DIR)) {
            mkdir($PNG_TEMP_DIR);
        }
        $filename = $PNG_TEMP_DIR . 'QR_' . $id . '.png';
        $errorCorrectionLevel = 'H';
        // array('L', 'M', 'Q', 'H')
        $matrixPointSize = 4;
        $url = Doo::conf()->APP_URL . 'fuec/' . $id;
        Doo::loadClass("GoogleURL");
        $api = new GoogleURL(C_GOOGLE_API_KEY);
        $url = $api->encode($url);
        if ($url === "") {
            $url = Doo::conf()->APP_URL . 'fuec/' . $id;
        }
        if (!file_exists($filename)) {
            QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        }
        return $url;
    }

    public function generarPDF($id) {
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/OrdenServicio");

        $pdf = new OrdenServicio();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $url = $this->generarQR($id);
        $data = $this->dataPlanilla($id);
        $data["url"] = $url;
        $pdf->body($data);
        $pdf->Output('global/docs/planillas/Planilla_' . $id . '.pdf', 'F');
        return $data["conductores"];
    }

    public function enviar($id_o = null) {
        if ($id_o !== null) {
            $id = $id_o;
        } else if (isset($this->params["pindex"])) {
            $id = $this->params["pindex"];
        }

        $cs = $this->generarPDF($id);

        Doo::loadHelper('DooMailer');
        $mail = new DooMailer();
        //$mail->addTo($cotizacion->email);
        $mail->addTo(C_EMAIL_AU); //copia
        foreach ($cs as $c) {
            if ($c["email"] !== "") {
            //    $mail->addTo($c["email"]);
            }
        }
        $mail->setSubject('Planilla');
        $body = '';
        $mail->setBodyHtml($body);
        $mail->setFrom(C_EMAIL2, C_TITLE);
        $mail->addTo(C_EMAIL2);
        //echo "Mensaje Enviado con Exito";
        $mail->addAttachment('global/docs/planillas/Planilla_' . $id . '.pdf');

        $mail->send();
        //Doo::db()->query("UPDATE ordenes_servicios SET status='E' WHERE id=?", array($id));
        //return Doo::conf()->APP_URL . "cotizaciones";
    }
    
    public function enviarAsignacion($id_ord, $id_con, $id_veh){
        Doo::loadHelper('DooMailer');
        $mail = new DooMailer();
        $mail->addTo(C_EMAIL_AU);
        $mail->setSubject('Asignación de Servicio');
        $sql = "SELECT o.numero,c.tipo AS c_tipo,c.nombre AS cliente,c.email,co.nombre AS contacto, co.email AS emailc, b1.nombre AS barrio_o, o.origen,o.tipo,
                b2.nombre AS barrio_d,cv.nombre AS clase_vehiculo,
                v.placa AS placa,v.marca, o.estado FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                INNER JOIN clases_vehiculos cv ON (o.clase_vehiculo=cv.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN contactos co ON (o.id_contacto = co.id)
                WHERE o.id = $id_ord";
        $rs = Doo::db()->query($sql)->fetch();        
        $body = $this->htmlAsignacion($rs);
        $mail->setBodyHtml($body);
        $mail->setFrom(C_EMAIL2, C_TITLE);
        //Destinos
        $mail->addTo(C_EMAIL2);
        //Si el cliente es juridico envia email al contacto, si no al cliente.
        if($rs["c_tipo"] == "J"){
            $mail->addTo($rs["emailc"]);
        }else{            
            $mail->addTo($rs["email"]);
        }                
        $mail->send();
    }
    
    public function enviarCancelacion($id_ord){
        Doo::loadHelper('DooMailer');
        $mail = new DooMailer();
        $mail->addTo(C_EMAIL_AU);
        $mail->setSubject('Cancelación de Servicio');
        $sql = "SELECT o.numero,c.tipo AS c_tipo,c.nombre AS cliente,c.email,co.nombre AS contacto, co.email AS emailc, b1.nombre AS barrio_o, o.origen,o.tipo,
                b2.nombre AS barrio_d,cv.nombre AS clase_vehiculo,
                v.placa AS placa,v.marca, o.estado FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                INNER JOIN clases_vehiculos cv ON (o.clase_vehiculo=cv.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN contactos co ON (o.id_contacto = co.id)
                WHERE o.id = $id_ord";
        $rs = Doo::db()->query($sql)->fetch();        
        $body = $this->htmlCancelacion($rs);
        $mail->setBodyHtml($body);
        $mail->setFrom(C_EMAIL2, C_TITLE);
        //Destinos
        $mail->addTo(C_EMAIL2);
        //Si el cliente es juridico envia email al contacto, si no al cliente.
        if($rs["c_tipo"] == "J"){
            $mail->addTo($rs["emailc"]);
        }else{            
            $mail->addTo($rs["email"]);
        }      
        $mail->send();
    }

    public function pendientes() {
        header('Content-Type: application/json');
        $login = $_SESSION['login'];
        $inc_time = "";
        if (null != filter_input(INPUT_GET, 'time')) {
            $inc_time = "AND o.created_at > '" . filter_input(INPUT_GET, 'time') . "'";
        }         
        $query = "SELECT o.id,o.tipo,o.id_cliente,c.nombre AS cliente,o.origen,o.destino,o.latitud_o,o.longitud_o, ";
        $query.= "o.barrio_o AS id_barrio_o,b1.nombre AS barrio_o,o.barrio_d AS id_barrio_d,";
        $query.= "b2.nombre AS barrio_d,o.clase_vehiculo,o.nhora,o.fecha,o.created_at ";
        $query.= "FROM ordenes_servicios o INNER JOIN usuarios u ON (o.id_usuario = u.id) INNER JOIN clientes c ON (o.id_cliente = c.id) LEFT JOIN barrios b1 ON (o.barrio_o = b1.id) ";
        $query.= "LEFT JOIN barrios b2 ON (o.barrio_d = b2.id) WHERE o.estado = 'P' ";
        $query.= "AND o.deleted = '0'  AND c.tipo != 'P' AND (u.tipo = 'A' OR u.tipo = 'C' OR u.tipo = 'CO') $inc_time ORDER BY o.created_at DESC";
        //exit($query);
        $ordenes = Doo::db()->query($query)->fetchAll();
        $response = array();

        if (count($ordenes) > 0) {
            $response['error'] = false;
            $response['fecha'] = $ordenes[0]["created_at"];
            $response['ordenes'] = $ordenes;
        } else {
            $response['error'] = true;
            $response['message'] = "No hay solicitudes nuevas";
            $response['ordenes'] = $ordenes;
        }
        echo json_encode($response);
    }
    
    public function cancelados() {
        header('Content-Type: application/json');
        $login = $_SESSION['login'];
        $inc_time = "";
        if (null != filter_input(INPUT_GET, 'time')) {
            $inc_time = "AND o.updated_at > '" . filter_input(INPUT_GET, 'time') . "'";
        }         
        $query = "SELECT o.id,o.tipo,o.id_cliente,c.nombre AS cliente,o.origen,o.destino,o.latitud_o,o.longitud_o, ";
        $query.= "o.barrio_o AS id_barrio_o,b1.nombre AS barrio_o,o.barrio_d AS id_barrio_d,";
        $query.= "b2.nombre AS barrio_d,o.clase_vehiculo,o.nhora,o.fecha,o.updated_at ";
        $query.= "FROM ordenes_servicios o INNER JOIN usuarios u ON (o.id_usuario = u.id) INNER JOIN clientes c ON (o.id_cliente = c.id) LEFT JOIN barrios b1 ON (o.barrio_o = b1.id) ";
        $query.= "LEFT JOIN barrios b2 ON (o.barrio_d = b2.id) WHERE o.estado = 'K' ";
        $query.= "AND o.deleted = '0'  AND c.tipo != 'P' AND (u.tipo = 'A' OR u.tipo = 'C' OR u.tipo = 'CO') $inc_time ORDER BY o.updated_at DESC";
//        exit($query);
        $ordenes = Doo::db()->query($query)->fetchAll();
        $response = array();

        if (count($ordenes) > 0) {
            $response['error'] = false;
            $response['fecha'] = $ordenes[0]["updated_at"];
            $response['ordenes'] = $ordenes;
        } else {
            $response['error'] = true;
            $response['message'] = "No hay solicitudes canceladas";
            $response['ordenes'] = $ordenes;
        }
        echo json_encode($response);
    }

    public function valor() {
        header('Content-Type: application/json');
        setlocale(LC_MONETARY, 'es_CO');
        switch (filter_input(INPUT_POST, "tipo")) {
            case 'D':
                if (null != filter_input(INPUT_POST, "id_cli") && null != filter_input(INPUT_POST, "nhora") && null != filter_input(INPUT_POST, "cl")) {
                    $id_cliente = filter_input(INPUT_POST, "id_cli");
                    $id_clase = filter_input(INPUT_POST, "cl");
                    $h = filter_input(INPUT_POST, "nhora");
                    $cn = $ce = 0;
                    $b = 8;
                    $t = 1;
//                    if ($h <= $b) {
//                        $cn = $b;
//                    } else {
//                        $ce = $h % $b;
//                        if ($ce <= 4) {
//                            $cn = $h - $ce;
//                            $t = $cn / $b;
//                        } else {
//                            $cn = $h - $ce + $b;
//                            $ce = 0;
//                            $t = $cn / $b;
//                        }
//                    }
                    if($h <= 8){
                        $cn = $h;
                    }else{
                        $ce = $h % $b;
                        $cn = $h - $ce;
                    }
                    //echo "Normal = $cn, Extras = $ce";
                    //exit();
                    //$query = 'SELECT vhoran * ' . $cn . ' + vhorae * ' . $ce . ' AS valor FROM clases_vehiculos WHERE id = ' . $id_clase;
                    $query = 'SELECT tarifa_disponibilidad("S",'.$id_cliente.', '.$id_clase.', '.$cn.', '.$ce.') AS valor, tarifa_disponibilidad("N",'.$id_cliente.', '.$id_clase.', '.$cn.', '.$ce.') AS valoro;';
                    $rs = Doo::db()->query($query)->fetch();
                }
                break;
            case 'T';
                if (null != filter_input(INPUT_POST, "id_cli") && null != filter_input(INPUT_POST, "b1") && null != filter_input(INPUT_POST, "b2") && null != filter_input(INPUT_POST, "cl")) {
                    $id_cliente = filter_input(INPUT_POST, "id_cli");
                    $b1 = filter_input(INPUT_POST, "b1");
                    $b2 = filter_input(INPUT_POST, "b2");
                    $id_clase = filter_input(INPUT_POST, "cl");
                    //$query = 'SELECT orden_valor(' . filter_input(INPUT_POST, "id_cli") . ', ' . filter_input(INPUT_POST, "b1") . ', ' . filter_input(INPUT_POST, "b2") . ', ' . filter_input(INPUT_POST, "cl") . ') AS valor;';
                    $query = 'SELECT tarifa_transfer("S",'.$id_cliente.','.$b1.', '.$b2.', '.$id_clase.') AS valor, tarifa_transfer("N",'.$id_cliente.','.$b1.', '.$b2.', '.$id_clase.') AS valoro ;';                                       
                    $rs = Doo::db()->query($query)->fetch();
                }
                break;
            default:
                $rs["valor"] = 0;
                break;
        }
        if(!isset($rs["valor"])){
            $rs["valor"] = 0; 
            $rs["error"] = true;   
        }
        echo json_encode($rs);
    }
    
    public function htmlAsignacion($data){
        $html = '<!doctype html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                
                <title>Responsive Email Template</title>

                <style type="text/css">
                    .ReadMsgBody {width: 100%; background-color: #ffffff;}
                    .ExternalClass {width: 100%; background-color: #ffffff;}
                    body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                    table {border-collapse: collapse;}

                    @media only screen and (max-width: 640px)  {
                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                        body[yahoo] .center {text-align: center!important;}  
                    }

                    @media only screen and (max-width: 479px) {
                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                        body[yahoo] .center {text-align: center!important;}  
                    }
                </style>
            </head>
            <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                <!-- Wrapper -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                        <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">                            

                            <!--Start Three Blocks-->
                            <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                <tr>
                                    <td width="100%" bgcolor="#f7f7f7" >
                                        <!-- Top  -->
                                        <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="center" > 
                                            <tr>
                                                <td  class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px; " >
                                                Su servicio fue asignado #'.$data["numero"].'                             
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                                    Cliente : '.$data["cliente"].'<br>
                                                    Contacto : '.$data["contacto"].'<br>
                                                    El servicio, '.$data["barrio_o"].' ('.$data["origen"].') - '.$data["barrio_d"].' fue asignado al vehiculo:<br>
                                                    Clase : '.$data["clase_vehiculo"].'<br>
                                                    Placa : '.$data["placa"].'<br>
                                                    Marca : '.$data["marca"].'<br>
                                                </td>
                                            </tr>
                                        </table><!--End Top-->
                                    </td>
                                </tr>
                            <!-- Footer -->
                            <table width="700"  border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                <tr>
                                    <td  class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 0px; " >
                                        Si tienes alguna duda comunícate al <a href="tel:035'.C_TEL.'" target="_blank">'.C_TEL.'</a> o escribe al correo <a href="mailto:'.C_EMAIL4.'" target="_blank">'.C_EMAIL4.'</a> siempre estamos dispuestos a atenderte.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px 50px; ">
                                        Copyright © Web And Net S.A.S 2016             
                                    </td>
                                </tr>
                            </table>
                            <!--End Footer-->

                            <div style="height:15px">&nbsp;</div><!-- divider-->


                        </td>
                    </tr>
                </table> 
                <!-- End Wrapper -->
            </body>
        </html>';
        return $html;
    }
    
    public function htmlCancelacion($data){
        $html = '<!doctype html>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                
                <title>Responsive Email Template</title>

                <style type="text/css">
                    .ReadMsgBody {width: 100%; background-color: #ffffff;}
                    .ExternalClass {width: 100%; background-color: #ffffff;}
                    body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                    table {border-collapse: collapse;}

                    @media only screen and (max-width: 640px)  {
                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                        body[yahoo] .center {text-align: center!important;}  
                    }

                    @media only screen and (max-width: 479px) {
                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                        body[yahoo] .center {text-align: center!important;}  
                    }
                </style>
            </head>
            <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                <!-- Wrapper -->
                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                    <tr>
                        <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">                            

                            <!--Start Three Blocks-->
                            <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                <tr>
                                    <td width="100%" bgcolor="#f7f7f7" >
                                        <!-- Top  -->
                                        <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="center" > 
                                            <tr>
                                                <td  class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px; " >
                                                El servicio #'.$data["numero"].' fue cancelado                             
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                                    Cliente : '.$data["cliente"].'<br>
                                                    Contacto : '.$data["contacto"].'<br>
                                                    El servicio, '.$data["barrio_o"].' ('.$data["origen"].') - '.$data["barrio_d"].' fue cancelado: <br>
                                                    Clase : '.$data["clase_vehiculo"].'<br>
                                                    Placa : '.$data["placa"].'<br>
                                                    Marca : '.$data["marca"].'<br>
                                                </td>
                                            </tr>
                                        </table><!--End Top-->
                                    </td>
                                </tr>


                            <!-- Footer -->
                            <table width="700"  border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                <tr>
                                    <td  class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 0px; " >
                                        Si tienes alguna duda comunícate al <a href="tel:035'.C_TEL.'" target="_blank">'.C_TEL.'</a> o escribe al correo <a href="mailto:'.C_EMAIL4.'" target="_blank">'.C_EMAIL4.'</a> siempre estamos dispuestos a atenderte.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px 50px; ">
                                        Copyright © Web And Net S.A.S 2016             
                                    </td>
                                </tr>
                            </table>
                            <!--End Footer-->

                            <div style="height:15px">&nbsp;</div><!-- divider-->


                        </td>
                    </tr>
                </table> 
                <!-- End Wrapper -->
            </body>
        </html>';
        return $html;
    }
    
    
    public function sendNotificaion(/*$tokens, $notification, $message*/) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        $fields = array(
            'priority' => 'high',
            'to' => "eGeH23tZxLA:APA91bEM_GHx55z-Y49Ku5qP3TGp8X9JCoM7PuJXjwt_BrqmuaDtQ3XRbPSlzH9TiQkh0qUKYJevCi5Ki02jtu8UaLH6WwJRYb9u6ebiOACBwC9H5KPc-OWB_z3eaGsYDSCylpZfX5yX",
            'notification' => array("body"=>"Hola mundo"),
            'data' =>  array("id"=>"1","longitud"=>"1223510","latitud"=>"121235115"),
        );
        $headers = array(
            'Authorization:key = AIzaSyCUTyaVRbxNXhoKMl79Nj9RytUeXHW6_is',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        echo json_encode($result) ;
    }
    

}
