<?php
Doo::loadCore('db/DooModel');

class ClientesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $identificacion;

    /**
     * @var varchar Max length is 200.
     */
    public $nombre;

    /**
     * @var varchar Max length is 20.
     */
    public $celular;

    /**
     * @var varchar Max length is 60.
     */
    public $email;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var varchar Max length is 100.
     */
    public $direccion;

    /**
     * @var varchar Max length is 20.
     */
    public $c_identificacion;

    /**
     * @var varchar Max length is 45.
     */
    public $c_nombre;

    /**
     * @var varchar Max length is 20.
     */
    public $c_celular;

    /**
     * @var varchar Max length is 100.
     */
    public $c_direccion;

    /**
     * @var char Max length is 1.
     */
    public $tipo_tarifa;

    /**
     * @var int Max length is 11.
     */
    public $id_usuario;

    /**
     * @var char Max length is 1.
     */
    public $estado;

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

    public $_table = 'clientes';
    public $_primarykey = 'id';
    public $_fields = array('id','identificacion','nombre','celular','email','tipo','direccion','c_identificacion','c_nombre','c_celular','c_direccion','tipo_tarifa','id_usuario','estado','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'celular' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'maxlength', 60 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'direccion' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'c_identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'c_nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'c_celular' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'c_direccion' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'tipo_tarifa' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
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