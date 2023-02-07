<?php

/**
 * Description of routes.conf
 *
 * @author Carlos Meriño Iriarte
 */

//MAIN
$route['*']['/'] = array('MainController', 'index');
$route['*']['/login'] = array('MainController', 'rutalogin');
$route['*']['/postlogin'] = array('MainController', 'login');

//DOCUMENTOS
$route['*']['/getdocvencidos'] = array('MainController', 'getdocvencidos');
$route['*']['/getdocvencidos/view'] = array('MainController', 'viewgetdocvencidos');

$route['*']['/admpropietarios'] = array('MainControllerPropietario', 'rutalogin');
$route['*']['/postloginpropietarios'] = array('MainControllerPropietario', 'login');
$route['*']['/logoutpropietario'] = array('MainControllerPropietario', 'logout');

$route['*']['/panel/home'] = array('MainController', 'index');


$route['*']['/signup'] = array('MainController', 'rutaSignup');
$route['*']['/postsignup'] = array('MainController', 'signup');
$route['*']['/check_username_availability'] = array('MainController', 'check_username');

$route['*']['/logout'] = array('MainController', 'logout');
//$route['*']['/home'] = array('MainController', 'home');
$route['*']['/error'] = array('ErrorController', 'index');

$route['*']['/fuec/:pindex'] = array('PublicController', 'fuec');
//Funcionales %100 admin
//$route['*']['/tarifas2'] = array('PublicController', 'tarifas');
//$route['*']['/tarifas2_update'] = array('PublicController', 'updateValores');
//$route['*']['/usuarios_propietarios'] = array('PublicController', 'updateUsuariosPropietarios');
//$route['*']['/usuarios_clientes_propietarios_delete'] = array('PublicController', 'deleteUsuariosClientesPropietarios');
//$route['*']['/tarifas_transferir'] = array('PublicController', 'transferirTarifas');
//$route['*']['/actualizar_tarifas'] = array('PublicController', 'actualizarTarifas');
//$route['*']['/asignar_tarifas_custom'] = array('PublicController', 'asignarTarifas');

/*Conductores propietarios   */

$route['*']['/conductoresp'] = array('ConductoresPropietarioController', 'index');
$route['*']['/conductoresp/deactivate/:pindex'] = array('ConductoresPropietarioController', 'deactivate');
$route['*']['/conductoresp/activate/:pindex'] = array('ConductoresPropietarioController', 'activate');
$route['*']['/conductoresp/openotify/:pindex'] = array('ConductoresPropietarioController', 'openNotify');


/*
*
*Ordenes
*
*/
$route['*']['/ordenes_servicios/sendNotificaion'] = array('OrdenesController', 'sendNotificaion');
$route['*']['/ordenes_servicios'] = array('OrdenesController', 'index');
$route['*']['/ordenes_servicios/paginate'] = array('OrdenesController', 'paginate');
$route['*']['/ordenes_servicios/add'] = array('OrdenesController', 'add');
$route['*']['/ordenes_servicios/edit/:pindex'] = array('OrdenesController', 'edit');
$route['*']['/ordenes_servicios/preview/:pindex'] = array('OrdenesController', 'preview');
$route['*']['/ordenes_servicios/delete/:pindex'] = array('OrdenesController', 'deactivate');
$route['*']['/ordenes_servicios/aprobar/:pindex'] = array('OrdenesController', 'aprobar');
$route['*']['/ordenes_servicios/save'] = array('OrdenesController', 'save');
$route['*']['/ordenes_servicios/new_add_print/:pindex'] = array('OrdenesController', 'new_add_print');
$route['*']['/ordenes_servicios/validar'] = array('OrdenesController', 'validar');
$route['*']['/ordenes_servicios/save_asignar'] = array('OrdenesController', 'save_asignar');
$route['*']['/ordenes_servicios/save_cancelar'] = array('OrdenesController', 'save_cancelar');
$route['*']['/ordenes_servicios/cancel'] = array('OrdenesController', 'cancel');
$route['*']['/ordenes_servicios/imprimir/:pindex'] = array('OrdenesController', 'imprimir');
$route['*']['/ordenes_servicios/factura/:pindex'] = array('OrdenesController', 'factura');
$route['*']['/ordenes_servicios/enviar/:pindex'] = array('OrdenesController', 'enviar');
$route['*']['/ordenes_servicios/cargar_asignar'] = array('OrdenesController', 'cargar_asignar');
$route['*']['/ordenes_servicios/cargar_conductor'] = array('OrdenesController', 'cargar_conductor');
$route['*']['/ordenes_servicios/cargar_cancelar'] = array('OrdenesController', 'cargar_cancelar');
$route['*']['/ordenes_servicios/pendientes'] = array('OrdenesController', 'pendientes');
$route['*']['/ordenes_servicios/cancelados'] = array('OrdenesController', 'cancelados');
$route['*']['/ordenes_servicios/valor'] = array('OrdenesController', 'valor');

