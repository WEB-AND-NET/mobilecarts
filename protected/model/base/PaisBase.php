<?php
Doo::loadCore('db/DooModel');

class PaisBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $nombre;

    public $_table = 'pais';
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
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                )
            );
    }

}