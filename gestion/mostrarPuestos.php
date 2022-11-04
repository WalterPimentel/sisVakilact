<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT * FROM roles";

    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){        
    ?>
    <option value="<?php echo $fila['ID_ROL'] ?>"><?php echo $fila['ROL'] ?></option>
    <?php        
    }    
?>