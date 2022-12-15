<?php
Doo::loadCore('db/DooModel');

class FinancieraBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 2.
     */
    public $trabajando;

    /**
     * @var int Max length is 11.
     */
    public $salario;

    /**
     * @var int Max length is 11.
     */
    public $id_beneficiario;

    public $_table = 'financiera';
    public $_primarykey = 'id';
    public $_fields = array('id','trabajando','salario','id_beneficiario');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'trabajando' => array(
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'salario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_beneficiario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}