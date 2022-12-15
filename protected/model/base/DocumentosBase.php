<?php
Doo::loadCore('db/DooModel');

class DocumentosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 150.
     */
    public $nombre;

    /**
     * @var varchar Max length is 150.
     */
    public $nombre_carpeta;

    /**
     * @var char Max length is 2.
     */
    public $vencimiento;

    /**
     * @var char Max length is 2.
     */
    public $tipo;

    /**
     * @var char Max length is 2.
     */
    public $deleted;

    /**
     * @var text
     */
    public $attr;

    public $_table = 'documentos';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','nombre_carpeta','vencimiento','tipo','deleted','attr');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 150 ),
                        array( 'optional' ),
                ),

                'nombre_carpeta' => array(
                        array( 'maxlength', 150 ),
                        array( 'optional' ),
                ),

                'vencimiento' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'attr' => array(
                        array( 'optional' ),
                )
            );
    }

}