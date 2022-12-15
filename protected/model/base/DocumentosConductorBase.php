<?php
Doo::loadCore('db/DooModel');

class DocumentosConductorBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_documento;

    /**
     * @var int Max length is 11.
     */
    public $id_conductor;

    public $_table = 'documentos_conductor';
    public $_primarykey = 'id';
    public $_fields = array('id','id_documento','id_conductor');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_conductor' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}