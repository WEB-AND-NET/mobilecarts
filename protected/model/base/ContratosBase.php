<?php
Doo::loadCore('db/DooModel');

class ContratosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $numero;

    /**
     * @var varchar Max length is 200.
     */
    public $objeto;

    /**
     * @var double
     */
    public $disponibilidad;

    /**
     * @var double
     */
    public $transfer;

    /**
     * @var double
     */
    public $parada;

    /**
     * @var date
     */
    public $fechaIni;

    /**
     * @var date
     */
    public $fechaFin;

    /**
     * @var varchar Max length is 50.
     */
    public $archivoContrato;

    public $_table = 'contratos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_cliente','numero','objeto','disponibilidad','transfer','parada','fechaIni','fechaFin','archivoContrato');

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

                'numero' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'objeto' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'disponibilidad' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'transfer' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'parada' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'fechaIni' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'fechaFin' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'archivoContrato' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                )
            );
    }

}