<?php
Doo::loadCore('db/DooModel');

class ParametrosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var char Max length is 3.
     */
    public $territorial;

    /**
     * @var char Max length is 4.
     */
    public $resolucion_hab;

    /**
     * @var char Max length is 2.
     */
    public $ano_hab;

    /**
     * @var int Max length is 4.
     */
    public $ano_actual;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $cons_contrato;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $cons_planilla;

    /**
     * @var int Max length is 5.  unsigned zerofill.
     */
    public $cons_ruta;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $cons_factura;

    /**
     * @var double
     */
    public $kmMatenimiento;

    /**
     * @var int Max length is 11.
     */
    public $diasNotifyMante;

    /**
     * @var double
     */
    public $kmNotify;

    /**
     * @var int Max length is 11.
     */
    public $proxMantMeses;

    public $_table = 'parametros';
    public $_primarykey = 'id';
    public $_fields = array('id','territorial','resolucion_hab','ano_hab','ano_actual','cons_contrato','cons_planilla','cons_ruta','cons_factura','kmMatenimiento','diasNotifyMante','kmNotify','proxMantMeses');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'territorial' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'resolucion_hab' => array(
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'ano_hab' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'ano_actual' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cons_contrato' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cons_planilla' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cons_ruta' => array(
                        array( 'integer' ),
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'cons_factura' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'kmMatenimiento' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'diasNotifyMante' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'kmNotify' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'proxMantMeses' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}