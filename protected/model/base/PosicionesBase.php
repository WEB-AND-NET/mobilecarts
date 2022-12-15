<?php
Doo::loadCore('db/DooModel');

class PosicionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_orden;

    /**
     * @var double
     */
    public $latitud;

    /**
     * @var double
     */
    public $longitud;

    public $_table = 'posiciones';
    public $_primarykey = 'id';
    public $_fields = array('id','id_orden','latitud','longitud');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_orden' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'latitud' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'longitud' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                )
            );
    }

}