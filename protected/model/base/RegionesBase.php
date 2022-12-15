<?php
Doo::loadCore('db/DooModel');

class RegionesBase extends DooModel{

    /**
     * @var tinyint Max length is 2.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;

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

    public $_table = 'regiones';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
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