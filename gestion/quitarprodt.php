<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $ultimo="SELECT MAX(ID_VENTA) AS ID_VENTA from venta_cabecera";
    $ejecutar = mysqli_query($miconex, $ultimo);
    $valor = mysqli_fetch_assoc($ejecutar);
    $idventa=$valor['ID_VENTA'];

    $idprodt = $_GET['q'];

    $consultastock = "SELECT STOCK FROM productos_terminados WHERE ID_PRODUCTO = '$idprodt'";
    $ejecutar2 = mysqli_query($miconex, $consultastock);
    $resultado = mysqli_fetch_assoc($ejecutar2);
    $stock = intval($resultado['STOCK']);

    $consultacant ="SELECT CANTIDAD FROM venta_cuerpo WHERE ID_PRODUCTO = '$idprodt' AND ID_VENTA = '$idventa'";
    $ejecutar2 = mysqli_query($miconex, $consultacant);
    $resultado2 = mysqli_fetch_assoc($ejecutar2);
    $cantidad = intval($resultado2['CANTIDAD']);

    $newStock = $stock + $cantidad;

    $consultaModify = "UPDATE productos_terminados SET STOCK = '$newStock' WHERE ID_PRODUCTO = '$idprodt'";
    mysqli_query($miconex, $consultaModify);

    $consultaeliminar = "DELETE FROM venta_cuerpo WHERE ID_PRODUCTO = '$idprodt' AND ID_VENTA = '$idventa'";
    mysqli_query($miconex, $consultaeliminar);
    mysqli_close($miconex);
?>