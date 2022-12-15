<?php
Doo::loadCore('db/DooModel');

class DepartementosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_pais;

    /**
     * @var varchar Max length is 20.
     */
    public $nombre;

    public $_table = 'departementos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_pais','nombre');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_pais' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                )
            );
    }

}