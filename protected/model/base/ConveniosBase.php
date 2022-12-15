<?php
Doo::loadCore('db/DooModel');

class ConveniosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $numero;

    /**
     * @var varchar Max length is 20.
     */
    public $nit;

    /**
     * @var varchar Max length is 45.
     */
    public $razon_social;

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

    public $_table = 'convenios';
    public $_primarykey = 'id';
    public $_fields = array('id','numero','nit','razon_social','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'numero' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'nit' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'razon_social' => array(
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