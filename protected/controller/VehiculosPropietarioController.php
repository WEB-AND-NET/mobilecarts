<?php

class VehiculosPropietarioController extends DooController  {



    public function index() {

        //var_dump($_SESSION['login']);

        $login = $_SESSION['login'];

        $sql = "SELECT v.id, cv.nombre AS clase, v.placa, v.modelo, v.marca, v.id_propietario,v.estado

                FROM vehiculos v 

                INNER JOIN clases_vehiculos cv ON (cv.id = v.id_clase) 

                WHERE v.deleted=0 AND v.id_propietario = '$login->id_usuario' ORDER BY v.placa ASC";     

        $this->data['vehiculos'] = Doo::db()->query($sql)->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->data['content'] = 'vehiculos/list_propietarios.php';

        $_SESSION["list_conduct"] = serialize(array());

        if (isset($_SESSION["list_conduct"])) {

            $_SESSION["list_conduct"] = null;

        }

        $this->renderc('index_propietarios', $this->data, true);

    }



    public function add() {

        

        $id_p = $_SESSION['login']->id_usuario;

        Doo::loadModel("Vehiculos");

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $v = new Vehiculos();

        $v->soat = $v->poliza = $v->tecnomecanica =  $v->v_contra = $v->v_extra = $v->v_todo = date('m/d/Y');



        $this->data['vehiculos'] = $v;

        $this->data['clases'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "asc" => "nombre", 'where' => 'deleted = 0'));        

