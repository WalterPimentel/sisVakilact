<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use \PhpOffice\PhpSpreadsheet\Style\{Border, Fill, Alignment};
use \PhpOffice\PhpSpreadsheet\Worksheet\{Drawing};
use PhpOffice\PhpSpreadsheet\Writer\{Xlsx, Xls, Csv}; //aqui se peude agregar mas formatos como xls, csv, etc.. OJO: no olvidar cambiar tambien los formatos de abajo

$spreadsheet = new SpreadSheet();
$spreadsheet->getProperties()->SetCreator('SysVakilact')->SetTitle('Reporte Usuarios')->setCategory('Gestión')->setCompany('Lácteos Vakilact');

$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();
$hojaActiva->setTitle("Usuarios");

$spreadsheet->getDefaultStyle()->getFont()->setName('Arial'); //tipo de letra
$spreadsheet->getDefaultStyle()->getFont()->setSize(12); //tamaño de letra

require "includes/conexiones.php";
$miconex= miConexionBD();

$nombreSede = $_POST['slctSedes'];
$nombrePuesto = $_POST['slctPuesto'];
$fReg = $_POST['txtFreg'];
$fSal = $_POST['txtFsal'];

if(empty($nombreSede = $_POST['slctSedes']) or empty($nombrePuesto = $_POST['slctPuesto']) or empty($fReg = $_POST['txtFreg']) or empty($fSal = $_POST['txtFsal'])){
    if(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND ID_ROL = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg'";
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND ID_ROL = '$nombrePuesto' AND FECHA_SALIDA >= '$fSal'";    
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_ROL = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND ID_ROL = '$nombrePuesto'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND FECHA_REGISTRO >= '$fReg'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_ROL = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg'";
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_ROL = '$nombrePuesto' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede'";
    }elseif(!empty($nombrePuesto = $_POST['slctPuesto'])){
        $consulta = "SELECT * FROM usuarios WHERE ID_ROL = '$nombrePuesto'";
    }elseif(!empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM usuarios WHERE FECHA_REGISTRO >= '$fReg'"; 
    }elseif(!empty($fSal = $_POST['txtFsal'])){
        $consulta = "SELECT * FROM usuarios WHERE FECHA_SALIDA >= '$fSal'";  
    }else{
        $consulta = "SELECT * FROM usuarios";
    }     
}elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombrePuesto = $_POST['slctPuesto']) and !empty($fReg = $_POST['txtFreg']) and !empty($fSal = $_POST['txtFsal'])){
    $consulta = "SELECT * FROM usuarios WHERE ID_SEDE = '$nombreSede' AND ID_ROL = '$nombrePuesto' AND FECHA_REGISTRO >= '$fReg' AND FECHA_SALIDA >= '$fSal'";
}else{
    //$pdf->Cell(276, 8, utf8_decode("No existen registros de la consulta realizada o hubo un error."), 1, 1, 'C', 0);
}

$resultado = mysqli_query($miconex, $consulta);
$numfilas = mysqli_num_rows($resultado);
$n = 0;

$styleArray = array(
    'borders' => array(
        'outline' => array(
            'borderStyle' => Border::BORDER_THIN,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFFFF'),
        'size'  => 12
        //'name'  => 'Verdana'
    ),
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
);

$spreadsheet->getActiveSheet()->getStyle('B2:L2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF4C4C4C');

//Cabecera del reporte
$styleCab = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FF000000'),
        'size'  => 36
        //'name'  => 'Verdana'
    ),
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
);

$drawing = new Drawing();

$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('imagenes/logo.png'); // put your path and image here
$drawing->setCoordinates('B1');
$drawing->setOffsetX(27); //margen a la derecha
$drawing->setOffsety(11);
//$drawing->setRotation(25); //Rotacion de imagen
$drawing->setWidth('100');
$drawing->getShadow()->setVisible(true);
$drawing->getShadow()->setDirection(45);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

$hojaActiva->getRowDimension('1')->setRowHeight('90');
$hojaActiva->getStyle('B1:L1')->applyFromArray($styleCab);
$spreadsheet->getActiveSheet()->mergeCells('B1:C1');
$spreadsheet->getActiveSheet()->mergeCells('D1:L1');
$hojaActiva->setCellValue('D1', 'Reporte Usuarios');

