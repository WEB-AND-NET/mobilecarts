<?php 



class ConductoresPropietarioController extends DooController {



    public function index() {

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $sql = "SELECT c.id,c.identificacion,c.nombre, u.nombre AS propietario, c.celular,c.email,c.tipo, c.estado_c_p, c.created_at

                        FROM conductores c  

                        INNER JOIN usuarios u ON (c.id_propietario=u.id)

                        WHERE id_propietario IS NOT NULL ORDER BY created_at DESC";

        $this->data['conductores'] = Doo::db()->query($sql)->fetchAll();

        $this->data['content'] = 'conductoresp/list.php';

        $this->renderc('index', $this->data, true);

    }



    public function activate () {

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE conductores SET estado_c_p = 'A' WHERE id = '$id' ");

        $this->index();

    }



    public function deactivate() {

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE conductores SET estado_c_p = 'I' WHERE id = '$id' ");

        $this->index();

    }



    public function openNotify(){

        $id = $this->params['pindex'];

        Doo::db()->query("UPDATE notificaciones SET estado = 'D' WHERE id = '$id' ");

        $aux = Doo::db()->query("SELECT * FROM notificaciones WHERE id = '$id'")->fetch();

        

        if($aux['tipo']=="NC"){

            return Doo::conf()->APP_URL."conductores/edit/".$aux['id_conductor'];

        } else if ($aux['tipo']=="NCL"){

            return Doo::conf()->APP_URL."clientesp/edit/".$aux['id_propietario']; 

        } else if ($aux['tipo']=="NV"){

            return Doo::conf()->APP_URL."vehiculos/edit/".$aux['id_vehiculo']; 

        }else if ($aux['tipo']=="CDP"){

            return Doo::conf()->APP_URL."conductores/documents/view/".$aux['id_conductor'];

        }else if ($aux['tipo']=="VDP"){

            return Doo::conf()->APP_URL."vehiculos/documents/view/".$aux['id_vehiculo'];
        }else if ($aux['tipo']=="SF"){

            return Doo::conf()->APP_URL."ordenes_servicios";
        }

        

    }



    public function opennotifyp(){

        $id = $this->params['pindex'];

        $notificacion = Doo::db()->find("Notificaciones",array("where"=>"id=?","param"=>array($id)));

        $id_conductor = $notificacion[0]->id_conductor;

        Doo::db()->query("UPDATE notificaciones SET estado = 'D' WHERE id = '$id' ");

        return Doo::conf()->APP_URL."conductores/documents/".$id_conductor;

    }



    public function save() {

        Doo::loadModel("Conductores");

        $conductor = new Conductores($_POST);

        if($conductor->id = null){

            Doo::db()->insert($conductor);

        } else {

            Doo::db()->Update($conductor);

        }

    }



    public function viewdocumentos () {

        $id = $this->params['pindex'];

        if(isset($id)){

            $this->data['id'] = $id;

            $this->data['rootUrl'] = Doo::conf()->APP_URL;

            $this->data['conductor'] = Doo::db()->find("Conductores",array("where"=>"id=?","param"=>array($id)));

            $this->data['documentos'] = Doo::db()->query("SELECT dcd.id, d.nombre AS tipo, d.nombre_carpeta, dcd.id_conductor,dcd.nombre_documento,dcd.fecha_expedicion,dcd.fecha_vencimiento, dcd.estado

                                        FROM documentos_conductor_data dcd

                                        INNER JOIN documentos d ON (d.id=dcd.id_documento)

                                        WHERE id_conductor = '$id'")->fetchAll();

            $this->data['content'] = "conductoresp/documentos.php";

            $this->renderc('index',$this->data,true);

        }else{

            return Doo::conf()->APP_URL;

        }

    }



    public function rechazardocumento() {

        if(isset($_POST)){

            $id_doc = $_POST['id_doc'];

            $id_conductor = $_POST['id_conductor'];

            $id_p = Doo::db()->query("SELECT id_propietario FROM conductores WHERE id = '$id_conductor' LIMIT 1")->fetch();

            $id_prop = $id_p["id_propietario"];

            $notificacion = $_POST['notify'];

            $comentario = $_POST['comentario'];

            $documento = $_POST['documento'];

            $sql = "INSERT INTO notificaciones(tipo,id_conductor,id_documento,id_propietario,mensaje) VALUES ('RD','$id_conductor','$id_doc','$id_prop','$comentario')";

            $sql1 = "UPDATE documentos_conductor_data SET estado = 'I' WHERE id = '$id_doc' AND id_conductor = '$id_conductor'";

            Doo::db()->query($sql);

            Doo::db()->query($sql1);

            echo "1";

        }else{

            return Doo::conf()->APP_URL;

        }

    }

    

     public function setnotifydocs() {

        $id = $this->params['pindex'];

         $sql = "SELECT c.id,c.identificacion,c.nombre, u.nombre AS propietario, c.celular,c.email,c.tipo, c.estado_c_p, c.created_at,u.id_usuario

                        FROM conductores c  

                        INNER JOIN usuarios u ON (c.id_propietario=u.id)

                        WHERE c.id = '$id'";

        $conductor = Doo::db()->query($sql)->fetch();    

        Doo::loadModel("Notificaciones");

        $notify = new Notificaciones();

        $notify->id = null;

        $notify->id_conductor  = $id;

        $notify->id_propietario = $conductor['id_usuario'];

        $notify->tipo = "CDP";

        $mensaje = "(".$conductor['propietario'].") SOLICITO UNA REVISION DE DOCUMENTOS  PARA EL CONDUCTOR ".$conductor['nombre'];

        $notify->mensaje = $mensaje;

        if($conductor){

            Doo::db()->insert($notify);

        }

        

        

        return Doo::conf()->APP_URL."conductores";

    }



    public function notificaciones (){

        $id = $_POST['id_prop'];

        $rechazados = Doo::db()->query("SELECT c.nombre AS conductor, n.id, d.nombre AS documento, n.id_documento,n.id_conductor,n.id_propietario,n.tipo,n.mensaje, n.fecha

        FROM notificaciones n 

        INNER JOIN conductores c ON (c.id=n.id_conductor)

        INNER JOIN documentos_conductor_data dcd ON (dcd.id=n.id_documento)

        INNER JOIN documentos d ON (d.id=dcd.id_documento)

        WHERE n.id_propietario = '$id' AND n.tipo = 'RD' AND n.estado = 'A'")->fetchAll();

        echo json_encode($rechazados);

    }



}



?>