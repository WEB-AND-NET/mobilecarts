<?php

/**
 * Description of MainController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class MainControllerPropietario extends DooController {

    public $data;
    private $permisos;
    private $accesos;

    public function index() {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL . "admpropietarios";
        } else {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['content'] = 'home_propietarios.php';
            $this->renderc('index_propietarios', $this->data);
        }
    }

    public function rutalogin() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('login_propietario', $this->data);
    }

    public function login() {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);
                $pass = md5(trim($_POST['password']));

                $u = $this->db()->find("Usuarios", array("where" => "usuario = ? and password = ? and tipo = ? ",
                    "limit" => 1,
                    "param" => array($user, $pass)
                        )
                );
                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Acceso denegado";
                    $this->renderc('login_propietario', $this->data);
                } else {
                    unset($_SESSION['login']);
                    $this->buildMenu($u->role);
                    $login = new stdclass();
                    $login->usuario = $u->usuario;
                    $login->role = $u->role;
                    $login->nombre = $u->nombre;
                    $login->id = $u->id;
                    $r = $this->db()->find("Roles", array("where" => "id = ? ",
                        "limit" => 1,
                        "param" => array($u->role)
                            )
                    );
                    if($r != null){
                        $login->perfil = $r->role;
                    }else{
                        $login->perfil = "Sin Perfil";
                    }
                    $login->menu = $this->data["htmlmenu"];
                    $login->toolbar = $this->data["toolbar"];
                    $_SESSION['login'] = $login;
                    $_SESSION['permisos'] = $this->permisos;
                    $_SESSION['accesos'] = $this->accesos;
                    //$this->home();
                    return Doo::conf()->APP_URL."panel/home";
                }
            } else {
                return Doo::conf()->APP_URL.'admpropietarios';
            }
        } else {
            return Doo::conf()->APP_URL.'admpropietarios';
        }
    }

    public function logout() {
        session_unset();
        // Destruir la session PHP
        session_destroy();
        // retornar al sitio de inicio
        return Doo::conf()->APP_URL.'admpropietarios';
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
                $this->data["htmlmenu"].= '<a href="#"><i class="'.$toolbar.'"></i> <span>' . ($row["menuitem"]) . '</span> <i class="fa fa-angle-left pull-right"></i></a>';

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

}
