<?php
Doo::loadCore('db/DooModel');

class FirmasRevisiondiariaBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $foto;

    /**
     * @var int Max length is 11.
     */
    public $revisionId;

    public $_table = 'firmas_revisiondiaria';
    public $_primarykey = 'id';
    public $_fields = array('id','foto','revisionId');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'foto' => array(
                        array( 'optional' ),
                ),

                'revisionId' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}