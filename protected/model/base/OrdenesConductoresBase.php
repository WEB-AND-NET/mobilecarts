<?php
Doo::loadCore('db/DooModel');

class OrdenesConductoresBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var int Max length is 10.
     */
    public $id_servicio;

    /**
     * @var int Max length is 10.
     */
    public $id_conductor;

    /**
     * @var char Max length is 3.
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

    public $_table = 'ordenes_conductores';
    public $_primarykey = 'id';
    public $_fields = array('id','id_servicio','id_conductor','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'id_servicio' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'id_conductor' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 3 ),
                        array( 'notnull' ),
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