<?php

ob_start();
require('fpdf.php');

class PDF extends FPDF{

    function Header(){

        $this->Image('logo.jpg',10,8,33);
        $this->SetFont('Arial','B',24);
        $this->Cell(100);
        $this->Cell(1,30,'Reporte de Sedes',0,0,'C');
        $this->Ln(35);
        $this->EncabezadoTabla();
        
    }

    function EncabezadoTabla(){

        $this->SetFont('Arial','B',12);
        $this->SetFillColor(76, 76, 76);
        $this->SetTextColor(255,255,255);
        $this->Cell(8, 8, "#", 1, 0, 'C', 1);
        $this->Cell(70, 8, utf8_decode("Dirección"), 1, 0, 'C', 1);
        $this->Cell(30, 8, utf8_decode("Distrito"), 1, 0, 'C', 1);
        $this->Cell(30, 8, utf8_decode("Ciudad"), 1, 0, 'C', 1);
        $this->Cell(50, 8, utf8_decode("Nombre"), 1, 1, 'C', 1);

    }

    function Footer(){

        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

require '../../includes/conexiones.php';
$miconex= miConexionBD();

$consulta = "SELECT * FROM sedes";

$resultado = mysqli_query($miconex, $consulta);
$n = 0;

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$numrows = mysqli_num_rows($resultado);

if($numrows != 0){
    while($fila = mysqli_fetch_assoc($resultado)){
    
        if($n%2 == 0){
            $pdf->SetFillColor(255, 255, 255);
        }else{
            $pdf->SetFillColor(230, 230, 230);
        }
    
        $n++;
        $pdf->Cell(8, 8, $n, 1, 0, 'C', 1);
        $pdf->Cell(70, 8, utf8_decode($fila['DIRECCION']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode($fila['DISTRITO']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode($fila['CIUDAD']), 1, 0, 'C', 1);
        $pdf->Cell(50, 8, utf8_decode($fila['NOMBRE']), 1, 1, 'C', 1);

    }
}else{
    $pdf->Cell(276, 8, utf8_decode("No existen registros de la consulta realizada o hubo un error."), 1, 1, 'C', 0);
}

mysqli_close($miconex);
$pdf->Output('Reporte Sedes.pdf', 'I');
ob_end_flush(); 

?>