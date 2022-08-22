<?php

ob_start();
require('fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',24);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    $this->Cell(84,30,'Reporte de Administradores',0,0,'C');
    // Salto de línea
    $this->Ln(35);

    $this->EncabezadoTabla();
    
}

function EncabezadoTabla()
{
    // Arial 12
    $this->SetFont('Arial','B',12);
    // Color de fondo
    $this->SetFillColor(76, 76, 76);
    // Color de texto
    $this->SetTextColor(255,255,255);
    // Título
    $this->Cell(8, 8, "#", 1, 0, 'C', 1);
    $this->Cell(23, 8, utf8_decode("DNI"), 1, 0, 'C', true);
    $this->Cell(30, 8, utf8_decode("Nombre"), 1, 0, 'C', 1);
    $this->Cell(30, 8, utf8_decode("Ap. paterno"), 1, 0, 'C', 1);
    $this->Cell(30, 8, utf8_decode("Ap. materno"), 1, 0, 'C', 1);
    $this->Cell(30, 8, utf8_decode("Puesto"), 1, 0, 'C', 1);
    //$this->Cell(50, 8, utf8_decode("Correo"), 1, 0, 'C', 1);
    $this->Cell(25, 8, utf8_decode("Teléfono"), 1, 0, 'C', 1);
    $this->Cell(50, 8, utf8_decode("Sede"), 1, 0, 'C', 1);
    $this->Cell(25, 8, utf8_decode("F. registro"), 1, 0, 'C', 1);
    $this->Cell(25, 8, utf8_decode("F. salida"), 1, 1, 'C', 1);    
    
    // Salto de línea
    //$this->Ln(4);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require '../../includes/conexiones.php';
$miconex= miConexionBD();

$nombreSede = $_POST['slctSedes'];
$nombrePuesto = $_POST['slctPuesto'];
$fReg = $_POST['txtFreg'];
$fSal = $_POST['txtFsal'];

if(empty($nombreSede = $_POST['slctSedes']) or empty($nombrePuesto = $_POST['slctPuesto']) or empty($fReg = $_POST['txtFreg']) or empty($fSal = $_POST['txtFsal'])){
    if(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND PUESTO = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg'";
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND PUESTO = '$nombrePuesto' AND FECHA_SALIDA >= '$fSal'";    
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND PUESTO = '$nombrePuesto'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND FECHA_REGISTRO >= '$fReg'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg'";
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nombrePuesto' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede'";
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nombrePuesto'";
    }elseif(!empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM administradores WHERE FECHA_REGISTRO >= '$fReg'"; 
    }elseif(!empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM administradores WHERE FECHA_SALIDA >= '$fSal'";  
    }else{
        $consulta = "SELECT * FROM administradores";
    }     
}elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
    $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$nombreSede' AND PUESTO = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";
}else{
    $pdf->Cell(276, 8, utf8_decode("No existen registros de la consulta realizada o hubo un error."), 1, 1, 'C', 0);
}

$resultado = mysqli_query($miconex, $consulta);
$n = 0;

$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$numrows = mysqli_num_rows($resultado);

if($numrows != 0){
    while($fila = mysqli_fetch_assoc($resultado)){
    
        $idsede = $fila['ID_SEDE'];
        $consultaNombreSede = "SELECT NOMBRE FROM SEDES WHERE ID_SEDE = '$idsede'";
        $resulNomSede = mysqli_query($miconex, $consultaNombreSede);
        $nomSede = mysqli_fetch_assoc($resulNomSede);
    
        if($n%2 == 0){
            $pdf->SetFillColor(255, 255, 255);
        }else{
            $pdf->SetFillColor(230, 230, 230);
        }
    
        $n++;
        $pdf->Cell(8, 8, $n, 1, 0, 'C', 1);
        $pdf->Cell(23, 8, utf8_decode($fila['DNI_RUC']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode($fila['NOMBRE']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode($fila['APELLIDO_P']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode($fila['APELLIDO_M']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode($fila['PUESTO']), 1, 0, 'C', 1);
        //$pdf->Cell(50, 8, utf8_decode($fila['CORREO']), 1, 0, 'C', 1);
        $pdf->Cell(25, 8, utf8_decode($fila['TELEFONO']), 1, 0, 'C', 1);
        $pdf->Cell(50, 8, utf8_decode($nomSede['NOMBRE']), 1, 0, 'C', 1);
        $pdf->Cell(25, 8, utf8_decode($fila['FECHA_REGISTRO']), 1, 0, 'C', 1);
        $pdf->Cell(25, 8, utf8_decode($fila['FECHA_SALIDA']), 1, 1, 'C', 1);
        
        //$pdf->Image(base64_encode($fila['F_PERFIL']), 10, 8, 33);
    }
}else{
    $pdf->Cell(276, 8, utf8_decode("No existen registros de la consulta realizada o hubo un error."), 1, 1, 'C', 0);
}

mysqli_close($miconex);
$pdf->Output();
ob_end_flush(); 

?>