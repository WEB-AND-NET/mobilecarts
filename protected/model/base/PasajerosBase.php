<?php
Doo::loadCore('db/DooModel');

class PasajerosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre;

    /**
     * @var varchar Max length is 11.
     */
    public $cedula;

    public $_table = 'pasajeros';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','cedula');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'cedula' => array(
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}