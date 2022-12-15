<?php

/**
 * Description of PerfilesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class PerfilesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        }
    }
    
    public function perfil(){
        $login = $_SESSION["login"];
        $usuario = Doo::db()->find("Usuarios", array("select" => "id,usuario,imagen,nombre,identificacion", 'where' => 'id = ?', 'limit' => 1, 'param' => array($login->id)));        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['usuario'] = $usuario;
        $this->data['content'] = 'usuarios/perfil.php';
        $this->renderc('index', $this->data);
    }
    
    public function perfil_save() {
        Doo::loadModel("Usuarios");
        Doo::loadHelper('DooFile');
        $usuario = new Usuarios($_POST);
        if ($usuario->id == "") {
            $usuario->id = Null;
        }
        if ($usuario->id == Null) {
            
        } else {
            $img = "";
            // Validacion si existe la imagen de l Firma
            if ($_FILES["imagen"]["name"] != "") {
                $gd2 = new DooFile();
                $type2 = $gd2->getUploadFormat('imagen');
                if ($type2 == "image/png" || $type2 == "image/jpeg") {
                    $img = $gd2->upload(Doo::conf()->IMG_DIR . 'users/', 'imagen', 'user_image_' . $usuario->id);
                } else {
                    $img = "";
                    //throw new Exception('Formato del Archivo no Valido!');
                }
            }

            $include = "";
            if ($img != "") {
                $include = ", imagen='$img'";
            }
            $fecha_update = date("Y-m-d H:i:s");
            Doo::db()->query("UPDATE usuarios SET usuario='$usuario->usuario',identificacion='$usuario->identificacion',nombre='$usuario->nombre', updated_at='$fecha_update' $include where id='$usuario->id'");
        }
        return Doo::conf()->APP_URL;
    }
    
}

?>
