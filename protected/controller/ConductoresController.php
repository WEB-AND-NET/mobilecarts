<?php

/**
 * Description of ConductoresController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ConductoresController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            /*if ($_SESSION["permisos"]["202"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }*/
        }
    }

    public function index()
    {
        $login = $_SESSION['login'];

        $this->data['role'] = $login->role;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'conductores/list.php';
        if ($login->role == "3") {
            $sql = "SELECT id,identificacion,nombre,celular,email,tipo,estado_c_p FROM conductores WHERE deleted=0 AND id_propietario = '$login->id_usuario' ORDER BY nombre ASC";
            $this->data['conductores'] = Doo::db()->query($sql)->fetchAll();
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $sql = "SELECT c.id,c.identificacion,c.nombre,c.celular,c.email,c.tipo,c.estado_c_p, p.razon_social AS propietario FROM conductores c LEFT JOIN propietarios p ON (c.id_propietario=p.id) WHERE c.deleted=0 ORDER BY c.nombre ASC";
            $this->data['conductores'] = Doo::db()->query($sql)->fetchAll();
            $this->renderc('index', $this->data, true);
        }
    }

    public function documentos(){
        $id=$this->params["pindex"];
        $login = $_SESSION['login'];
        $documentos = Doo::db()->find("Documentos", array("where" => "deleted=1 and tipo = 'CR'" ));
        /*$documentosC = Doo::db()->query("SELECT * FROM documentos_conductor_data WHERE id_conductor='$id'")->fetchAll();
        $allDocumentsCon=array();
        foreach($documentosC as $doc){
            $doc['atributos'] = json_decode($doc['atributos'],true);
            $allDocumentsCon[]=$doc;
        }*/
        $this->data['rol'] = $_SESSION['login']->role;
        $allDocument=array();
        foreach($documentos as $docume){
            $docume->attr=json_decode($docume->attr,true);
            $allDocument[]=$docume;
        }
        $this->data['id']=$id;
        //$this->data['documentosC']=$allDocumentsCon;
        $this->data['documentos']=$allDocument;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'conductores/documentos.php';
        if($login->role == "3"){
            $this->renderc('index_propietarios', $this->data);
        }else{
            $this->renderc('index', $this->data, true);
        }
        
    }

    public function saveDocs(){

        Doo::loadModel("DocumentosConductorData");
        $doc = new DocumentosConductorData($_POST);
        $tipodoc = Doo::db()->query("SELECT * FROM documentos WHERE id = '$doc->id_documento' LIMIT 1")->fetch();
        $attr = json_decode($tipodoc['attr']);
        $cantidad = sizeof($_POST);
        $doc->nombre_documento = $tipodoc['nombre_carpeta'].$doc->id_conductor;
        $arg = [];
        foreach($attr as $a){
            foreach($_POST as $key=>$value){
                if($a->nombre_tag == $key){
                    $arg[$key] = $value;
                }                
            }
        }
      
        $doc->atributos = "[".json_encode($arg)."]";
        $auxiliar = Doo::db()->query("SELECT * FROM documentos_conductor_data WHERE id_conductor = '$doc->id_conductor' AND id_documento = '$doc->id_documento' LIMIT 1 ")->fetch();
        if($auxiliar){
            Doo::db()->query("UPDATE documentos_conductor_data 
            SET fecha_expedicion = '$doc->fecha_expedicion',
            fecha_vencimiento = '$doc->fecha_vencimiento', estado = 'A',
            atributos = '$doc->atributos' WHERE id_conductor = '$doc->id_conductor' AND id_documento = '$doc->id_documento' ");
        } else {
            Doo::db()->Insert($doc);
        }
        echo "Documento Exitoso";
    }
    

    public function getDocs() {
        
        $id = $_POST['id'];
        
        $datos = Doo::db()->query("SELECT id, id_documento, id_conductor, nombre_documento, fecha_expedicion, fecha_vencimiento, atributos,estado, DATEDIFF(fecha_vencimiento,CURDATE()) AS resto FROM documentos_conductor_data WHERE id_conductor = '$id'")->fetchAll();

        echo json_encode($datos);
        
    }

    public function add() {
        $login = $_SESSION['login'];
        Doo::loadModel("Conductores");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $c = new Conductores();
        $c->vigencia = date('m/d/Y');
        $this->data['propietarios'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['conductores'] = $c;

        $this->data['conductore'] = Doo::db()->find("Conductores", array("select" => "id,nombre", "desc" => "id"));
        $this->data['content'] = 'conductores/from.php';
        $this->data['role']=$login->role;
        if($login->role == "3"){
            $this->renderc('index_propietarios', $this->data);
        } else {
            $this->renderc('index', $this->data);
        }
    }

    public function edit() {
        $login = $_SESSION['login'];
        $id = $this->params["pindex"];
        $conductores = Doo::db()->find("Conductores", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $conductores->vigencia = (new DateTime($conductores->vigencia))->format('m/d/Y');
        $this->data['conductores'] = $conductores;
        $this->data['propietarios'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "asc" => "razon_social", 'where' => 'deleted = 0'));
        $this->data['content'] = 'conductores/from.php';
        $this->data['role']=$login->role;
        if($login->role == "3"){
            $this->renderc('index_propietarios', $this->data);
        } else {
            $this->renderc('index', $this->data);

        }
    }

    public function save() {
        Doo::loadModel("Conductores");
        $login = $_SESSION['login'];
        
        $conductores = new Conductores($_POST);
        if ($conductores->id == "") {
            $conductores->id = Null;
        }

        //Formateando la fecha de nacimiento de la licencia
        $date = new DateTime($conductores->fecha_nac);
        $conductores->fecha_nac = $date->format('Y-m-d');
        //..............................................
        if ($conductores->id == Null) {
            //Formateando la fecha de vigencia de la licencia
            $date = new DateTime($conductores->vigencia);
            $conductores->vigencia = $date->format('Y-m-d');
            //..............................................
            

            $conductores->password = md5($conductores->identificacion);
            $conductores->imagen = "";
            $conductores->estado = "D";
            $conductores->created_at = date('Y-m-d H:i:s');
            $conductores->updated_at = date('Y-m-d H:i:s');
            if($login->role == "3"){ 
            $conductores->id_propietario = $login->id_usuario;
            }
            $conductores->id = Doo::db()->insert($conductores);
            
                
            $mensaje = "(".$login->nombre.")<br>Nuevo conductor Registrado: ".$conductores->nombre;
            Doo::db()->query("INSERT INTO notificaciones(mensaje,tipo,id_conductor) VALUES ('$mensaje','NC','$conductores->id')");
        } else {
            //Formateando la fecha de vigencia de la licencia
            $date = new DateTime($conductores->vigencia);
            $conductores->vigencia = $date->format('Y/m/d');
            //..............................................
            if($login->role == "3"){ 
                $conductores->id_propietario = $login->id_usuario;
            }
            $conductores->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($conductores);
        }
        return Doo::conf()->APP_URL . "conductores";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE conductores SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "conductores";
    }

    public function validar() {
        $identificacion = $_POST["ced"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("SELECT id FROM conductores WHERE identificacion = '$identificacion' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    public function validare() {
        $email = $_POST["email"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("SELECT id FROM conductores WHERE email = '$email' AND id <> '$id'")->rowCount();
        if ($count1 > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    public function posiciones() {
        header('Content-Type: application/json');
        $pat = Doo::conf()->APP_URL . 'global/img/users/';
        //$clientes = Doo::db()->query("SELECT id,nombre,latitud,longitud FROM conductores WHERE deleted = '0' ORDER BY nombre ASC ")->fetchAll();
        $query = "SELECT c.id,c.nombre,c.celular,c.latitud,c.longitud,v.id AS id_veh,v.placa,v.marca,v.modelo,
                  CONCAT('$pat',if(isnull(u.imagen) || u.imagen = '','default.jpg',u.imagen) ) AS user_img
                  FROM conductores c
                  INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor)
                  INNER JOIN vehiculos v ON (v.id = vc.id_vehiculo)
                  INNER JOIN usuarios u ON (c.id = u.id_usuario)
                  WHERE estado = 'D' AND c.deleted = '0' AND !ISNULL(c.latitud) AND !ISNULL(c.longitud) AND u.tipo='D' ORDER BY c.nombre ASC";
        $clientes = Doo::db()->query($query)->fetchAll();
        echo json_encode($clientes);
    }


    public function activate () {

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE conductores SET estado_c_p = 'A' WHERE id = '$id' ");

        $this->index();

    }



    public function deactivate2() {

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE conductores SET estado_c_p = 'I' WHERE id = '$id' ");

        $this->index();

    }

    public function saveAll(){
        $id_d=$_POST["id_doc"];
        $id_c=$_POST["id_c"];
        $documento = Doo::db()->find("Documentos", array("where" => "deleted=1 and id=?", 'limit' => 1,"param"=>array($id_d)));
        Doo::loadHelper('DooFile');
        $htmlname="nombre_documento$_POST[id_doc]";
       
        if ($_FILES[$htmlname]["name"] != "") {
            $name = $_FILES[$htmlname]["name"];
            $ext = end((explode(".", $name)));   
            $gd2 = new DooFile();
                
            $img = $gd2->upload(Doo::conf()->DOC.$documento->nombre_carpeta.'/' , $htmlname, $documento->nombre_carpeta.$id_c);
            
            $name=$documento->nombre_carpeta.$id_c.".".$ext;
              Doo::db()->query("update documentos_conductor_data set nombre_documento='$name' where  id_conductor='$id_c' and id_documento='$id_d'");
     
        }
        echo $name;
    }
    
    public function curriculum()
    
        {
    
            ob_start();
    
            Doo::loadClass("pdf/fpdf");
    
            Doo::loadClass("reportes/HojaVidaConductor");
    
            $pdf = new HojaVida('P','mm','A4');
    
            $pdf->AliasNbPages();
    
            $pdf->AddPage();
    
            $pdf->SetFont('Times','',12);
    
            $id = $this->params['pindex'];
            
            
            $cond = Doo::db()->query("SELECT nombre, celular, telefono, grupo_san, email, tipo, tipo_identificacion, apellidos, estadocv, genero, fecha_nac, niveled, libreta_mil, clase, dm, vigencia, direccion, eps, arl, fondope, fondoce, cajacom, cat_licencia, n_licencia, identificacion FROM conductores WHERE id = $id")->fetch();
    
            $segs = [];
    
            $docs = Doo::db()->query("SELECT d.nombre AS doc, d.nombre_carpeta AS dir, dd.nombre_documento AS archivo, dd.fecha_expedicion, dd.fecha_vencimiento, dd.atributos FROM documentos_conductor_data dd

            LEFT JOIN documentos d ON dd.id_documento = d.id

            WHERE id_conductor = $id")->fetchAll();
    
    
            $pdf->Body($cond, $segs, $docs);
    
            ob_end_clean();
    
            $pdf->Output();
    
        }


}
