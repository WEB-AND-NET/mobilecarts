<?php
Doo::loadCore('db/DooModel');

class RevisionDiaraBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_conductor;

    /**
     * @var int Max length is 11.
     */
    public $id_vehiculo;

    /**
     * @var date
     */
    public $fecha;

    /**
     * @var double
     */
    public $kilometraje;

    /**
     * @var date
     */
    public $venc_botiquin;

    /**
     * @var date
     */
    public $venc_extintor;

    /**
     * @var date
     */
    public $ulti_engrase;

    /**
     * @var date
     */
    public $ulti_lavado;

    /**
     * @var text
     */
    public $tipo_lavado;

    /**
     * @var text
     */
    public $observaciones;

    /**
     * @var datetime
     */
    public $creacion;

    public $_table = 'revision_diara';
    public $_primarykey = 'id';
    public $_fields = array('id','id_conductor','id_vehiculo','fecha','kilometraje','venc_botiquin','venc_extintor','ulti_engrase','ulti_lavado','tipo_lavado','observaciones','creacion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_conductor' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'fecha' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'kilometraje' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'venc_botiquin' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'venc_extintor' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'ulti_engrase' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'ulti_lavado' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'tipo_lavado' => array(
                        array( 'notnull' ),
                ),

                'observaciones' => array(
                        array( 'optional' ),
                ),

                'creacion' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                )
            );
    }

}