        $this->data['propietario'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));

        $this->data['conductore'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "asc" => "nombre", 'where' => "deleted = 0 and id_propietario='$id_p'"));

        $this->data['convenios'] = Doo::db()->find("Convenios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));



        $this->data['content'] = 'vehiculos/from_propietarios.php';

        $this->renderc('index_propietarios', $this->data);

    }



    public function edit() {

        $id_p = $_SESSION['login']->id_usuario;

        $id = $this->params["pindex"];

        

        $vehiculos = Doo::db()->find("Vehiculos", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));

        

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->data['vehiculos'] = $vehiculos;

        $this->data['clases'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "asc" => "nombre", 'where' => 'deleted = 0'));

        $this->data['propietario'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));

        $this->data['conductore'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "asc" => "nombre", 'where' => "deleted= 0 and id_propietario='$id_p'"));

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



        $this->data['content'] = 'vehiculos/from_propietarios.php';

        $this->renderc('index_propietarios', $this->data);

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





    

    public function save() {

        

        Doo::loadModel("Vehiculos");

        $login = $_SESSION['login'];

        $vehiculos = new Vehiculos($_POST);

        if ($vehiculos->id == "") {

            $vehiculos->id = Null;

        }

        $vehiculos->id_propietario = $login->id_usuario;

        $vehiculos->deleted = "0";

        $vehiculos->estado = "D";

        if ($vehiculos->id == Null) {



            Doo::loadModel("Notificaciones");

            $notif = new Notificaciones();

            $notif->mensaje = "(".$login->nombre.")<br> Nuevo Vehiculo Registrado ".$vehiculos->marca."";

            $notif->tipo = "NV";

            

            //$notif->id_propietario



            //Formateando las fechas al momento de la insercion

            $vehiculos->soat = (new DateTime($vehiculos->soat))->format('Y-m-d');

            $vehiculos->tecnomecanica = (new DateTime($vehiculos->tecnomecanica))->format('Y-m-d');            

            $vehiculos->v_contra = (new DateTime($vehiculos->v_contra))->format('Y-m-d');

            $vehiculos->v_extra = (new DateTime($vehiculos->v_extra))->format('Y-m-d');

            $vehiculos->v_todo = (new DateTime($vehiculos->v_todo))->format('Y-m-d');

            $vehiculos->v_tg_operacion = (new DateTime($vehiculos->v_tg_operacion))->format('Y-m-d');

            

            //..............................................

            $vehiculos->created_at = date('Y-m-d H:i:s');

            $vehiculos->updated_at = date('Y-m-d H:i:s');

            $vehiculos->id = Doo::db()->insert($vehiculos);

            $notif->id_vehiculo = $vehiculos->id;

            Doo::db()->insert($notif);

        } else {

            //Formateando las fechas al momento de actualizar

            $vehiculos->soat = (new DateTime($vehiculos->soat))->format('Y-m-d');

            $vehiculos->tecnomecanica = (new DateTime($vehiculos->tecnomecanica))->format('Y-m-d');            

            $vehiculos->v_contra = (new DateTime($vehiculos->v_contra))->format('Y-m-d');

            $vehiculos->v_extra = (new DateTime($vehiculos->v_extra))->format('Y-m-d');

            $vehiculos->v_todo = (new DateTime($vehiculos->v_todo))->format('Y-m-d');

            $vehiculos->v_tg_operacion = (new DateTime($vehiculos->v_tg_operacion))->format('Y-m-d');



            //..............................................

            $vehiculos->updated_at = date('Y-m-d H:i:s');

            Doo::db()->Update($vehiculos);

        }

        

        $this->saveItems($vehiculos->id);

        

        return Doo::conf()->APP_URL . "vehiculos_propietario";

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

        return Doo::conf()->APP_URL . "vehiculos_propietario";

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

    

    public function getDocs() {

        $id = $_POST['id'];

        $datos = Doo::db()->query("SELECT id, id_documento, id_vehiculo, nombre_documento, fecha_expedicion, fecha_vencimiento, atributos,estado, DATEDIFF(fecha_vencimiento,CURDATE()) AS resto FROM documentos_conductor_data WHERE id_vehiculo = '$id'")->fetchAll();

        echo json_encode($datos);

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



    

    public function saveDocs(){

        Doo::loadModel("DocumentosConductorData");

        $doc = new DocumentosConductorData($_POST);

        $tipodoc = Doo::db()->query("SELECT * FROM documentos WHERE id = '$doc->id_documento' LIMIT 1")->fetch();

        

        $attr = json_decode($tipodoc['attr']);

        $cantidad = sizeof($_POST);

        $doc->nombre_documento = $tipodoc['nombre_carpeta'].$doc->id_vehiculo;

        $arg = [];

        foreach($attr as $a){

            foreach($_POST as $key=>$value){

                if($a->nombre_tag == $key){

                    $arg[$key] = $value;

                }                

            }

        }

        $doc->atributos = "[".json_encode($arg)."]";

        $auxiliar = Doo::db()->query("SELECT * FROM documentos_conductor_data WHERE id_vehiculo = '$doc->id_vehiculo' AND id_documento = '$doc->id_documento' LIMIT 1 ")->fetch();

        if($auxiliar){

            $fecha_v =$doc->fecha_vencimiento == ""  ? "": "fecha_vencimiento = '$doc->fecha_vencimiento',";

            Doo::db()->query("UPDATE documentos_conductor_data 

            SET fecha_expedicion = '$doc->fecha_expedicion',

            $fecha_v

            atributos = '$doc->atributos' WHERE id_vehiculo = '$doc->id_vehiculo' AND id_documento = '$doc->id_documento' ");

        } else {

            

            Doo::db()->Insert($doc);

        }

        echo  "Documento Exitoso";

    }



    public function saveAll(){

        $id_d=$_POST["id_doc"];

        $id_c=$_POST["id_c"];

        $documento = Doo::db()->find("Documentos", array("where" => "deleted=1 and id=?", 'limit' => 1,"param"=>array($id_d)));

        Doo::loadHelper('DooFile');

        $htmlname="nombre_documento$_POST[id_doc]";  



        if ($_FILES[$htmlname]["name"] != "") {           

            $name = $_FILES[$htmlname]["name"];

            $gd2 = new DooFile();

            $ext = end((explode(".", $name)));    

           // echo $ext;

            $img = $gd2->upload(Doo::conf()->DOC.$documento->nombre_carpeta.'/' , $htmlname, $documento->nombre_carpeta.$id_c);

            $name=$documento->nombre_carpeta.$id_c.".".$ext;

            //Doo::db()->query("UPDATE documentos_conductor_data set nombre_documento='$name' where id_documento='$id_d'");

            Doo::db()->query("UPDATE documentos_conductor_data set nombre_documento='$name' where id_vehiculo='$id_c' and id_documento='$id_d'");

       

        

        }

        echo $name;

    }



    public function setnotifydocs() {

        $id = $this->params['pindex'];

        $vehiculo = Doo::db()->query("SELECT v.id, v.marca, v.placa, u.nombre AS nombre_prop, u.id AS id_propietario

                                        FROM vehiculos v 

                                        INNER JOIN usuarios u ON (u.id_usuario=v.id_propietario)

                                        WHERE v.id = '$id'")->fetch();      

        Doo::loadModel("Notificaciones");

        $notify = new Notificaciones();

        $notify->id = null;

        $notify->id_vehiculo  = $id;

        $notify->id_propietario = $vehiculo['id_propietario'];

        $notify->tipo = "VDP";

        $mensaje = "(".$vehiculo['nombre_prop'].") SOLICITO UNA REVISION DE DOCUMENTO PARA EL VEHICULO ".$vehiculo['marca']." CON PLACA: ".$vehiculo['placa']."";

        $notify->mensaje = $mensaje;

        Doo::db()->insert($notify);

        return Doo::conf()->APP_URL."vehiculos_propietario";

    }



    public function index_view (){  

        $sql = "SELECT v.id,cv.nombre AS clase,v.placa,v.modelo,v.marca,p.razon_social AS propietario,v.estado, v.created_at ";

        $sql.= " FROM vehiculos v INNER JOIN clases_vehiculos cv ON (cv.id = v.id_clase) INNER JOIN propietarios p ON (v.id_propietario = p.id) WHERE v.deleted=0 ORDER BY v.created_at DESC";

        $this->data['vehiculos'] = Doo::db()->query($sql)->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->data['content'] = 'vehiculosp/list.php';

        $_SESSION["list_conduct"] = serialize(array());

        if (isset($_SESSION["list_conduct"])) {

            $_SESSION["list_conduct"] = null;

        }

        $this->renderc('index', $this->data, true);

    }



    public function deactivate_p () {

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE vehiculos SET estado = 'D' WHERE id = '$id'");

        return Doo::conf()->APP_URL."vehiculos";

    }



    public function activate_p () {

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE vehiculos SET estado = 'A' WHERE id = '$id'");

        $vehiculo = Doo::db()->query("SELECT v.id,v.marca, u.id AS id_propietario

                                        FROM vehiculos v

                                        INNER JOIN usuarios u ON u.id_usuario = v.id_propietario

                                        WHERE v.id = '$id' LIMIT 1")->fetch();

        if($vehiculo){

            Doo::loadModel("Notificaciones");

            $notificacion = new Notificaciones();

            $notificacion->tipo = "AVP";

            $notificacion->id_vehiculo = $id;

            $notificacion->id_propietario = $vehiculo['id_propietario'];

            $notificacion->mensaje = "EL VEHICULO ".$vehiculo['marca']." HA SIDO ACTIVADO ";

            Doo::db()->insert($notificacion);

        }

        return Doo::conf()->APP_URL."vehiculos";

    }



    public function viewdocumentos () {

        $id = $this->params['pindex'];

        if(isset($id)){

            $this->data['id'] = $id;

            $this->data['rootUrl'] = Doo::conf()->APP_URL;

            $this->data['vehiculo'] = Doo::db()->find("Vehiculos",array("where"=>"id=?","limit"=>1,"param"=>array($id)));

            $this->data['documentos'] = Doo::db()->query("SELECT dcd.id, d.nombre AS tipo, d.nombre_carpeta, dcd.id_vehiculo,dcd.nombre_documento,dcd.fecha_expedicion,dcd.fecha_vencimiento, dcd.estado

                                        FROM documentos_conductor_data dcd

                                        INNER JOIN documentos d ON (d.id=dcd.id_documento)

                                        WHERE id_vehiculo = '$id'")->fetchAll();

            $this->data['content'] = "vehiculosp/documentos.php";

            $this->renderc('index',$this->data,true);

        }else{

            return Doo::conf()->APP_URL;

        }

    }

    

    public function getDocumentosVencidos(){

        $id= $_POST["id_vehiculo"];

        $documentos  = Doo::db()->query("SELECT dcd.id, d.nombre AS tipo, d.nombre_carpeta, dcd.id_vehiculo,dcd.nombre_documento,dcd.fecha_expedicion,dcd.fecha_vencimiento, if(dcd.estado <=> null,'I',dcd.estado) as estado 

        FROM documentos d LEFT JOIN documentos_conductor_data dcd ON (dcd.id_documento = d.id AND id_vehiculo = '$id') WHERE d.tipo='VE' and d.vencimiento='S' and d.requerido = 'S' ")->fetchAll();

        echo json_encode($documentos);

    }



    public function rechazardocumento() {

        if(isset($_POST)){

            $id_doc = $_POST['id_doc'];

            $id_vehiculo = $_POST['id_vehiculo'];

            $id_p = Doo::db()->query("SELECT u.id , u.id_usuario

                                    FROM vehiculos v

                                    INNER JOIN usuarios u ON (u.id_usuario=v.id_propietario)

                                    WHERE v.id = '$id_vehiculo' LIMIT 1")->fetch();

            $id_prop = $id_p["id"];

            $notificacion = $_POST['notify'];

            $comentario = $_POST['comentario'];

            $documento = $_POST['documento'];

            $sql = "INSERT INTO notificaciones(tipo,id_vehiculo,id_documento,id_propietario,mensaje) VALUES ('RDV','$id_vehiculo','$id_doc','$id_prop','$comentario')";

            $sql1 = "UPDATE documentos_conductor_data SET estado = 'I' WHERE id = '$id_doc' AND id_vehiculo = '$id_vehiculo'";

            Doo::db()->query($sql);

            Doo::db()->query($sql1);

            echo "1";

        }else{

            return Doo::conf()->APP_URL;

        }

    }

    

    public function activar(){

            $id_doc = $_POST['id_doc'];

            $id_vehiculo = $_POST['id_vehiculo'];

            $sql1 = "UPDATE documentos_conductor_data SET estado = 'A' WHERE id = '$id_doc' AND id_vehiculo = '$id_vehiculo'";

     

            Doo::db()->query($sql1);

    }



    public function notificaciones (){

        $id = $_POST['id_prop'];

        $rechazados = Doo::db()->query("SELECT n.id, c.placa, d.nombre AS documento, n.id_documento,n.id_conductor,n.id_propietario,n.tipo,n.mensaje, n.fecha

        FROM notificaciones n 

        INNER JOIN vehiculos c ON (c.id=n.id_vehiculo)

        INNER JOIN documentos_conductor_data dcd ON (dcd.id=n.id_documento)

        INNER JOIN documentos d ON (d.id=dcd.id_documento)

        WHERE n.id_propietario = '$id' AND n.tipo = 'RDV' AND n.estado = 'A'")->fetchAll();

        echo json_encode($rechazados);

    }



    public function curriculum()

    {

        ob_start();

        Doo::loadClass("pdf/fpdf");

        Doo::loadClass("reportes/HojaVida");

        $pdf = new HojaVida('P','mm','A4');

        $pdf->AliasNbPages();

        $pdf->AddPage();

        $pdf->SetFont('Times','',12);

        $id = $this->params['pindex'];
        

        $vehi = Doo::db()->query("SELECT v.placa, v.num_interno, cv.nombre AS clase, v.modelo, v.marca, v.capacidad, v.cilindraje, v.motor,v.chasis, p.razon_social AS propietario,

        v.color, v.combustible, v.fechaExpeLic, v.fechaMatricula, v.linea, v.numLicTran, v.numSerie, v.potencia, v.puertas, v.servicio, v.tipoCarroceria, v.vin FROM vehiculos v 

        LEFT JOIN clases_vehiculos cv ON v.id_clase = cv.id

        LEFT JOIN propietarios p ON p.id=v.id_propietario

        WHERE v.id = '$id' LIMIT 1")->fetch();



        $mant = Doo::db()->query("SELECT tipo, fecha, km, SUBSTRING(descripcion, 1, 80) AS descripcion FROM mantenimiento 

        WHERE ESTADO = 'T' AND vehiculoId = $id ORDER BY id DESC LIMIT 10")->fetchAll();



        $docs = Doo::db()->query("SELECT d.nombre AS doc, d.nombre_carpeta AS dir, dd.nombre_documento AS archivo, dd.fecha_expedicion, dd.fecha_vencimiento, dd.atributos FROM documentos_conductor_data dd

        LEFT JOIN documentos d ON dd.id_documento = d.id

        WHERE id_vehiculo = '$id'")->fetchAll();

        // var_dump($docs);

        // exit;



        $pdf->Body($vehi, $docs, $mant);

        ob_end_clean();

        $pdf->Output();

    }


    public function openNotify(){

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE notificaciones SET estado = 'D' WHERE id = '$id' ");

        $aux = Doo::db()->query("SELECT * FROM notificaciones WHERE id = '$id'")->fetch();
        
        return Doo::conf()->APP_URL."vehiculos_propietario/documentos/".$aux['id_vehiculo'];         

    }

    



}



?>