<?php 
require_once("../includes/conexiones.php");
$miconex= miConexionBD();
$conectar = ConectarBD();

$ultimo="SELECT MAX(ID_VENTA) AS ID_VENTA from venta_cabecera";
$ejecutar = mysqli_query($miconex, $ultimo);
$valor=mysqli_fetch_assoc($ejecutar);
$idventa=$valor['ID_VENTA'];

$consulta="SELECT * FROM VENTA_CUERPO WHERE ID_VENTA ='$idventa' ORDER BY F_H";

if($resultado = mysqli_query($miconex, $consulta)){
?>
<table border="1" class="tablaRegistros">
    <tbody>
        <tr bgcolor="4C4C4C" style="color: white;">
            <td>#</td>
            <td>ID Venta</td>
            <td>ID Producto</td>
            <td>Nombre</td>
            <td>Cant.</td>
            <td>Precio</td>
            <td>SubTotal</td>
            <td>Remover</td>                                        
        </tr>
<?php
    $c=1;
    $total = 0;                             
    while ($fila = mysqli_fetch_assoc($resultado) and $c >= 1){
        $idprod = $fila['ID_PRODUCTO'];
        $consultaNomProd = "SELECT NOMBRE FROM productos_terminados WHERE ID_PRODUCTO = '$idprod'";
        $exeConsultaNomProd = mysqli_query($miconex, $consultaNomProd);
        $nomProd = mysqli_fetch_assoc($exeConsultaNomProd);
        ?>
        <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">
            <td><?php echo $c++; ?></td>
            <td><b>&nbsp;<?php echo $fila['ID_VENTA'];?>&nbsp;</b></td>
            <td>&nbsp;<?php echo $fila['ID_PRODUCTO'];?>&nbsp;</td>
            <td>&nbsp;<?php echo $nomProd['NOMBRE'];?>&nbsp;</td>
            <td>&nbsp;<?php echo $fila['CANTIDAD'];?>&nbsp;</td>
            <td>&nbsp;<?php echo "S/. ".$fila['PRECIO'];?>&nbsp;</td>
            <td>&nbsp;<?php echo "S/. ".$fila['PRECIO_TOTAL'];?>&nbsp;</td>
            <?php 
            if($c == 2){            
            ?>            
            <td><button type="submit" value="<?php echo $fila['ID_PRODUCTO'];?>" name="btnQuitar" id="btnQuitar" onclick="ConfirmarC(event);">&#128465;</button></td>
            <?php
            }else{                
            ?>
            <td><button type="button" value="<?php echo $fila['ID_PRODUCTO'];?>" name="btnQuitar" onclick="QuitarProductos(this.value); setTimeout(mostrar, 256); setTimeout(actualizarStock, 512);">&#128465;</button></td>
            <?php
            }
            ?>                    
        </tr>
        <?php
        $subtotal = $fila['PRECIO_TOTAL'];
        $total = $fila['PRECIO_TOTAL'] + $total;
    }
?>
        <tr bgcolor="4C4C4C" style="color: white;">
            <td colspan="6" align="right">TOTAL:&nbsp;</td>
            <td><?php echo "S/. ".number_format($total, 2, '.', ' '); ?></td>
        </tr>
        <tr>
            <td colspan="8" style="border: medium transparent">
                <input type="submit" value="Registrar Venta" name="btnRegistrar" class="Botones" onclick="ConfirmarR(event)">
            </td>
        </tr>
    </tbody>
</table>
<?php 
}
mysqli_close($miconex);
?>