<?php
    require_once("../includes/conexiones.php");
    $miconex= miConexionBD();
    $conectar = ConectarBD();

    $consulta="SELECT DISTINCT vendedor.PUESTO, administradores.PUESTO 
                FROM vendedor 
                INNER JOIN administradores";

    $ejecutarConsulta=mysqli_query($miconex, $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){        
    ?>
    <option value="<?php echo $fila['PUESTO'] ?>"><?php echo $fila['PUESTO'] ?></option>
    <?php        
    }    
?>