$hojaActiva->setCellValue('B2', '#');
$hojaActiva->getColumnDimension("B")->setWidth("6"); // ancho de columna
$hojaActiva->getStyle('B2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('C2', 'DNI');
$hojaActiva->getColumnDimension("C")->setWidth("11");
$hojaActiva->getStyle('C2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('D2', 'Nombre');
$hojaActiva->getColumnDimension("D")->setWidth("16");
$hojaActiva->getStyle('D2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('E2', 'Ap. paterno');
$hojaActiva->getColumnDimension("E")->setWidth("16");
$hojaActiva->getStyle('E2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('F2', 'Ap. materno');
$hojaActiva->getColumnDimension("F")->setWidth("16");
$hojaActiva->getStyle('F2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('G2', 'Cargo');
$hojaActiva->getColumnDimension("G")->setWidth("16");
$hojaActiva->getStyle('G2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('H2', 'Correo');
$hojaActiva->getColumnDimension("H")->setWidth("37");
$hojaActiva->getStyle('H2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('I2', 'Teléfono');
$hojaActiva->getColumnDimension("I")->setWidth("12");
$hojaActiva->getStyle('I2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('J2', 'Sede');
$hojaActiva->getColumnDimension("J")->setWidth("27");
$hojaActiva->getStyle('J2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('K2', 'F. registro');
$hojaActiva->getColumnDimension("K")->setWidth("12");
$hojaActiva->getStyle('K2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('L2', 'F. Salida');
$hojaActiva->getColumnDimension("L")->setWidth("12");
$hojaActiva->getStyle('L2')->applyFromArray($styleArray);

if($numfilas != 0){
    
    $row = 3; //contenio empieza desde la fila 2

    while($fila = mysqli_fetch_assoc($resultado)){
        $idsede = $fila['ID_SEDE'];
        $consultaNombreSede = "SELECT NOMBRE FROM SEDES WHERE ID_SEDE = '$idsede'";
        $resulNomSede = mysqli_query($miconex, $consultaNombreSede);
        $nomSede = mysqli_fetch_assoc($resulNomSede);

        if($n%2 == 0){
            $styleArray = array(
                'borders' => array(
                    'outline' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('argb' => 'FF000000'),
                    ),
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('argb' => 'FFFFFFFF')
                ),
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            );
        }else{
            $styleArray = array(
                'borders' => array(
                    'outline' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('argb' => 'FF000000'),
                    ),
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('argb' => 'FFE6E6E6')
                ),
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            );
        }

        $n++;
        $hojaActiva->setCellValue('B'.$row, $n);
        $hojaActiva->getStyle('B'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('C'.$row, $fila['DNI']);
        $hojaActiva->getStyle('C'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('D'.$row, $fila['NOMBRE'] );
        $hojaActiva->getStyle('D'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('E'.$row, $fila['APELLIDO_P'] );
        $hojaActiva->getStyle('E'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('F'.$row, $fila['APELLIDO_M'] );
        $hojaActiva->getStyle('F'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('G'.$row, $fila['ID_ROL'] );
        $hojaActiva->getStyle('G'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('H'.$row, $fila['CORREO'] );
        $hojaActiva->getStyle('H'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('I'.$row, $fila['TELEFONO'] );
        $hojaActiva->getStyle('I'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('J'.$row, $nomSede['NOMBRE'] );
        $hojaActiva->getStyle('J'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('K'.$row, $fila['FECHA_REGISTRO'] );
        $hojaActiva->getStyle('K'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('L'.$row, $fila['FECHA_SALIDA'] );
        $hojaActiva->getStyle('L'.$row)->applyFromArray($styleArray);        
        $row++;

    }
}else{
    
}
mysqli_close($miconex);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Usuarios.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

/* Esto para descargar archivos xls
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte usuarios.xls"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
*/

/* Esto es para un guardado en la carpeta de este archivo PHP
$writer = new Xlsx($spreadsheet);
$writer->Save('Reporte usuarios.xlsx');
*/
?>