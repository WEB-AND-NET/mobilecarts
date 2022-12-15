<?php
Doo::loadCore('db/DooModel');

class ClienteVehiculosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var int Max length is 11.
     */
    public $id_vehiculo;

    public $_table = 'cliente_vehiculos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_cliente','id_vehiculo');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}