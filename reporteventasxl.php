<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use \PhpOffice\PhpSpreadsheet\Style\{Border, Fill, Alignment};
use \PhpOffice\PhpSpreadsheet\Worksheet\{Drawing};

$spreadsheet = new SpreadSheet();
$spreadsheet->getProperties()->SetCreator('SysVakilact')->SetTitle('Reporte Ventas')->setCategory('Gestión')->setCompany('Lácteos Vakilact');

$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();
$hojaActiva->setTitle("Ventas");

$spreadsheet->getDefaultStyle()->getFont()->setName('Arial'); //tipo de letra
$spreadsheet->getDefaultStyle()->getFont()->setSize(12); //tamaño de letra

require "includes/conexiones.php";
$miconex= miConexionBD();

$idSede = $_POST['slctSedes'];
$nomVende = $_POST['slctVende'];
$nomProd = $_POST['slctProd'];
$consultIdProd = "SELECT ID_PRODUCTO FROM productos_terminados WHERE NOMBRE = '$nomProd' AND ID_SEDE = '$idSede'";
$FV = $_POST['txtFV'];

if(empty($idSede = $_POST['slctSedes']) or empty($nomVende = $_POST['slctVende']) or empty($nomProd = $_POST['slctProd']) or empty($FV = $_POST['txtFV'])){
    if(!empty($idSede = $_POST['slctSedes']) and !empty($nomVende = $_POST['slctVende']) and !empty($nomProd = $_POST['slctProd'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND PUESTO = '$nomVende' AND FECHA_REGISTRO >= '$nomProd'";
    }elseif(!empty($idSede = $_POST['slctSedes']) and !empty($nomVende = $_POST['slctVende']) and !empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND PUESTO = '$nomVende' AND FECHA_SALIDA >= '$FV'";    
    }elseif(!empty($idSede = $_POST['slctSedes']) and !empty($nomProd = $_POST['slctProd']) and !empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND FECHA_REGISTRO >= '$nomProd' AND FECHA_SALIDA >= '$FV'";  
    }elseif(!empty($nomVende = $_POST['slctVende']) and !empty($nomProd = $_POST['slctProd']) and !empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nomVende' AND FECHA_REGISTRO >= '$nomProd' AND FECHA_SALIDA >= '$FV'";  
    }elseif(!empty($idSede = $_POST['slctSedes']) and !empty($nomVende = $_POST['slctVende'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND PUESTO = '$nomVende'";  
    }elseif(!empty($idSede = $_POST['slctSedes']) and !empty($nomProd = $_POST['slctProd'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND FECHA_REGISTRO >= '$nomProd'";  
    }elseif(!empty($idSede = $_POST['slctSedes']) and !empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND FECHA_SALIDA >= '$FV'";  
    }elseif(!empty($nomVende = $_POST['slctVende']) and !empty($nomProd = $_POST['slctProd'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nomVende' AND FECHA_REGISTRO >= '$nomProd'";
    }elseif(!empty($nomVende = $_POST['slctVende']) and !empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nomVende' AND FECHA_SALIDA >= '$FV'";  
    }elseif(!empty($nomProd = $_POST['slctProd']) and !empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE FECHA_REGISTRO >= '$nomProd' AND FECHA_SALIDA >= '$FV'";  
    }elseif(!empty($idSede = $_POST['slctSedes'])){
        $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede'";
    }elseif(!empty($nomVende = $_POST['slctVende'])){
        $consulta = "SELECT * FROM administradores WHERE PUESTO = '$nomVende'";
    }elseif(!empty($nomProd = $_POST['slctProd'])){
        $consulta = "SELECT * FROM administradores WHERE FECHA_REGISTRO >= '$nomProd'"; 
    }elseif(!empty($FV = $_POST['txtFV'])){
        $consulta = "SELECT * FROM administradores WHERE FECHA_SALIDA >= '$FV'";  
    }else{
        $consulta = "SELECT * FROM administradores";
    }     
}elseif(!empty($idSede = $_POST['slctSedes']) and !empty($nomVende = $_POST['slctVende']) and !empty($nomProd = $_POST['slctProd']) and !empty($FV = $_POST['txtFV'])){
    $consulta = "SELECT * FROM administradores WHERE ID_SEDE = '$idSede' AND PUESTO = '$nomVende' AND FECHA_REGISTRO >= '$nomProd' AND FECHA_SALIDA >= '$FV'";
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
$drawing->setPath('imagenes/logo.jpg'); // put your path and image here
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
$hojaActiva->setCellValue('D1', 'Reporte Administradores');

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
$hojaActiva->setCellValue('G2', 'Puesto');
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
        $consultaidSede = "SELECT NOMBRE FROM SEDES WHERE ID_SEDE = '$idsede'";
        $resulNomSede = mysqli_query($miconex, $consultaidSede);
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
        $hojaActiva->setCellValue('C'.$row, $fila['DNI_RUC']);
        $hojaActiva->getStyle('C'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('D'.$row, $fila['NOMBRE'] );
        $hojaActiva->getStyle('D'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('E'.$row, $fila['APELLIDO_P'] );
        $hojaActiva->getStyle('E'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('F'.$row, $fila['APELLIDO_M'] );
        $hojaActiva->getStyle('F'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('G'.$row, $fila['PUESTO'] );
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
header('Content-Disposition: attachment;filename="Reporte Ventas.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>