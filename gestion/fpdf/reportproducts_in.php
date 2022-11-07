<?php

ob_start();
require('fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',24);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    $this->Cell(1,30,'Reporte de Entrada Productos',0,0);
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
    $this->Cell(40, 8, utf8_decode("Nombre"), 1, 0, 'C', 1);
    $this->Cell(60, 8, utf8_decode("Sede"), 1, 0, 'C', 1);
    $this->Cell(35, 8, utf8_decode("Cantidad"), 1, 0, 'C', 1);
    $this->Cell(15, 8, utf8_decode("P. Compra"), 1, 0, 'C', 1);
    $this->Cell(20, 8, utf8_decode("Fecha Ingreso"), 1, 0, 'C', 1);
    
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
$nombre = $_POST['slctNombre'];
empty($UM = $_POST['slctUM']);
$fReg = $_POST['txtFreg'];

if(empty($nombreSede = $_POST['slctSedes']) or empty($nombre = $_POST['slctNombre']) or empty($fReg = $_POST['txtFreg']) or empty($UM = $_POST['slctUM'])){
    if(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg'";
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre' AND UNIDAD_MEDIDA = '$UM'";    
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND FECHA_INGRESO >= '$fReg'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg'";
    }elseif(!empty($nombre = $_POST['slctNombre']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE NOMBRE = '$nombre' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede'";
    }elseif(!empty($nombre = $_POST['slctNombre'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE NOMBRE = '$nombre'";
    }elseif(!empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE FECHA_INGRESO >= '$fReg'"; 
    }elseif(!empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM ingreso_prodt WHERE UNIDAD_MEDIDA = '$UM'";  
    }else{
        $consulta = "SELECT * FROM ingreso_prodt";
    }     
}elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
    $consulta = "SELECT * FROM ingreso_prodt WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";
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
        $pdf->Cell(40, 8, utf8_decode($fila['NOMBRE']), 1, 0, 'C', 1);
        $pdf->Cell(60, 8, utf8_decode($nomSede['NOMBRE']), 1, 0, 'C', 1);
        $pdf->Cell(35, 8, utf8_decode($fila['UNIDAD_MEDIDA']), 1, 0, 'C', 1);
        $pdf->Cell(15, 8, utf8_decode($fila['STOCK']), 1, 0, 'C', 1);
        $pdf->Cell(20, 8, utf8_decode("S/.".$fila['PV_MIN']), 1, 0, 'C', 1);
        $pdf->Cell(20, 8, utf8_decode("S/.".$fila['PV_MAX']), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode("S/.".$fila['C_PROD']), 1, 0, 'C', 1);
        $pdf->Cell(25, 8, utf8_decode($fila['FECHA_INGRESO']), 1, 1, 'C', 1);
        
        //$pdf->Image(base64_encode($fila['F_PERFIL']), 10, 8, 33);
    }
}else{
    $pdf->Cell(276, 8, utf8_decode("No existen registros de la consulta realizada o hubo un error."), 1, 1, 'C', 0);
}

mysqli_close($miconex);
$pdf->Output('Reporte Productos.pdf', 'I');
ob_end_flush(); 

?>