$route['*']['/ordenes_servicios/cargarvh'] = array('OrdenesController', 'cargar_vehiculo');
$route['*']['/ordenes_servicios/cargarvhp'] = array('OrdenesController', 'cargar_vehiculoP');
$route['*']['/ordenes_servicios/cargarcondu'] = array('OrdenesController', 'cargar_conductores');
$route['*']['/ordenes_servicios/cargar_contacto'] = array('OrdenesController', 'cargar_contacto');

$route['*']['/ordenes_servicios/getitems'] = array('OrdenesController', 'insert');
$route['*']['/ordenes_servicios/validarConductores'] = array('OrdenesController', 'validarConductor');
$route['*']['/ordenes_servicios/load'] = array('OrdenesController', 'load');
$route['*']['/ordenes_servicios/delete'] = array('OrdenesController', 'delete');
$route['*']['/ordenes_servicios/clean'] = array('OrdenesController', 'clean');

$route['*']['/ordenes_servicios/getitems2'] = array('OrdenesController', 'insert_parada');
$route['*']['/ordenes_servicios/load2'] = array('OrdenesController', 'load_paradas');
$route['*']['/ordenes_servicios/delete2'] = array('OrdenesController', 'delete_parada');


$route['*']['/ordenes_servicios/aviso'] = array('OrdenesController', 'aviso');
/*
*
*Clientes
*
*/
$route['*']['/clientes'] = array('ClientesController', 'index');
$route['*']['/clientes/add'] = array('ClientesController', 'add');
//temp
$route['*']['/clientes/add2'] = array('ClientesController', 'add2');
$route['*']['/clientes/edit/:pindex'] = array('ClientesController', 'edit');
$route['*']['/clientes/delete/:pindex'] = array('ClientesController', 'deactivate');
$route['*']['/clientes/deleteitem'] = array('ClientesController', 'deleteitem');
$route['*']['/clientes/save'] = array('ClientesController', 'save');
$route['*']['/clientes/validar'] = array('ClientesController', 'validar');
$route['*']['/clientes/clean'] = array('ClientesController', 'clean');
$route['*']['/clientes/posiciones'] = array('ClientesController', 'posiciones');
$route['*']['/clientes/getccostos'] = array('ClientesController', 'ccostos');
$route['*']['/clientes/getcontactos'] = array('ClientesController', 'contactos');
$route['*']['/clientes/desactivar_contacto'] = array('ClientesController', 'desactivarContacto');
$route['*']['/clientes/activar_contacto'] = array('ClientesController', 'activarContacto');
$route['*']['/clientes/validarcosto'] = array('ClientesController', 'validarcosto');
$route['*']['/clientes/savetemporal'] = array('ClientesController', 'savetemporal');
$route['*']['/clientes/contratos/edit/:pindex'] = array('ClientesController', 'edit_contrato');
$route['*']['/clientes/contratos/vehiculo/add'] = array('ClientesController', 'addVehiculoContrato');
$route['*']['/clientes/contratos/vehiculo/get'] = array('ClientesController', 'getVehiculosContrato');
//$route['*']['/clientes/contratos/insert_tarifa'] = array('ClientesController', 'insertTarifa');
$route['*']['/clientes/contratos/load_tarifas'] = array('ClientesController', 'loadTarifas');
$route['*']['/clientes/tarifas/paginate/:pindex'] = array('ClientesController', 'paginateTarifas');
$route['*']['/clientes/contratos/update_tarifa'] = array('ClientesController', 'updateTarifa');
$route['*']['/clientes/contratos/delete_tarifa'] = array('ClientesController', 'deleteTarifa');
$route['*']['/clientes/contratos/save'] = array('ClientesController', 'save_contrato');

