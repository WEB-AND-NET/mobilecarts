<?php
Doo::loadCore('db/DooModel');

class VehiculosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $placa;

    /**
     * @var varchar Max length is 200.
     */
    public $deviceId;

    /**
     * @var varchar Max length is 20.
     */
    public $modelo;

    /**
     * @var varchar Max length is 20.
     */
    public $marca;

    /**
     * @var tinyint Max length is 2.
     */
    public $id_clase;

    /**
     * @var varchar Max length is 20.
     */
    public $num_interno;

    /**
     * @var varchar Max length is 20.
     */
    public $tg_operacion;

    /**
     * @var date
     */
    public $v_tg_operacion;

    /**
     * @var int Max length is 11.
     */
    public $id_propietario;

    /**
     * @var tinyint Max length is 3.
     */
    public $capacidad;

    /**
     * @var date
     */
    public $soat;

    /**
     * @var date
     */
    public $tecnomecanica;

    /**
     * @var varchar Max length is 30.
     */
    public $n_contra;

    /**
     * @var date
     */
    public $v_contra;

    /**
     * @var varchar Max length is 30.
     */
    public $n_extra;

    /**
     * @var date
     */
    public $v_extra;

    /**
     * @var varchar Max length is 30.
     */
    public $n_todo;

    /**
     * @var date
     */
    public $v_todo;

    /**
     * @var int Max length is 11.
     */
    public $id_convenio;

    /**
     * @var varchar Max length is 20.
     */
    public $motor;

    /**
     * @var varchar Max length is 45.
     */
    public $chasis;

    /**
     * @var varchar Max length is 20.
     */
    public $cilindraje;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    /**
     * @var varchar Max length is 20.
     */
    public $numLicTran;

    /**
     * @var varchar Max length is 20.
     */
    public $linea;

    /**
     * @var int Max length is 11.
     */
    public $potencia;

    /**
     * @var varchar Max length is 20.
     */
    public $color;

    /**
     * @var varchar Max length is 20.
     */
    public $servicio;

    /**
     * @var varchar Max length is 20.
     */
    public $tipoCarroceria;

    /**
     * @var varchar Max length is 20.
     */
    public $combustible;

    /**
     * @var int Max length is 11.
     */
    public $puertas;

    /**
     * @var varchar Max length is 45.
     */
    public $vin;

    /**
     * @var varchar Max length is 45.
     */
    public $numSerie;

    /**
     * @var date
     */
    public $fechaMatricula;

    /**
     * @var date
     */
    public $fechaExpeLic;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    public $_table = 'vehiculos';
    public $_primarykey = 'id';
    public $_fields = array('id','placa','deviceId','modelo','marca','id_clase','num_interno','tg_operacion','v_tg_operacion','id_propietario','capacidad','soat','tecnomecanica','n_contra','v_contra','n_extra','v_extra','n_todo','v_todo','id_convenio','motor','chasis','cilindraje','deleted','created_at','updated_at','numLicTran','linea','potencia','color','servicio','tipoCarroceria','combustible','puertas','vin','numSerie','fechaMatricula','fechaExpeLic','estado');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'placa' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'deviceId' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'modelo' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'marca' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'id_clase' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'num_interno' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'tg_operacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'v_tg_operacion' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'id_propietario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'capacidad' => array(
                        array( 'integer' ),
                        array( 'maxlength', 3 ),
                        array( 'notnull' ),
                ),

                'soat' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'tecnomecanica' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'n_contra' => array(
                        array( 'maxlength', 30 ),
                        array( 'notnull' ),
                ),

                'v_contra' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'n_extra' => array(
                        array( 'maxlength', 30 ),
                        array( 'notnull' ),
                ),

                'v_extra' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'n_todo' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'v_todo' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'id_convenio' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'motor' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'chasis' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'cilindraje' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'numLicTran' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'linea' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'potencia' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'color' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'servicio' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'tipoCarroceria' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'combustible' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'puertas' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'vin' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'numSerie' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'fechaMatricula' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'fechaExpeLic' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}