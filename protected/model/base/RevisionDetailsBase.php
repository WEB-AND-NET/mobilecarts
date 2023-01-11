<?php
Doo::loadCore('db/DooModel');

class RevisionDetailsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_revision;

    /**
     * @var int Max length is 11.
     */
    public $id_subcategoria;

    /**
     * @var varchar Max length is 5.
     */
    public $estado;

    /**
     * @var text
     */
    public $observacion;

    /**
     * @var tinyint Max length is 1.
     */
    public $notificar;

    public $_table = 'revision_details';
    public $_primarykey = 'id';
    public $_fields = array('id','id_revision','id_subcategoria','estado','observacion','notificar');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_revision' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_subcategoria' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'estado' => array(
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
                ),

                'observacion' => array(
                        array( 'optional' ),
                ),

                'notificar' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}