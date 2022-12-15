<?php

/**
 * Description of ZonasController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ZonasController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["208"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT z.id,z.nombre,r.nombre AS region FROM zonas z INNER JOIN regiones r ON (r.id = z.id_region) WHERE z.deleted = 0";
        $this->data['zonas'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'zonas/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Zonas");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['zonas'] = new Zonas();
        $this->data['regiones'] = Doo::db()->find("Regiones", array("select" => "id,nombre", "asc" => "nombre", 'where' => 'deleted = 0'));
        $this->data['content'] = 'zonas/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $zona = Doo::db()->find("Zonas", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['zonas'] = $zona;
        $this->data['regiones'] = Doo::db()->find("Regiones", array("select" => "id,nombre", "asc" => "nombre", 'where' => 'deleted = 0'));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'zonas/from.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("Zonas");
        $zona = new Zonas($_POST);
        if ($zona->id == "") {
            $zona->id = Null;
        }
        $zona->deleted = "0";

        if ($zona->id == Null) {
            $zona->created_at = date('Y-m-d H:i:s');
            $zona->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Insert($zona);
        } else {
            $zona->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($zona);
        }
        return Doo::conf()->APP_URL . "zonas";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE zonas SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "zonas";
    }

    public function validar() {
        $nombre = $_POST["nomb"];
        $id_r = $_POST["id_r"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("SELECT id FROM zonas WHERE nombre = '$nombre' AND id_region = '$id_r' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

}
