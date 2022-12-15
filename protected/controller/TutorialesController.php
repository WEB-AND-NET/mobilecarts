<?php

/**
 * Description of TarifasController
 *
 * @author Carlos Meri単o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class TutorialesController extends DooController {

  

    public function index() {
//        $sql = "SELECT t.id,t.nombreo,t.nombred,t.valor FROM tarifas_transfers t ";
//        $this->data['tarifas'] = Doo::db()->query($sql)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'tutoriales/list.php';
        $this->renderc('index', $this->data, true);
    }
    
}