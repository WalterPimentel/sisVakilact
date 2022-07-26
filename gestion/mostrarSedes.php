<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT * FROM sedes";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
    ?>
    <option value="<?php echo $fila['ID_SEDE'] ?>"><?php echo $fila['NOMBRE'] ?></option>
    <?php        
    }
    mysqli_close($miconex);
?>