$route['*']['/clientes/contactos/paginate/:pindex'] = array('ClientesController', 'paginate');
//$route['*']['/clientes/edit/:pindex/contacto/:pindex2'] = array('ClientesController', 'edit_contacto');
$route['*']['/clientes/edit/contacto'] = array('ClientesController', 'edit_contacto');

/*
*
*Clientes Propietarios
*
*/
$route['*']['/clientesp'] = array('ClientesPropietariosController', 'index');
$route['*']['/clientesp/add'] = array('ClientesPropietariosController', 'add');
$route['*']['/clientesp/edit/:pindex'] = array('ClientesPropietariosController', 'edit');
$route['*']['/clientesp/save'] = array('ClientesPropietariosController', 'save');
$route['*']['/clientesp/validar'] = array('ClientesPropietariosController', 'validar');
$route['*']['/clientesp/deactivate/:pindex'] = array('ClientesPropietariosController', 'deactivate');
$route['*']['/clientesp/activate/:pindex'] = array('ClientesPropietariosController', 'activate');

/** clientes_pro */
$route['*']['/clientes_pro'] = array('ClientesPropietariosController', 'indexFromPropietarios');
$route['*']['/clientes_pro/add'] = array('ClientesPropietariosController', 'addFromPropietarios');
$route['*']['/clientes_pro/save'] = array('ClientesPropietariosController', 'saveFromPropietarios');
$route['*']['/clientes_pro/edit/:pindex'] = array('ClientesPropietariosController', 'editFromPropietarios');


/*
*
*Clases Vehiculos
*
*/
$route['*']['/clases_vehiculos'] = array('ClasesVehiculosController', 'index');
$route['*']['/clases_vehiculos/add'] = array('ClasesVehiculosController', 'add');
$route['*']['/clases_vehiculos/edit/:pindex'] = array('ClasesVehiculosController', 'edit');
$route['*']['/clases_vehiculos/delete/:pindex'] = array('ClasesVehiculosController', 'deactivate');
$route['*']['/clases_vehiculos/save'] = array('ClasesVehiculosController', 'save');
$route['*']['/clases_vehiculos/validar'] = array('ClasesVehiculosController', 'validar');
$route['*']['/clases_vehiculos/posiciones'] = array('ClasesVehiculosController', 'posiciones');

/*
*
*Conductores
*
*/
$route['*']['/conductores'] = array('ConductoresController', 'index');
$route['*']['/conductores/add'] = array('ConductoresController', 'add');
$route['*']['/conductores/edit/:pindex'] = array('ConductoresController', 'edit');
$route['*']['/conductores/delete/:pindex'] = array('ConductoresController', 'deactivate');
$route['*']['/conductores/save'] = array('ConductoresController', 'save');
$route['*']['/conductores/validar'] = array('ConductoresController', 'validar');
$route['*']['/conductores/validare'] = array('ConductoresController', 'validare');
$route['*']['/conductores/posiciones'] = array('ConductoresController', 'posiciones');

$route['*']['/conductores/documents/:pindex'] = array('ConductoresController', 'documentos');
$route['*']['/conductores/documents/saveAll'] = array('ConductoresController', 'saveAll');
$route['*']['/conductores/documents/save'] = array('ConductoresController', 'saveDocs');
$route['*']['/conductores/documents/getDocuments'] = array('ConductoresController', 'getDocs');

$route['*']['/conductores/curriculum/:pindex'] = array('ConductoresController', 'curriculum');

$route['*']['/conductores/deactivate/:pindex'] = array('ConductoresController', 'deactivate2');
$route['*']['/conductores/activate/:pindex'] = array('ConductoresController', 'activate');

