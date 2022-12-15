<?php
Doo::loadCore('db/DooModel');

class ClasesVehiculosBase extends DooModel{

    /**
     * @var tinyint Max length is 2.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $nombre;

    /**
     * @var double
     */
    public $vhoran;

    /**
     * @var double
     */
    public $vhorae;

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

    public $_table = 'clases_vehiculos';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','vhoran','vhorae','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'vhoran' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'vhorae' => array(
                        array( 'float' ),
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