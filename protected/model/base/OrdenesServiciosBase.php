<?php
Doo::loadCore('db/DooModel');

class OrdenesServiciosBase extends DooModel{

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
    public $id_contacto;

    /**
     * @var varchar Max length is 10.
     */
    public $numero;

    /**
     * @var varchar Max length is 45.
     */
    public $objetoc;

    /**
     * @var varchar Max length is 500.
     */
    public $recorrido;

    /**
     * @var tinyint Max length is 3.
     */
    public $n_pasajero;

    /**
     * @var varchar Max length is 500.
     */
    public $origen;

    /**
     * @var varchar Max length is 45.
     */
    public $destino;

    /**
     * @var varchar Max length is 40.
     */
    public $latitud_o;

    /**
     * @var varchar Max length is 40.
     */
    public $longitud_o;

    /**
     * @var int Max length is 11.
     */
    public $barrio_o;

    /**
     * @var int Max length is 11.
     */
    public $barrio_d;

    /**
     * @var double
     */
    public $valor;

    /**
     * @var double
     */
    public $sobre_tasa;

    /**
     * @var tinyint Max length is 2.
     */
    public $clase_vehiculo;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var int Max length is 11.
     */
    public $id_vehiculo;

    /**
     * @var int Max length is 11.
     */
    public $id_conductor;

    /**
     * @var datetime
     */
    public $fecha;

    /**
     * @var date
     */
    public $fecha_inicial;

    /**
     * @var date
     */
    public $fecha_final;

    /**
     * @var date
     */
    public $fecha_fact;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $num_fact;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    /**
     * @var tinyint Max length is 2.
     */
    public $nhora;

    /**
     * @var int Max length is 10.
     */
    public $id_usuario;

    /**
     * @var varchar Max length is 500.
     */
    public $observacion;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    public $_table = 'ordenes_servicios';
    public $_primarykey = 'id';
    public $_fields = array('id','id_cliente','id_contacto','numero','objetoc','recorrido','n_pasajero','origen','destino','latitud_o','longitud_o','barrio_o','barrio_d','valor','sobre_tasa','clase_vehiculo','tipo','id_vehiculo','id_conductor','fecha','fecha_inicial','fecha_final','fecha_fact','num_fact','estado','nhora','id_usuario','observacion','deleted','created_at','updated_at');

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

                'id_contacto' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'numero' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'objetoc' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'recorrido' => array(
                        array( 'maxlength', 500 ),
                        array( 'optional' ),
                ),

                'n_pasajero' => array(
                        array( 'integer' ),
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'origen' => array(
                        array( 'maxlength', 500 ),
                        array( 'notnull' ),
                ),

                'destino' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'latitud_o' => array(
                        array( 'maxlength', 40 ),
                        array( 'optional' ),
                ),

                'longitud_o' => array(
                        array( 'maxlength', 40 ),
                        array( 'optional' ),
                ),

                'barrio_o' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'barrio_d' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'sobre_tasa' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'clase_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'id_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_conductor' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'fecha_inicial' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'fecha_final' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'fecha_fact' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'num_fact' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'nhora' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'observacion' => array(
                        array( 'maxlength', 500 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                )
            );
    }

}