$route['*']['/conductores_propietario/updatedocts/:pindex'] = array('ConductoresPropietarioController', 'setnotifydocs');
$route['*']['/conductores/documents/view/:pindex'] = array('ConductoresPropietarioController', 'viewdocumentos');
$route['*']['/conductores/documents/rechazar'] = array('ConductoresPropietarioController', 'rechazardocumento');
$route['*']['/conductores/documents/getnrechazados'] = array('ConductoresPropietarioController', 'notificaciones');
$route['*']['/conductores/documents/opennotify/:pindex'] = array('ConductoresPropietarioController', 'opennotifyp');




//Cambio de Constraseña
$route['*']['/cambio'] = array('CambiarController', 'index');
$route['*']['/cambiar'] = array('CambiarController', 'update');
$route['*']['/cambiar/validar'] = array('CambiarController', 'validar');

/*
*
*Propietario
*
*/
$route['*']['/propietarios'] = array('PropietariosController', 'index');
$route['*']['/propietarios/add'] = array('PropietariosController', 'add');
$route['*']['/propietarios/edit/:pindex'] = array('PropietariosController', 'edit');
$route['*']['/propietarios/delete/:pindex'] = array('PropietariosController', 'deactivate');
$route['*']['/propietarios/activar/:pindex'] = array('PropietariosController', 'activate');
$route['*']['/propietarios/desactivar/:pindex'] = array('PropietariosController', 'deactivate');
$route['*']['/propietarios/bloquear/:pindex'] = array('PropietariosController', 'bloquear');
$route['*']['/propietarios/save'] = array('PropietariosController', 'save');
$route['*']['/propietarios/savebloqueo'] = array('PropietariosController', 'savebloqueo');
$route['*']['/propietarios/validar'] = array('PropietariosController', 'validar');
/*
*
*Rutas
*
*/
$route['*']['/rutas'] = array('RutasController', 'index');
$route['*']['/rutas/add'] = array('RutasController', 'add');
$route['*']['/rutas/edit/:pindex'] = array('RutasController', 'edit');
$route['*']['/rutas/barrios/list'] = array('RutasController', 'listBarrios');
$route['*']['/rutas/tarifas/:pindex'] = array('RutasController', 'tarifas');
$route['*']['/rutas/tarifas/add'] = array('RutasController', 'addTarifa');
$route['*']['/rutas/tarifas/list'] = array('RutasController', 'listTarifas');
$route['*']['/rutas/tarifas/save'] = array('RutasController', 'saveTarifas');
$route['*']['/rutas/tarifas/clean'] = array('RutasController', 'cleanTarifas');
$route['*']['/rutas/delete/:pindex'] = array('RutasController', 'deactivate');
$route['*']['/rutas/save'] = array('RutasController', 'save');
$route['*']['/rutas/validar'] = array('RutasController', 'validar');

$route['*']['/rutas/cargar_cliente'] = array('RutasController', 'cargar_clientes');
/*
*
*Roles
*
*/
$route['*']['/roles'] = array('RolesController', 'index');
$route['*']['/roles/add'] = array('RolesController', 'add');
$route['*']['/roles/edit/:pindex'] = array('RolesController', 'edit');
$route['*']['/roles/delete/:pindex'] = array('RolesController', 'deactivate');
$route['*']['/roles/save'] = array('RolesController', 'save');
$route['*']['/roles/validar'] = array('RolesController', 'validar');
/*
*
*Reportes
*
*/
$route['*']['/ser_realizados'] = array('ReportesController', 'serviciosRealizados');

$route['*']['/ser_cliente'] = array('ReportesController', 'reporteServiciosC');
$route['*']['/ser_cliente/html/:pindex/:fi/:ff'] = array('ReportesController', 'reporteServiciosCHtml');
$route['*']['/ser_cliente/imprimir/:pindex/:fi/:ff'] = array('ReportesController', 'imprimirServiciosC');
$route['*']['/ser_cliente/imprimirv2/:pindex/:fi/:ff'] = array('ReportesController', 'imprimirServiciosCv2');

