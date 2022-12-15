<?php
Doo::loadCore('db/DooModel');

class RutasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var int Max length is 5.  unsigned zerofill.
     */
    public $numero;

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;

    /**
     * @var tinyint Max length is 2.
     */
    public $zona_origen;

    /**
     * @var tinyint Max length is 2.
     */
    public $zona_destino;

    /**
     * @var int Max length is 11.
     */
    public $id_contrato;

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

    public $_table = 'rutas';
    public $_primarykey = 'id';
    public $_fields = array('id','tipo','numero','nombre','zona_origen','zona_destino','id_contrato','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'numero' => array(
                        array( 'integer' ),
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'zona_origen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'zona_destino' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'id_contrato' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
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