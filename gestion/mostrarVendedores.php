<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT * FROM usuarios ";
    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
    ?>
    <option value="<?php echo $fila['ID_USER'] ?>"><?php echo $fila['NOMBRE']." ".$fila['APELLIDO_P']." ".$fila['APELLIDO_M'] ?></option>
    <?php        
    }    
?>