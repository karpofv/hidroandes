<?php
    $codigo = $_GET[cd];
    if ($mes==0){ $mes=1; $agno=$agno-1; }
    $fecha=$agno."-".$mes; 
    require_once('../includes/fpdf/fpdf.php');
    class PDF extends FPDF {
        function Header() {
         }
         function Footer() {
          /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona Inferior del Documento ***/
          }
     }
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
setlocale(LC_TIME, "es_VE.utf8"); 
$fechac=strftime("%A %d de %B de %Y a las %T");
$pdf->SetFont('Arial','B',10);
$pdf->Image('../assets/images/logo.jpg' , 10 ,10,30 , 30,'JPG', '');
$pdf->SetXY(10, 10);
$consulorden = paraTodos::arrayConsulta("*", "orden", "ord_codigo=$codigo");
foreach($consulorden as $orden){
    $fecha = $orden[ord_fecha];
    $total = $orden[ord_total];
}
$pdf->Cell(190,7,"C.A. HIDROLOGICA DE LA CORDILLERA ANDINA",0,1,'C');
$pdf->Cell(190,7,"HIDROANDES C.A.",0,1,'C');
$pdf->Cell(190,7,"ORDEN DE COMPRA",0,1,'C');
$pdf->Cell(190,7,"FECHA: ".paraTodos::convertDate($fecha),0,1,'R');
$pdf->Ln();
$pdf->Cell(16,7,"Cantidad",1,0,'C');
$pdf->Cell(16,7,"Unidad",1,0,'C');
$pdf->Cell(70,7,utf8_decode("Descripción"),1,0,'C');
$pdf->Cell(30,7,"Precio unitario",1,0,'C');
$pdf->Cell(30,7,"Subtotal",1,0,'C');
$pdf->Cell(30,7,utf8_decode("Nº de requisicion"),1,1,'C');
$pdf->SetFont('Arial','',10);
$consulrequi = paraTodos::arrayConsulta("*", "requisicion r, producto", "prod_codigo=r.req_procodigo and req_ordcodigo=$codigo");
foreach($consulrequi as $requi){
    $pdf->Cell(16,7,number_format($requi[req_cantidad],2,",","."),1,0,'C');
    $pdf->Cell(16,7,$requi[pro_medida],1,0,'C');
    $pdf->Cell(70,7,utf8_decode($requi[prod_descripcion]),1,0,'C');
    $pdf->Cell(30,7,number_format($requi[req_precio],2,",","."),1,0,'C');
    $pdf->Cell(30,7,number_format($requi[req_monto],2,",","."),1,0,'C');
    $pdf->Cell(30,7,utf8_decode($requi[req_codigo]),1,1,'C');
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(162,7,"TOTAL:".number_format($total,2,",","."),1,1,'R');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(45,4,"Compras",0,0,'L');
$pdf->Cell(45,4,utf8_decode("Administración"),0,0,'L');
$pdf->Cell(45,4,"Presupuesto",0,0,'L');
$pdf->Cell(45,4,utf8_decode("Contraloría"),0,1,'L');
$pdf->Cell(45,4,"Firma",0,0,'L');
$pdf->Cell(45,4,utf8_decode("Firma"),0,0,'L');
$pdf->Cell(45,4,"Firma",0,0,'L');
$pdf->Cell(45,4,utf8_decode("Firma"),0,1,'L');
$pdf->Ln(6);
$pdf->Cell(45,4,"__________________________",0,0,'L');
$pdf->Cell(45,4,utf8_decode("__________________________"),0,0,'L');
$pdf->Cell(45,4,"__________________________",0,0,'L');
$pdf->Cell(45,4,utf8_decode("__________________________"),0,1,'L');
$pdf->SetFont('Arial','B',6);
$pdf->Cell(45,4,"Nombre y Apellidos",0,0,'C');
$pdf->Cell(45,4,utf8_decode("Nombre y Apellidos"),0,0,'C');
$pdf->Cell(45,4,"Nombre y Apellidos",0,0,'C');
$pdf->Cell(45,4,utf8_decode("Nombre y Apellidos"),0,1,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(45,4,"__________________________",0,0,'L');
$pdf->Cell(45,4,utf8_decode("__________________________"),0,0,'L');
$pdf->Cell(45,4,"__________________________",0,0,'L');
$pdf->Cell(45,4,utf8_decode("__________________________"),0,1,'L');
$pdf->Output();
?>