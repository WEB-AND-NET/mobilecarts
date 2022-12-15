<?php

/**
 * Description of DocumentosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class DocumentosController extends DooController {
      

    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['documentos'] = Doo::db()->find("Documentos", array("where" => "deleted=1"));
        $this->data['content'] = 'documentos/list.php';
        $this->renderc('index', $this->data, true);
    }   
    public function add() {
        if (isset($_SESSION["attributes"])) {
            $_SESSION["attributes"]=null;
        } 
        Doo::loadModel("Documentos");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['documentos'] = new Documentos();
        $this->data['content'] = 'documentos/form.php';
        $this->renderc('index', $this->data, true);  
    }

    public function edit() {
        if (isset($_SESSION["attributes"])) {
            $_SESSION["attributes"]=null;
        } 
        $id=$this->params["pindex"];
        Doo::loadModel("Documentos");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['documentos'] = Doo::db()->find("Documentos", array("where" => "deleted=1 and id=?", 'limit' => 1,"param"=>array($id)));
        
        $_SESSION["attributes"]=json_decode( $this->data['documentos']->attr,true);
       
        $this->data['content'] = 'documentos/form.php';
        $this->renderc('index', $this->data, true);  
    }
    public function save(){
        Doo::loadModel("Documentos");
        $Documentos = new Documentos($_POST);
        if($Documentos->id==""){
            $Documentos->id=null;
            $Documentos->nombre_carpeta=$this->limpia_espacios($Documentos->nombre);
            if(!file_exists(Doo::conf()->DOC.$Documentos->nombre_carpeta)){
                mkdir(Doo::conf()->DOC.$Documentos->nombre_carpeta, 0777);
            }
            Doo::db()->insert($Documentos);
        }else{
        
            Doo::db()->update($Documentos);
        }
        return Doo::conf()->APP_URL . "documentos";
    }

   

    public function getAtributes(){
        
    
        if (isset($_SESSION["attributes"])) {
                $datos = $_SESSION["attributes"];
            } else {
                $datos = [];
            }
            $data=array("data"=>$datos);
            echo json_encode($data);
    }

    function setAtributes(){
        if (isset($_SESSION["attributes"])) {
            $datos = $_SESSION["attributes"];
        } else {
            $datos = array();
        }
        if(isset($_POST["pindex"])){
            if($_POST["pindex"]){
                $datos[$_POST["pindex"]-1]=$_POST;
            }
        }else{
            $datos[] = $_POST;
        }
        $_SESSION["attributes"] = $datos;
    }

    function limpia_espacios($cadena){
        $cadena=strtolower($cadena);
        $cadena = str_replace(' ', '_', $cadena);
        return $cadena;
    }






}
