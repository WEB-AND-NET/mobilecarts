<?php

/**
 * Description of PropietariosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class PropietariosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["203"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT id,identificacion, razon_social, telefono, email, pago_estado, revision_estado,
DATE_ADD(revision_fecha,INTERVAL 2 MONTH) AS fecha_vc_revision, 
DATE_ADD(`pago_fecha`,INTERVAL 1 MONTH) AS fecha_vc_pago,
IF( CURDATE() > DATE_ADD(pago_fecha,INTERVAL 1 MONTH) || 
CURDATE() > DATE_ADD(revision_fecha,INTERVAL 2 MONTH) ||
pago_estado ='D' || revision_estado = 'D','NO' , 'SI') AS valido,estado
FROM propietarios WHERE deleted=0 ORDER BY razon_social ASC";
        $this->data['propietarios'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'propietarios/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Propietarios");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['propietarios'] = new Propietarios();
        $this->data['propietario'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "desc" => "id"));
        $this->data['content'] = 'propietarios/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $propietarios = Doo::db()->find("Propietarios", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['propietarios'] = $propietarios;
        $this->data['content'] = 'propietarios/from.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("Propietarios");
        $propietarios = new Propietarios($_POST);
        if ($propietarios->id == "") {
            $propietarios->id = Null;
        }
        $propietarios->deleted = "0";
        if ($propietarios->id == Null) {
            $propietarios->password = md5($propietarios->identificacion);
            $propietarios->estado = "H";
            $propietarios->created_at = date('Y-m-d H:i:s');
            $propietarios->updated_at = date('Y-m-d H:i:s');
            $propietarios->id=Doo::db()->Insert($propietarios);
//            Doo::db()->query("INSERT INTO usuarios (identificacion, usuario, nombre, PASSWORD, role, tipo, id_usuario, deleted, created_at, updated_at)  "
//                    . "VALUES ('$propietarios->identificacion','$propietarios->identificacion','$propietarios->razon_social',MD5('$propietarios->identificacion'),'3','P','$propietarios->id','0','$propietarios->created_at', '$propietarios->updated_at')");
            
        } else {
            $propietarios->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($propietarios);
        }
        return Doo::conf()->APP_URL . "propietarios";
    }

//    public function deactivate() {
//        $id = $this->params["pindex"];
//        Doo::db()->query("UPDATE propietarios SET deleted=1 WHERE id=?", array($id));
//        Doo::db()->query("UPDATE usuarios SET deleted=1 WHERE tipo = 'P' AND id_usuario=?", array($id));
//        return Doo::conf()->APP_URL . "propietarios";
//    }
    
    public function activate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE propietarios SET estado='H' WHERE id=?", array($id));
        Doo::db()->query("UPDATE usuarios SET deleted=0 WHERE tipo = 'P' AND id_usuario=?", array($id));
        return Doo::conf()->APP_URL . "propietarios";
    }
    
    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE propietarios SET estado='D' WHERE id=?", array($id));
        Doo::db()->query("UPDATE usuarios SET deleted=1 WHERE tipo = 'P' AND id_usuario=?", array($id));
        return Doo::conf()->APP_URL . "propietarios";
    }
    
    public function bloquear() {
        $id = $this->params["pindex"];
        $propietarios = Doo::db()->find("Propietarios", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['propietarios'] = $propietarios;
        $propietarios->pago_fecha = (new DateTime($propietarios->pago_fecha))->format('m/d/Y');
        $propietarios->revision_fecha = (new DateTime($propietarios->revision_fecha))->format('m/d/Y');
        $this->data['content'] = 'propietarios/bloquear.php';
        $this->renderc('index', $this->data);
    }
    
    public function savebloqueo() {
       
        //$rves = filter_input(INPUT_POST, "revision_estado");
        
         if(filter_input(INPUT_POST, "revision_estado")!=null){
             $rves = filter_input(INPUT_POST, "revision_estado");
         }  else {
            $rves ="H";
         }
             
         if (filter_input(INPUT_POST, "pago_estado")!=null){
            $pges = filter_input(INPUT_POST, "pago_estado");
         }  else {
             $pges ="H";
         }
        
        
        $id = filter_input(INPUT_POST, "id");
        
        
        $frvs=(new DateTime(filter_input(INPUT_POST, "revision_fecha") ))->format('Y-m-d');
        $fpges=(new DateTime(filter_input(INPUT_POST, "pago_fecha") ))->format('Y-m-d');
        
        $rs= Doo::db()->query("UPDATE propietarios SET revision_estado='$rves', revision_fecha='$frvs', pago_estado='$pges', pago_fecha='$fpges' WHERE id=$id");
       return Doo::conf()->APP_URL . "propietarios";
    }

    public function validar() {
        $identificacion = filter_input(INPUT_POST, "ced");
        $id = filter_input(INPUT_POST, "id");
        $count1 = Doo::db()->query("select * from propietarios where deleted = 0 AND identificacion = '$identificacion' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

}
