<?php
class MantenimientosController extends DooController
{

    public function beforeRun($resource, $action)
    {
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

    public function index()
    {
        $id = $this->params['pindex'];
        $this->data['id'] = $id;
        $sql = "SELECT id, tipo, fecha, CONCAT(km,' Km') AS km, archivoFactura, fechaCierre, estado FROM mantenimiento 
        WHERE vehiculoId = $id 
        ORDER BY id DESC";

        $this->data['vehiculo'] = Doo::db()->find("Vehiculos", array("where" => "id=?", "limit" => 1, "param" => array($id)));
        $this->data['mantenimientos'] = Doo::db()->query("$sql")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'mantenimientos/list.php';

        $this->renderc('index', $this->data, true);
    }

    public function add()
    {

        $idVehiculo = $this->params['pindex'];

        Doo::loadModel("Mantenimiento");
        Doo::loadModel("Mttosactividades");
        $m = new Mantenimiento();
        
        $this->clean();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['idVehiculo'] = $idVehiculo;
        $this->data['mantenimiento'] = $m;
        $this->data['mttact'] = array();
        $this->data['actividades'] = Doo::db()->find("Actividades", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'mantenimientos/form.php';
        $this->renderc('index', $this->data);
    }


    public function edit()
    {

        $id = $this->params["pindex"];

        Doo::loadModel("Mantenimiento");
        $this->clean();

        $sql = "SELECT * FROM mantenimiento 
        WHERE id = $id";

        $m = new Mantenimiento(Doo::db()->query("$sql")->fetch());
        $idVehiculo = $m->vehiculoId;

        $query = "SELECT mt.id, mt.actividadId, mt.anotacion, mt.costo, a.nombre FROM mttosactividades mt 
        LEFT JOIN actividades a ON mt.actividadId = a.id 
        WHERE mt.mantenimientoId = '$id'";

        $listActividad = Doo::db()->query($query)->fetchAll();
        $_SESSION["list_actividad"] = serialize($listActividad); 

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['idVehiculo'] = $idVehiculo;
        $this->data['mantenimiento'] = $m;
        $this->data['mttact'] = $listActividad;
        $this->data['actividades'] = Doo::db()->find("Actividades", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'mantenimientos/form.php';
        $this->renderc('index', $this->data);
    }

    public function finish()
    {

        $id = $this->params["pindex"];

        Doo::loadModel("Mantenimiento");
        $this->clean();

        $sql = "SELECT * FROM mantenimiento 
        WHERE id = $id";

        $m = new Mantenimiento(Doo::db()->query("$sql")->fetch());
        if ($m->estado == "T") {
            return Doo::conf()->APP_URL . "mantenimientos/" . $m->vehiculoId;
        }

        $idVehiculo = $m->vehiculoId;
        
        $query = "SELECT mt.id, mt.actividadId, mt.anotacion, mt.costo, a.nombre FROM mttosactividades mt 
        LEFT JOIN actividades a ON mt.actividadId = a.id 
        WHERE mt.mantenimientoId = '$id'";

        $listActividad = Doo::db()->query($query)->fetchAll();
        $_SESSION["list_actividad"] = serialize($listActividad); 

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['idVehiculo'] = $idVehiculo;
        $this->data['mantenimiento'] = $m;
        $this->data['actividades'] = Doo::db()->find("Actividades", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'mantenimientos/terminar.php';
        $this->renderc('index', $this->data);
    }

    public function save()
    {
        Doo::loadModel("Mantenimiento");
        Doo::loadHelper('DooFile');

        $mantenimiento = new Mantenimiento($_POST);
        
        if ($mantenimiento->id == "") {
            $mantenimiento->id = Null;
        }
        
        if ($mantenimiento->id == Null) {
            $mantenimiento->estado = 'P';
            $mantenimiento->id = Doo::db()->Insert($mantenimiento);
            if ($_FILES["archivoFactura"]["name"] != "") {
                $name = $_FILES["archivoFactura"]["name"];
                $gd2 = new DooFile();
                $ext = end((explode(".", $name)));

                $img = $gd2->upload(Doo::conf()->DOC . 'FacturasMantenimientos/', "archivoFactura", "Factura" . $mantenimiento->id);
                $name = "Factura" . $mantenimiento->id .'.'. $ext;
                $mantenimiento->archivoFactura = $name;
                Doo::db()->Update($mantenimiento);
            }

        } else {

                
                
                if ($_FILES["archivoFactura"]["name"] != "") {
                    $name = $_FILES["archivoFactura"]["name"];
                    $gd2 = new DooFile();
                    $ext = end((explode(".", $name)));

                    $img = $gd2->upload(Doo::conf()->DOC . 'FacturasMantenimientos/', "archivoFactura", "Factura" . $mantenimiento->id);
                    $name = "Factura" . $mantenimiento->id .'.'. $ext;
                    $mantenimiento->archivoFactura = $name;
                }
                else{
                    $mantenimiento->archivoFactura = $_POST["archivo"];
                }

            Doo::db()->Update($mantenimiento);
        }

        $this->saveItems($mantenimiento->id);

        return Doo::conf()->APP_URL . "mantenimientos/" . $mantenimiento->vehiculoId;
    }

    public function saveItems($id_veh){        
        Doo::loadModel("Mttosactividades");
        //Elimina las actividades del mantenimiento
        if (isset($_SESSION["list_actividad_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_actividad_del"]);
            foreach ($itemsBorrar as $i) {
                if($i['id'] != "")
                    Doo::db()->query("DELETE FROM mttosactividades WHERE id =?", array($i['id']));
            }
            $_SESSION["list_actividad_del"] = null;
        }         
        // Guardar las actividades del mantenimiento                
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
            foreach ($array as $item) {
                $rp = new Mttosactividades($item);
                if (isset($rp->id) && !empty($rp->id)) {                                    
                                                                             
                }else{
                    $rp->id = null;
                    $rp->mantenimientoId = $id_veh;
                    Doo::db()->insert($rp);   
                }
            }
            $_SESSION["list_actividad"] = null;                        
        }                            
    }

    public function Savefinish()
    {
        Doo::loadHelper('DooFile');
        Doo::loadModel("Mantenimiento");
        $mantenimiento = new Mantenimiento($_POST);


        $mantenimiento->estado = 'T';
        $mantenimiento->fechaCierre = Date("Y-m-d H:i:s");

        if ($_FILES["archivoFactura"]["name"] != "") {
                $name = $_FILES["archivoFactura"]["name"];
                $gd2 = new DooFile();
                $ext = end((explode(".", $name)));

                $img = $gd2->upload(Doo::conf()->DOC . 'FacturasMantenimientos/', "archivoFactura", "Factura" . $mantenimiento->id);
                $name = "Factura" . $mantenimiento->id .'.'. $ext;
                $mantenimiento->archivoFactura = $name;
                Doo::db()->Update($mantenimiento);
            }else if ($mantenimiento->archivoFactura == "") {
                $mantenimiento->archivoFactura = $_POST["archivo"];
            }

        Doo::db()->Update($mantenimiento);


        $this->saveItems($mantenimiento->id);

        return Doo::conf()->APP_URL . "mantenimientos/" . $mantenimiento->vehiculoId;
    }

    function load() {
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
        } else {
            $array = null;
        }
        $this->data['mttact'] = $array;
        $this->renderc("mantenimientos/items", $this->data, true);
    }

    public function insert() {
        Doo::loadModel("Mttosactividades");
        $act = new Mttosactividades($_POST);

        $id = $_POST["id"];

        $rs = Doo::db()->query("SELECT id, nombre FROM actividades WHERE id = $id")->fetch();

        $response = array('id' => '', 'nombre' => $rs['nombre'], 'actividadId' => $rs['id'], 'costo' => $act->costo, 'anotacion' => $act->anotacion);

        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
            $array[] = $response;
        } else {
            $array[] = $response;
        }
        $_SESSION["list_actividad"] = serialize($array);

        $this->data['mttact'] = $array;

        $this->renderc("mantenimientos/items", $this->data, true);
    }

    function delete() {
        if (isset($_SESSION["list_actividad"])) {
            $array = unserialize($_SESSION["list_actividad"]);
        }
        
        $ext = array_splice($array, $_POST['index'] - 1, 1);
        $itemsBorrar = array();
        if (isset($_SESSION["list_actividad_del"])) {
            $itemsBorrar = unserialize($_SESSION["list_actividad_del"]);
            $itemsBorrar[] = $ext[0];
        } else {
            $itemsBorrar[] = $ext[0];
        }
        
        $_SESSION["list_actividad_del"] = serialize($itemsBorrar);
        $_SESSION["list_actividad"] = serialize($array);
        $this->data['mttact'] = $array;
        $this->renderc("mantenimientos/items", $this->data, true);
    }

    function clean() {
        if (isset($_SESSION["list_actividad"])) {
            $_SESSION["list_actividad"] = null;
        }
        if (isset($_SESSION["list_actividad_del"])) {
            $_SESSION["list_actividad_del"] = null;
        }
    }

}
