<?php

/**
 * Description of VehiculosController
 *
 * @author Carlos Meri単o Iriarte <carlos.merino.iriarte@gmail.com>, Maykel Rhenals.
 */
class VehiculosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["204"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT v.id,cv.nombre AS clase,v.placa,v.modelo,v.marca,p.razon_social AS propietario, v.estado ";
        $sql.= " FROM vehiculos v INNER JOIN clases_vehiculos cv ON (cv.id = v.id_clase) INNER JOIN propietarios p ON (v.id_propietario = p.id) WHERE v.deleted=0 ORDER BY v.placa asc";
        $this->data['vehiculos'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'vehiculos/list.php';

        // Creacion de seccion para agregar conductores
        $_SESSION["list_conduct"] = serialize(array());
        if (isset($_SESSION["list_conduct"])) {
            $_SESSION["list_conduct"] = null;
        }

        $this->renderc('index', $this->data, true);
    }



    public function add() {
        Doo::loadModel("Vehiculos");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $v = new Vehiculos();
        $v->soat = $v->poliza = $v->tecnomecanica =  $v->v_contra = $v->v_extra = $v->v_todo = date('m/d/Y');

        $this->data['vehiculos'] = $v;
        $this->data['clases'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "asc" => "nombre", 'where' => 'deleted = 0'));        
        $this->data['propietario'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['conductore'] = Doo::db()->find("Conductores", array("select" => "id,nombre, apellidos", "asc" => "nombre", 'where' => 'deleted = 0'));
        $this->data['convenios'] = Doo::db()->find("Convenios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));

        $this->data['content'] = 'vehiculos/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        
        $vehiculos = Doo::db()->find("Vehiculos", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['vehiculos'] = $vehiculos;
        $this->data['clases'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "asc" => "nombre", 'where' => 'deleted = 0'));
        $this->data['propietario'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['conductore'] = Doo::db()->find("Conductores", array("select" => "id,nombre,apellidos", "asc" => "nombre", 'where' => 'deleted = 0'));
        $this->data['convenios'] = Doo::db()->find("Convenios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        
        $query = "SELECT vc.id,c.id AS id_conductor,c.nombre,c.celular,c.direccion,c.email FROM conductores c INNER JOIN vehiculos_conductores vc ON(c.id = vc.id_conductor) WHERE vc.deleted=0 AND vc.id_vehiculo = '$id'";
        $list_conduct = Doo::db()->query($query)->fetchAll();
        $_SESSION["list_conduct"] = serialize($list_conduct);               

        $vehiculos->soat = (new DateTime($vehiculos->soat))->format('m/d/Y');
        $vehiculos->tecnomecanica = (new DateTime($vehiculos->tecnomecanica))->format('m/d/Y');
        $vehiculos->v_contra = (new DateTime($vehiculos->v_contra))->format('m/d/Y');
        $vehiculos->v_extra = (new DateTime($vehiculos->v_extra))->format('m/d/Y');
        $vehiculos->v_todo = (new DateTime($vehiculos->v_todo))->format('m/d/Y');
        $vehiculos->v_tg_operacion = (new DateTime($vehiculos->v_tg_operacion))->format('m/d/Y');

        $this->data['content'] = 'vehiculos/from.php';
        $this->renderc('index', $this->data);
    }

    // Metodos para agregar conductores a los vehiculos

    function load() {
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
        } else {
            $array = null;
        }
        $this->data['items'] = $array;
        $this->renderc("vehiculos/items", $this->data, true);
    }
    
    function clean() {
        if (isset($_SESSION["list_conduct"])) {
            $_SESSION["list_conduct"] = null;
        }
        if (isset($_SESSION["list_conduct_del"])) {
            $_SESSION["list_conduct_del"] = null;
        }
    }

    public function validarConductor() {
        $id_conductor = $_POST["id_conductor"];

        $val = false;
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
            foreach ($array as $item) {
                if ($item['id_conductor'] == $id_conductor) {
                    $val = true;
                }
            }
        }
        echo $val;
    }

    public function insert() {
        Doo::loadModel("Conductores");
        $rp = new Conductores($_POST);

        $id = $_POST["id_cond"];

        $rs = Doo::db()->query("SELECT id, nombre, celular, direccion, email FROM conductores WHERE id= $id")->fetch();
        $response = array('id' => '','id_conductor' => $rs['id'], 'nombre' => $rs['nombre'], 'celular' => $rs['celular'], 'direccion' => $rs['direccion'], 'email' => $rs['email']);

        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
            $array[] = $response;
        } else {
            $array[] = $response;
        }
        $_SESSION["list_conduct"] = serialize($array);

        $this->data['items'] = $array;

        $this->renderc("vehiculos/items", $this->data, true);
    }

    function delete() {
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
        }
        
        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_conduct_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_conduct_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }
        
        $_SESSION["list_conduct_del"] = serialize($itemsBorrar);
        $_SESSION["list_conduct"] = serialize($array);
        $this->data['items'] = $array;
        $this->renderc("vehiculos/items", $this->data, true);
    }

    // Fin Metodos agregacion conductores

    public function save() {
        Doo::loadModel("Vehiculos");
        $vehiculos = new Vehiculos($_POST);
        if ($vehiculos->id == "") {
            $vehiculos->id = Null;
        }
        $vehiculos->deleted = "0";

        if ($vehiculos->id == Null) {

            //Formateando las fechas al momento de la insercion
            $vehiculos->soat = (new DateTime($vehiculos->soat))->format('Y-m-d');
            $vehiculos->tecnomecanica = (new DateTime($vehiculos->tecnomecanica))->format('Y-m-d');            
            $vehiculos->v_contra = (new DateTime($vehiculos->v_contra))->format('Y-m-d');
            $vehiculos->v_extra = (new DateTime($vehiculos->v_extra))->format('Y-m-d');
            $vehiculos->v_todo = (new DateTime($vehiculos->v_todo))->format('Y-m-d');
            $vehiculos->v_tg_operacion = (new DateTime($vehiculos->v_tg_operacion))->format('Y-m-d');
            $vehiculos->fechaMatricula = (new DateTime($vehiculos->fechaMatricula))->format('Y-m-d');
            $vehiculos->fechaExpeLic = (new DateTime($vehiculos->fechaExpeLic))->format('Y-m-d');
            
            //..............................................
            $vehiculos->created_at = date('Y-m-d H:i:s');
            $vehiculos->updated_at = date('Y-m-d H:i:s');
            $vehiculos->id = Doo::db()->Insert($vehiculos);
                
        } else {
            //Formateando las fechas al momento de actualizar
            $vehiculos->soat = (new DateTime($vehiculos->soat))->format('Y-m-d');
            $vehiculos->tecnomecanica = (new DateTime($vehiculos->tecnomecanica))->format('Y-m-d');            
            $vehiculos->v_contra = (new DateTime($vehiculos->v_contra))->format('Y-m-d');
            $vehiculos->v_extra = (new DateTime($vehiculos->v_extra))->format('Y-m-d');
            $vehiculos->v_todo = (new DateTime($vehiculos->v_todo))->format('Y-m-d');
            $vehiculos->v_tg_operacion = (new DateTime($vehiculos->v_tg_operacion))->format('Y-m-d');
            $vehiculos->fechaMatricula = (new DateTime($vehiculos->fechaMatricula))->format('Y-m-d');
            $vehiculos->fechaExpeLic = (new DateTime($vehiculos->fechaExpeLic))->format('Y-m-d');

            //..............................................
            $vehiculos->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($vehiculos);
        }
        
        $this->saveItems($vehiculos->id);
        
        return Doo::conf()->APP_URL . "vehiculos";
    }
    
    public function saveItems($id_veh){        
        Doo::loadModel("VehiculosConductores");
        //Elimina los conductores del vehiculo
        if (isset($_SESSION["list_conduct_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_conduct_del"]);
            foreach ($itemsBorrar as $i) {
                //$eliminar = true;
                //if ($rp->id == $i['id']) {
                //    $eliminar = false;
                //}
                //if ($eliminar) {
                    Doo::db()->query("UPDATE vehiculos_conductores SET deleted=1 WHERE id=?", array($i['id']));
                //}
            }
            $_SESSION["list_conduct_del"] = null;
        }         
        // Guardar los conductores del vehiculo                
        if (isset($_SESSION["list_conduct"])) {
            $array = unserialize($_SESSION["list_conduct"]);
            foreach ($array as $item) {
                $rp = new VehiculosConductores($item);
                if (isset($rp->id) && !empty($rp->id)) {                                    
                                                                             
                }else{
                    $rp->id = null;
                    //$rp->id_conductor = $item["id"];
                    $rp->id_vehiculo = $id_veh;
                    $rp->deleted = 0;
                    $rp->created_at = date('Y-m-d H:i:s');
                    $rp->updated_at = date('Y-m-d H:i:s');
                    Doo::db()->insert($rp);   
                }
            }
            $_SESSION["list_conduct"] = null;                        
        }                            
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE vehiculos SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "vehiculos";
    }

    public function validar() {
        $placa = $_POST["plac"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from vehiculos where placa = '$placa' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    public function documentos(){
        $id = $this->params["pindex"];
        $documentos = Doo::db()->find("Documentos", array("where" => "deleted=1 and tipo = 'VE'  " ));
        $allDocument=array();
        foreach($documentos as $docume){
            $docume->attr=json_decode($docume->attr,true);
            $allDocument[]=$docume;
        }
        $this->data['id']=$id;
        $this->data['rol'] = $_SESSION['login']->role;
        $this->data['documentos']=$allDocument;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'vehiculos/documentos_propietarios.php';
        $this->renderc('index_propietarios', $this->data, true);
    }

}
