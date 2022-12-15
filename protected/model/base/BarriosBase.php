<?php
Doo::loadCore('db/DooModel');

class BarriosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var tinyint Max length is 2.
     */
    public $id_zona;

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;

    public $_table = 'barrios';
    public $_primarykey = 'id';
    public $_fields = array('id','id_zona','nombre');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_zona' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                )
            );
    }

}