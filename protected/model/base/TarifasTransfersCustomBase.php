<?php
Doo::loadCore('db/DooModel');

class TarifasTransfersCustomBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_tarifa;

    /**
     * @var int Max length is 11.
     */
    public $id_clase_vehiculo;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var double
     */
    public $valor;

    public $_table = 'tarifas_transfers_custom';
    public $_primarykey = 'id';
    public $_fields = array('id','id_tarifa','id_clase_vehiculo','id_cliente','valor');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_tarifa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_clase_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                )
            );
    }

}