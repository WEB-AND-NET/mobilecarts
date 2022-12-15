<?php

/**
 * Description of BarriosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class PasajerosController extends DooController {
    
    
    public function save() {
        Doo::loadModel("Pasajeros");
        $pasajeros = new Pasajeros($_POST);
        if ($pasajeros->id == "") {
            $pasajeros->id = Null;
        }
       

        if ($pasajeros->id == Null) {
            $pasajeros->id = Doo::db()->Insert($pasajeros);
        } else {
            Doo::db()->Update($pasajeros);
        }
        echo json_encode(array("message" => "Success"));
    }
    
    public function getPasajeros(){
        if(isset($_REQUEST["search"])){
            $param=$_REQUEST["search"];
            $json["item"] = Doo::db()->query("SELECT id,nombre  FROM pasajeros WHERE nombre  LIKE '%$param%'")->fetchAll();
            echo json_encode($json);
        }
    }
    
    public function getAllPasajeros(){
  
        if (isset($_SESSION["pasajeros"])) {
            $datos = unserialize($_SESSION["pasajeros"]);
        } else {
            $datos = array();
        }
        $data=array("data"=>$datos);
        echo json_encode($data);
    }
    
    
    
    public function insertPasajero(){
        $id = $_POST["id"];
        if (isset($_SESSION["pasajeros"])) {
            $datos = unserialize($_SESSION["pasajeros"]);
        } else {
            $datos = array();
        }
        $datos[] =  Doo::db()->query("SELECT * FROM `pasajeros` where id = '$id'")->fetch();
        $_SESSION["pasajeros"]=serialize($datos);
    }
    
    public function remove(){
        $index = $_POST["index"];
        if (isset($_SESSION["pasajeros"])) {
            $datos = unserialize($_SESSION["pasajeros"]);
        } else {
            $datos = array();
        }
        $fila = array_slice($datos, $index , 1);
        array_splice($datos, $index , 1);
        $_SESSION["pasajeros"] = serialize($datos);
    }
    
}