<?php

/**
 * Description of ClientesPropietariosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ClientesPropietariosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            // if ($_SESSION["permisos"]["211"] != 1) {
            //     $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
            //     return Doo::conf()->APP_URL . "home";
            // }
        }
    }

    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT c.id,p.identificacion AS identificacionp,p.razon_social AS propietario,c.identificacion,c.nombre,c.celular,c.email,c.tipo,c.deleted 
                FROM clientes c INNER JOIN propietarios p ON (p.id = c.id_usuario) WHERE c.tipo = 'P' ORDER BY p.razon_social,c.nombre ASC";
        $this->data['clientes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'clientesp/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function indexFromPropietarios() {
        $login=$_SESSION["login"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT c.id,p.identificacion AS identificacionp,p.razon_social AS propietario,c.identificacion,c.nombre,c.celular,c.email,c.tipo,c.deleted 
                FROM clientes c INNER JOIN propietarios p ON (p.id = c.id_usuario) WHERE  c.id_usuario='$login->id_usuario' and c.tipo = 'P' ORDER BY p.razon_social,c.nombre ASC";
        $this->data['clientes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'propietarios_clientes/list.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function add() {
        Doo::loadModel("Clientes");
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = new Clientes();
        $this->data['ccostos'] = array();
        $this->data['contactos'] = array();
        $this->data['propietarios'] =   Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['content'] = 'clientesp/from.php';
        $this->renderc('index', $this->data, true);
       
    }

    public function addFromPropietarios() {
        $login=$_SESSION["login"];
        Doo::loadModel("Clientes");
        $this->data["id_usuario"]=$login->id_usuario;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = new Clientes();
        $this->data['ccostos'] = array();
        $this->data['contactos'] = array();
        $this->data['propietarios'] =   Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['content'] = 'propietarios_clientes/form.php';
        $this->renderc('index', $this->data, true);
       
    }

    public function edit() {
        $id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = Doo::db()->find("Clientes", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['ccostos'] = array();
        $this->data['contactos'] = array();
        $this->data['propietarios'] =   Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['content'] = 'clientesp/from.php';
        $this->renderc('index', $this->data, true);
    }

    public function editFromPropietarios(){
        $login=$_SESSION["login"];
        $id = $this->params["pindex"];
        $this->data["id_usuario"]=$login->id_usuario;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = Doo::db()->find("Clientes", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['ccostos'] = array();
        $this->data['contactos'] = array();
        $this->data['propietarios'] =   Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['content'] = 'propietarios_clientes/form.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function save() {
        Doo::loadModel("Clientes");
        $clientes = new Clientes($_POST);
        
        if ($clientes->id == "") {
            $clientes->id = Null;
        }
        $clientes->deleted = "0";
        
        if ($clientes->id == Null) {           
            $clientes->id_usuario = $_POST["id_propietario"];                       
            $clientes->created_at = date('Y-m-d H:i:s');
            $clientes->updated_at = date('Y-m-d H:i:s');         
            $clientes->password = md5($clientes->identificacion);
            $clientes->id = Doo::db()->Insert($clientes);         
        } else {
            $clientes->id_usuario = $_POST["id_propietario"];      
            $clientes->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($clientes);
        }
     
        return Doo::conf()->APP_URL . "clientesp";
    }

    public function saveFromPropietarios(){
        Doo::loadModel("Contratos");
      Doo::loadModel("Clientes");
      $clientes = new Clientes($_POST);
      $login = $_SESSION['login'];
      if ($clientes->id == "") {
          $clientes->id = Null;
      }
      $clientes->deleted = "0";
      
      if ($clientes->id == Null) {  
          $clientes->deleted='0';     
          $clientes->id_usuario = $_POST["id_usuario"];                       
          $clientes->created_at = date('Y-m-d H:i:s');
          $clientes->updated_at = date('Y-m-d H:i:s');         
          $clientes->password = md5($clientes->identificacion);
          $clientes->id = Doo::db()->insert($clientes);    
          /*----------------------------*/
          /*$contrato = new Contratos();
          $contrato->id = Null;
          $contrato->id_cliente = $clientes->id;
          $rs = Doo::db()->query("SELECT cons_contrato+1 AS c FROM parametros")->fetch();
          $contrato->numero = $rs['c'];
          Doo::db()->query("UPDATE parametros SET cons_contrato=cons_contrato+1");
          Doo::db()->Insert($contrato);*/
          $mensaje = "(".$login->nombre.")<br>Nuevo Cliente Registrado: ".$clientes->nombre;
          Doo::db()->query("INSERT INTO notificaciones(mensaje,tipo,id_propietario) VALUES ('$mensaje','NCL','$clientes->id')");
      } else {
          $clientes->id_usuario = $_POST["id_usuario"];      
          $clientes->updated_at = date('Y-m-d H:i:s');
          Doo::db()->Update($clientes);
      }
   
      return Doo::conf()->APP_URL . "clientes_pro"; 
  }
    
    public function validar() {
        $id_pro = $_POST["id_propietario"];
        $identificacion = $_POST["ced"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from clientes where id_usuario = '$id_pro' AND identificacion = '$identificacion' AND id <> '$id'")->rowCount();
        
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }
   
    public function deactivate(){  
        $id = $this->params["pindex"];    
        Doo::db()->query("UPDATE clientes SET deleted=1 WHERE tipo = 'P' AND id=?", array($id));
             
        return Doo::conf()->APP_URL . "clientesp";
    }
    
    public function activate(){
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE clientes SET deleted=0 WHERE tipo = 'P' AND id=?", array($id));
       
        return Doo::conf()->APP_URL . "clientesp";
    }

}
