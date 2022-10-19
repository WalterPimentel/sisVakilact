<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT DISTINCT UNIDAD_MEDIDA FROM productos_terminados";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
    ?>
    <option value="<?php echo $fila['UNIDAD_MEDIDA'] ?>"><?php echo $fila['UNIDAD_MEDIDA'] ?></option>
    <?php        
    }    
?>