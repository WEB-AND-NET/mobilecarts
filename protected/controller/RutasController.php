<?php

/**
 * Description of RutasController
 *
 * @author web
 */
class RutasController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["205"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT r.id,r.tipo,r.numero,r.nombre,z1.nombre AS Zona_origen,z2.nombre AS Zona_destino,r.id_contrato
        FROM rutas r
        INNER JOIN zonas z1 ON (r.zona_origen = z1.id)
        INNER JOIN zonas z2 ON (r.zona_destino = z2.id)
        WHERE r.deleted = 0";
        $this->data['rutas'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'rutas/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Rutas");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['rutas'] = new Rutas();
        $this->data['zona'] = Doo::db()->find("Zonas", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data["clientes"]=array();
        $this->data['content'] = 'rutas/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $ruta = Doo::db()->find("Rutas", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['rutas'] = $ruta;
        $this->data['selected'] = $ruta->id_contrato;
        $this->data['zona'] = Doo::db()->find("Zonas", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data["clientes"]=array();
        $this->data['content'] = 'rutas/from.php';
        $this->renderc('index', $this->data);
    }
    
    public function tarifas(){
        $id = $this->params["pindex"];        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ruta'] = Doo::db()->find("Rutas", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['clases'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "asc" => "nombre"));
        $sql = "SELECT t.id,t.id_ruta,t.id_clase,cv.nombre AS clase,t.valor FROM tarifas t INNER JOIN clases_vehiculos cv ON (cv.id = t.id_clase) WHERE t.id_ruta = $id AND t.deleted = 0";        
        $tarifas = Doo::db()->query($sql)->fetchAll();
        $_SESSION["tarifas_items"] = serialize($tarifas);
        //$this->data['tarifas_items'] = $tarifas;
        $this->data['content'] = 'rutas/from_tarifa.php';
        $this->renderc('index', $this->data);
    }
    
    public function listBarrios(){
        header('Content-Type: application/json');
        $id_z = filter_input(INPUT_POST, "id_z");
        $sql = "SELECT GROUP_CONCAT(b.nombre SEPARATOR ', ') AS barrios FROM barrios b INNER JOIN zonas z ON (z.id = b.id_zona) WHERE z.id = $id_z";
        $rs = Doo::db()->query($sql)->fetch();
        if($rs["barrios"] === null){
            echo json_encode("No se encontraron Barrios en esta Zona.");
        }else{
            echo json_encode($rs["barrios"]);
        }
        
    }
    
    public function listTarifas(){        
        if (isset($_SESSION["tarifas_items"])) {
            $array = unserialize($_SESSION["tarifas_items"]);
        } else {
            $array = array();
        }      
        echo json_encode($array);
    }
    
    public function addTarifa(){
        $data = $_POST;
        
        if (isset($_SESSION["tarifas_items"])) {
            $array = unserialize($_SESSION["tarifas_items"]);
        } else {
            $array = array();
        } 
        $array[] = array("id" => "","id_ruta" => $data["id_ruta"], "id_clase" => $data["id_clase"], "clase" => $data["clase"], "valor" => $data["valor"]);
        $_SESSION["tarifas_items"] = serialize($array);
        echo json_encode($array);
    }
    
    public function saveTarifas(){
        Doo::loadModel("Tarifas");
        if (isset($_SESSION["tarifas_items"])) {
            $array = unserialize($_SESSION["tarifas_items"]);
        } else {
            $array = array();
        }     
        
        foreach ($array as $i){
            if($i["id"] === ""){
                $t = new Tarifas();
                $t->id = NULL;
                $t->id_ruta = $i["id_ruta"];
                $t->id_clase = $i["id_clase"];
                $t->valor = $i["valor"];
                $t->deleted = 0;
                $t->crated_at = date('Y-m-d H:i:s');
                $t->updated_at = date('Y-m-d H:i:s');
                Doo::db()->insert($t);
            }
        }
        $this->cleanTarifas();
        return Doo::conf()->APP_URL . "rutas";
    }
    
    function cleanTarifas() {
        if (isset($_SESSION["tarifas_items"])) {
            $_SESSION["tarifas_items"] = null;
        }
    }

    public function save() {
        Doo::loadModel("Rutas");
        $ruta = new Rutas($_POST);
        $zorigen=$_POST["nzonaorigen"];
        $zdestino=$_POST["nzonadestino"];
        if ($ruta->id == "") {
            $ruta->id = Null;
        }
        $ruta->deleted = "0";

        if($ruta->tipo === "N"){
            $ruta->id_contrato = NULL;
        }
        
        if ($ruta->id == Null) {
            $ruta->created_at = date('Y-m-d H:i:s');
            $ruta->updated_at = date('Y-m-d H:i:s');
            if ($_POST["zona_destino"] == "0") {

                $array = Doo::db()->find("Zonas", array("select" => "id,nombre"));


                foreach ($array as $i) {
                    $r = new Rutas();
                    $r->id = null;
                    $r->tipo = $ruta->tipo;
//                    $r->numero = "";
                    $r->nombre = $r->tipo." - ".$zorigen." - ".$i->nombre;
                    $r->zona_origen = $ruta->zona_origen;
                    $r->zona_destino = $i->id;
                    $r->id_contrato = $ruta->id_contrato;
                    $r->deleted = 0;
                    $r->created_at = date('Y-m-d H:i:s');
                    $r->updated_at = date('Y-m-d H:i:s');
                    Doo::db()->insert($r);
                    //$id_destino = $i->id;
                    //Doo::db()->query("INSERT INTO rutas (tipo,numero,nombre,zona_origen,zona_destino,id_contrato,deleted,created_at,updated_at) VALUES ('$ruta->tipo','$ruta->numero','$ruta->nombre','$ruta->zona_origen','$id_destino','$ruta->id_contrato','0','$ruta->created_at','$ruta->updated_at')");
                }
            } else {
                $ruta->nombre = $ruta->tipo." - ".$zorigen." - ".$zdestino;
                Doo::db()->Insert($ruta);
            }
        } else {
            $ruta->nombre = $ruta->tipo." - ".$zorigen." - ".$zdestino;
            $ruta->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($ruta);
        }
        return Doo::conf()->APP_URL . "rutas";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE rutas SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "rutas";
    }
    
    public function cargar_clientes() {
        $tip = $_POST["tipo"];
        $id_contrato = $_POST["id_contrato"];
        
        $r = Doo::db()->query("SELECT c.`numero`, cl.nombre AS cliente, c.`id` AS id_contrato FROM contratos c 
        INNER JOIN clientes cl
        ON (c.id_cliente=cl.id)
        WHERE cl.tipo='$tip'")->fetchAll();
        $this->data["clientes"]=$r;
        $this->data["selected"]=$id_contrato;
        
        
        $this->renderc("rutas/select", $this->data, true);
    }

    public function validar() {
        $id_origen = $_POST["origen"];
        $id_destino = $_POST["destino"];
        $id = $_POST["id"];
        
        $count1 = Doo::db()->query("SELECT * FROM rutas WHERE zona_origen = '$id_origen' AND zona_destino = '$id_destino' AND id <> '$id' ")->rowCount();
        if ($count1 > 0)
            echo true;
        else
            echo false;
    }

}
