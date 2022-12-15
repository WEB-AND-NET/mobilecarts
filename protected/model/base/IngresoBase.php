<?php
Doo::loadCore('db/DooModel');

class IngresoBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_beneficiario;

    /**
     * @var varchar Max length is 100.
     */
    public $tipo_ingreso;

    /**
     * @var varchar Max length is 150.
     */
    public $ies;

    /**
     * @var int Max length is 11.
     */
    public $periodo_cursar;

    /**
     * @var int Max length is 11.
     */
    public $valor_semestre;

    /**
     * @var varchar Max length is 200.
     */
    public $nombre_programa;

    /**
     * @var int Max length is 11.
     */
    public $version;

    public $_table = 'ingreso';
    public $_primarykey = 'id';
    public $_fields = array('id','id_beneficiario','tipo_ingreso','ies','periodo_cursar','valor_semestre','nombre_programa','version');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_beneficiario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'tipo_ingreso' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'ies' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'periodo_cursar' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'valor_semestre' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre_programa' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'version' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}