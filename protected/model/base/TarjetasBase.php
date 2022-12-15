<?php
Doo::loadCore('db/DooModel');

class TarjetasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var varchar Max length is 45.
     */
    public $ccv;

    /**
     * @var varchar Max length is 45.
     */
    public $cardNumber;

    /**
     * @var int Max length is 2.
     */
    public $expingMonth;

    /**
     * @var int Max length is 4.
     */
    public $expingYear;

    /**
     * @var varchar Max length is 45.
     */
    public $postalCode;

    /**
     * @var varchar Max length is 45.
     */
    public $cardholderName;

    /**
     * @var varchar Max length is 45.
     */
    public $type;

    public $_table = 'tarjetas';
    public $_primarykey = 'id';
    public $_fields = array('id','id_cliente','ccv','cardNumber','expingMonth','expingYear','postalCode','cardholderName','type');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'ccv' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'cardNumber' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'expingMonth' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'expingYear' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'postalCode' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'cardholderName' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}