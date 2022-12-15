<?php
Doo::loadCore('db/DooModel');

class OrdenesParadasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_servicio;

    /**
     * @var int Max length is 11.
     */
    public $id_barrio;

    /**
     * @var double
     */
    public $valor;

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

    public $_table = 'ordenes_paradas';
    public $_primarykey = 'id';
    public $_fields = array('id','id_servicio','id_barrio','valor','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_servicio' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_barrio' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}