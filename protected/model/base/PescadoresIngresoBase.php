<?php
Doo::loadCore('db/DooModel');

class PescadoresIngresoBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_pescador;

    /**
     * @var varchar Max length is 2.
     */
    public $certificacion;

    /**
     * @var int Max length is 11.
     */
    public $numero_certificacion;

    /**
     * @var varchar Max length is 100.
     */
    public $lugar_pesca;

    /**
     * @var int Max length is 11.
     */
    public $asociado;

    /**
     * @var int Max length is 11.
     */
    public $tipo_producto;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre_proveedor;

    public $_table = 'pescadores_ingreso';
    public $_primarykey = 'id';
    public $_fields = array('id','id_pescador','certificacion','numero_certificacion','lugar_pesca','asociado','tipo_producto','nombre_proveedor');

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

                'certificacion' => array(
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'numero_certificacion' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'lugar_pesca' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'asociado' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'tipo_producto' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nombre_proveedor' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                )
            );
    }

}