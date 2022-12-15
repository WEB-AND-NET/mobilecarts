<?php
Doo::loadCore('db/DooModel');

class PropietariosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $identificacion;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var varchar Max length is 45.
     */
    public $razon_social;

    /**
     * @var varchar Max length is 20.
     */
    public $telefono;

    /**
     * @var varchar Max length is 20.
     */
    public $celular;

    /**
     * @var varchar Max length is 60.
     */
    public $email;

    /**
     * @var varchar Max length is 45.
     */
    public $password;

    /**
     * @var char Max length is 1.
     */
    public $revision_estado;

    /**
     * @var date
     */
    public $revision_fecha;

    /**
     * @var char Max length is 1.
     */
    public $pago_estado;

    /**
     * @var date
     */
    public $pago_fecha;

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

    public $_table = 'propietarios';
    public $_primarykey = 'id';
    public $_fields = array('id','identificacion','tipo','razon_social','telefono','celular','email','password','revision_estado','revision_fecha','pago_estado','pago_fecha','estado','deleted','created_at','updated_at');

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

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'razon_social' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'telefono' => array(
                        array( 'maxlength', 20 ),
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

                'password' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'revision_estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'revision_fecha' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'pago_estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'pago_fecha' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
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