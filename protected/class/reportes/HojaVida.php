..<?php



/**

 * Description of OrdenServicio

 *

 * @author Maykel Rhenals

 */



class HojaVida extends FPDF

{

// Cabecera de página

function Header()

{

    // Ancho de linea

    $this->SetLineWidth(.4);



    // Arial bold 15

    $this->SetFont('Arial','B',11);

    // Título

    $this->Cell(129,13,'HOJA DE VIDA DE VEHICULOS','LTR',1,'C');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(129,3,'AGUAS & AGUAS & CIA LTDA','LR',1,'C');

    

    $this->SetFont('Arial','',8);

    $this->Cell(129,5,'NIT 830.090.037-8','LRB',1,'C');

    // Logo

    $this->Image('global/img/logo.jpeg',154,11,28);

    $x = $this->GetX();

    $y = $this->GetY();

    $this->Rect($x+129,10,61,21);



    // Salto de línea

    $this->Ln(5);

}





function Body($inf, $docs, $mant)

{

    $this->SetLineWidth(.4);



    //--------------------------------Informacion general--------------------------------------

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'INFORMACIÓN GENERAL', 1, 1,'C',true);

    $ancho = $this->w-20;

    $c4 = $ancho/8;

    $c3 = $ancho/6;

    $c2 = $ancho/4;

    $c1 = $ancho/2;



    //fila 1

    $this->Cell($c4, 5,'PLACA', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['placa'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c4, 5,'No. INTERNO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['num_interno'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c4-7, 5,'CLASE', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4+7, 5,$inf['clase'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c4, 5,'MODELO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['modelo'], 'RB', 1,'L');



    //fila2

    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'MARCA', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['marca'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'LÍNEA', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['linea'], 'RB', 1,'L');



    //fila3

    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'LICENCIA DE TRÁNSITO', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['numLicTran'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'SERVICIO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['servicio'], 'RB', 1,'L');



    //fila 4

    $this->SetFont('Arial','B',8);

    $this->Cell($c4, 5,'CAPACIDAD', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['capacidad'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c4, 5,'CILINDRAJE', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['cilindraje'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c4, 5,'POTENCIA', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['potencia'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c4, 5,'PUERTAS', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c4, 5,$inf['puertas'], 'RB', 1,'L');



    //fila5

    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'NÚMERO DE MOTOR', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['motor'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'VIN', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['vin'], 'RB', 1,'L');



    //fila6

    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'NÚMERO DE SERIE', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['numSerie'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'NÚMERO DE CHASIS', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['chasis'], 'RB', 1,'L');



    //fila7

    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'COLOR', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['color'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c2, 5,'CARROCERÍA', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c2, 5,$inf['tipoCarroceria'], 'RB', 1,'L');



    //fila8

    $this->SetFont('Arial','B',8);

    $this->Cell($c3, 5,'COMBUSTIBLE', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c3, 5,$inf['combustible'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c3, 5,'F. MATRÍCULA', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c3, 5,$inf['fechaMatricula'], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell($c3, 5,'F. LICENCIA', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell($c3, 5,$inf['fechaExpeLic'], 'RB', 1,'L');



     //fila9

     $this->SetFont('Arial','B',8);

     $this->Cell($c1-15, 5,'PROPIETARIO', 'LB', 0,'L');

     $this->SetFont('Arial','',8);

     $this->Cell($c1+15, 5,$inf['propietario'], 'RB', 0,'L');



    $this->Ln(10);



    //---------------------------------------DOCUMENTOS-----------------------------------------

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'DOCUMENTOS', 1, 1,'C',true);

    $ancho = $this->w-20;

    $c5 = $ancho/5;



    //subcabecera

    $this->SetFillColor(224, 224, 224);

    $this->Cell($c5+25, 5,'DOCUMENTO', 'LB', 0,'L',true);



    $this->Cell($c5-8, 5,'F. NÚMERO', 'B', 0,'L',true);



    $this->Cell($c5+11, 5,'F. ENTIDAD EMISORA', 'B', 0,'L',true);



    $this->Cell($c5-15, 5,'F. EMISIÓN', 'B', 0,'L',true);



    $this->Cell($c5-13, 5,'F. VENCIMIENTO', 'RB', 1,'L',true);



    //fila 1

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Licencia de Tránsito', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("LICENCIA TRANSITO",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_lt",$soat[0]))
                $p1 = $soat[0]->numero_lt;
    
            if(array_key_exists("enti_emisora_lt",$soat[0]))
                $p2 = $soat[0]->enti_emisora_lt;
        }

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    



    //fila2

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Tarjeta de Operación', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("TARJETA DE OPERACION",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("tarjeta_operacion",$soat[0]))
                $p1 = $soat[0]->tarjeta_operacion;
            
            if(array_key_exists("enti_emisora_to",$soat[0]))
                $p2 = $soat[0]->enti_emisora_to;
                
        }

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila3

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'SOAT', 'LB', 0,'L');

    

    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("SOAT",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_soat",$soat[0]))
                $p1 = $soat[0]->numero_soat;
            
            if(array_key_exists("enti_emisora_soat",$soat[0]))
                $p2 = $soat[0]->enti_emisora_soat;
        }

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    }    



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila 4

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Revisión Técnico Mecánica', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("TECNOMECANICA",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("TECNOMECANICA",$soat[0]))
                $p1 = $soat[0]->TECNOMECANICA;
            
            if(array_key_exists("enti_emisora_tec",$soat[0]))
                $p2 = $soat[0]->enti_emisora_tec;
        }
        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    }  



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila5

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Póliza de Responsabilidad Civil Contractual', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("POLIZAS CONTRACTUAL",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_pc",$soat[0]))
                $p1 = $soat[0]->numero_pc;
    
            if(array_key_exists("enti_emisora_pc",$soat[0]))
                $p2 = $soat[0]->enti_emisora_pc;
        }
        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila6

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Póliza de Responsabilidad Civil Extracontractual', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("POLIZA EXTRACONTRACTUAL",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_pe",$soat[0]))
                $p1 = $soat[0]->numero_pe;
    
