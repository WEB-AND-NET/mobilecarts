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

        if ($rol != "1") {
            $render = 'index_propietarios';
            $id_usuario = "AND id_usuario=$login->id_usuario";
            $tipo = "";
        } else {
            $render = 'index';
            $id_usuario = "";
            $tipo = "AND tipo != 'P'";
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT id,identificacion,nombre,celular,email,tipo FROM clientes WHERE deleted=0 $tipo $id_usuario ORDER BY nombre ASC";
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
        $this->data['contactos'] = array();
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
        $query2 = "SELECT c.id,c.id_cliente,c.id_centrocosto,cc.nombre AS centrocosto,c.identificacion,c.nombre,c.cargo,c.telefono,";
        $query2.= "c.celular,c.direccion,c.email,c.deleted FROM contactos c INNER JOIN centros_costos cc ON (c.id_centrocosto = cc.id) WHERE c.id_cliente = '$id'";
        $list_contactos = Doo::db()->query($query2)->fetchAll();
        //$this->data['contactos'] = $list_contactos;
        $_SESSION["list_contactos"] = serialize($list_contactos);
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
        
        $sql = "SELECT tc.id,tc.id_tarifa,tt.nombreo,tt.nombred,tc.id_clase_vehiculo,cv.nombre AS clase,tc.id_cliente,tc.valor 
                FROM tarifas_transfers_custom tc 
                INNER JOIN tarifas_transfers tt ON (tc.id_tarifa = tt.id)
                INNER JOIN clases_vehiculos cv ON (tc.id_clase_vehiculo = cv.id)
                WHERE tc.id_cliente = $id";
        
        $tarifas = Doo::db()->query($sql)->fetchAll();
        
        // Creacion de seccion para agregar tarifas
        $_SESSION["list_tarifas"] = serialize($tarifas);       
        if (isset($_SESSION["list_tarifas_del"])) {
            $_SESSION["list_tarifas_del"] = null;
        }
        
        $this->data['content'] = 'clientes/contrato.php';
        $this->renderc('index', $this->data, true);        
    }   
    
    public function loadTarifas(){
        if (isset($_SESSION["list_tarifas"])) {
            $array = unserialize($_SESSION["list_tarifas"]);
        } else {
            $array = array();
        }

        $this->data['items'] = $array;

        $this->renderc("clientes/items", $this->data, true);
    }
    
    public function updateTarifa(){
        if (isset($_SESSION["list_tarifas"])) {
            $array = unserialize($_SESSION["list_tarifas"]);
            $array[$_POST['index'] - 1]["valor"] = $_POST['valor'];
        }else{
            $array = array();
        }
        
        $_SESSION["list_tarifas"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("clientes/items", $this->data, true);
    }
    
    public function deleteTarifa(){
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
        $contrato = new Contratos($_POST);
        if($contrato->id != null) {          
            Doo::db()->Update($contrato);
            
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
        }
        if (isset($_SESSION["list_tarifas"])) {
            $_SESSION["list_tarifas"] = null;
        }
        if (isset($_SESSION["list_tarifas_del"])) {
            $_SESSION["list_tarifas_del"] = null;
        }
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
        if (isset($_SESSION["list_contactos"])) {
            $array = unserialize($_SESSION["list_contactos"]);
            foreach ($array as $item) {
                $c = new Contactos($item);
                if (isset($c->id) && !empty($c->id)) {
                    
                } else {
                    $c->id = null;
                    //$cc->deleted = 0;
                    $c->id_cliente = $id_cli;
                    //$rp->estado_r = 1;
                    $c->created_at = $c->updated_at = date('Y-m-d H:i:s');

                    Doo::db()->insert($c);
                }
            }
            $_SESSION["list_contactos"] = null;
        }
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
        $count1 = Doo::db()->query("select * from centros_costos where numero = '$numero'  AND id_cliente = '$id' ")->rowCount();
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

        if (isset($_SESSION["list_contactos"])) {
            $response = unserialize($_SESSION["list_contactos"]);
            //$response[] = $insert;
        } else {
            //$response[] = $insert;
            $response = array();
        }
        //{c_nombre: $('#c_nombre').val(),c_cargo: $('#c_cargo').val(),c_ccosto: $('#c_ccosto').val(),c_celular: $('#c_celular').val()},
        if (isset($_POST["c_ccosto"]) && isset($_POST["c_identificacion"]) && isset($_POST["c_nombre"])) {
            $ccos = $_POST["c_ccosto"];
            $ccos_des = $_POST["c_ccosto_des"];
            $ide = $_POST["c_identificacion"];
            $nom = $_POST["c_nombre"];
            $car = $_POST["c_cargo"];
            $tel = $_POST["c_telefono"];
            $cel = $_POST["c_celular"];
            $dir = $_POST["c_direccion"];
            $ema = $_POST["c_email"];
            $insert = array('id' => '', 'id_cliente' => '', 'id_centrocosto' => $ccos, 'centrocosto' => $ccos_des, 'identificacion' => $ide, 'nombre' => $nom, 'cargo' => $car, 'telefono' => $tel, 'celular' => $cel, 'direccion' => $dir, 'email' => $ema);
            $response[] = $insert;
        }

        $_SESSION["list_contactos"] = serialize($response);
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
        if (isset($_SESSION["list_contactos"])) {
            $_SESSION["list_contactos"] = null;
        }
    }

}
