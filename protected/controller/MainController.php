<?php

/**
 * Description of MainController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class MainController extends DooController {

    public $data;
    private $permisos;
    private $accesos;

    public function index() {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL . "login";
        } else {

            $login = $_SESSION['login'];
            $rol = $login->role;
            $tipo = $login->tipo;

            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            if ($rol != "1" && $tipo != "A") {
//                $this->data['content'] = 'home_propietarios.php';
//                $this->renderc('index_propietarios', $this->data, true);
                 return Doo::conf()->APP_URL . "ordenes_servicios";
            } else {
                $this->data['content'] = 'home.php';
                $this->renderc('index', $this->data);
            }
        }
    }

    public function rutalogin() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('login', $this->data);
    }

    public function login() {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['tipo'])) {

                $user = trim($_POST['usuario']);
                $pass = md5(trim($_POST['password']));
                $tipo = $_POST['tipo'];

                $u = $this->db()->find("Usuarios", array("where" => "deleted = '0' and usuario = ? and password = ? and tipo = ? ",
                    "limit" => 1,
                    "param" => array($user, $pass, $tipo)
                        )
                );
           
                
                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Acceso denegado";
                    $this->renderc('login', $this->data);
                } else {
                    unset($_SESSION['login']);
                    $this->buildMenu($u->role);
                    $login = new stdclass();
                    $login->imagen = $u->imagen;
                    $login->usuario = $u->usuario;
                    $login->tipo = $u->tipo;
                    $login->role = $u->role;
                    $login->nombre = $u->nombre;
                    $login->id_usuario = $u->id_usuario;
                    $login->id = $u->id;
                    $r = $this->db()->find("Roles", array("where" => "id = ? ",
                        "limit" => 1,
                        "param" => array($u->role)
                            )
                    );
                    if ($r != null) {
                        $login->perfil = $r->role;
                    } else {
                        $login->perfil = "Sin Perfil";
                    }
                    $login->menu = $this->data["htmlmenu"];
                    $login->toolbar = $this->data["toolbar"];
                    $_SESSION['login'] = $login;
                    $_SESSION['permisos'] = $this->permisos;
                    $_SESSION['accesos'] = $this->accesos;
                    //$this->home();
                    if ($tipo == "A") {
                        return Doo::conf()->APP_URL;
                    } else {
                        return Doo::conf()->APP_URL . "panel/home";
                    }
                }
            } else {
                if ($tipo == "A") {
                    return Doo::conf()->APP_URL;
                } else {
                    return Doo::conf()->APP_URL . 'admpropietarios';
                }
//                return Doo::conf()->APP_URL;
            }
        } else {
            if ($tipo == "A") {
                return Doo::conf()->APP_URL;
            } else {
                return Doo::conf()->APP_URL . 'admpropietarios';
            }
        }
    }

    public function logout() {

        session_unset();
        // Destruir la session PHP
        session_destroy();
        // retornar al sitio de inicio
        return Doo::conf()->APP_URL;
    }

    private function buildMenu($role) {

        $this->data["role"] = $role;

        $sql = "select o.codigo,o.codigo, o.menuitem, o.depende, o.submenu, o.url, r.opcion, o.toolbar,r.acceso
        from opciones o
        inner join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
        where depende = '' ORDER BY orden";
        //and estado = 1

        $rs = Doo::db()->query($sql);
        $parentMenu = $rs->fetchAll();

        $this->data["toolbar"] = "";
        $this->data["permisos"] = array();
        $this->data["accesos"] = array();

        $this->data["htmlmenu"] = '<ul class="sidebar-menu">';
        $this->buildChildMenu($parentMenu);
        $this->data["htmlmenu"].= '</ul>';
        //$this->data["htmlmenu"].= '<br class="clear" />';
    }

    private function buildChildMenu($parentMenu) {

        $role = $this->data["role"];

        foreach ($parentMenu as $row):

            $submenu = $row["submenu"];
            $depende = $row["depende"];
            $codigo = $row["codigo"];
            $opcion = $row["opcion"];
            $toolbar = $row["toolbar"];

            if (strlen($opcion) == Null) {
                $a = 0;
                $access = "N";
            } else {
                $a = 1;
                $access = $row["acceso"];
            }
            $this->permisos[$row["codigo"]] = $a;
            $this->accesos[$row["codigo"]] = $access;

            if ($submenu == 'S') {

                $this->data["htmlmenu"].= '<li class="treeview">';
                $this->data["htmlmenu"].= '<a href="#"><i class="' . $toolbar . '"></i> <span>' . ($row["menuitem"]) . '</span> <i class="fa fa-angle-left pull-right"></i></a>';

                $sql = "select o.codigo,o.codigo, o.menuitem, o.depende, o.submenu, o.url, r.opcion,o.toolbar,r.acceso
      from opciones o
      inner join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
      where depende = '$codigo'  ORDER BY orden";
                //and estado = 1

                $rs = Doo::db()->query($sql);
                $childMenu = $rs->fetchAll();

                $this->data["htmlmenu"].= '<ul class="treeview-menu">';
                $this->buildChildMenu($childMenu);
                $this->data["htmlmenu"].= '</ul>';
            } else {

                if (strlen($opcion) == Null) {
                    $this->data["htmlmenu"].= '<li class="treeview">';
                    $this->data["htmlmenu"].= '<a class="disabled" href="javascript:void(0);"><i class="fa fa-pie-chart"></i><span>' . $row["menuitem"] . '</span><i class="fa fa-angle-left pull-right"></i></a>';
                } else {
                    $this->data["htmlmenu"].= '<li class="treeview">';
                    $this->data["htmlmenu"].= '<a href="' . Doo::conf()->APP_URL . $row["url"] . '">' . ($row["menuitem"]) . '</a>';
                }

                if ($toolbar != "" & strlen($opcion) != Null) {
                    $toolbar = $this->data["rootUrl"] . "global/img/" . $toolbar;
                    $this->data["toolbar"].='<div class="icon">
        <a href="' . Doo::conf()->APP_URL . $row["url"] . '"><img src="' . $toolbar . '" width="48" height="48" border="0"  alt="' . ($row["menuitem"]) . '"/><span>' . ($row["menuitem"]) . '</span></a>
        </div>';
                }
            }
            $this->data["htmlmenu"].= '</li>';

        endforeach;
    }
    public function getdocvencidos() {
        $conductores = Doo::db()->query("	SELECT * FROM notificaciones WHERE estado = 'A' AND (tipo = 'NCL' OR tipo = 'NP' OR tipo = 'NC' OR tipo = 'NV' OR tipo = 'VDP' OR tipo = 'CDP' OR tipo = 'VD' OR tipo = 'SF') 
        AND fecha > DATE_SUB(date(now()), INTERVAL 10 DAY) ORDER BY FECHA DESC;")->fetchAll();
        $vencidos = Doo::db()->query("SELECT dcd.id, c.id AS id_conductor, c.nombre AS conductor, d.nombre AS documento, dcd.fecha_vencimiento 
                                    FROM documentos_conductor_data dcd 
                                    INNER JOIN conductores c ON (c.id=dcd.id_conductor)
                                    INNER JOIN documentos d ON (d.id=dcd.id_documento) 
                                    WHERE IF(dcd.fecha_vencimiento = '0000-00-00' OR dcd.fecha_vencimiento IS NULL, id_conductor IS NULL ,(DATE_ADD(CURDATE(),INTERVAL 1 MONTH) > fecha_vencimiento ))
                                    GROUP BY conductor")->fetchAll();

        $vehiculos = Doo::db()->query("SELECT dcd.id, v.id AS id_vehiculo, v.placa AS vehiculo, p.razon_social AS nombre_prop ,d.nombre AS documento, dcd.fecha_vencimiento 
        FROM documentos_conductor_data dcd 
        INNER JOIN vehiculos v ON (v.id=dcd.id_vehiculo)
        INNER JOIN propietarios p ON (p.id=v.id_propietario)
        INNER JOIN documentos d ON (d.id=dcd.id_documento) 
        WHERE IF(dcd.fecha_vencimiento = '0000-00-00' OR dcd.fecha_vencimiento IS NULL, id_vehiculo IS NULL ,(DATE_ADD(CURDATE(),INTERVAL 1 MONTH) > fecha_vencimiento ))")->fetchAll();
        
        $documento_revision = Doo::db()->query("SELECT n.mensaje, n.id_conductor, n.tipo, n.fecha
                                        FROM notificaciones n
                                        WHERE tipo = 'VD' AND estado = 'A'")->fetchAll();
        $noti["nuevoc"] = $conductores;
        $noti["vencidos"] = $vencidos;
        $noti["vehiculos"] = $vehiculos;
        echo json_encode($noti);
    }
    
     public function viewgetdocvencidos () {
        $this->data['vencidos'] = Doo::db()->query("SELECT dcd.id, c.id AS id_conductor, c.nombre AS conductor, d.nombre 
        AS documento, dcd.fecha_vencimiento, 
        DATEDIFF(dcd.fecha_vencimiento,CURDATE()) AS resto 
                                    FROM documentos_conductor_data dcd 
                                    INNER JOIN conductores c ON (c.id=dcd.id_conductor)
                                    INNER JOIN documentos d ON (d.id=dcd.id_documento) 
                                    WHERE IF(dcd.fecha_vencimiento = '0000-00-00' OR dcd.fecha_vencimiento IS NULL , 
                                    id_conductor IS NULL ,(DATE_ADD(CURDATE(),INTERVAL 1 MONTH) > fecha_vencimiento ))")->fetchAll();
        $this->data['vehiculosv'] = Doo::db()->query("SELECT dcd.id,dcd.id_vehiculo,v.marca, p.razon_social, d.nombre AS documento, dcd.fecha_vencimiento, DATEDIFF(dcd.fecha_vencimiento,CURDATE()) AS resto 
                                    FROM documentos_conductor_data dcd 
                                    INNER JOIN vehiculos v ON (v.id=dcd.`id_vehiculo`)
                                    INNER JOIN propietarios p ON (p.id=v.`id_propietario`)
                                    INNER JOIN documentos d ON (d.id=dcd.id_documento) 
                                    WHERE IF(dcd.fecha_vencimiento = '0000-00-00' OR dcd.fecha_vencimiento IS NULL , id_vehiculo IS NULL ,(DATE_ADD(CURDATE(),INTERVAL 1 MONTH) > fecha_vencimiento ))")->fetchAll();
        $this->data['allDocs']=Doo::db()->find("DocumentosConductorData");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'vencidos/list.php';
        $this->renderc('index',$this->data,true);
    }
    
    
    public function gen_maprub(){
		//This will write a new file,  routes2.conf.php file
		$this->renderc("checklist", false);
	}
}
?>