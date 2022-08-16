<?php 
require_once("../includes/conexiones.php");
$miconex= miConexionBD();
$conectar = ConectarBD();

$conteo="SELECT MAX(ID_VENTA) AS ID_VENTA FROM venta_cabecera";
$ejecutarconteo = mysqli_query($miconex, $conteo);
$resul = mysqli_fetch_assoc($ejecutarconteo);

$venta=$resul['ID_VENTA'];

$idpord=$_POST['idpord'];
$cant=intval($_POST['cant']);

if($_POST['rbV1'] == 1){

    $consultaPV="SELECT PV_MIN, STOCK FROM productos_terminados WHERE ID_PRODUCTO = '$idpord' ";
    $ejecutarconsultaPV =mysqli_query($miconex, $consultaPV);
    $result = mysqli_fetch_assoc($ejecutarconsultaPV);
    $PV = $result['PV_MIN'];
    $oldStock = intval($result['STOCK']);
        
}else{

    $consultaPV="SELECT PV_MAX, STOCK FROM productos_terminados WHERE ID_PRODUCTO = '$idpord' ";
    $ejecutarconsultaPV =mysqli_query($miconex, $consultaPV);
    $result = mysqli_fetch_assoc($ejecutarconsultaPV);
    $PV = $result['PV_MAX'];
    $oldStock = intval($result['STOCK']);
}

$precio = $cant * $PV;                   
    
$stock = $oldStock - $cant;
$consultaModifyStock = "UPDATE productos_terminados SET STOCK = '$stock' WHERE ID_PRODUCTO = '$idpord'";
mysqli_query($miconex, $consultaModifyStock);

$consultaInsertarVcue = "INSERT INTO venta_cuerpo (ID_PRODUCTO, ID_VENTA, CANTIDAD, PRECIO, PRECIO_TOTAL) 
                                            VALUES ('$idpord', '$venta', '$cant', '$PV', '$precio')";

echo mysqli_query($miconex, $consultaInsertarVcue);
mysqli_close($miconex);
?>