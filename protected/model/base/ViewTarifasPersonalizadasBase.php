<?php
Doo::loadCore('db/DooModel');

class ViewTarifasPersonalizadasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var int Max length is 11.
     */
    public $id_tarifa;

    /**
     * @var varchar Max length is 93.
     */
    public $nombre;

    /**
     * @var varchar Max length is 45.
     */
    public $nombreo;

    /**
     * @var varchar Max length is 45.
     */
    public $nombred;

    /**
     * @var int Max length is 11.
     */
    public $id_clase_vehiculo;

    /**
     * @var varchar Max length is 20.
     */
    public $clase;

    /**
     * @var double
     */
    public $valor;

    public $_table = 'view_tarifas_personalizadas';
    public $_primarykey = '';
    public $_fields = array('id','id_cliente','id_tarifa','nombre','nombreo','nombred','id_clase_vehiculo','clase','valor');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_tarifa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 93 ),
                        array( 'optional' ),
                ),

                'nombreo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'nombred' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'id_clase_vehiculo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'clase' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                )
            );
    }

}