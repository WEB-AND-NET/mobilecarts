<?php
Doo::loadCore('db/DooModel');

class DocumentosConductorDataBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_documento;

    /**
     * @var int Max length is 11.
     */
    public $id_conductor;

    /**
     * @var int Max length is 11.
     */
    public $id_vehiculo;

    /**
     * @var varchar Max length is 200.
     */
    public $nombre_documento;

    /**
     * @var date
     */
    public $fecha_expedicion;

    /**
     * @var date
     */
    public $fecha_vencimiento;

    /**
     * @var text
     */
    public $atributos;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    public $_table = 'documentos_conductor_data';
    public $_primarykey = 'id';
    public $_fields = array('id','id_documento','id_conductor','id_vehiculo','nombre_documento','fecha_expedicion','fecha_vencimiento','atributos','estado');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_conductor' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre_documento' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'fecha_expedicion' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'fecha_vencimiento' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'atributos' => array(
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}