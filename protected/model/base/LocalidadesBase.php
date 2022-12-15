<?php
Doo::loadCore('db/DooModel');

class LocalidadesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $_id;

    /**
     * @var longtext
     */
    public $codigo;

    /**
     * @var longtext
     */
    public $nombre;

    public $_table = 'localidades';
    public $_primarykey = '_id';
    public $_fields = array('_id','codigo','nombre');

    public function getVRules() {
        return array(
                '_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'codigo' => array(
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'optional' ),
                )
            );
    }

}