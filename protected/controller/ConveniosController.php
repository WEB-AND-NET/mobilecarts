<?php

/**
 * Description of ConveniosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ConveniosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["212"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT id,numero,nit,razon_social FROM convenios WHERE deleted=0 ORDER BY razon_social ASC";
        $this->data['convenios'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'convenios/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Convenios");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $c = new Convenios();
        $this->data['convenio'] = $c;
        $this->data['vehiculos'] = Doo::db()->query("SELECT id,placa FROM vehiculos WHERE deleted=0")->fetchAll();     
        $_SESSION['list_vehiculos_convenios'] = null;
        $this->data['content'] = 'convenios/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $convenio = Doo::db()->find("Convenios", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['convenio'] = $convenio;        
        $this->data['vehiculos'] = Doo::db()->query("SELECT id,placa FROM vehiculos WHERE deleted=0")->fetchAll();        
        $list = Doo::db()->query("SELECT id,placa FROM vehiculos WHERE id_convenio = $id AND deleted=0")->fetchAll();
        $_SESSION['list_vehiculos_convenios'] = serialize($list);
        $this->data['content'] = 'convenios/from.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("Convenios");
        $convenio = new Convenios($_POST);
        if ($convenio->id == "") {
            $convenio->id = Null;
        }       

        if ($convenio->id == Null) {        
            $convenio->created_at = date('Y-m-d H:i:s');
            $convenio->updated_at = date('Y-m-d H:i:s');
            $convenio->id = Doo::db()->Insert($convenio);
        } else {
            $convenio->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($convenio);
        }
        $this->saveItems($convenio->id);
        return Doo::conf()->APP_URL . "convenios";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE convenios SET deleted=1 WHERE id=?", array($id));
        Doo::db()->query("UPDATE vehiculos SET id_convenio=0 WHERE id_convenio = ?", array($id));
        return Doo::conf()->APP_URL . "convenios";
    }

    public function validar() {
        $nit = $_POST["nit"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("SELECT id FROM convenios WHERE deleted = 0 AND nit = '$nit' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }
    
    public function load(){
        if (isset($_SESSION["list_vehiculos_convenios"])) {
            $array = unserialize($_SESSION["list_vehiculos_convenios"]);
        } else {
            $array = null;
        }
        $this->data['items'] = $array;
        $this->renderc("convenios/items", $this->data, true);        
    }
    
    public function insert_vehiculo() {
        //Doo::loadModel("Vehiculos");
        //$rp = new Vehiculos($_POST);

        $id = $_POST["id_vehiculo"];
        $placa = $_POST["placa"];

        //$rs = Doo::db()->query("SELECT id, nombre, celular, direccion, email FROM conductores WHERE id= $id")->fetch();
        $response = array('id' => $id, 'placa' => $placa);

        if (isset($_SESSION["list_vehiculos_convenios"])) {
            $array = unserialize($_SESSION["list_vehiculos_convenios"]);
            $array[] = $response;
        } else {
            $array[] = $response;
        }
        $_SESSION["list_vehiculos_convenios"] = serialize($array);

        $this->data['items'] = $array;

        $this->renderc("convenios/items", $this->data, true);
    }
    
    public function delete_vehiculo(){
        if (isset($_SESSION["list_vehiculos_convenios"])) {
            $array = unserialize($_SESSION["list_vehiculos_convenios"]);
        }
        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_vehiculos_convenios_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_vehiculos_convenios_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }
        $_SESSION["list_vehiculos_convenios_del"] = serialize($itemsBorrar);
        $_SESSION["list_vehiculos_convenios"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("convenios/items", $this->data, true);
    }
    
    public function saveItems($id_con) {        
        //Elimina los vehiculos del vehiculo
        if (isset($_SESSION["list_vehiculos_convenios_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_vehiculos_convenios_del"]);
            foreach ($itemsBorrar as $i) {              
                Doo::db()->query("UPDATE vehiculos SET id_convenio=0 WHERE id=? AND id_convenio = ?", array($i['id'], $id_con));
            }
            $_SESSION["list_vehiculos_convenios_del"] = null;
        }
        ///Guardar vehiculos en convenio
        if (isset($_SESSION["list_vehiculos_convenios"])) {
            $array = unserialize($_SESSION["list_vehiculos_convenios"]);
            Doo::loadModel("Vehiculos");

            foreach ($array as $a) {
                Doo::db()->query("UPDATE vehiculos SET id_convenio=? WHERE id=?", array($id_con, $a['id']));
//                if ($a['id'] == '') {
//                    $s = new Vehiculos();
//                    $s->id = null;
//                    $s->id_conductor = $a["id_conductor"];
//                    $s->id_servicio = $id_srv;
//                    $s->deleted = 0;
//                    $s->created_at = date('Y-m-d H:i:s');
//                    $s->updated_at = date('Y-m-d H:i:s');
//                    Doo::db()->insert($s);
//                }
            }
        }
    }

}
