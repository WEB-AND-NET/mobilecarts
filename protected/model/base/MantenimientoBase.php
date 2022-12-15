<?php
Doo::loadCore('db/DooModel');

class MantenimientoBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 3.
     */
    public $tipo;

    /**
     * @var date
     */
    public $fecha;

    /**
     * @var int Max length is 11.
     */
    public $km;

    /**
     * @var double
     */
    public $costoTotal;

    /**
     * @var varchar Max length is 25.
     */
    public $archivoFactura;

    /**
     * @var text
     */
    public $descripcion;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    /**
     * @var datetime
     */
    public $fechaCreacion;

    /**
     * @var datetime
     */
    public $fechaUpdate;

    /**
     * @var datetime
     */
    public $fechaCierre;

    /**
     * @var int Max length is 11.
     */
    public $vehiculoId;

    public $_table = 'mantenimiento';
    public $_primarykey = 'id';
    public $_fields = array('id','tipo','fecha','km','costoTotal','archivoFactura','descripcion','estado','fechaCreacion','fechaUpdate','fechaCierre','vehiculoId');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'km' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'costoTotal' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'archivoFactura' => array(
                        array( 'maxlength', 25 ),
                        array( 'optional' ),
                ),

                'descripcion' => array(
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'fechaCreacion' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'fechaUpdate' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'fechaCierre' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'vehiculoId' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}