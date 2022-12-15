<?php

/**
 * Description of RegionesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class RegionesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["207"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT id,nombre FROM regiones WHERE deleted = 0";
        $this->data['regiones'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'regiones/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Regiones");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['region'] = new Regiones();       
        $this->data['content'] = 'regiones/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $region = Doo::db()->find("Regiones", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['region'] = $region;           
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'regiones/from.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("Regiones");
        $region = new Regiones($_POST);
        if ($region->id == "") {
            $region->id = Null;
        }
        $region->deleted = "0";

        if ($region->id == Null) {
            $region->created_at = date('Y-m-d H:i:s');
            $region->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Insert($region);
        } else {
            $region->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($region);
        }
        return Doo::conf()->APP_URL . "regiones";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE regiones SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "regiones";
    }
    
    
    public function validar() {
        $nombre = $_POST["nomb"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("SELECT id FROM regiones WHERE nombre = '$nombre' AND id <> '$id'")->rowCount();
        if ($count1 > 0){
            echo true;
        }else{
            echo false;
        }
    }    

}
