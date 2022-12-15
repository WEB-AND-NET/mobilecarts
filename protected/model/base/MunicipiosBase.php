<?php
Doo::loadCore('db/DooModel');

class MunicipiosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_departamento;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre;

    public $_table = 'municipios';
    public $_primarykey = 'id';
    public $_fields = array('id','id_departamento','nombre');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_departamento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                )
            );
    }

}