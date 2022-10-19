<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use \PhpOffice\PhpSpreadsheet\Style\{Border, Fill, Alignment};
use \PhpOffice\PhpSpreadsheet\Worksheet\{Drawing};
use PhpOffice\PhpSpreadsheet\Writer\{Xlsx, Xls, Csv}; //aqui se peude agregar mas formatos como xls, csv, etc.. OJO: no olvidar cambiar tambien los formatos de abajo

$spreadsheet = new SpreadSheet();
$spreadsheet->getProperties()->SetCreator('SysVakilact')->SetTitle('Reporte Sedes')->setCategory('Gestión')->setCompany('Lácteos Vakilact');

$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();
$hojaActiva->setTitle("Sedes");

$spreadsheet->getDefaultStyle()->getFont()->setName('Arial'); //tipo de letra
$spreadsheet->getDefaultStyle()->getFont()->setSize(12); //tamaño de letra

require "includes/conexiones.php";
$miconex= miConexionBD();

$consulta = "SELECT * FROM sedes";
  

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

$spreadsheet->getActiveSheet()->getStyle('B2:F2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF4C4C4C');

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
$hojaActiva->getStyle('B1:F1')->applyFromArray($styleCab);
$spreadsheet->getActiveSheet()->mergeCells('B1:F1');
$hojaActiva->setCellValue('B1', 'Reporte Sedes');

$hojaActiva->setCellValue('B2', '#');
$hojaActiva->getColumnDimension("B")->setWidth("6"); // ancho de columna
$hojaActiva->getStyle('B2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('C2', 'Dirección');
$hojaActiva->getColumnDimension("C")->setWidth("30");
$hojaActiva->getStyle('C2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('D2', 'Distrito');
$hojaActiva->getColumnDimension("D")->setWidth("16");
$hojaActiva->getStyle('D2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('E2', 'Ciudad');
$hojaActiva->getColumnDimension("E")->setWidth("16");
$hojaActiva->getStyle('E2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('F2', 'Nombre');
$hojaActiva->getColumnDimension("F")->setWidth("20");
$hojaActiva->getStyle('F2')->applyFromArray($styleArray);

if($numfilas != 0){
    
    $row = 3; //contenio empieza desde la fila 2

    while($fila = mysqli_fetch_assoc($resultado)){

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
        $hojaActiva->setCellValue('C'.$row, $fila['DIRECCION']);
        $hojaActiva->getStyle('C'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('D'.$row, $fila['DISTRITO'] );
        $hojaActiva->getStyle('D'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('E'.$row, $fila['CIUDAD'] );
        $hojaActiva->getStyle('E'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('F'.$row, $fila['NOMBRE'] );
        $hojaActiva->getStyle('F'.$row)->applyFromArray($styleArray);      
        $row++;

    }
}else{
    
}
mysqli_close($miconex);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Sedes.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

/* Esto para descargar archivos xls
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte Administradores.xls"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
*/

/* Esto es para un guardado en la carpeta de este archivo PHP
$writer = new Xlsx($spreadsheet);
$writer->Save('Reporte Administradores.xlsx');
*/
?>