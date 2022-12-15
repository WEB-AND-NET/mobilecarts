<?php
Doo::loadCore('db/DooModel');

class PasajerosOrdenBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_pasajero;

    /**
     * @var int Max length is 11.
     */
    public $id_orden;

    public $_table = 'pasajeros_orden';
    public $_primarykey = 'id';
    public $_fields = array('id','id_pasajero','id_orden');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_pasajero' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_orden' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}