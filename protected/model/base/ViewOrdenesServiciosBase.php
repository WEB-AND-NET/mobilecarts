<?php
Doo::loadCore('db/DooModel');

class ViewOrdenesServiciosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $factura;

    /**
     * @var varchar Max length is 200.
     */
    public $cliente;

    /**
     * @var varchar Max length is 45.
     */
    public $barrio_o;

    /**
     * @var varchar Max length is 500.
     */
    public $origen;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var varchar Max length is 45.
     */
    public $barrio_d;

    /**
     * @var varchar Max length is 45.
     */
    public $destino;

    /**
     * @var varchar Max length is 20.
     */
    public $clase_vehiculo;

    /**
     * @var varchar Max length is 10.
     */
    public $placa;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    /**
     * @var varchar Max length is 23.
     */
    public $fecha;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var int Max length is 10.
     */
    public $id_usuario;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var varchar Max length is 23.
     */
    public $created_at;

    /**
     * @var char Max length is 3.
     */
    public $u_tipo;

    /**
     * @var char Max length is 1.
     */
    public $c_tipo;

    /**
     * @var varchar Max length is 45.
     */
    public $conductor;

    public $_table = 'view_ordenes_servicios';
    public $_primarykey = '';
    public $_fields = array('id','factura','cliente','barrio_o','origen','tipo','barrio_d','destino','clase_vehiculo','placa','estado','fecha','id_cliente','id_usuario','deleted','created_at','u_tipo','c_tipo','conductor');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'factura' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cliente' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'barrio_o' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'origen' => array(
                        array( 'maxlength', 500 ),
                        array( 'notnull' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'barrio_d' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'destino' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'clase_vehiculo' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'placa' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'fecha' => array(
                        array( 'maxlength', 23 ),
                        array( 'optional' ),
                ),

                'id_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'created_at' => array(
                        array( 'maxlength', 23 ),
                        array( 'optional' ),
                ),

                'u_tipo' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'c_tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'conductor' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}