<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use \PhpOffice\PhpSpreadsheet\Style\{Border, Fill, Alignment};
use \PhpOffice\PhpSpreadsheet\Worksheet\{Drawing};

$spreadsheet = new SpreadSheet();
$spreadsheet->getProperties()->SetCreator('SysVakilact')->SetTitle('Reporte Productos')->setCategory('Gestión')->setCompany('Lácteos Vakilact');

$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();
$hojaActiva->setTitle("Productos");

$spreadsheet->getDefaultStyle()->getFont()->setName('Arial'); //tipo de letra
$spreadsheet->getDefaultStyle()->getFont()->setSize(12); //tamaño de letra

require "includes/conexiones.php";
$miconex= miConexionBD();

$nombreSede = $_POST['slctSedes'];
$nombre = $_POST['slctNombre'];
$fReg = $_POST['txtFreg'];
$UM = $_POST['slctUM'];

if(empty($nombreSede = $_POST['slctSedes']) or empty($nombre = $_POST['slctNombre']) or empty($fReg = $_POST['txtFreg']) or empty($UM = $_POST['slctUM'])){
    if(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg'";
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre' AND UNIDAD_MEDIDA = '$UM'";    
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND FECHA_INGRESO >= '$fReg'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM productos_terminados WHERE NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg'";
    }elseif(!empty($nombre = $_POST['slctNombre']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE NOMBRE = '$nombre' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";  
    }elseif(!empty($nombreSede = $_POST['slctSedes'])){
        $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede'";
    }elseif(!empty($nombre = $_POST['slctNombre'])){
        $consulta = "SELECT * FROM productos_terminados WHERE NOMBRE = '$nombre'";
    }elseif(!empty($fReg = $_POST['txtFreg'])){
        $consulta = "SELECT * FROM productos_terminados WHERE FECHA_INGRESO >= '$fReg'"; 
    }elseif(!empty($UM = $_POST['slctUM'])){
        $consulta = "SELECT * FROM productos_terminados WHERE UNIDAD_MEDIDA = '$UM'";  
    }else{
        $consulta = "SELECT * FROM productos_terminados";
    }     
}elseif(!empty($nombreSede = $_POST['slctSedes']) and !empty($nombre = $_POST['slctNombre']) and !empty($fReg = $_POST['txtFreg']) and !empty($UM = $_POST['slctUM'])){
    $consulta = "SELECT * FROM productos_terminados WHERE ID_SEDE = '$nombreSede' AND NOMBRE = '$nombre' AND FECHA_INGRESO >= '$fReg' AND UNIDAD_MEDIDA = '$UM'";
}else{
    $spreadsheet->getActiveSheet()->mergeCells('B1:L1');
    $hojaActiva->setCellValue('B3', 'No existen registros de la consulta realizada o hubo un error.');
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

$spreadsheet->getActiveSheet()->getStyle('B2:J2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF4C4C4C');

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
$spreadsheet->getActiveSheet()->mergeCells('D1:J1');
$hojaActiva->setCellValue('D1', 'Reporte Productos');

$hojaActiva->setCellValue('B2', '#');
$hojaActiva->getColumnDimension("B")->setWidth("5"); // ancho de columna
$hojaActiva->getStyle('B2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('C2', 'Nombre');
$hojaActiva->getColumnDimension("C")->setWidth("15");
$hojaActiva->getStyle('C2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('D2', 'Sede');
$hojaActiva->getColumnDimension("D")->setWidth("20");
$hojaActiva->getStyle('D2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('E2', 'Unidad de Medida');
$hojaActiva->getColumnDimension("E")->setWidth("17");
$hojaActiva->getStyle('E2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('F2', 'Stock');
$hojaActiva->getColumnDimension("F")->setWidth("8");
$hojaActiva->getStyle('F2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('G2', 'Precio de venta menor');
$hojaActiva->getColumnDimension("G")->setWidth("20");
$hojaActiva->getStyle('G2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('H2', 'Precio de venta mayor');
$hojaActiva->getColumnDimension("H")->setWidth("20");
$hojaActiva->getStyle('H2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('I2', 'Costo de producción');
$hojaActiva->getColumnDimension("I")->setWidth("20");
$hojaActiva->getStyle('I2')->applyFromArray($styleArray);
$hojaActiva->setCellValue('J2', 'Fecha de ingreso');
$hojaActiva->getColumnDimension("J")->setWidth("15");
$hojaActiva->getStyle('J2')->applyFromArray($styleArray);

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
        $hojaActiva->setCellValue('C'.$row, $fila['NOMBRE']);
        $hojaActiva->getStyle('C'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('D'.$row, $nomSede['NOMBRE'] );
        $hojaActiva->getStyle('D'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('E'.$row, $fila['UNIDAD_MEDIDA'] );
        $hojaActiva->getStyle('E'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('F'.$row, $fila['STOCK'] );
        $hojaActiva->getStyle('F'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('G'.$row, $fila['PV_MIN'] );
        $hojaActiva->getStyle('G'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('H'.$row, $fila['PV_MAX'] );
        $hojaActiva->getStyle('H'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('I'.$row, $fila['C_PROD'] );
        $hojaActiva->getStyle('I'.$row)->applyFromArray($styleArray);
        $hojaActiva->setCellValue('J'.$row, $fila['FECHA_INGRESO'] );
        $hojaActiva->getStyle('J'.$row)->applyFromArray($styleArray);       
        $row++;

    }
}else{
    
}
mysqli_close($miconex);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Productos.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
?>