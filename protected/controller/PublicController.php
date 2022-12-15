<?php

/**
 * Description of PublicController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class PublicController extends DooController {    
    
    public function fuec(){
        //header('Content-Type: application/json');        
        $id = $this->params["pindex"];
        //$q = 'SELECT CONCAT("# ",territorial," ",resolucion_hab," ",ano_hab," ",ano_actual) AS header FROM parametros WHERE id = 1';
        $q = 'SELECT territorial,resolucion_hab,ano_hab,ano_actual FROM parametros WHERE id = 1';
        $header= Doo::db()->query($q)->fetch();

        $q1 = "SELECT o.id,o.numero,o.objetoc,co.numero AS contrato,o.id_cliente,o.recorrido,c.tipo AS tipo_cliente,c.identificacion,c.celular,c.direccion,c.nombre AS cliente,con.identificacion AS c_identificacion,
                c.c_identificacion AS r_identificacion,c.c_nombre AS r_nombre,c.c_celular AS r_celular,c.c_direccion AS r_direccion,
                con.nombre AS c_nombre,con.telefono AS c_telefono,con.direccion AS c_direccion,o.origen,o.destino,b1.nombre AS barrio_o,
                b2.nombre AS barrio_d,v.id AS id_vehiculo,v.placa,v.modelo,v.marca,cv.nombre AS clase,v.num_interno,v.tg_operacion,o.fecha,
                date_format(o.fecha_inicial,'%Y/%m/%d') AS inicial,
                date_format(o.fecha_final,'%Y/%m/%d') AS final,
                date_format(o.fecha,'%d de %M del %Y, Hora %r') AS expedido
                FROM ordenes_servicios o INNER JOIN clientes c ON (o.id_cliente = c.id) 
                LEFT JOIN contactos con ON (con.id = o.id_contacto)
                INNER JOIN contratos co ON (c.id = co.id_cliente) LEFT JOIN vehiculos v ON (o.id_vehiculo = v.id)
                LEFT JOIN clases_vehiculos cv ON (cv.id = v.id_clase) LEFT JOIN barrios b1 ON (o.barrio_o = b1.id)
                LEFT JOIN barrios b2 ON (o.barrio_d = b2.id) WHERE o.id = '$id';";
        //exit($q1);
        Doo::db()->query("SET lc_time_names = 'es_CO';");
        $orden = Doo::db()->query($q1)->fetch();

        if (isset($orden["id_vehiculo"])) {
            $q2 = "SELECT c.nombre,c.identificacion,c.n_licencia,c.vigencia,c.email FROM conductores c ";
            $q2.= "INNER JOIN vehiculos_conductores vc ON (c.id = vc.id_conductor) INNER JOIN vehiculos v ";
            $q2.= "ON (v.id = vc.id_vehiculo) WHERE vc.deleted = 0 and  v.id = '" . $orden["id_vehiculo"] . "'";
            $conductores = Doo::db()->query($q2)->fetchAll();
        } else {
            $conductores = array();
        }
        
        $q3 ="SELECT oc.id,c.id AS id_conductor,c.identificacion,c.nombre,c.n_licencia,c.vigencia
        FROM conductores c 
        INNER JOIN ordenes_conductores oc ON(c.id = oc.id_conductor) 
        WHERE oc.deleted=0 AND oc.id_servicio = $id";
        $ordenesCondu = Doo::db()->query($q3)->fetchAll();

        $data = array();
        $data["header"] = $header;
        $data["orden"] = $orden;
        $data["conductores"] = $conductores;
        $data["ordenesCondu"] = $ordenesCondu;
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['fuec'] = $data;

        $this->renderc('fuec', $this->data, true);
    }
    //Funcionales %100 admin
//    public function tarifas(){
//        header('Content-Type: text/plain');
//        Doo::loadModel("TarifasTransfers");
//        $barrios = Doo::db()->query("select id,id_zona,nombre from barrios")->fetchAll();// where id_zona = 19
//        
//        foreach ($barrios as $b1){
//            $i_id_o = $b1["id"];
//            $i_id_zonao = $b1["id_zona"];
//            $i_nombreo = $b1["nombre"];
//            foreach ($barrios as $b2){
//                $i_id_d = $b2["id"];
//                $i_id_zonad = $b2["id_zona"];
//                $i_nombred = $b2["nombre"];
//                
//                $t = $this->db()->find("TarifasTransfers", array("where" => "(id_o = ? AND id_d = ?) OR (id_o = ? AND id_d = ?) ",
//                    "limit" => 1,
//                    "param" => array($i_id_o, $i_id_d, $i_id_d,$i_id_o)
//                        )
//                );               
//                //INSERT INTO tarifas (id_o, id_zonao, id_d, id_zonad, nombreo, nombred, valor) 
//                if ($t == Null) { // o $u == false
//                    $t = new TarifasTransfers();
//                    $t->id = NUll;
//                    $t->id_o = $i_id_o;
//                    $t->id_zonao = $i_id_zonao;
//                    $t->id_d = $i_id_d;
//                    $t->id_zonad = $i_id_zonad;
//                    $t->nombreo = $i_nombreo;
//                    $t->nombred = $i_nombred;
//                    $t->valor = 0;
//                    /*
//                     * Registrar solo intermunicipales con relación a cartagena.
//                    echo "exprecion => $t->id_zonao === 19 && $t->id_zonad === 19) && ($t->id_o !== 139 || $t->id_d !== 139 ===".($t->id_zonao == 19 && $t->id_zonad == 19) && ($t->id_o != 139 || $t->id_d != 139)."\n";
//                     * 
//                     */
//                    if( ($t->id_zonao == 19 && $t->id_zonad == 19) && ($t->id_o != 139 && $t->id_d != 139) ){
//                        //echo("NO REGISTRAR\n = $i_nombreo <-> $i_nombred \n\n");
//                    }else{   
//                        if( ($t->id_zonao == 19 || $t->id_zonad == 19) && ($t->id_zonao != $t->id_zonad) ){
//                            //echo("NO REGISTRAR\n = $i_nombreo <-> $i_nombred\n\n");
//                        }else{
//                            //echo("SI REGISTRAR\n = $i_nombreo <-> $i_nombred \n\n");   
//                            Doo::db()->insert($t);
//                        }
//                        //Doo::db()->insert($t);
//                    }
//                    //Doo::db()->insert($t);
//                }
//                
//            }
//        }
//        exit();
//    }
//    
//    public function updateValores(){
//        Doo::loadModel("Tarifas2");
//        $tarifas = Doo::db()->query("SELECT id_o,id_zonao,id_d,id_zonad,nombreo,nombred,valor FROM tarifas3 where valor != 0")->fetchAll();
//        $count = 0;
//        foreach ($tarifas as $tf){
//            $t = $this->db()->find("Tarifas2", array("where" => "(id_o = ? AND id_d = ?) OR (id_o = ? AND id_d = ?) ",
//                    "limit" => 1,
//                    "param" => array($tf["id_o"], $tf["id_d"], $tf["id_d"],$tf["id_o"])
//                        )
//            ); 
//            if ($t != Null) {
//                $t->valor = $tf["valor"];
//                Doo::db()->update($t);
//                $count++;
//            }
//        }
//        echo $count;
//    }
//    
//    public function updateUsuariosPropietarios(){
//        Doo::loadModel("Propietarios");
//        $propietarios = Doo::db()->query("SELECT id,identificacion,razon_social AS nombre FROM propietarios WHERE deleted = 0")->fetchAll();
//        $count = 0;
//        $count2 = 0;
//        foreach ($propietarios as $p){
//            $u = $this->db()->find("Usuarios", array("where" => "identificacion = ? AND tipo = 'P' ",
//                    "limit" => 1,
//                    "param" => array($p["identificacion"])
//                    )
//            ); 
//            if ($u != Null) {
//                //Doo::db()->update($p);
//                $count++;
//            }else{
//                $count2++;
//                $user = new Usuarios();
//                $user->identificacion = $p["identificacion"];
//                $user->usuario = $p["identificacion"];
//                $user->nombre = $p["nombre"];
//                $user->password = md5($p["identificacion"]);
//                $user->role = 3;
//                $user->tipo = "P";
//                $user->id_usuario = $p["id"];
//                $user->deleted = "0";
//                $user->created_at = date('Y-m-d H:i:s');
//                $user->updated_at = date('Y-m-d H:i:s');
//                //echo $p["identificacion"].", ";
//                Doo::db()->insert($user);
//            }
//        }
//        //echo "Registrados ".$count." <-> No Registrados ".$count2;
//    }
        
