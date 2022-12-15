<?php
Doo::loadCore('db/DooModel');

class ScoresBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $Id;

    /**
     * @var int Max length is 11.
     */
    public $rating;

    /**
     * @var int Max length is 11.
     */
    public $idService;

    /**
     * @var int Max length is 11.
     */
    public $idDriver;

    /**
     * @var int Max length is 11.
     */
    public $idClient;

    public $_table = 'Scores';
    public $_primarykey = 'Id';
    public $_fields = array('Id','rating','idService','idDriver','idClient');

    public function getVRules() {
        return array(
                'Id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'rating' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'idService' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'idDriver' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'idClient' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}