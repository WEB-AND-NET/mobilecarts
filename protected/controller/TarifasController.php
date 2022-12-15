<?php

/**
 * Description of TarifasController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class TarifasController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
//            if ($_SESSION["permisos"]["206"] != 1) {
//                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
//                return Doo::conf()->APP_URL . "home";
//            }
        }
    }

    public function index() {
//        $sql = "SELECT t.id,t.nombreo,t.nombred,t.valor FROM tarifas_transfers t ";
//        $this->data['tarifas'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'tarifas/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function paginate() {

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'nombreo', 'nombred', 'valor');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "tarifas_transfers";

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
//		$sLimit = "LIMIT ".mysql_real_escape_string( $_POST['iDisplayStart'] ).", ".
//			mysql_real_escape_string( $_POST['iDisplayLength'] );
            $sLimit = "LIMIT " . $_POST['iDisplayStart'] . ", " .
                    $_POST['iDisplayLength'];
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_POST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_POST['iSortingCols']); $i++) {
                if ($_POST['bSortable_' . intval($_POST['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_POST['iSortCol_' . $i])] . "
				 	" . $_POST['sSortDir_' . $i] . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if ($_POST['sSearch'] != "") {
            $sWhere = "WHERE (";

            $trozos = explode(" ", $_POST['sSearch']);
            $numero = count($trozos);
            if ($numero == 1) {
                for ($i = 0; $i < count($aColumns); $i++) {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . $_POST['sSearch'] . "%' OR ";
                }
                $sWhere = substr_replace($sWhere, "", -3);
            } else {
                //WHERE MATCH ( TITULO, DESARROLLO ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50";
                //este va    $sWhere = " WHERE ( MATCH (nombreo, nombred) AGAINST ('".$_POST['sSearch']."') ";
                //                    for ( $i=0 ; $i<count($aColumns) ; $i++ )
                //                    {
                //                            $sWhere .= $aColumns[$i]." LIKE '%". $_POST['sSearch'] ."%' OR ";
                //                    }
                //                    echo $sWhere;
                //                    exit();

                for ($e = 0; $e < count($trozos); $e++) {
                    if ($trozos[$e] != "") {
                        $sWhere .= " ( ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= $aColumns[$i] . " LIKE '%" . $trozos[$e] . "%' OR ";
                        }
                        $sWhere = substr_replace($sWhere, "", -3);
                        if (isset($trozos[$e + 1])) {
                            $trozos[$e + 1] != "" ? $sWhere .= " ) AND " : $sWhere .= " ) ";
                        } else {
                            $sWhere .= " ) ";
                        }
                    }
                }
            }



            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if ($_POST['bSearchable_' . $i] == "true" && $_POST['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $_POST['sSearch_' . $i] . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";

        $tarifas = Doo::db()->query($sQuery)->fetchAll();

//        $total = Doo::db()->query("SELECT count(id) AS total FROM $sTable $sWhere")->fetch();        
//        $nTotal = $total["total"];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(" . $sIndexColumn . ") AS total 
		FROM $sTable $sWhere
	";

        $total = Doo::db()->query($sQuery)->fetch();
        $iTotal = $total["total"];


        $aaData = array();

        foreach ($tarifas as $row) {
            $aaData[] = array(
                $row['id'],
                $row['nombreo'],
                $row['nombred'],
                $row['valor']
            );
        }

        $aa = array(
            'sEcho' => $_POST['sEcho'],
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => $aaData);

        echo json_encode($aa);
    }

//    public function add() {
//        Doo::loadModel("TarifasTransfers");
//        $this->data['rootUrl'] = Doo::conf()->APP_URL;
//        $this->data['tarifas'] = new TarifasTransfers();
//        $this->data['barrios'] = Doo::db()->find("Barrios", array("select" => "id,nombre", "asc" => "nombre"));     
//        $this->data['content'] = 'tarifas/from.php';
//        $this->renderc('index', $this->data);
//    }

    public function edit() {
        $id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tarifas'] = Doo::db()->find("TarifasTransfers", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['barrios'] = Doo::db()->find("Barrios", array("select" => "id,nombre", "asc" => "nombre"));
        $this->data['content'] = 'tarifas/from.php';
        $this->renderc('index', $this->data);
    }
    
    public function custom() {
        if(!isset($this->params["pindex"])){
            return Doo::conf()->APP_URL . "error";
        }
            
        $id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("TarifasTransfersCustom");
        $t = new TarifasTransfersCustom();
        $t->id_tarifa = $id;
        $this->data['tarifa_custom'] = $t;
        $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre",'where' => 'tipo != "P" AND deleted = 0', "asc" => "nombre"));
        $this->data['clases_v'] = Doo::db()->find("ClasesVehiculos", array("select" => "id,nombre", "where" => "deleted=0", "asc" => "nombre"));
        $this->data['content'] = 'tarifas/custom.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("TarifasTransfers");
        $t = new TarifasTransfers($_POST);
        if ($t->id == "") {
            $t->id = Null;
        }

        if ($t->id == Null) {
//            $t->created_at = date('Y-m-d H:i:s');
//            Doo::db()->Insert($t);
        } else {
//            $t->updated_at = date('Y-m-d H:i:s');
//            Doo::db()->Update($t);
            $aplica_anexo = "N";
            if($t->aplica_anexo == "S"){
                $aplica_anexo = $t->aplica_anexo;
            }
            Doo::db()->query("UPDATE tarifas_transfers SET valor = '$t->valor', aplica_anexo = '$aplica_anexo', anexo = '$t->anexo' WHERE id='$t->id'");
        }
        return Doo::conf()->APP_URL . "tarifas";
    }
    
    public function save_custom(){
        //var_dump($_POST);
        //exit();
        Doo::loadModel("TarifasTransfersCustom");
        $t = new TarifasTransfersCustom($_POST);
        if ($t->id == "") {
            $t->id = Null;
        }
        
        if ($t->id == Null) {
            $t->created_at = $t->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Insert($t);
        } else {
//            $t->updated_at = date('Y-m-d H:i:s');
//            Doo::db()->Update($t);
        }
        return Doo::conf()->APP_URL . "tarifas";
    }

//    public function deactivate() {
//        $id = $this->params["pindex"];
//        Doo::db()->query("UPDATE tarifas_transfers SET deleted=1 WHERE id=?", array($id));
//        return Doo::conf()->APP_URL . "tarifas";
//    }
//
//    public function validar() {
//        $id_o = $_POST["id_o"];
//        $id_d = $_POST["id_d"];
//        $count1 = Doo::db()->query("SELECT id FROM tarifas_transfers WHERE (id_o = '$id_o' AND id_d <> '$id_d') OR (id_d = '$id_o' AND id_o <> '$id_d') ")->rowCount();
//        if ($count1 > 0)
//            echo true;
//        else
//            echo false;
//    }
}
