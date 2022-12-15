<?php
Doo::loadCore('db/DooModel');

class MttosactividadesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $mantenimientoId;

    /**
     * @var int Max length is 11.
     */
    public $actividadId;

    /**
     * @var double
     */
    public $costo;

    /**
     * @var text
     */
    public $anotacion;

    public $_table = 'mttosactividades';
    public $_primarykey = 'id';
    public $_fields = array('id','mantenimientoId','actividadId','costo','anotacion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'mantenimientoId' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'actividadId' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'costo' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'anotacion' => array(
                        array( 'optional' ),
                )
            );
    }

}