$route['*']['/clientes_propietarios'] = array('ReportesController', 'reporteClienteP');
$route['*']['/clientes_propietarios/html/:pindex'] = array('ReportesController', 'reporteClientePHtml');
$route['*']['/clientes_propietarios/imprimir/:pindex'] = array('ReportesController', 'imprimirClienteP');

$route['*']['/documentovencer'] = array('ReportesController', 'ReporteDocumentoV');
$route['*']['/documentovencer/list/:meses'] = array('ReportesController', 'ImprimirDocumentoVHtml');
$route['*']['/documentovencer/save/:meses'] = array('ReportesController', 'ImprimirDocumentoV');

$route['*']['/soatvencer'] = array('ReportesController', 'ReporteSoatV');
$route['*']['/soatvencer/list/:fi/:ff'] = array('ReportesController', 'ImprimirSoatVHtml');
$route['*']['/soatvencer/save/:fi/:ff'] = array('ReportesController', 'ImprimirSoatV');

$route['*']['/tecnomecanicavencer'] = array('ReportesController', 'ReporteTecnoV');
$route['*']['/tecnomecanicavencer/list/:fi/:ff'] = array('ReportesController', 'ImprimirTecnoVHtml');
$route['*']['/tecnomecanicavencer/save/:fi/:ff'] = array('ReportesController', 'ImprimirTecnoV');

$route['*']['/contravencer'] = array('ReportesController', 'ReporteContraV');
$route['*']['/contravencer/list/:fi/:ff'] = array('ReportesController', 'ImprimirContraVHtml');
$route['*']['/contravencer/save/:fi/:ff'] = array('ReportesController', 'ImprimirContraV');

$route['*']['/extravencer'] = array('ReportesController', 'ReporteExtraV');
$route['*']['/extravencer/list/:fi/:ff'] = array('ReportesController', 'ImprimirExtraVHtml');
$route['*']['/extravencer/save/:fi/:ff'] = array('ReportesController', 'ImprimirExtraV');

$route['*']['/operacionvencer'] = array('ReportesController', 'ReporteOperV');
$route['*']['/operacionvencer/list/:fi/:ff'] = array('ReportesController', 'ImprimirOperVHtml');
$route['*']['/operacionvencer/save/:fi/:ff'] = array('ReportesController', 'ImprimirOperV');

$route['*']['/todovencer'] = array('ReportesController', 'ReporteTodoV');
$route['*']['/todovencer/list/:fi/:ff'] = array('ReportesController', 'ImprimirTodoVHtml');
$route['*']['/todovencer/save/:fi/:ff'] = array('ReportesController', 'ImprimirTodoV');

$route['*']['/tarifas_cliente'] = array('ReportesController', 'reporteTarifasC');
$route['*']['/tarifas_cliente/html/:pindex'] = array('ReportesController', 'reporteTarifasCHtml');
$route['*']['/tarifas_cliente/imprimir/:pindex'] = array('ReportesController', 'imprimirTarifasC');

$route['*']['/ing_vehiculo'] = array('ReportesController', 'reporteIngresosVeh');
$route['*']['/ing_vehiculo/html/:pindex/:fi/:ff'] = array('ReportesController', 'reporteIngresosVehHtml');
$route['*']['/ing_vehiculo/imprimir/:pindex/:fi/:ff'] = array('ReportesController', 'imprimirIngresosVeh');


/*  vehiculos_propietarios   */


$route['*']['/vehiculos_propietario'] = array('VehiculosPropietarioController', 'index');
$route['*']['/vehiculos_propietario/add'] = array('VehiculosPropietarioController', 'add');
$route['*']['/vehiculos_propietario/edit/:pindex'] = array('VehiculosPropietarioController', 'edit');
$route['*']['/vehiculos_propietario/delete/:pindex'] = array('VehiculosController', 'deactivate');
$route['*']['/vehiculos_propietario/save'] = array('VehiculosPropietarioController', 'save');
$route['*']['/vehiculos_propietario/validar'] = array('VehiculosPropietarioController', 'validar');