            if(array_key_exists("enti_emisora_pe",$soat[0]))
                $p2 = $soat[0]->enti_emisora_pe;
        }
        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila7

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Póliza Todo Riesgo', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("POLIZA TODO RIESGO",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_ptr",$soat[0]))
                $p1 = $soat[0]->numero_ptr;
    
            if(array_key_exists("enti_emisora_ptr",$soat[0]))
                $p2 = $soat[0]->enti_emisora_ptr;
        }

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila8

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Revisión Preventiva', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("Revision Preventiva",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_rp",$soat[0]))
                $p1 = $soat[0]->numero_rp;
    
            if(array_key_exists("enti_emisora_rp",$soat[0]))
                $p2 = $soat[0]->enti_emisora_rp;
        }

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila9

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'CONTRATO DE VINCULACIÓN DE FLOTA', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("CONTRATO VINCULACION FLOTA",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_cv",$soat[0]))
                $p1 = $soat[0]->numero_cv;
    
            if(array_key_exists("enti_emisora_cv",$soat[0]))
                $p2 = $soat[0]->enti_emisora_cv;
        }

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila10

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'PAGARE', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("PAGARE",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_p",$soat[0]))
                $p1 = $soat[0]->numero_p;
    
            if(array_key_exists("enti_emisora_p",$soat[0]))
                $p2 = $soat[0]->enti_emisora_p;
        }
        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');



    //fila11

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'CONVENIO DE COLABORACIÓN', 'LB', 0,'L');



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("CONVENIO COLABORACION",array_column($docs, 'doc'));

    if($pos > -1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("numero_cc",$soat[0]))
                $p1 = $soat[0]->numero_cc;
    
            if(array_key_exists("enti_emisora_cc",$soat[0]))
                $p2 = $soat[0]->enti_emisora_cc;
        }
        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5, $p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');





    $this->Ln(5);





    //------------------------------ÚLTIMOS MANTENIMIENTOS--------------------------------

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'ÚLTIMOS MANTENIMIENTOS', 1, 1,'C',true);

    $ancho = $this->w-20;

    $c5 = $ancho/4;



    //subcabecera

    $this->SetFillColor(224, 224, 224);

    $this->Cell($c5-20, 5,'FECHA', 'LB', 0,'L',true);



    $this->Cell($c5-25, 5,'TIPO', 'B', 0,'L',true);



    $this->Cell($c5-10, 5,'KILOMETRAJE', 'B', 0,'L',true);



    $this->Cell($c5+55, 5,'DESCRIPCIÓN', 'RB', 1,'C',true);



    $numLin =10;



    foreach ($mant AS $m)

    {

        $this->Cell($c5-20, 5,$m["fecha"], 'LB', 0,'L');



        $this->Cell($c5-25, 5,$m["tipo"], 'B', 0,'L');



        $this->Cell($c5-10, 5,$m["km"], 'B', 0,'L');



        $this->Cell($c5+55, 5,$m["descripcion"], 'RB', 1,'C');

        $numLin--;

                

    }



    for($i=0; $i <$numLin; $i++)

    {

        $this->Cell($c5-20, 5,'', 'LB', 0,'L');



        $this->Cell($c5-25, 5,'', 'B', 0,'L');



        $this->Cell($c5-10, 5,'', 'B', 0,'L');



        $this->Cell($c5+55, 5,'', 'RB', 1,'C');

    }



    $this->LN(5);



    //-------------------------------------FOTOS------------------------------------

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'FOTO', 1, 1,'C',true);

    $x = $this->GetX();

    $y = $this->GetY();

    $this->Rect($x,$y,$ancho,50);

    $i= $x +10;

    foreach ($docs AS $doc)

    {

        if(strpos($doc["doc"], 'Foto') !== false && !$this->endsWith(strtoupper($doc['archivo']), ".PDF") )

        {

            $this->Image('documentacion/'.$doc["dir"].'/'.$doc["archivo"],$i,$y+5,40);

            $i += 59;

        }

        

    }

    

    //------------------------------ANEXOS-------------------------------

    $i=1;

    foreach ($docs AS $doc)

    {

        if(strlen($doc["atributos"]) > 5  && $doc["archivo"] !== ""&& ($this->endsWith(strtoupper($doc['archivo']), ".JPG") || $this->endsWith(strtoupper($doc['archivo']), ".PNG") || $this->endsWith(strtoupper($doc['archivo']), ".BMP") || $this->endsWith(strtoupper($doc['archivo']), ".JPEG")   )  )

        {

            $this->AddPage();



            $this->Cell(0, 5,'ANEXO '.$i, 1, 1,'C',true);

            $x = $this->GetX();

            $y = $this->GetY();

            $this->Rect($x,$y,$ancho,$this->h-54);

            $this->LN(2);

            $this->Cell(0, 5,$doc["doc"], 0, 1,'C');

            $this->LN(5);

            $this->Image('documentacion/'.$doc["dir"].'/'.$doc["archivo"],$x+10,$y+10,150);

            $i += 1;

        }        

        

    }



}

function endsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}




// Pie de página

function Footer()

{

    // Posición: a 1,5 cm del final

    $this->SetY(-15);

    // Arial italic 5

    $this->SetFont('Arial','I',5);

    // Número de página

    $dt = date('Y-m-d H:i:s');

    $this->Cell(0,10,'Fecha creacion: '.$dt,0,0,'L');

    // Arial italic 8

    $this->SetFont('Arial','I',8);

    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');

}



}



?>