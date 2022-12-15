<?php
Doo::loadCore('db/DooModel');

class TarifasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_ruta;

    /**
     * @var tinyint Max length is 2.
     */
    public $id_clase;

    /**
     * @var double Max length is 10. ,2).
     */
    public $valor;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $crated_at;

    /**
     * @var datetime
     */
    public $updated_at;

    public $_table = 'tarifas';
    public $_primarykey = 'id';
    public $_fields = array('id','id_ruta','id_clase','valor','deleted','crated_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_ruta' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_clase' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'crated_at' => array(
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