$route['*']['/vehiculos_propietario/getitems'] = array('VehiculosPropietarioController', 'insert');
$route['*']['/vehiculos_propietario/validarConductores'] = array('VehiculosPropietarioController', 'validarConductor');
$route['*']['/vehiculos_propietario/load'] = array('VehiculosPropietarioController', 'load');
$route['*']['/vehiculos_propietario/delete'] = array('VehiculosPropietarioController', 'delete');
$route['*']['/vehiculos_propietario/clean'] = array('VehiculosPropietarioController', 'clean');

$route['*']['/vehiculos_propietario/documentos/:pindex'] = array('VehiculosPropietarioController', 'documentos');
$route['*']['/vehiculos_propietario/documents/save'] = array('VehiculosPropietarioController', 'saveDocs');
$route['*']['/vehiculos_propietario/documents/saveAll'] = array('VehiculosPropietarioController', 'saveAll');
$route['*']['/vehiculos_propietario/documents/getDocuments'] = array('VehiculosPropietarioController', 'getDocs');
$route['*']['/vehiculos_propietario/updatedocts/:pindex'] = array('VehiculosPropietarioController', 'setnotifydocs');

$route['*']['/vehiculos_propietario/documents/opennotify/:pindex'] = array('VehiculosPropietarioController', 'openNotify');




$route['*']['/vehiculosp'] = array('VehiculosPropietarioController', 'index_view');
$route['*']['/vehiculosp/deactivate/:pindex'] = array('VehiculosPropietarioController', 'deactivate_p');
$route['*']['/vehiculosp/activate/:pindex'] = array('VehiculosPropietarioController', 'activate_p');
/*
*
*Vehiculos
*
*/
$route['*']['/vehiculos'] = array('VehiculosController', 'index');
$route['*']['/vehiculos/add'] = array('VehiculosController', 'add');
$route['*']['/vehiculos/edit/:pindex'] = array('VehiculosController', 'edit');
$route['*']['/vehiculos/delete/:pindex'] = array('VehiculosController', 'deactivate');
$route['*']['/vehiculos/save'] = array('VehiculosController', 'save');
$route['*']['/vehiculos/validar'] = array('VehiculosController', 'validar');

$route['*']['/vehiculos/getitems'] = array('VehiculosController', 'insert');
$route['*']['/vehiculos/validarConductores'] = array('VehiculosController', 'validarConductor');
$route['*']['/vehiculos/load'] = array('VehiculosController', 'load');
$route['*']['/vehiculos/delete'] = array('VehiculosController', 'delete');
$route['*']['/vehiculos/clean'] = array('VehiculosController', 'clean');

$route['*']['/vehiculos/documents/view/:pindex'] = array('VehiculosPropietarioController', 'viewdocumentos');
$route['*']['/vehiculos/documents/rechazar'] = array('VehiculosPropietarioController', 'rechazardocumento');
$route['*']['/vehiculos/documents/activar'] = array('VehiculosPropietarioController', 'activar');
$route['*']['/vehiculos/documents/getnrechazados'] = array('VehiculosPropietarioController', 'notificaciones');
$route['*']['/vehiculos/documents/getDocumentosVencidos'] = array('VehiculosPropietarioController', 'getDocumentosVencidos');

$route['*']['/vehiculos/curriculum/:pindex'] = array('VehiculosPropietarioController', 'curriculum');

$route['*']['/vehiculos/documents/:pindex'] = array('VehiculosController', 'documentos');
/*
*
*Mantenimientos
*
*/
$route['*']['/mantenimientos/:pindex'] = array('MantenimientosController', 'index');
$route['*']['/mantenimientos/add/:pindex'] = array('MantenimientosController', 'add');
$route['*']['/mantenimientos/edit/:pindex'] = array('MantenimientosController', 'edit');
$route['*']['/mantenimientos/finish/:pindex'] = array('MantenimientosController', 'finish');
$route['*']['/mantenimientos/save'] = array('MantenimientosController', 'save');
$route['*']['/mantenimientos/savefinish'] = array('MantenimientosController', 'Savefinish');
$route['*']['/mantenimientos/addItem'] = array('MantenimientosController', 'insert');
$route['*']['/mantenimientos/deleteItem'] = array('MantenimientosController', 'delete');
$route['*']['/mantenimientos/loadItem'] = array('MantenimientosController', 'load');



