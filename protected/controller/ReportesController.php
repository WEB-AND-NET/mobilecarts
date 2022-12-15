<?php

/**
 * Description of ReportesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ReportesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function servicios(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/ServiciosCliente");
        $pdf = new ServiciosCliente();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body();
        $pdf->Output();
    }
    
     public function serviciosRealizados(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/ServiciosRealizados");
        $pdf = new ServiciosRealizados();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body();
        $pdf->Output();
    }
    
    public function reporteServiciosC(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre", "where" => "deleted=0 AND tipo != 'P'", "asc" => "nombre"));
        $this->data['content'] = 'reportes/ser_cliente.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function reporteServiciosCHtml(){
        $id = $this->params["pindex"];
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');
        
        $sql = "SELECT o.id,o.numero,o.fecha,o.num_fact,b1.nombre AS barrio_o,
                o.origen,b2.nombre AS barrio_d,
                o.valor,o.sobre_tasa,GROUP_CONCAT(',',bp.nombre) AS 'paradas',
                cc.nombre AS 'centrocosto',co.nombre AS 'contacto',v.placa AS placa 
                FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN ordenes_paradas op ON (op.id_servicio = o.id AND op.deleted = 0)
                LEFT JOIN barrios bp ON (bp.id = op.id_barrio)
                LEFT JOIN contactos co ON (co.id = o.id_contacto)
                LEFT JOIN centros_costos cc ON (cc.id = co.id_centrocosto)
                WHERE o.id_cliente = $id AND o.deleted = 0 AND o.estado = 'F' 
                AND o.fecha_inicial >= '$fi' AND o.fecha_final <= '$ff' GROUP BY o.id";
        
        $servicios = Doo::db()->query($sql)->fetchAll();   
        
        $sqlc = "SELECT co.numero,c.tipo,c.identificacion,c.nombre FROM clientes c "
                ."INNER JOIN contratos co ON (c.id = co.id_cliente) WHERE c.id = $id";
        $cliente = Doo::db()->query($sqlc)->fetch();
        
        $this->data["cliente"] = $cliente;
        $this->data["servicios"] = $servicios;
        $this->data["id_cli"] = $id;
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/ser_cliente_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function imprimirServiciosC() {
        $id = $this->params["pindex"];
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/ServiciosCliente");
        $pdf = new ServiciosCliente();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        
        $sql = "SELECT o.id,o.numero,o.fecha,o.num_fact,b1.nombre AS barrio_o,
                b2.nombre AS barrio_d,
                o.valor,o.sobre_tasa,GROUP_CONCAT(',',bp.nombre) AS 'paradas',
                cc.nombre AS 'centrocosto',co.nombre AS 'contacto',v.placa AS placa 
                FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN ordenes_paradas op ON (op.id_servicio = o.id AND op.deleted = 0)
                LEFT JOIN barrios bp ON (bp.id = op.id_barrio)
                LEFT JOIN contactos co ON (co.id = o.id_contacto)
                LEFT JOIN centros_costos cc ON (cc.id = co.id_centrocosto)
                WHERE o.id_cliente = $id AND o.deleted = 0 AND o.estado = 'F' 
                AND o.fecha_inicial >= '$fi' AND o.fecha_final <= '$ff' GROUP BY o.id";
        
        $servicios = Doo::db()->query($sql)->fetchAll();   
        
        $sqlc = "SELECT co.numero,c.tipo,c.identificacion,c.nombre FROM clientes c "
                ."INNER JOIN contratos co ON (c.id = co.id_cliente) WHERE c.id = $id";
        $cliente = Doo::db()->query($sqlc)->fetch();
        
        $pdf->body($cliente,$servicios,$fi,$ff);
        $pdf->Output("ServiciosCliente_$id.pdf", "I");
    }
    
    public function imprimirServiciosCv2() {
        $id = $this->params["pindex"];
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/ServiciosClientev2");
        $pdf = new ServiciosClientev2();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        
        $sql = "SELECT o.id,o.numero,o.fecha,o.num_fact,b1.nombre AS barrio_o,
                b2.nombre AS barrio_d,
                o.valor,o.sobre_tasa,GROUP_CONCAT(',',bp.nombre) AS 'paradas',
                cc.nombre AS 'centrocosto',co.nombre AS 'contacto',v.placa AS placa,o.observacion 
                FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN ordenes_paradas op ON (op.id_servicio = o.id AND op.deleted = 0)
                LEFT JOIN barrios bp ON (bp.id = op.id_barrio)
                LEFT JOIN contactos co ON (co.id = o.id_contacto)
                LEFT JOIN centros_costos cc ON (cc.id = co.id_centrocosto)
                WHERE o.id_cliente = $id AND o.deleted = 0 AND o.estado = 'F' 
                AND o.fecha_inicial >= '$fi' AND o.fecha_final <= '$ff' GROUP BY o.id";
        
        $servicios = Doo::db()->query($sql)->fetchAll();   
        
        $sqlc = "SELECT co.numero,c.tipo,c.identificacion,c.nombre FROM clientes c "
                ."INNER JOIN contratos co ON (c.id = co.id_cliente) WHERE c.id = $id";
        $cliente = Doo::db()->query($sqlc)->fetch();
        
        $pdf->body($cliente,$servicios,$fi,$ff);
        $pdf->Output("ServiciosCliente_$id.pdf", "I");
    }
    
    public function reporteClienteP(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['propietarios'] = Doo::db()->find("Propietarios", array("select" => "id,razon_social", "where" => "deleted=0", "asc" => "razon_social"));
        $this->data['content'] = 'reportes/clientespropietarios.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function reporteClientePHtml(){
        $id = $this->params["pindex"];
        
        $propietario = Doo::db()->query("SELECT id,identificacion,razon_social FROM propietarios WHERE deleted=0 AND id = $id")->fetch(); 

        $clientes = Doo::db()->query("SELECT id,identificacion,nombre,c_nombre,celular,email,direccion FROM clientes WHERE deleted=0 AND tipo='P' AND id_usuario = $id")->fetchAll();

        
        $this->data["propietario"] = $propietario;
        $this->data["clientes"] = $clientes;
        $this->data["id_pro"] = $id;
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/clientespropietarios_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function imprimirClienteP(){
        $id = $this->params["pindex"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/ClientesPropietarios");
        $pdf = new ClientesPropietarios();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        
        $propietario = Doo::db()->query("SELECT id,identificacion,razon_social FROM propietarios WHERE deleted=0 AND id = $id")->fetch(); 
//        var_dump($propietario);
//        exit();
        $clientes = Doo::db()->query("SELECT id,identificacion,nombre,c_nombre,celular,email,direccion FROM clientes WHERE deleted=0 AND tipo='P' AND id_usuario = $id")->fetchAll();
//        $propietario = Doo::db()->find("Propietarios", array("select" => "id,identificacion,razon_social", "where" => "deleted=0 AND id = $id"));
//        $clientes = Doo::db()->find("Clientes", array("select" => "id,nombre,celular,email,direccion", "where" => "deleted=0 AND tipo='P' AND id_usuario=$id", "asc" => "nombre"));
        
//        $sql = "SELECT tc.id,tc.id_tarifa,tt.nombreo,tt.nombred,tc.id_clase_vehiculo,cv.nombre AS clase,tc.id_cliente,tc.valor 
//                FROM tarifas_transfers_custom tc 
//                INNER JOIN tarifas_transfers tt ON (tc.id_tarifa = tt.id)
//                INNER JOIN clases_vehiculos cv ON (tc.id_clase_vehiculo = cv.id)
//                WHERE tc.id_cliente = $id ORDER BY nombreo,nombred,clase ASC";
//        
//        $tarifas = Doo::db()->query($sql)->fetchAll();   
        
        $pdf->body($propietario,$clientes);
        $pdf->Output("ClientePropietarios_$id.pdf", "I");
    }
    
    public function reporteTarifasC(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = Doo::db()->find("Clientes", array("select" => "id,nombre,tipo", "where" => "deleted=0 AND tipo != 'P'", "asc" => "nombre"));
        $this->data['content'] = 'reportes/tarifascliente.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function reporteTarifasCHtml(){
        $id = $this->params["pindex"];
        
        $sql = "SELECT tc.id,tc.id_tarifa,tt.nombreo,tt.nombred,tc.id_clase_vehiculo,cv.nombre AS clase,tc.id_cliente,tc.valor 
                FROM tarifas_transfers_custom tc 
                INNER JOIN tarifas_transfers tt ON (tc.id_tarifa = tt.id)
                INNER JOIN clases_vehiculos cv ON (tc.id_clase_vehiculo = cv.id)
                WHERE tc.id_cliente = $id ORDER BY nombreo,nombred,clase ASC";
        
        $tarifas = Doo::db()->query($sql)->fetchAll();   
        
        $sqlc = "SELECT co.numero,c.tipo,c.identificacion,c.nombre FROM clientes c "
                ."INNER JOIN contratos co ON (c.id = co.id_cliente) WHERE c.id = $id";
        $cliente = Doo::db()->query($sqlc)->fetch();
        
        $this->data["cliente"] = $cliente;
        $this->data["tarifas"] = $tarifas;
        $this->data["id_cli"] = $id;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/tarifascliente_html.php';
        $this->renderc('index', $this->data, true);
    }
  
    public function imprimirTarifasC() {
        $id = $this->params["pindex"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/TarifasCliente");
        $pdf = new TarifasCliente();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        
        $sql = "SELECT tc.id,tc.id_tarifa,tt.nombreo,tt.nombred,tc.id_clase_vehiculo,cv.nombre AS clase,tc.id_cliente,tc.valor 
                FROM tarifas_transfers_custom tc 
                INNER JOIN tarifas_transfers tt ON (tc.id_tarifa = tt.id)
                INNER JOIN clases_vehiculos cv ON (tc.id_clase_vehiculo = cv.id)
                WHERE tc.id_cliente = $id ORDER BY nombreo,nombred,clase ASC";
        
        $tarifas = Doo::db()->query($sql)->fetchAll();   
        
        $sqlc = "SELECT co.numero,c.tipo,c.identificacion,c.nombre FROM clientes c "
                ."INNER JOIN contratos co ON (c.id = co.id_cliente) WHERE c.id = $id";
        $cliente = Doo::db()->query($sqlc)->fetch();
        
        $pdf->body($cliente,$tarifas);
        $pdf->Output("TarifasCliente_$id.pdf", "I");
    }
    
    public function ReporteDocumentoV() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/documentovencer.php';
        $this->renderc('index', $this->data, true);
    }
    public function ImprimirDocumentoVHtml(){      
        $meses = $this->params["meses"];       
        $hoy = date('Y-m-d');
        $limite = strtotime ( '+'.$meses.' month' , strtotime ( $hoy ) ) ;
        $fecha = date ( 'Y-m-d' , $limite );       
        $this->data['meses'] = $meses;
        $sql = "SELECT id,placa,
                soat AS f_soat,IF (soat <= CURDATE(),'Vencido',IF (soat <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_soat,
                tecnomecanica AS f_tecnomecanica,IF (tecnomecanica <= CURDATE(),'Vencido',IF (tecnomecanica <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_tecnomecanica,
                v_contra AS f_contra,IF (v_contra <= CURDATE(),'Vencido',IF (v_contra <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_contra,
                v_extra AS f_extra,IF (v_extra <= CURDATE(),'Vencido',IF (v_extra <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_extra,
                v_tg_operacion AS f_operacion,IF (v_tg_operacion <= CURDATE(),'Vencido',IF (v_tg_operacion <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_operacion,
                v_todo AS f_todo,IF (v_todo <= CURDATE(),'Vencido',IF (v_todo <= DATE_ADD(CURDATE(),INTERVAL $meses MONTH) ,'Proximos','No Aplica'))  AS v_todo

                FROM vehiculos WHERE 
                soat < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                tecnomecanica < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_contra < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_extra < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_tg_operacion < DATE_ADD(CURDATE(),INTERVAL $meses MONTH) OR
                v_todo < DATE_ADD(CURDATE(),INTERVAL $meses MONTH)
                AND
                deleted = 0";   

        $items = Doo::db()->query($sql)->fetchAll();
        $this->data['items'] = $items;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/documentovencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    public function ImprimirDocumentoV(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencer");
        $pdf = new DocumentosVencer();
        //$date = new DateTime( $this->params["rfecha"] );
        //$fecha = $date->format('Y-m-d');    
        $meses = $this->params["meses"];
        //$fecha = date('Y-m-d');            
        $hoy = date('Y-m-d');
        $limite = strtotime ( '+'.$meses.' month' , strtotime ( $hoy ) ) ;
        $fecha = date ( 'Y-m-d' , $limite );        
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($fecha,$meses);
        $pdf->Output("Documentos por Vencer .pdf", "I");
        
    }
    
    public function ReporteSoatV(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/soatvencer.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirSoatVHtml(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');                
        
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $query = "SELECT id,placa,date_format(soat,'%m/%d/%Y') AS soat FROM vehiculos "
                . "WHERE (soat >= '$fi' AND soat <= '$ff' ) AND deleted = 0 ORDER BY soat";
      
        $this->data["vehiculos"] = Doo::db()->query($query)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/soatvencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirSoatV(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');   
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencerCustom");
        $pdf = new DocumentosVencerCustom();
        
        $data = array();
        $data["title"] = "SOAT";
        $data["rango"] = $fi." - ".$ff;
        $data["title_document"] = "SOAT(Mes/Día/Año)";
        $data["query"] = "SELECT id,placa,date_format(soat,'%m/%d/%Y') AS soat FROM vehiculos "
                . "WHERE (soat >= '$fi' AND soat <= '$ff' ) AND deleted = 0 ORDER BY soat";
        $data["document"] = "soat";
       
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($data);
        $pdf->Output($data["title"]." por Vencer .pdf", "I");
    }
    
    public function ReporteTecnoV(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/tecnovencer.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirTecnoVHtml(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');                
        
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $query = "SELECT id,placa,date_format(tecnomecanica,'%m/%d/%Y') AS tecnomecanica FROM vehiculos "
                . "WHERE (tecnomecanica >= '$fi' AND tecnomecanica <= '$ff' ) AND deleted = 0 ORDER BY tecnomecanica";
      
        $this->data["vehiculos"] = Doo::db()->query($query)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/tecnovencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirTecnoV(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');   
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencerCustom");
        $pdf = new DocumentosVencerCustom();
        
        $data = array();
        $data["title"] = "Tecnomecanica";
        $data["rango"] = $fi." - ".$ff;
        $data["title_document"] = "Tecnomecanica(Mes/Día/Año)";
        $data["query"] = "SELECT id,placa,date_format(tecnomecanica,'%m/%d/%Y') AS tecnomecanica FROM vehiculos "
                . "WHERE (tecnomecanica >= '$fi' AND tecnomecanica <= '$ff' ) AND deleted = 0 ORDER BY tecnomecanica";
        $data["document"] = "tecnomecanica";
       
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($data);
        $pdf->Output($data["title"]." por Vencer .pdf", "I");
    }
    
    public function ReporteContraV(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/contravencer.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirContraVHtml(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');                
        
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $query = "SELECT id,placa,date_format(v_contra,'%m/%d/%Y') AS v_contra FROM vehiculos "
                . "WHERE (v_contra >= '$fi' AND v_contra <= '$ff' ) AND deleted = 0 ORDER BY v_contra";
      
        $this->data["vehiculos"] = Doo::db()->query($query)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/contravencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirContraV(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');   
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencerCustom");
        $pdf = new DocumentosVencerCustom();
        
        $data = array();
        $data["title"] = "Contractual";
        $data["rango"] = $fi." - ".$ff;
        $data["title_document"] = "Contractual(Mes/Día/Año)";
        $data["query"] = "SELECT id,placa,date_format(v_contra,'%m/%d/%Y') AS v_contra FROM vehiculos "
                . "WHERE (v_contra >= '$fi' AND v_contra <= '$ff' ) AND deleted = 0 ORDER BY v_contra";
        $data["document"] = "v_contra";
       
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($data);
        $pdf->Output($data["title"]." por Vencer .pdf", "I"); 
    }
    
    public function ReporteExtraV(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/extravencer.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirExtraVHtml(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');                
        
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $query = "SELECT id,placa,date_format(v_extra,'%m/%d/%Y') AS v_extra FROM vehiculos "
                . "WHERE (v_extra >= '$fi' AND v_extra <= '$ff' ) AND deleted = 0 ORDER BY v_extra";
      
        $this->data["vehiculos"] = Doo::db()->query($query)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/extravencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirExtraV(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');   
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencerCustom");
        $pdf = new DocumentosVencerCustom();
        
        $data = array();
        $data["title"] = "Extractual";
        $data["rango"] = $fi." - ".$ff;
        $data["title_document"] = "Extractual(Mes/Día/Año)";
        $data["query"] = "SELECT id,placa,date_format(v_extra,'%m/%d/%Y') AS v_extra FROM vehiculos "
                . "WHERE (v_extra >= '$fi' AND v_extra <= '$ff' ) AND deleted = 0 ORDER BY v_extra";
        $data["document"] = "v_extra";
       
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($data);
        $pdf->Output($data["title"]." por Vencer .pdf", "I"); 
    }
    
    public function ReporteOperV(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/operacionvencer.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirOperVHtml(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');                
        
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $query = "SELECT id,placa,date_format(v_tg_operacion,'%m/%d/%Y') AS v_tg_operacion FROM vehiculos "
                . "WHERE (v_tg_operacion >= '$fi' AND v_tg_operacion <= '$ff' ) AND deleted = 0 ORDER BY v_tg_operacion";
      
        $this->data["vehiculos"] = Doo::db()->query($query)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/operacionvencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirOperV(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');   
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencerCustom");
        $pdf = new DocumentosVencerCustom();
        
        $data = array();
        $data["title"] = "Tarjeta operación";
        $data["rango"] = $fi." - ".$ff;
        $data["title_document"] = "Tarjeta operación(Mes/Día/Año)";
        $data["query"] = "SELECT id,placa,date_format(v_tg_operacion,'%m/%d/%Y') AS v_tg_operacion FROM vehiculos "
                . "WHERE (v_tg_operacion >= '$fi' AND v_tg_operacion <= '$ff' ) AND deleted = 0 ORDER BY v_tg_operacion";
        $data["document"] = "v_tg_operacion";
       
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($data);
        $pdf->Output($data["title"]." por Vencer .pdf", "I"); 
    }
    
     public function ReporteTodoV(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/todovencer.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirTodoVHtml(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');                
        
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $query = "SELECT id,placa,date_format(v_todo,'%m/%d/%Y') AS v_todo FROM vehiculos "
                . "WHERE (v_todo >= '$fi' AND v_todo <= '$ff' ) AND deleted = 0 ORDER BY v_todo";
      
        $this->data["vehiculos"] = Doo::db()->query($query)->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/vencimientos/todovencer_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function ImprimirTodoV(){
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');   
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/DocumentosVencerCustom");
        $pdf = new DocumentosVencerCustom();
        
        $data = array();
        $data["title"] = "Todo Riesgo";
        $data["rango"] = $fi." - ".$ff;
        $data["title_document"] = "Todo Riesgo(Mes/Día/Año)";
        $data["query"] = "SELECT id,placa,date_format(v_todo,'%m/%d/%Y') AS v_todo FROM vehiculos "
                . "WHERE (v_todo >= '$fi' AND v_todo <= '$ff' ) AND deleted = 0 ORDER BY v_todo";
        $data["document"] = "v_todo";
       
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->body($data);
        $pdf->Output($data["title"]." por Vencer .pdf", "I"); 
    }
    
    public function reporteIngresosVeh(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['vehiculos'] = Doo::db()->find("Vehiculos", array("select" => "id,placa", "where" => "deleted=0", "asc" => "placa"));
        $this->data['content'] = 'reportes/ing_vehiculo.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function reporteIngresosVehHtml() {
        $id = $this->params["pindex"];
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');
        
        $sql2 = "SELECT o.id,o.numero,o.fecha,o.num_fact,b1.nombre AS barrio_o,
                b2.nombre AS barrio_d,
                o.valor,o.sobre_tasa,GROUP_CONCAT(',',bp.nombre) AS 'paradas',
                c.nombre AS 'cliente',cc.nombre AS 'centrocosto',co.nombre AS 'contacto'
                FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN ordenes_paradas op ON (op.id_servicio = o.id AND op.deleted = 0)
                LEFT JOIN barrios bp ON (bp.id = op.id_barrio)
                LEFT JOIN contactos co ON (co.id = o.id_contacto)
                LEFT JOIN centros_costos cc ON (cc.id = co.id_centrocosto)
                WHERE o.id_vehiculo = $id AND o.deleted = 0 AND o.estado = 'F' 
                AND o.fecha_inicial >= '$fi' AND o.fecha_final <= '$ff' GROUP BY o.id";
        //exit($sql2);
        $servicios = Doo::db()->query($sql2)->fetchAll();
        
        $sqlc = "SELECT placa,modelo,marca,num_interno,p.razon_social AS propietario FROM vehiculos v INNER JOIN propietarios p ON v.id_propietario = p.id WHERE v.id = $id";
        $vehiculo = Doo::db()->query($sqlc)->fetch();
        
        //$data = array();
        $this->data["vehiculo"] = $vehiculo;
        $this->data["servicios"] = $servicios;
        $this->data["id_veh"] = $id;
        $this->data["fi"] = $fi;
        $this->data["ff"] = $ff;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'reportes/ing_vehiculo_html.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function imprimirIngresosVeh() {
        $id = $this->params["pindex"];
        $fi = (new DateTime($this->params["fi"]))->format('Y-m-d');
        $ff = (new DateTime($this->params["ff"]))->format('Y-m-d');
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/IngresosVehiculo");
        $pdf = new IngresosVehiculo();
        $pdf->AddPage();
        $pdf->AliasNbPages();              
        
        $sql2 = "SELECT o.id,o.numero,o.fecha,o.num_fact,b1.nombre AS barrio_o,
                b2.nombre AS barrio_d,
                o.valor,o.sobre_tasa,GROUP_CONCAT(',',bp.nombre) AS 'paradas',
                c.nombre AS 'cliente',cc.nombre AS 'centrocosto',co.nombre AS 'contacto'
                FROM ordenes_servicios o
                INNER JOIN clientes c ON (o.id_cliente=c.id)
                LEFT JOIN vehiculos v ON (o.id_vehiculo=v.id)
                LEFT JOIN barrios b1 ON (b1.id=o.barrio_o)
                LEFT JOIN barrios b2 ON (b2.id=o.barrio_d)
                LEFT JOIN ordenes_paradas op ON (op.id_servicio = o.id AND op.deleted = 0)
                LEFT JOIN barrios bp ON (bp.id = op.id_barrio)
                LEFT JOIN contactos co ON (co.id = o.id_contacto)
                LEFT JOIN centros_costos cc ON (cc.id = co.id_centrocosto)
                WHERE o.id_vehiculo = $id AND o.deleted = 0 AND o.estado = 'F' 
                AND o.fecha_inicial >= '$fi' AND o.fecha_final <= '$ff' GROUP BY o.id";
        
        $servicios = Doo::db()->query($sql2)->fetchAll();
        
        $sqlc = "SELECT placa,modelo,marca,num_interno,p.razon_social AS propietario FROM vehiculos v INNER JOIN propietarios p ON v.id_propietario = p.id WHERE v.id = $id";
        $vehiculo = Doo::db()->query($sqlc)->fetch();
        
        $data = array();
        $data["vehiculo"] = $vehiculo;
        $data["servicios"] = $servicios;
        $data["fi"] = $fi;
        $data["ff"] = $ff;
        
        $pdf->body($data);
        $pdf->Output("ServiciosCliente_$id.pdf", "I");
    }

}