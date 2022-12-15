<?php
Doo::loadCore('db/DooModel');

class NotificacionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_documento;

    /**
     * @var int Max length is 11.
     */
    public $id_conductor;

    /**
     * @var int Max length is 11.
     */
    public $id_propietario;

    /**
     * @var int Max length is 11.
     */
    public $id_vehiculo;

    /**
     * @var varchar Max length is 4.
     */
    public $tipo;

    /**
     * @var varchar Max length is 200.
     */
    public $mensaje;

    /**
     * @var datetime
     */
    public $fecha;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    public $_table = 'notificaciones';
    public $_primarykey = 'id';
    public $_fields = array('id','id_documento','id_conductor','id_propietario','id_vehiculo','tipo','mensaje','fecha','estado');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_conductor' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_propietario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'mensaje' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}