//    public function deleteUsuariosClientesPropietarios(){
//        Doo::loadModel("Usuarios");
//        $usuarios_delete = Doo::db()->query('SELECT u.id,c.tipo,c.identificacion,c.nombre,u.tipo,u.identificacion,u.nombre
//                    FROM usuarios u inner join clientes c ON (u.identificacion = c.identificacion) 
//                    where  c.tipo =  "P" AND u.tipo = "C"')->fetchAll();
//        $count = 0;
//        foreach ($usuarios_delete as $ud){
//            $u = $this->db()->find("Usuarios", array("where" => "id = ?",
//                    "limit" => 1,
//                    "param" => array($ud["id"])
//                    )
//            ); 
//            if ($u != Null) {
//                Doo::db()->delete($u);
//                echo $u->identificacion.",\n";
//                $count++;
//            }
//        }
//        //echo "Registrados ".$count." <-> No Registrados ".$count2;
//    }
    
//    public function transferirTarifas(){
//        Doo::loadModel("TarifasTransfers");
//        Doo::loadModel("TarifasTransfersCustom");
//        $tarifas = Doo::db()->find("TarifasTransfers", array("select" => "id, valor,nombreo,nombred", "where" => "valor > 0"));
//        foreach ($tarifas as $t){
//            
//            
//            $existe = $this->db()->find("TarifasTransfersCustom", array("where" => "id_tarifa = ? and id_cliente = 25 and id_clase_vehiculo = 5",
//                    "limit" => 1,
//                    "param" => array($t->id)
//                    )
//            ); 
//            if ($existe == Null) {
//                echo $t->id." - ".$t->valor." - ".$t->nombreo." - ".$t->nombred."</br>";
//                $tt = new TarifasTransfersCustom();
//                $tt->id = null;
//                $tt->id_tarifa = $t->id;
//                $tt->id_clase_vehiculo = 5;
//                $tt->id_cliente = 25;            
//                $tt->valor = $t->valor;
//                Doo::db()->insert($tt);
//            }else{
//                echo"Ya existe</br>";
//            }                       
//        }
//        echo 'Exitos..!';
//    }

     /*public function actualizarTarifas(){
        Doo::loadModel("TarifasTransfers");
        $tarifas = Doo::db()->query("SELECT id,nombreo,nombred,valor FROM tarifas_transfers2")->fetchAll();
        $count = 0;
        foreach ($tarifas as $tf){
            $t = $this->db()->find("TarifasTransfers", array("where" => "id = ?",
                    "limit" => 1,
                    "param" => array($tf["id"])
                        )
            ); 
            if ($t != Null) {
                $t->valor = $tf["valor"];
                Doo::db()->update($t);
                $count++;
            }
        }
        echo "Tarifas actualizadas {".$count."}";
    }

    public function asignarTarifas(){
        Doo::loadModel("TarifasTransfersCustom");
        Doo::loadModel("TarifasTransfersCustomNew");
        $list_ttcn = Doo::db()->find("TarifasTransfersCustomNew");
        foreach($list_ttcn as $ttcn){
            //var_dump($ttcn);
            $existe = $this->db()->find("TarifasTransfersCustom", array("where" => "id_tarifa = ? and id_cliente = ? and id_clase_vehiculo = ?",
                    "limit" => 1,
                    "param" => array($ttcn->id_tarifa,$ttcn->id_cliente,$ttcn->id_clase_vehiculo)
                    )
            ); 
            if($existe == Null){
                $t = new TarifasTransfersCustom();
                $t->id_tarifa = $ttcn->id_tarifa;
                $t->id_cliente = $ttcn->id_cliente;
                $t->id_clase_vehiculo = $ttcn->id_clase_vehiculo;
                $t->valor = $ttcn->valor;
                Doo::db()->insert($t);
            }else{
                echo "Ya existe esta tarifa<br>";
                echo json_encode($ttcn);
                echo "<br>Con este valor {".$ttcn->valor."}<br>";
                echo "<br>";
            }         
        }
    }*/

}
