<?php

/**
 * Description of BarriosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class BarriosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["209"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT b.id,b.nombre AS barrio,z.nombre AS zona FROM barrios b 
                INNER JOIN zonas z ON (b.id_zona= z.id)";
        $this->data['barrios'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'barrios/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Barrios");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['barrios'] = new Barrios();

        $this->data['zona'] = Doo::db()->query('SELECT z.id,concat(z.nombre, "  -  ", r.nombre) AS nombre FROM zonas z INNER JOIN regiones r ON (r.id = z.id_region) WHERE z.deleted = "0" ORDER BY r.nombre,z.nombre ASC')->fetchAll();

        $this->data['content'] = 'barrios/from.php';
        $this->renderc('index', $this->data);
    }

    public function edit() {
        $id = $this->params["pindex"];
        $barrio = Doo::db()->find("Barrios", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['barrios'] = $barrio;

        $this->data['zona'] = Doo::db()->query('SELECT z.id,concat(z.nombre, "  -  ", r.nombre) AS nombre FROM zonas z INNER JOIN regiones r ON (r.id = z.id_region) WHERE z.deleted = "0" ORDER BY r.nombre,z.nombre ASC')->fetchAll();

        $this->data['content'] = 'barrios/from.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("Barrios");
        $barrio = new Barrios($_POST);
        if ($barrio->id == "") {
            $barrio->id = Null;
        }
        $barrio->deleted = "0";

        if ($barrio->id == Null) {
            $barrio->id = Doo::db()->Insert($barrio);
            $this->update_tarifas($barrio);
        } else {
            Doo::db()->Update($barrio);
        }
        return Doo::conf()->APP_URL . "barrios";
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE barrios SET deleted=1 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "barrios";
    }

    public function validar() {
        $nombre = $_POST["nomb"];
        $id = $_POST["id"];
        $count1 = Doo::db()->query("select * from barrios where nombre = '$nombre' AND id <> '$id'")->rowCount();
        if ($count1 > 0)
            echo true;
        else
            echo false;
    }
    
    public function update_tarifas($barrio){
        //$barrios = Doo::db()->query("select id,id_zona,nombre from barrios")->fetchAll();// where id_zona = 19
        $id_zona = $barrio->id_zona;
        $barrios = Doo::db()->query("select b.id,b.id_zona,b.nombre FROM barrios b INNER JOIN zonas z ON (b.id_zona = z.id) INNER JOIN regiones r ON (z.id_region = r.id) WHERE z.id = $id_zona")->fetchAll();// where id_zona = 19
        
        $i_id_d = $barrio->id;
        $i_id_zonad = $barrio->id_zona;
        $i_nombred = $barrio->nombre;
//        exit($barrio->id. " - ".$barrio->id_zona. " - ".$barrio->nombre);
                
        foreach ($barrios as $b1){
            $i_id_o = $b1["id"];
            $i_id_zonao = $b1["id_zona"];
            $i_nombreo = $b1["nombre"];            
                
                $t = $this->db()->find("TarifasTransfers", array("where" => "(id_o = ? AND id_d = ?) OR (id_o = ? AND id_d = ?) ",
                    "limit" => 1,
                    "param" => array($i_id_o, $i_id_d, $i_id_d,$i_id_o)
                        )
                );               
                //INSERT INTO tarifas (id_o, id_zonao, id_d, id_zonad, nombreo, nombred, valor) 
                if ($t == Null) { // o $u == false
                    $t = new TarifasTransfers();
                    $t->id = NUll;
                    $t->id_o = $i_id_o;
                    $t->id_zonao = $i_id_zonao;
                    $t->id_d = $i_id_d;
                    $t->id_zonad = $i_id_zonad;
                    $t->nombreo = $i_nombreo;
                    $t->nombred = $i_nombred;
                    $t->valor = 0;
                    /*
                     * Registrar solo intermunicipales con relación a cartagena.
                    echo "exprecion => $t->id_zonao === 19 && $t->id_zonad === 19) && ($t->id_o !== 139 || $t->id_d !== 139 ===".($t->id_zonao == 19 && $t->id_zonad == 19) && ($t->id_o != 139 || $t->id_d != 139)."\n";
                     * 
                     */
                    if( ($t->id_zonao == 19 && $t->id_zonad == 19) && ($t->id_o != 139 && $t->id_d != 139) ){
                        //echo("NO REGISTRAR\n = $i_nombreo <-> $i_nombred \n\n");
                    }else{   
                        if( ($t->id_zonao == 19 || $t->id_zonad == 19) && ($t->id_zonao != $t->id_zonad) ){
                            //echo("NO REGISTRAR\n = $i_nombreo <-> $i_nombred\n\n");
                        }else{
                            //echo("SI REGISTRAR\n = $i_nombreo <-> $i_nombred \n\n");   
                            Doo::db()->insert($t);
                        }
                        //Doo::db()->insert($t);
                    }
                }
        }
        //exit();
    }

}
