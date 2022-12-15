<?php

/**
 * Description of ZonasController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 *         web
 */
class ChecklistController extends DooController {

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

    public function index(){
        #$sql = "SELECT id,nombre,vhoran,vhorae FROM clases_vehiculos where deleted=0";
        #$this->data['clasesvehiculo'] = Doo::db()->query($sql)->fetchAll();
        $this->data['vehiculos'] = Doo::db()->query("SELECT id,placa FROM vehiculos WHERE deleted=0")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'checklist/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function agg(){
        
    }
}

?>