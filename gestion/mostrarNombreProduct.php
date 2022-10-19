<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT DISTINCT NOMBRE FROM productos_terminados";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
    ?>
    <option value="<?php echo $fila['NOMBRE'] ?>"><?php echo $fila['NOMBRE'] ?></option>
    <?php        
    }    
?>