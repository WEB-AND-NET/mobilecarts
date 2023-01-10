<?php
Doo::loadCore('db/DooModel');

class RevisionSubcategoriaBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_categoria;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre;

    public $_table = 'revision_subcategoria';
    public $_primarykey = 'id';
    public $_fields = array('id','id_categoria','nombre');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_categoria' => array(
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