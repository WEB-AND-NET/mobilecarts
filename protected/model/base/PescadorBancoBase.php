<?php
Doo::loadCore('db/DooModel');

class PescadorBancoBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_pescador;

    /**
     * @var int Max length is 11.
     */
    public $numero_cuenta;

    /**
     * @var int Max length is 11.
     */
    public $tipo_cuenta;

    /**
     * @var int Max length is 11.
     */
    public $entidad_bancaria;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre_titular;

    public $_table = 'pescador_banco';
    public $_primarykey = 'id';
    public $_fields = array('id','id_pescador','numero_cuenta','tipo_cuenta','entidad_bancaria','nombre_titular');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_pescador' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'numero_cuenta' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'tipo_cuenta' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'entidad_bancaria' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nombre_titular' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                )
            );
    }

}