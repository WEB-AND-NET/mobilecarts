<?php
Doo::loadCore('db/DooModel');

class TarifasTransfersBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_o;

    /**
     * @var tinyint Max length is 2.
     */
    public $id_zonao;

    /**
     * @var int Max length is 11.
     */
    public $id_d;

    /**
     * @var tinyint Max length is 2.
     */
    public $id_zonad;

    /**
     * @var varchar Max length is 45.
     */
    public $nombreo;

    /**
     * @var varchar Max length is 45.
     */
    public $nombred;

    /**
     * @var double
     */
    public $valor;

    /**
     * @var char Max length is 1.
     */
    public $aplica_anexo;

    /**
     * @var blob
     */
    public $anexo;

    public $_table = 'tarifas_transfers';
    public $_primarykey = 'id';
    public $_fields = array('id','id_o','id_zonao','id_d','id_zonad','nombreo','nombred','valor','aplica_anexo','anexo');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_o' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_zonao' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'id_d' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_zonad' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'nombreo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'nombred' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'aplica_anexo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'anexo' => array(
                        array( 'optional' ),
                )
            );
    }

}