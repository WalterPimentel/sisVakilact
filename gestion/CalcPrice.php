<?php
require_once("../includes/conexiones.php");
$miconex= miConexionBD();
$conectar = ConectarBD();

$cant=$_GET['p'];
$price=$cant*80;
echo $price;
?>