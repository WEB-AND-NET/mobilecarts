<?php
Doo::loadCore('db/DooModel');

class ObjetosContratoBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 75.
     */
    public $nombre;

    public $_table = 'objetos_contrato';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 75 ),
                        array( 'optional' ),
                )
            );
    }

}