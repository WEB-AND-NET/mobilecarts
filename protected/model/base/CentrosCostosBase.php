<?php
Doo::loadCore('db/DooModel');

class CentrosCostosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;

    /**
     * @var varchar Max length is 20.
     */
    public $numero;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    public $_table = 'centros_costos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_cliente','nombre','numero','deleted');

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

                'nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'numero' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                )
            );
    }

}