<?php
Doo::loadCore('db/DooModel');

class CodeudorBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_usuario;

    /**
     * @var varchar Max length is 100.
     */
    public $nombres;

    /**
     * @var varchar Max length is 100.
     */
    public $apellidos;

    /**
     * @var varchar Max length is 5.
     */
    public $tipo_documento;

    /**
     * @var int Max length is 11.
     */
    public $numero_documento;

    /**
     * @var int Max length is 11.
     */
    public $pais_expedicion_documento;

    /**
     * @var int Max length is 11.
     */
    public $departamento_expedicion_documento;

    /**
     * @var int Max length is 11.
     */
    public $municipio_expedicion_documento;

    /**
     * @var date
     */
    public $fecha_nacimiento;

    /**
     * @var int Max length is 11.
     */
    public $pais_nacimiento;

    /**
     * @var int Max length is 11.
     */
    public $departamento_nacimiento;

    /**
     * @var int Max length is 11.
     */
    public $municipio_nacimiento;

    /**
     * @var varchar Max length is 11.
     */
    public $celular;

    /**
     * @var varchar Max length is 11.
     */
    public $telefono_fijo;

    /**
     * @var varchar Max length is 11.
     */
    public $celular_alternativo;

    /**
     * @var varchar Max length is 100.
     */
    public $email;

    /**
     * @var varchar Max length is 100.
     */
    public $email_alternativo;

    /**
     * @var int Max length is 11.
     */
    public $pais_recidencia;

    /**
     * @var int Max length is 11.
     */
    public $departamento_recidencia;

    /**
     * @var int Max length is 11.
     */
    public $municipio_recidencia;

    /**
     * @var varchar Max length is 200.
     */
    public $direccion_recidencia;

    /**
     * @var varchar Max length is 100.
     */
    public $barrio;

    /**
     * @var varchar Max length is 20.
     */
    public $estrato;

    /**
     * @var int Max length is 10.
     */
    public $personas_cargo;

    /**
     * @var int Max length is 2.
     */
    public $activo;

    /**
     * @var varchar Max length is 100.
     */
    public $relacion_aspirante;

    /**
     * @var varchar Max length is 100.
     */
    public $relacion_anexpac;

    /**
     * @var int Max length is 11.
     */
    public $ingresos;

    /**
     * @var int Max length is 11.
     */
    public $id_beneficiario;

    public $_table = 'codeudor';
    public $_primarykey = 'id';
    public $_fields = array('id','id_usuario','nombres','apellidos','tipo_documento','numero_documento','pais_expedicion_documento','departamento_expedicion_documento','municipio_expedicion_documento','fecha_nacimiento','pais_nacimiento','departamento_nacimiento','municipio_nacimiento','celular','telefono_fijo','celular_alternativo','email','email_alternativo','pais_recidencia','departamento_recidencia','municipio_recidencia','direccion_recidencia','barrio','estrato','personas_cargo','activo','relacion_aspirante','relacion_anexpac','ingresos','id_beneficiario');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nombres' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'apellidos' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'tipo_documento' => array(
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
                ),

                'numero_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'pais_expedicion_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'departamento_expedicion_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'municipio_expedicion_documento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'fecha_nacimiento' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'pais_nacimiento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'departamento_nacimiento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'municipio_nacimiento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'celular' => array(
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'telefono_fijo' => array(
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'celular_alternativo' => array(
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'email' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'email_alternativo' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'pais_recidencia' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'departamento_recidencia' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'municipio_recidencia' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'direccion_recidencia' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'barrio' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'estrato' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'personas_cargo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'activo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'relacion_aspirante' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'relacion_anexpac' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'ingresos' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_beneficiario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}