/*
*
*Tarifas
*
*/
$route['*']['/tarifas'] = array('TarifasController', 'index');
$route['*']['/tarifas/paginate'] = array('TarifasController', 'paginate');
//$route['*']['/tarifas/add'] = array('TarifasController', 'add');
$route['*']['/tarifas/edit/:pindex'] = array('TarifasController', 'edit');
$route['*']['/tarifas/custom/:pindex'] = array('TarifasController', 'custom');
//$route['*']['/tarifas/delete/:pindex'] = array('TarifasController', 'deactivate');
$route['*']['/tarifas/save'] = array('TarifasController', 'save');
//$route['*']['/tarifas/validar'] = array('TarifasController', 'validar');

/*
*
*Regíones
*
*/
$route['*']['/regiones'] = array('RegionesController', 'index');
$route['*']['/regiones/add'] = array('RegionesController', 'add');
$route['*']['/regiones/edit/:pindex'] = array('RegionesController', 'edit');
$route['*']['/regiones/delete/:pindex'] = array('RegionesController', 'deactivate');
$route['*']['/regiones/save'] = array('RegionesController', 'save');
$route['*']['/regiones/validar'] = array('RegionesController', 'validar');

/*
*
*Zonas
*
*/
$route['*']['/zonas'] = array('ZonasController', 'index');
$route['*']['/zonas/add'] = array('ZonasController', 'add');
$route['*']['/zonas/edit/:pindex'] = array('ZonasController', 'edit');
$route['*']['/zonas/delete/:pindex'] = array('ZonasController', 'deactivate');
$route['*']['/zonas/save'] = array('ZonasController', 'save');
$route['*']['/zonas/validar'] = array('ZonasController', 'validar');

/*
*
*Barrios
*
*/
$route['*']['/barrios'] = array('BarriosController', 'index');
$route['*']['/barrios/add'] = array('BarriosController', 'add');
$route['*']['/barrios/edit/:pindex'] = array('BarriosController', 'edit');
$route['*']['/barrios/delete/:pindex'] = array('BarriosController', 'deactivate');
$route['*']['/barrios/save'] = array('BarriosController', 'save');
$route['*']['/barrios/validar'] = array('BarriosController', 'validar');
/*
*
*Usuarios
*
*/
$route['*']['/usuarios'] = array('UsuariosController', 'index');
$route['*']['/usuarios/add'] = array('UsuariosController', 'add');
$route['*']['/usuarios/edit/:pindex'] = array('UsuariosController', 'edit');
$route['*']['/usuarios/delete/:pindex'] = array('UsuariosController', 'deactivate');
$route['*']['/usuarios/save'] = array('UsuariosController', 'save');
$route['*']['/usuarios/validar'] = array('UsuariosController', 'validar');

$route['*']['/perfil'] = array('PerfilesController', 'perfil');
$route['*']['/perfil/save'] = array('PerfilesController', 'perfil_save');

/*
*
*Convenios
*
*/
$route['*']['/convenios'] = array('ConveniosController', 'index');
$route['*']['/convenios/add'] = array('ConveniosController', 'add');
$route['*']['/convenios/edit/:pindex'] = array('ConveniosController', 'edit');
$route['*']['/convenios/delete/:pindex'] = array('ConveniosController', 'deactivate');
$route['*']['/convenios/save'] = array('ConveniosController', 'save');
$route['*']['/convenios/validar'] = array('ConveniosController', 'validar');
$route['*']['/convenios/load'] = array('ConveniosController', 'load');
$route['*']['/convenios/insert_vehiculo'] = array('ConveniosController', 'insert_vehiculo');
$route['*']['/convenios/delete_vehiculo'] = array('ConveniosController', 'delete_vehiculo');

//ESCOLAR
/*
*
*Rutas Escolares
*
*/
$route['*']['/rutas_escolares'] = array('RutasEscolaresController', 'index');
$route['*']['/rutas_escolares/add'] = array('RutasEscolaresController', 'add');
$route['*']['/rutas_escolares/edit/:pindex'] = array('RutasEscolaresController', 'edit');
$route['*']['/rutas_escolares/delete/:pindex'] = array('RutasEscolaresController', 'deactivate');
$route['*']['/rutas_escolares/save'] = array('RutasEscolaresController', 'save');

