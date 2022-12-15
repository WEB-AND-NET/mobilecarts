<?php

/**
 * Description of ZonasController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 *         web
 */
class ClasesVehiculosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["210"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT id,nombre,vhoran,vhorae FROM clases_vehiculos where deleted=0";
        $this->data['clasesvehiculo'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'clases_vehiculos/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("ClasesVehiculos");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clasesvehiculo'] = new ClasesVehiculos();
        $this->data['content'] = 'clases_vehiculos/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $clases = Doo::db()->find("ClasesVehiculos", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clasesvehiculo'] = $clases;
        $this->data['content'] = 'clases_vehiculos/from.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("ClasesVehiculos");
        $clases = new ClasesVehiculos($_POST);
        //if ($clases->id == "") {
        //    $vehiculos = Doo::db()->find("ClasesVehiculos");
        //    $ultimo = end($vehiculos);
        //    $clases->id = $ultimo->id+1;
        //}
        $clases->deleted = "0";
        //echo json_encode($clases);
        //exit();
        if ($clases->id == "") {
            $vehiculos = Doo::db()->find("ClasesVehiculos");
            $ultimo = end($vehiculos);
            $clases->id = $ultimo->id+1;
            $clases->created_at = date('Y-m-d H:i:s');
            $clases->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Insert($clases);
        } else {
            $clases->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($clases);
        }
        return Doo::conf()->APP_URL . "clases_vehiculos";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE clases_vehiculos SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "clases_vehiculos";
    }

    public function validar() {
        $nombre = $_POST["nomb"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from clases_vehiculos where nombre = '$nombre' AND id <> '$id'")->rowCount();
        if ($count1 > 0)
            echo true;
        else
            echo false;
    }

}
