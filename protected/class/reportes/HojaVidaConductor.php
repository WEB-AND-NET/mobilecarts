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

    $this->Cell(129,13,'HOJA DE VIDA DE CONDUCTOR','LTR',1,'C');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(129,3,'AGUAS & AGUAS & CIA LTDA','LR',1,'C');

    

    $this->SetFont('Arial','',8);

    $this->Cell(129,5,'NIT 901.416.965-7','LRB',1,'C');

    // Logo

    $this->Image('global/img/logo.jpeg',154,11,28);

    $x = $this->GetX();

    $y = $this->GetY();

    $this->Rect($x+129,10,61,21);



    // Salto de línea

    $this->Ln(5);

}





function Body($cond, $segs, $docs)

{

    $this->SetLineWidth(.4);



    //--------------------------------Informacion general--------------------------------------

    

    //$this->Image('global/img/logo.jpeg',150,50,43);

    $this->SetFillColor(232, 230, 230);

    $x = $this->GetX();

    $y = $this->GetY();

    $this->Rect($x+160,40,30,41,"DF");

    

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'INFORMACIÓN GENERAL', 1, 1,'C',true);

    

    $this->Cell(20, 5,'NOMBRES', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(75, 5,$cond["nombre"], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'TIPO DOC.', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(45, 5,($cond["tipo_identificacion"] == 'CC' ? 'Cédula' : ($cond["tipo_identificacion"] == 'CE' ? 'Cédula de Extranjería' : ($cond["tipo_identificacion"] == 'PA' ? 'Pasaporte' :  'Ninguno'))), 'RB', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'APELLIDOS', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(75, 5,$cond["apellidos"], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'DOCUMENTO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(45, 5,$cond["identificacion"], 'RB', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(25, 5,'ESTADO CIVIL', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(70, 5,($cond["estadocv"] == 'CA' ? 'Casado' : ($cond["estadocv"] == 'SO' ? 'Soltero' : ($cond["estadocv"] == 'DI' ? 'Divorciado' : ($cond["estadocv"] == 'UL' ? 'Unión Libre' : ($cond["estadocv"] == 'SE' ? 'Separado' :  'Ninguno'))))), 'RB', 0,'L');

    

    

    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'GÉNERO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(45, 5,($cond["genero"] == 'MA' ? 'Masculino' : ($cond["genero"] == 'FE' ? 'Femenino' :  'No Binario')), 'RB', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(30, 5,'FEC. NACIMIENTO', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(65, 5,$cond["fecha_nac"], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(30, 5,'GRUPO SANGUÍNEO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(35, 5,$cond["grupo_san"], 'RB', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(30, 5,'LIBRETA MILITAR', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(65, 5,$cond["libreta_mil"], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'CLASE', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(20, 5,($cond["clase"] == 'PR' ? 'Primera': ($cond["clase"] == 'SE' ? 'Segunda' : 'No tiene')), 'B', 0,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(10, 5,'DM', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(15, 5,$cond["dm"], 'BR', 1,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(30, 5,'LICENCIA COND.', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(23, 5,$cond["n_licencia"], 'B', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'CATEGORÍA', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(22, 5,$cond["cat_licencia"], 'B', 0,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(25, 5,'VENCIMIENTO', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(40, 5,$cond["vigencia"], 'BR', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'TELÉFONO', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(33, 5,$cond["telefono"], 'B', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(20, 5,'CELULAR', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(22, 5,$cond["celular"], 'B', 0,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(15, 5,'EMAIL', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(50, 5,$cond["email"], 'BR', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(30, 5,'TIPO CONTRATO', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(65, 5,($cond["tipo"] == 'F' ? 'Fijo' : ($cond["tipo"] == 'A' ? 'Afiliado' : ($cond["tipo"] == 'C' ? 'Convenio' : 'otro'))), 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(30, 5,'NIVEL EDUCATIVO', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(35, 5,($cond["niveled"] == 'PR' ? 'Primaria Elemental' : ($cond["niveled"] == 'BA' ? 'Bachiller' : ($cond["niveled"] == 'TC' ? 'Técnico' : ($cond["niveled"] == 'TN' ? 'Tecnólogo' : ($cond["niveled"] == "PF" ? 'Profesional' : ($cond["niveled"] == 'PT' ? 'Postgrado' : 'No Binario')))))), 'RB', 1,'L');

    

    $this->SetFont('Arial','B',8);

    $this->Cell(50, 5,'DIRECCIÓN DE RESIDENCIA', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(140, 5,$cond["direccion"], 'RB', 1,'L');

    



    $this->Ln(10);



    //---------------------------------------SEGURIDAD SOCIAL-----------------------------------------

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'SEGURIDAD SOCIAL', 1, 1,'C',true);



    $this->Cell(10, 5,'EPS', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(85, 5,$cond["eps"], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(10, 5,'ARL', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(85, 5,$cond["arl"], 'RB', 1,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(40, 5,'FONDO DE PENSIONES', 'LB', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(55, 5,$cond["fondope"], 'RB', 0,'L');



    $this->SetFont('Arial','B',8);

    $this->Cell(40, 5,'FONDO DE CESANTÍAS', 'B', 0,'L');

    $this->SetFont('Arial','',8);

    $this->Cell(55, 5,$cond["fondoce"], 'RB', 1,'L');



     $this->SetFont('Arial','B',8);

     $this->Cell(45, 5,'CAJA DE COMPENSACIÓN', 'LB', 0,'L');

     $this->SetFont('Arial','',8);

     $this->Cell(145, 5,$cond["cajacom"], 'RB', 0,'L');



    $this->Ln(10);





    //------------------------------DOCUMENTOS--------------------------------

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $this->Cell(0, 5,'DOCUMENTOS', 1, 1,'C',true);



    //subcabecera

    $this->SetFillColor(224, 224, 224);

    $this->Cell(40, 5,'DOCUMENTO', 'LB', 0,'C',true);



    $this->Cell(50, 5,'NÚMERO', 'B', 0,'C',true);



    $this->Cell(40, 5,'ENTIDAD EMISORA', 'B', 0,'C',true);



    $this->Cell(30, 5,'F. EMISIÓN', 'B', 0,'R',true);

    

    $this->Cell(30, 5,'F. VENCIMIENTO', 'RB', 1,'R',true);



    $numLin =10;

    

    $ancho = $this->w-20;

    $c5 = $ancho/5;



    //fila 1

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'AUDIOMETRÍA', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("AUDIOMETRÍA",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    

    //fila 2

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'VISIOMETRIA', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("VISIOMETRIA",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    



    //fila 3

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'COORDINACIÓN MOTRIZ', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("COORDINACIÓN MOTRIZ",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    

    

    //fila 4

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'FIEBRE AMARILLA Y TÉTANO (CARNE DE VACUNA)', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("FIEBRE AMARILLA Y TÉTANO (CARNE DE VACUNA)",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    

    

    //fila 5

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'EPS', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("EPS",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    

    

    //fila 6

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'MECANICA BASICA', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("MECANICA BASICA",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    

    

    //fila 7

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'MANEJO DEFENSIVO', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("MANEJO DEFENSIVO",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    



    //fila 8

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'PRIMEROS AUXILIO', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("PRIMEROS AUXILIO",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');

    

    

    

    //fila 9

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'HOJA DE VIDA', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("HOJA DE VIDA",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');    





    //fila 10

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'PAGO DE RODAMIENTOS', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("PAGO DE RODAMIENTOS",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');  

    

    

    //fila 11

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'PRUEBA PSICOSENSOMETRICA', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("PRUEBA PSICOSENSOMETRICA",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        $p1 = "";

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');    





    //fila 12

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'Cédula de Ciudadanía', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("Cédula de Ciudadanía",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

       if(is_array($soat)){
            if(array_key_exists("Numero_cedula",$soat[0]))
                $p1 = $soat[0]->Numero_cedula;
                
        }

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');    





    //fila 13

    $this->SetFont('Arial','B',7);

    $this->Cell($c5+25, 5,'LICENCIA DE CONDUCCIÓN', 'LB', 0,'L');

    



    $p1="";

    $p2="";

    $p3="";

    $p4="";



    $pos = array_search("LICENCIA DE CONDUCCIÓN",array_column($docs, 'doc'));

    if($pos>-1)

    {

        $soat = json_decode($docs[$pos]["atributos"]);

        if(is_array($soat)){
            if(array_key_exists("Numero_licencia",$soat[0]))
                $p1 = $soat[0]->Numero_licencia;
                
        }

        $p2 = "";

        $p3 = $docs[$pos]["fecha_expedicion"];

        $p4 = $docs[$pos]["fecha_vencimiento"];

    } 



    $this->SetFont('Arial','',7);

    $this->Cell($c5-8, 5,$p1, 'B', 0,'L');



    $this->Cell($c5+11, 5,$p2, 'B', 0,'L');

    

    $this->Cell($c5-15, 5,$p3, 'B', 0,'L');



    $this->Cell($c5-13, 5,$p4, 'RB', 1,'L');  

    

    



    



    //------------------------------ANEXOS-------------------------------

    $this->SetFillColor(191,191,191);

    $this->SetFont('Arial','B',8);

    $i=1;

    foreach ($docs AS $doc)

    {

        if($doc["archivo"] !== "" && ($this->endsWith(strtoupper($doc['archivo']), ".JPG") || $this->endsWith(strtoupper($doc['archivo']), ".PNG") || $this->endsWith(strtoupper($doc['archivo']), ".BMP") || $this->endsWith(strtoupper($doc['archivo']), ".JPEG")   ))

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