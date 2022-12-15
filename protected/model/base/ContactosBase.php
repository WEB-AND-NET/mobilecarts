<?php
Doo::loadCore('db/DooModel');

class ContactosBase extends DooModel{

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
    public $id_centrocosto;

    /**
     * @var varchar Max length is 20.
     */
    public $identificacion;

    /**
     * @var varchar Max length is 40.
     */
    public $nombre;

    /**
     * @var varchar Max length is 45.
     */
    public $cargo;

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
    public $direccion;

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

    public $_table = 'contactos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_cliente','id_centrocosto','identificacion','nombre','cargo','telefono','celular','email','direccion','deleted','created_at','updated_at');

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

                'id_centrocosto' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 40 ),
                        array( 'notnull' ),
                ),

                'cargo' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'telefono' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'celular' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'maxlength', 60 ),
                        array( 'notnull' ),
                ),

                'direccion' => array(
                        array( 'maxlength', 45 ),
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