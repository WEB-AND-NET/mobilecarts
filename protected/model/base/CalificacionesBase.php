<?php
Doo::loadCore('db/DooModel');

class CalificacionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_usuario;

    /**
     * @var double Max length is 2. ,1).
     */
    public $valor;

    public $_table = 'calificaciones';
    public $_primarykey = 'id';
    public $_fields = array('id','id_usuario','valor');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                )
            );
    }

}