/*
*
*Colegios
*
*/
$route['*']['/colegios'] = array('ColegiosController', 'index');
$route['*']['/colegios/add'] = array('ColegiosController', 'add');
$route['*']['/colegios/edit/:pindex'] = array('ColegiosController', 'edit');
$route['*']['/colegios/delete/:pindex'] = array('ColegiosController', 'deactivate');
$route['*']['/colegios/save'] = array('ColegiosController', 'save');
$route['*']['/colegios/validar'] = array('ColegiosController', 'validar');
$route['*']['/colegios/valirdar'] = array('ColegiosController', 'validar');

/*
*
*Acudientes
*
*/
$route['*']['/acudientes'] = array('AcudientesController', 'index');
$route['*']['/acudientes/add'] = array('AcudientesController', 'add');
$route['*']['/acudientes/edit/:pindex'] = array('AcudientesController', 'edit');
$route['*']['/acudientes/delete/:pindex'] = array('AcudientesController', 'deactivate');
$route['*']['/acudientes/save'] = array('AcudientesController', 'save');
$route['*']['/acudientes/validar'] = array('AcudientesController', 'validar');

/*
*
*Estudiantes
*
*/
$route['*']['/estudiantes'] = array('EstudiantesController', 'index');
$route['*']['/estudiantes/add'] = array('EstudiantesController', 'add');
$route['*']['/estudiantes/edit/:pindex'] = array('EstudiantesController', 'edit');
$route['*']['/estudiantes/delete/:pindex'] = array('EstudiantesController', 'deactivate');
$route['*']['/estudiantes/save'] = array('EstudiantesController', 'save');
$route['*']['/estudiantes/validar'] = array('EstudiantesController', 'validar');

/*
*
*Monitores
*
*/
$route['*']['/monitores'] = array('MonitoresController', 'index');
$route['*']['/monitores/add'] = array('MonitoresController', 'add');
$route['*']['/monitores/edit/:pindex'] = array('MonitoresController', 'edit');
$route['*']['/monitores/delete/:pindex'] = array('MonitoresController', 'deactivate');
$route['*']['/monitores/save'] = array('MonitoresController', 'save');
$route['*']['/monitores/validar'] = array('MonitoresController', 'validar');

/*Documentos*/
$route['*']['/documentos'] = array('DocumentosController', 'index');
$route['*']['/documentos/edit/:pindex'] = array('DocumentosController', 'edit');
$route['*']['/documentos/getAtributes'] = array('DocumentosController', 'getAtributes');
$route['*']['/documentos/setAtributes'] = array('DocumentosController', 'setAtributes');

/*Pasajeors*/


$route['*']['/pasajeros/save'] = array('PasajerosController', 'save');
$route['*']['/pasajeros/getPasajeros'] = array('PasajerosController', 'getPasajeros');
$route['*']['/pasajeros/list'] = array('PasajerosController', 'getAllPasajeros');
$route['*']['/pasajeros/insert'] = array('PasajerosController', 'insertPasajero');
$route['*']['/pasajeros/remove'] = array('PasajerosController', 'remove');


$route['*']['/checklist'] = array('ChecklistController', 'index');
$route['*']['/checklist/add'] = array('ChecklistController', 'add');
$route['*']['/checklist/semanal'] = array('ChecklistController', 'semanal');
$route['*']['/checklist/last'] = array('ChecklistController', 'lastCheck');
$route['*']['/checklist/save'] = array('ChecklistController', 'save');
$route['*']['/checklist/report/:pindex'] = array('ChecklistController', 'report');
$route['*']['/checklist/reports'] = array('ChecklistController', 'report');
$route['*']['/checklist/reportsemanal'] = array('ChecklistController', 'reportSemanal');
$route['*']['/checklist/pendientes'] = array('ChecklistController', 'pendientes');
$route['*']['/checklist/openNotify/:pindex'] = array('ChecklistController', 'openNotify');
$route['*']['/checklist/reportExcel'] = array('ChecklistController', 'downloadExcel');

