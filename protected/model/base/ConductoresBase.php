<?php
Doo::loadCore('db/DooModel');

class ConductoresBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_propietario;

    /**
     * @var varchar Max length is 20.
     */
    public $identificacion;
    
    /**
     * @var varchar Max length is 20.
     */
    public $tipo_identificacion;    

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;
    
    /**
     * @var varchar Max length is 45.
     */
    public $apellidos;

    /**
     * @var varchar Max length is 20.
     */
    public $celular;

    /**
     * @var varchar Max length is 20.
     */
    public $telefono;

    /**
     * @var varchar Max length is 20.
     */
    public $estadocv;
    
    /**
     * @var varchar Max length is 20.
     */
    public $genero;

    /**
     * @var varchar Max length is 20.
     */
    public $fecha_nac;
    
    /**
     * @var varchar Max length is 20.
     */
    public $niveled;
    
    /**
     * @var varchar Max length is 20.
     */
    public $grupo_san;
    
    /**
     * @var varchar Max length is 20.
     */
    public $libreta_mil;
    
    /**
     * @var varchar Max length is 20.
     */
    public $clase;
    
    /**
     * @var varchar Max length is 20.
     */
    public $dm;

    /**
     * @var varchar Max length is 60.
     */
    public $email;

    /**
     * @var varchar Max length is 40.
     */
    public $password;

    /**
     * @var char Max length is 2.
     */
    public $cat_licencia;

    /**
     * @var varchar Max length is 20.
     */
    public $n_licencia;

    /**
     * @var date
     */
    public $vigencia;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var varchar Max length is 45.
     */
    public $direccion;

    /**
     * @var char Max length is 1.
     */
    public $estado;

    /**
     * @var char Max length is 1.
     */
    public $estado_c_p;

    /**
     * @var varchar Max length is 45.
     */
    public $empresa;
    
    /**
     * @var varchar Max length is 45.
     */
    public $eps;
    
    /**
     * @var varchar Max length is 45.
     */
    public $arl;
    
    /**
     * @var varchar Max length is 45.
     */
    public $fondope;

    /**
     * @var varchar Max length is 45.
     */
    public $fondoce;
    
    /**
     * @var varchar Max length is 45.
     */
    public $cajacom;    

    /**
     * @var varchar Max length is 255.
     */
    public $dtoken;

    /**
     * @var varchar Max length is 10.
     */
    public $dtype;

    /**
     * @var double
     */
    public $latitud;

    /**
     * @var double
     */
    public $longitud;

    /**
     * @var varchar Max length is 30.
     */
    public $imagen;

    /**
     * @var int Max length is 11.
     */
    public $v_actual;

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

    public $_table = 'conductores';
    public $_primarykey = 'id';
    public $_fields = array('id','id_propietario','identificacion','tipo_identificacion','nombre','apellidos','celular','telefono','estadocv','genero','fecha_nac','niveled','grupo_san','libreta_mil','clase','dm','email','password','cat_licencia','n_licencia','vigencia','tipo','direccion','estado','estado_c_p','empresa','eps','arl','fondope','fondoce','cajacom','dtoken','dtype','latitud','longitud','imagen','v_actual','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_propietario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),
                
                'tipo_identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),
                

                'nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),
                
                'apellidos' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),                

                'celular' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),
                
                'telefono' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),
                
                'estadocv' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),
                
                'genero' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),                 
                
                'fecha_nac' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),
                
                'niveled' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),  
                
                'grupo_san' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),
                
                'libreta_mil' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),  
                
                'clase' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),
                
                'dm' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),
                
                'email' => array(
                        array( 'maxlength', 60 ),
                        array( 'optional' ),
                ),

                'password' => array(
                        array( 'maxlength', 40 ),
                        array( 'notnull' ),
                ),

                'cat_licencia' => array(
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'n_licencia' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'vigencia' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'direccion' => array(
                        array( 'maxlength', 45 ),
                        array( 'notnull' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'estado_c_p' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'empresa' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),
                
                
                'eps' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ), 
                
                'arl' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ), 
                
                'fondope' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ), 
                
                'cajacom' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),                 

                'dtoken' => array(
                        array( 'maxlength', 255 ),
                        array( 'optional' ),
                ),

                'dtype' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'latitud' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'longitud' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'imagen' => array(
                        array( 'maxlength', 30 ),
                        array( 'notnull' ),
                ),

                'v_actual' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
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
                )
            );
    }

}