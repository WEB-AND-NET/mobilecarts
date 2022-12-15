<?php
Doo::loadCore('db/DooModel');

class ClientesPropietariosBase extends DooModel{

    /**
     * @var varchar Max length is 11.
     */
    public $id_cliente;

    /**
     * @var varchar Max length is 11.
     */
    public $id_propietario;

    public $_table = 'clientes_propietarios';
    public $_primarykey = '';
    public $_fields = array('id_cliente','id_propietario');

    public function getVRules() {
        return array(
                'id_cliente' => array(
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_propietario' => array(
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}