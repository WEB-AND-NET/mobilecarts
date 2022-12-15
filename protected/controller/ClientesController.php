<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ClientesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["201"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $login = $_SESSION['login'];
        $rol = $login->role;
	$tipo = $login->tipo;

        if ($rol != "1" && $tipo!= "A") {
            $render = 'index_propietarios';
            $id_usuario = "AND id_usuario=$login->id_usuario";
            $tipo = "";
        } else {
            $render = 'index';
            $id_usuario = "";
            $tipo = "AND tipo != 'P'";
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT c.id,c.identificacion,c.nombre,c.celular,c.email,c.tipo, ct.archivoContrato FROM clientes c left join contratos ct on c.id = ct.id_cliente WHERE deleted=0 $tipo $id_usuario ORDER BY nombre ASC";
        $this->data['clientes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'clientes/list.php';
        $this->renderc($render, $this->data, true);
    }

    public function add() {
        Doo::loadModel("Clientes");

        $login = $_SESSION['login'];
        $rol = $login->role;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = new Clientes();
        $this->data['ccostos'] = array();
        $this->data['contactos'] = array();

        if ($rol != "1") {
            $this->data['content'] = 'clientes/from_propietario.php';
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->data['content'] = 'clientes/from.php';
            $this->renderc('index', $this->data, true);
        }
    }
    
    public function add2() {
        Doo::loadModel("Clientes");
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = new Clientes();
        $this->data['ccostos'] = array();
//        $this->data['contactos'] = array();
        $this->data['propietarios'] =   Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['content'] = 'clientes/from_propietario.php';
        $this->renderc('index_propietarios', $this->data, true);
       
    }

    public function edit() {
        $id = $this->params["pindex"];

        $login = $_SESSION['login'];
        $rol = $login->role;

        $Clientes = Doo::db()->find("Clientes", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = $Clientes;
        $query = "SELECT id,numero,nombre FROM centros_costos WHERE id_cliente = '$id' AND deleted = 0";
        $list_ccostos = Doo::db()->query($query)->fetchAll();
        $this->data['ccostos'] = $list_ccostos;
        $_SESSION["list_ccostos"] = serialize($list_ccostos);
//        $query2 = "SELECT c.id,c.id_cliente,c.id_centrocosto,cc.nombre AS centrocosto,c.identificacion,c.nombre,c.cargo,c.telefono,";
//        $query2.= "c.celular,c.direccion,c.email,c.deleted FROM contactos c INNER JOIN centros_costos cc ON (c.id_centrocosto = cc.id) WHERE c.id_cliente = '$id'";
//        $list_contactos = Doo::db()->query($query2)->fetchAll();
//        $_SESSION["list_contactos"] = serialize($list_contactos);
        if ($rol != "1") {
            $this->data['content'] = 'clientes/from_propietario.php';
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->data['content'] = 'clientes/from.php';
            $this->renderc('index', $this->data, true);
        }
    }
    
    public function edit_contrato() {
        $id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;        
        $this->data['cliente'] = Doo::db()->find("Clientes", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['contrato'] = Doo::db()->find("Contratos", array('where' => 'id_cliente = ?', 'limit' => 1, 'param' => array($id))); 
        $this->data['clases_v'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['tarifas'] = Doo::db()->find("TarifasTransfers", array("select" => "id,nombreo,nombred", "asc" => "id"));
        
         $sql = "SELECT v.id,cv.nombre AS clase,v.placa,v.modelo,v.marca,p.razon_social AS propietario ";
        $sql.= " FROM vehiculos v INNER JOIN clases_vehiculos cv ON (cv.id = v.id_clase) INNER JOIN propietarios p ON (v.id_propietario = p.id) WHERE v.deleted=0 ORDER BY v.placa asc";
        $this->data['vehiculos'] = Doo::db()->query($sql)->fetchAll();
        
        /*$sql = "SELECT tc.id,tc.id_tarifa,tt.nombreo,tt.nombred,tc.id_clase_vehiculo,cv.nombre AS clase,tc.id_cliente,tc.valor 
                FROM tarifas_transfers_custom tc 
                INNER JOIN tarifas_transfers tt ON (tc.id_tarifa = tt.id)
                INNER JOIN clases_vehiculos cv ON (tc.id_clase_vehiculo = cv.id)
                WHERE tc.id_cliente = $id";
        
        $tarifas = Doo::db()->query($sql)->fetchAll();
        
        // Creacion de seccion para agregar tarifas
        $_SESSION["list_tarifas"] = serialize($tarifas);       
        if (isset($_SESSION["list_tarifas_del"])) {
            $_SESSION["list_tarifas_del"] = null;
        }*/
        
        $this->data['content'] = 'clientes/contrato.php';
        $this->renderc('index', $this->data, true);        
    }   
    
    //
    public function getVehiculosContrato(){
        $id = $_GET["id_cliente"];
        $sql = "SELECT v.id,cv.nombre AS clase,v.placa,v.modelo,v.marca,p.razon_social AS propietario ";
        $sql.= " FROM vehiculos v INNER JOIN clases_vehiculos cv ON (cv.id = v.id_clase) INNER JOIN propietarios p ON (v.id_propietario = p.id) WHERE v.deleted=0 and v.id in (select id_vehiculo from cliente_vehiculos where id_cliente = '$id') ORDER BY v.placa asc";
        $datos = Doo::db()->query($sql)->fetchAll();
        if(!$datos){
            $datos = [];
        }
        $data=array("data"=>$datos);
        echo json_encode($data);
    }
    public function addVehiculoContrato(){
        Doo::loadModel("ClienteVehiculos");
        $cv = new ClienteVehiculos($_POST);
        if ($cv->id == "") {
            $cv->id = Null;
        }
        if ($cv->id == Null) {
            $cv->id = Doo::db()->Insert($cv);
        } else {
            Doo::db()->Update($cv);
        }
    }
    
    /*public function loadTarifas(){
        if (isset($_SESSION["list_tarifas"])) {
            $array = unserialize($_SESSION["list_tarifas"]);
        } else {
            $array = array();
        }

        $this->data['items'] = $array;

        $this->renderc("clientes/items", $this->data, true);
    }*/
    
    public function paginateTarifas() {
        
        $id = $this->params["pindex"];
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        //SELECT id, nombre, clase, valor FROM tarifas_personalizadas WHERE id_cliente = 27;
        $aColumns = array('id', 'nombre', 'clase', 'valor');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "view_tarifas_personalizadas";

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
//		$sLimit = "LIMIT ".mysql_real_escape_string( $_POST['iDisplayStart'] ).", ".
//			mysql_real_escape_string( $_POST['iDisplayLength'] );
            $sLimit = "LIMIT " . $_POST['iDisplayStart'] . ", " .
                    $_POST['iDisplayLength'];
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
				 	" . $_POST['sSortDir_' . $i] . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
         $sWhere = "WHERE id_cliente = $id ";
        if ($_POST['sSearch'] != "") {
            //$sWhere = "WHERE id_cliente = $id AND (";
            $sWhere = "WHERE id_cliente = $id AND (";

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
		$sLimit
	";

        $tarifas = Doo::db()->query($sQuery)->fetchAll();

//        $total = Doo::db()->query("SELECT count(id) AS total FROM $sTable $sWhere")->fetch();        
//        $nTotal = $total["total"];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(" . $sIndexColumn . ") AS total 
		FROM $sTable $sWhere
	";

        $total = Doo::db()->query($sQuery)->fetch();
        $iTotal = $total["total"];


        $aaData = array();

        foreach ($tarifas as $row) {
            $aaData[] = array(   
                //$row['id'],
                $row['nombre'],
                $row['clase'],
                $row['valor'],
                $row['id']
            );
        }

        $aa = array(
            'sEcho' => $_POST['sEcho'],
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => $aaData);

        echo json_encode($aa);
    }
    
    public function updateTarifa(){
        /*
        if (isset($_SESSION["list_tarifas"])) {
            $array = unserialize($_SESSION["list_tarifas"]);
            $array[$_POST['index'] - 1]["valor"] = $_POST['valor'];
        }else{
            $array = array();
        }
        
        $_SESSION["list_tarifas"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("clientes/items", $this->data, true);         
         */
    }
    
    public function deleteTarifa(){
        /*
        if (isset($_SESSION["list_tarifas"])) {
            $array = unserialize($_SESSION["list_tarifas"]);
        }
        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_tarifas_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_tarifas_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }
        $_SESSION["list_tarifas_del"] = serialize($itemsBorrar);
        $_SESSION["list_tarifas"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("clientes/items", $this->data, true);
        */
        if(isset($_POST['index'])){
            $id = $_POST['index'];
            $del = Doo::db()->find("TarifasTransfersCustom", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
            if($del != null){
                Doo::db()->delete($del);
                echo "Item eliminado.!";
            }    
        }            
    }

//    public function insertTarifa(){
//        Doo::loadModel("TarifasTransfersCustom");
//        $t = new TarifasTransfersCustom($_POST);                        
//
//        $rst = Doo::db()->query("SELECT nombreo,nombred FROM tarifas_transfers WHERE id = '$t->id_tarifa'")->fetch();
//        $rsc = Doo::db()->query("SELECT nombre FROM clases_vehiculos WHERE id = '$t->id_clase_vehiculo'")->fetch();
//        
//        $response = array('id' => '', 'id_tarifa' => $t->id_tarifa, 'nombreo' => $rst['nombreo'],
//            'nombred' => $rst['nombred'], 'id_clase_vehiculo' => $t->id_clase_vehiculo, 'clase' => $rsc['nombre'],
//            'id_cliente' => $t->id_cliente, 'valor' => $t->valor);
//        
//        if (isset($_SESSION["list_tarifas"])) {
//            $array = unserialize($_SESSION["list_tarifas"]);
//            $array[] = $response;
//        } else {
//            $array = array();
//        }
//        
//        $_SESSION["list_tarifas"] = serialize($array);
//
//        $this->data['items'] = $array;
//
//        $this->renderc("clientes/items", $this->data, true);
//    }        
    
    public function save() {
        Doo::loadModel("Clientes");
        Doo::loadModel("Contratos");
        //var_dump($_POST);
        //exit(0);
        $clientes = new Clientes($_POST);
        if ($clientes->id == "") {
            $clientes->id = Null;
        }
        $clientes->deleted = "0";

        $login = $_SESSION['login'];
        $id_usuario = $login->id_usuario;
        $rol = $login->role;
        
        if ($clientes->id == Null) {
            /**
             * 
             */
            if($clientes->tipo == "P"){
                $clientes->id_usuario = $_POST["id_propietario"];
            }else{
                $clientes->id_usuario = $id_usuario;
            }
            /*
             * 
             */
//            $clientes->id_usuario = $id_usuario;
            $clientes->created_at = date('Y-m-d H:i:s');
            $clientes->updated_at = date('Y-m-d H:i:s');
            //$clientes->password = md5('12345678');            
            $clientes->password = md5($clientes->identificacion);
            $clientes->id = Doo::db()->Insert($clientes);
            //Guardar Contrato
            /*
              $contrato = new Contratos();
              $contrato->id = Null;
              $contrato->id_cliente = $clientes->id;
              $rs = Doo::db()->query("SELECT cons_contrato+1 AS c FROM parametros")->fetch();
              $contrato->numero = $rs['c'];
              Doo::db()->query("UPDATE parametros SET cons_contrato=cons_contrato+1");
              Doo::db()->Insert($contrato);
             * 
             */
        } else {
            //$clientes->id_usuario = $id_usuario;
            $clientes->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($clientes);
        }
      
        
        if ($rol != "1") {
//            $this->data['rootUrl'] = Doo::conf()->APP_URL;
//            $this->data['content'] = 'clientes/from_propietario.php';
//            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->saveItems($clientes->id);
            $this->clean();
            //return Doo::conf()->APP_URL . "clientes";
        }  
        return Doo::conf()->APP_URL . "clientes";
    }
    
    public function save_contrato(){
        Doo::loadModel("Contratos");
        Doo::loadHelper('DooFile');
        $contrato = new Contratos($_POST);
        
        
        if($contrato->id != null) {    
            
            if ($_FILES["archivoContrato"]["name"] != "") {
                $name = $_FILES["archivoContrato"]["name"];
                $gd2 = new DooFile();
                $ext = end((explode(".", $name)));

                $img = $gd2->upload(Doo::conf()->DOC . 'CopiasContratos/', "archivoContrato", "Contrato" . $contrato->id);
                $name = "Contrato" . $contrato->id .'.'. $ext;
                $contrato->archivoContrato = $name;
            }
            else{
                $contrato->archivoContrato = $_POST["archivo"];
            }
            Doo::db()->Update($contrato);
            
            
            /*
            if (isset($_SESSION["list_tarifas"])) {
                Doo::loadModel("TarifasTransfersCustom");
                $array = unserialize($_SESSION["list_tarifas"]);
                foreach ($array as $t){
                    $id = $t["id_tarifa"];
                    $valor = $t["valor"];
                    //Doo::db()->query("UPDATE tarifas_transfers_custom SET valor=? WHERE id=?", array($valor,$id));
                    $upd = new TarifasTransfersCustom($t);
                    Doo::db()->update($upd);
                }
            }
            
            if (isset($_SESSION["list_tarifas_del"])) {
                Doo::loadModel("TarifasTransfersCustom");
                $array = unserialize($_SESSION["list_tarifas_del"]);
                foreach ($array as $t){
                    $del = new TarifasTransfersCustom($t);
                    Doo::db()->delete($del);
                }
            }                
            */                     
        }
        /*
        if (isset($_SESSION["list_tarifas"])) {
            $_SESSION["list_tarifas"] = null;
        }
        if (isset($_SESSION["list_tarifas_del"])) {
            $_SESSION["list_tarifas_del"] = null;
        }
         */
        return Doo::conf()->APP_URL . "clientes";
    }

    public function savetemporal() {
        Doo::loadModel("CentrosCostos");
        Doo::loadModel("Clientes");

        $login = $_SESSION['login'];
        $id_usuario = $login->id_usuario;

        if (filter_input(INPUT_POST, "id") === "") {
            // Guardar Clientes
            $cliente = new Clientes();
            //$clientes->id = Null;
            $cliente->id_usuario = $id_usuario;
            $cliente->identificacion = filter_input(INPUT_POST, "identificacion");
            $cliente->nombre = filter_input(INPUT_POST, "nombre");
            $cliente->celular = filter_input(INPUT_POST, "celular");
            $cliente->email = filter_input(INPUT_POST, "email");
            $cliente->password = md5(filter_input(INPUT_POST, "identificacion"));
            $cliente->tipo = filter_input(INPUT_POST, "tipo");
            $cliente->created_at = date('Y-m-d H:i:s');
            $cliente->updated_at = date('Y-m-d H:i:s');
            $idcliente = Doo::db()->Insert($cliente);
        } else {
            $idcliente = filter_input(INPUT_POST, "id");
        }
        // Guardar Centro de costo
        $ccosto = new CentrosCostos();
        $ccosto->id_cliente = $idcliente;
        $ccosto->nombre = filter_input(INPUT_POST, "nombrecc");
        $ccosto->numero = filter_input(INPUT_POST, "numero");
        Doo::db()->Insert($ccosto);

        $r = Doo::db()->query("SELECT id,numero,nombre FROM centros_costos WHERE id_cliente = '$idcliente' AND deleted=0")->fetchAll();
        $data = array();
        $data["id_cliente"] = $idcliente;
        $data["ccostos"] = $r;
        echo json_encode($data);
    }

    public function saveItems($id_cli) {
        Doo::loadModel("CentrosCostos");
        Doo::loadModel("Contactos");
        //Elimina los centros costos del cliente
        if (isset($_SESSION["list_ccostos_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_ccostos_del"]);
            foreach ($itemsBorrar as $i) {
                //$eliminar = true;
                //if ($rp->id == $i['id']) {
                //    $eliminar = false;
                //}
                //if ($eliminar) {
                Doo::db()->query("UPDATE centros_costos SET deleted=1 WHERE id=?", array($i['id']));
                //}
            }
            $_SESSION["list_ccostos_del"] = null;
        }
        // Guardar los centro costos del cliente                
        if (isset($_SESSION["list_ccostos"])) {
            $array = unserialize($_SESSION["list_ccostos"]);
            foreach ($array as $item) {
                $cc = new CentrosCostos($item);
                if (isset($cc->id) && !empty($cc->id)) {
                    
                } else {
                    $cc->id = null;
                    //$cc->deleted = 0;
                    $cc->id_cliente = $id_cli;
                    //$rp->estado_r = 1;
                    Doo::db()->insert($cc);
                }
            }
            $_SESSION["list_ccostos"] = null;
        }
        // Guardar los contactos del cliente                
//        if (isset($_SESSION["list_contactos"])) {
//            $array = unserialize($_SESSION["list_contactos"]);
//            foreach ($array as $item) {
//                $c = new Contactos($item);
//                if (isset($c->id) && !empty($c->id)) {
//                    
//                } else {
//                    $c->id = null;
//                    //$cc->deleted = 0;
//                    $c->id_cliente = $id_cli;
//                    //$rp->estado_r = 1;
//                    $c->created_at = $c->updated_at = date('Y-m-d H:i:s');
//
//                    Doo::db()->insert($c);
//                }
//            }
//            $_SESSION["list_contactos"] = null;
//        }
    }

    /* public function insert() {
      $cc_numero = $_POST["cc_numero"];
      $nombre = $_POST["nombre"];


      $response = array('id' => '','id_conductor' => $rs['id'], 'nombre' => $rs['nombre'], 'celular' => $rs['celular'], 'direccion' => $rs['direccion'], 'email' => $rs['email']);

      if (isset($_SESSION["list_ccostos"])) {
      $array = unserialize($_SESSION["list_ccostos"]);
      $array[] = $response;
      } else {
      $array[] = $response;
      }
      $_SESSION["list_ccostos"] = serialize($array);

      //$this->data['items'] = $array;

      //$this->renderc("vehiculos/items", $this->data, true);
      } */

    function load() {
        if (isset($_SESSION["list_ccostos"])) {
            $array = unserialize($_SESSION["list_ccostos"]);
        } else {
            $array = null;
        }
        //$this->data['items'] = $array;
        //$this->renderc("vehiculos/items", $this->data, true);
    }

    public function deleteitem() {

        $id = filter_input(INPUT_POST, "index");
        $count1 = Doo::db()->query("SELECT * FROM contactos WHERE `id_centrocosto` = $id AND deleted = 0")->rowCount();

        if ($count1 > 0) {
            echo true;
        } else {
            Doo::db()->query("UPDATE  centros_costos SET deleted=1 WHERE id = $id");

//            $r = Doo::db()->query("SELECT id,numero,nombre FROM centros_costos WHERE deleted=0")->fetchAll();
//            echo json_encode($r);

            echo false;
        }

//        return Doo::conf()->APP_URL . "clientes";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE clientes SET deleted=1 WHERE id=?", array($id));        
        Doo::db()->query("UPDATE usuarios SET deleted=1 WHERE tipo = 'C' AND id_usuario=?", array($id));
        return Doo::conf()->APP_URL . "clientes";
    }

    public function validar() {
        $tipo = $_POST["tipo"];
        if($tipo === "NJ"){
            $inc_tipo = "(tipo = 'N' OR tipo = 'J')";
        }else{
            $inc_tipo = "tipo = '$tipo'";
        }
        $identificacion = $_POST["ced"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from clientes where $inc_tipo AND identificacion = '$identificacion' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    public function validarcosto() {
        $numero = $_POST["num"];
//        $idcliente = $_POST["idcliente"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from centros_costos where deleted = 0 AND numero = '$numero'  AND id_cliente = '$id' ")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    public function posiciones() {
        $clientes = Doo::db()->find("Clientes", array("select" => "id,nombre,latitud,longitud", "acs" => "nombre", "where" => "deleted=0"));
        echo $clientes;
    }

    public function ccostos() {
        $response = array();
        if (filter_input(INPUT_POST, "id_c") !== null) {
            $id_c = filter_input(INPUT_POST, "id_c");
            if ($id_c !== "") {
                $response = Doo::db()->query("SELECT id,numero,nombre FROM centros_costos WHERE deleted=0 AND id_cliente=$id_c")->fetchAll();
            }
        }
        echo json_encode($response);
    }

    public function contactos() {
//
//        if (isset($_SESSION["list_contactos"])) {
//            $response = unserialize($_SESSION["list_contactos"]);
//            //$response[] = $insert;
//        } else {
//            //$response[] = $insert;
//            $response = array();
//        }
        //{c_nombre: $('#c_nombre').val(),c_cargo: $('#c_cargo').val(),c_ccosto: $('#c_ccosto').val(),c_celular: $('#c_celular').val()},
        $response = "NO";
        if (isset($_POST["c_ccosto"]) && isset($_POST["c_identificacion"]) && isset($_POST["c_nombre"])) {
            $id = $_POST["c_id"];
            $id_cliente = $_POST["id_cliente"];
            $ccos = $_POST["c_ccosto"];
            $ccos_des = $_POST["c_ccosto_des"];
            $ide = $_POST["c_identificacion"];
            $nom = $_POST["c_nombre"];
            $car = $_POST["c_cargo"];
            $tel = $_POST["c_telefono"];
            $cel = $_POST["c_celular"];
            $dir = $_POST["c_direccion"];
            $ema = $_POST["c_email"];
//            $insert = array('id' => '', 'id_cliente' => '', 'id_centrocosto' => $ccos, 'centrocosto' => $ccos_des, 'identificacion' => $ide, 'nombre' => $nom, 'cargo' => $car, 'telefono' => $tel, 'celular' => $cel, 'direccion' => $dir, 'email' => $ema);
//            $response[] = $insert;
            
            if($id != "" && $id != null){
                $c = Doo::db()->find("Contactos", array('where' => 'id = ? AND id_cliente = ?', 'limit' => 1, 'param' => array($id, $id_cliente)));
                $c->id_centrocosto = $ccos;
                $c->identificacion = $ide;
                $c->nombre = $nom;
                $c->cargo = $car;
                $c->telefono = $tel;
                $c->celular = $cel;
                $c->email = $ema;
                $c->direccion = $dir;
                $c->updated_at = date('Y-m-d H:i:s');
                Doo::db()->update($c);
            }else{
                Doo::loadModel("Contactos");
                $c = new Contactos();
                $c->id = NULL;
                $c->id_cliente = $id_cliente;
                $c->id_centrocosto = $ccos;
                $c->identificacion = $ide;
                $c->nombre = $nom;
                $c->cargo = $car;
                $c->telefono = $tel;
                $c->celular = $cel;
                $c->email = $ema;
                $c->direccion = $dir;
                $c->deleted = 0;
                $c->created_at = date('Y-m-d H:i:s');
                $c->updated_at = date('Y-m-d H:i:s');
                Doo::db()->insert($c);
            }                       
            $response = "OKA";
        }

//        $_SESSION["list_contactos"] = serialize($response);
        echo json_encode($response);
    }
    
    public function desactivarContacto(){       
        if(isset($_POST["id_contacto"]) && !empty($_POST["id_contacto"])){
            $id = $_POST["id_contacto"];
            Doo::db()->query("UPDATE contactos SET deleted=1 WHERE id=?", array($id));        
            Doo::db()->query("UPDATE usuarios SET deleted=1 WHERE tipo = 'CO' AND id_usuario=?", array($id));
        }        
    }
    
    public function activarContacto(){
        if(isset($_POST["id_contacto"]) && !empty($_POST["id_contacto"])){
            $id = $_POST["id_contacto"];
            Doo::db()->query("UPDATE contactos SET deleted=0 WHERE id=?", array($id));        
            Doo::db()->query("UPDATE usuarios SET deleted=0 WHERE tipo = 'CO' AND id_usuario=?", array($id));
        }        
    }

    function clean() {
        if (isset($_SESSION["list_ccostos"])) {
            $_SESSION["list_ccostos"] = null;
        }
//        if (isset($_SESSION["list_contactos"])) {
//            $_SESSION["list_contactos"] = null;
//        }
    }
    
    public function paginate() {
        $id = $this->params["pindex"];
//        echo $id;
//        exit($id);
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         *///select c.id,c.identificacion,c.nombre,c.cargo,cc.nombre AS centrocosto,c.celular,c.deleted 
     //   SELECT c.id,cc.nombre AS centrocosto,c.identificacion,c.nombre,c.cargo,
     //   c.celular,c.deleted FROM contactos c INNER JOIN centros_costos cc ON (c.id_centrocosto = cc.id) WHERE c.id_cliente = 27
        $aColumns = array('c.id', 'c.identificacion', 'c.nombre', 'c.cargo', 'cc.nombre AS centrocosto', 'c.celular', 'c.deleted' );

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "c.id";

        /* DB table to use */
        $sTable = "contactos c INNER JOIN centros_costos cc ON (c.id_centrocosto = cc.id) ";

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
//		$sLimit = "LIMIT ".mysql_real_escape_string( $_POST['iDisplayStart'] ).", ".
//			mysql_real_escape_string( $_POST['iDisplayLength'] );
            $sLimit = "LIMIT " . $_POST['iDisplayStart'] . ", " .
                    $_POST['iDisplayLength'];
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    if(intval($_POST['iSortCol_' . $i]) !== 4){
                        $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
                        " . $_POST['sSortDir_' . $i] . ", ";                    
                    }else{
                        $sOrder .= "cc.nombre" . "
				 	" . $_POST['sSortDir_' . $i] . ", ";
                    }
                    //Codigo original
//                    $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
//                        " . $_POST['sSortDir_' . $i] . ", ";   
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        //custom code
//        else{
//            $sOrder = "ORDER BY c.nombre ASC";
//        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "WHERE c.id_cliente = $id ";
        if ($_POST['sSearch'] != "") {
            //$sWhere = "WHERE c.id_cliente = $id AND (";
            $sWhere = "WHERE c.id_cliente = $id AND (";

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
		$sLimit
	";
//        echo($sQuery);
//        exit($sQuery);
        $tarifas = Doo::db()->query($sQuery)->fetchAll();

//        $total = Doo::db()->query("SELECT count(id) AS total FROM $sTable $sWhere")->fetch();        
//        $nTotal = $total["total"];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(" . $sIndexColumn . ") AS total 
		FROM $sTable $sWhere
	";
       
        $total = Doo::db()->query($sQuery)->fetch();
        $iTotal = $total["total"];


        $aaData = array();
//  array('c.id', 'c.identificacion', 'c.nombre', 'c.cargo', 'cc.nombre AS centrocosto', 'c.celular', 'c.deleted' );
        foreach ($tarifas as $row) {
            $aaData[] = array(
                $row['id'],
                $row['identificacion'],
                $row['nombre'],
                $row['cargo'],
                $row['centrocosto'],
                $row['celular'],
                $row['deleted'],
                $row['id'],
                $row['id'],
                $row['id']
            );
        }

        $aa = array(
            'sEcho' => $_POST['sEcho'],
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => $aaData);

        echo json_encode($aa);
    }
    
    public function edit_contacto(){
        $id_cliente = $_POST["id_cliente"];
        $id_contacto = $_POST["id_contacto"] ;
        $contacto = Doo::db()->find("Contactos", array('where' => 'id = ? AND id_cliente = ?', 'limit' => 1, 'param' => array($id_contacto, $id_cliente)));
        echo json_encode($contacto);        
    }

}
