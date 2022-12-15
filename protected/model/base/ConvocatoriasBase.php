<?php
Doo::loadCore('db/DooModel');

class ConvocatoriasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre;

    /**
     * @var varchar Max length is 100.
     */
    public $codigo;

    /**
     * @var date
     */
    public $fecha_inicial;

    /**
     * @var date
     */
    public $fecha_final;

    /**
     * @var varchar Max length is 15.
     */
    public $activa;

    public $_table = 'convocatorias';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','codigo','fecha_inicial','fecha_final','activa');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'codigo' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'fecha_inicial' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'fecha_final' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'activa' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                )
            );
    }

}