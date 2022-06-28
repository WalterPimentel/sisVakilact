<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >Productos</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>    
    <body>
        <?php                                                           
            require_once("../index.php");
            $scriptSelectProduct = "SELECT * FROM productos_terminados";
            $scriptSelectProductIn = "SELECT * FROM ingreso_prodt ORDER BY FECHA_REGISTRO DESC";
            if (isset($_REQUEST['btnCancelar'])){
                ?>
                <script>                 
                    e.preventDefault();                                                                   
                    window.location.replace("productos_in.php");
                </script>
                <meta http-equiv="refresh" content="0;url=productos_in.php">                                    
                <?php
            }
        ?>
       <div class="divGeneral" style="margin-top: 100px;">            
            <div class="divGestion">                            
                    <div class="divRegsitro">
                        <form action="productos_in.php" method="POST">
                            <fieldset class="containerGestion">
                                <legend>Registrar datos</legend>
                                <article>
                                    <section>                                    
                                        <?php 
                                            if (!isset($_REQUEST['btnEditar'])){                                            
                                        ?>
                                        <table>
                                            <tr>
                                                <input type="hidden" name="txtID">
                                                <td class="tdGestion">Producto Entrante y Lugar
                                                    <form>                                            
                                                        <select class="seleccion" name="slctProduct">
                                                            <?php 
                                                            if($resultado = $miconex->query($scriptSelectProduct)){   
                                                                while ($fila = $resultado->fetch_assoc()){
                                                                    $idsede = $fila['ID_SEDE'];                                
                                                                    $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                                                    $resultado2 = $miconex->query($scriptSelectNombreSedes);
                                                                    $columSedes = $resultado2->fetch_assoc();                                                                    
                                                                    ?>                                                                
                                                                    <option value="<?php echo $fila['ID_PRODUCTO'];?>"><?php echo $fila['NOMBRE'];?> - <?php echo $columSedes['NOMBRE'];?></option>
                                                                    <?php 
                                                                    $resultado2->close();    
                                                                } 
                                                                $resultado->close();                                                               
                                                            }
                                                            ?>
                                                        </select>
                                                    </form>
                                                </td>                                                
                                                <td class="tdGestion">Cantidad<input type="number" name="txtCant"></td>
                                                <td class="tdGestion">Precio de Compra<input type="number" name="txtPCompra"></td>                                                                                                                                                                          
                                            </tr>
                                            <tr>
                                                <td class="tdGestion">Precio de Venta al Mayor<input type="number" name="txtPVmax" required></td>  
                                                <td class="tdGestion">Precio de Venta al Menor<input type="number" name="txtPVmin" required></td>  
                                                <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" id="fechaActual"></td>
                                            </tr>                                            
                                            <tr>
                                                <td class="tdGestion" colspan="3">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                            </tr>
                                        </table>
                                                    <?php 
                                                    }elseif(isset($_REQUEST['btnEditar'])){                                    
                                                        $IDINGRESO = $_POST['btnEditar'];
                                                        $scriptSelectIngresoporID = "SELECT * FROM ingreso_prodt WHERE ID_INGRESO ='$IDINGRESO'";                                             
                                                        $llenarDatosIngreso = $miconex->query($scriptSelectIngresoporID);
                                                        $llenado = $llenarDatosIngreso->fetch_assoc();

                                                        $idsede = $llenado['ID_SEDE'];
                                                        $idproduct = $llenado['ID_PRODUCTO'];

                                                        $scriptSelectProductporIDnoDef = "SELECT * FROM productos_terminados WHERE NOT ID_PRODUCTO ='$idproduct'";
                                                        $scriptSelectProductporIDDef = "SELECT NOMBRE FROM productos_terminados WHERE ID_PRODUCTO ='$idproduct'";
                                                        $scriptSelectSedeporIDDef = "SELECT NOMBRE FROM sedes WHERE ID_SEDE ='$idsede'";

                                                    ?>
                                        <table>
                                            <input type="hidden" name="txtID" value="<?php echo $llenado['ID_INGRESO'];?>">                                            
                                            <tr>                                                
                                                <td class="tdGestion">Producto Entrante y Lugar
                                                    <form>                                            
                                                        <select class="seleccion" name="slctProduct">
                                                            <?php
                                                                if($resultado = $miconex->query($scriptSelectProductporIDnoDef)){
                                                                     
                                                                    $resultado2=$miconex->query($scriptSelectProductporIDDef);
                                                                    $llenarProductDef= $resultado2->fetch_assoc();
                                                                    $resultado3=$miconex->query($scriptSelectSedeporIDDef);
                                                                    $llenarSedeDef= $resultado3->fetch_assoc();
                                                                    ?>
                                                                    <option value="<?php echo $llenado['ID_INGRESO'];?>" selected><?php echo $llenarProductDef['NOMBRE'];?> - <?php echo $llenarSedeDef['NOMBRE'];?></option>
                                                                    <?php
                                                                    while ($fila = $resultado->fetch_assoc()){
                                                                        $idsede = $fila['ID_SEDE'];
                                                                        $idproduct = $fila['ID_PRODUCTO'];
                                                                        
                                                                        $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                                                        $resultado4 = $miconex->query($scriptSelectNombreSedes);
                                                                        $columSedes = $resultado4->fetch_assoc();

                                                                        $scriptSelectNombreProduct = "SELECT NOMBRE FROM productos_terminados WHERE ID_PRODUCTO = '$idproduct'";
                                                                        $resultado5 = $miconex->query($scriptSelectNombreProduct);
                                                                        $columProdutc = $resultado5->fetch_assoc();                                                                    
                                                                        ?>                                                                
                                                                        <option value="<?php echo $llenado['ID_INGRESO'];?>"><?php echo $columProdutc['NOMBRE'];?> - <?php echo $columSedes['NOMBRE'];?></option>
                                                                        <?php                                                                        
                                                                        $resultado4->close();
                                                                        $resultado5->close();    
                                                                    } 
                                                                    $resultado->close();                                                               
                                                                    $resultado2->close();
                                                                    $resultado3->close();
                                                                }
                                                            ?>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="tdGestion">Cantidad<input type="text"  name="txtCant" value="<?php echo $llenado['CANTIDAD'];?>"></td>
                                                <td class="tdGestion">Precio de Compra<input type="number" name="txtPCompra"value="<?php echo $llenado['PRECIO_COMPRA'];?>"  ></td>                                                                                                  
                                            </tr>
                                            <tr>
                                                <td class="tdGestion">Precio de Venta al Mayor<input type="number" name="txtPVmax" value="<?php echo $llenado['PRECIO_VENTAMAX'];?>" required></td>  
                                                <td class="tdGestion">Precio de Venta al Menor<input type="number" name="txtPVmin" value="<?php echo $llenado['PRECIO_VENTAMIN'];?>" required></td>
                                                <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['FECHA_REGISTRO'];?>"></td>
                                            </tr>                                            
                                            <tr>
                                                <td class="tdGestion" colspan="5">
                                                    <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                    <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                    <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                                </td>
                                                <?php
                                                        $llenarDatosIngreso->close();
                                                    }
                                                ?>                                                                                   
                                            </tr>
                                        </table>
                                    </section>
                                </article>
                            </fieldset>
                        </form>
                    </div>
                    <div class="divBuscar">
                        <form action="productos_in.php" method="GET">
                            <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por DNI, apellido o nombre" maxlength="64">
                            <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                        </form>
                    </div>
                    <?php 
                        if (isset($_REQUEST['btnRegistrar'])){
                            $noidprod = $_POST['slctProduct'];
                            $idproduct = intval($noidprod);
                            $scriptSelectProductId ="SELECT ID_SEDE, NOMBRE FROM productos_terminados WHERE ID_PRODUCTO = '$idproduct';";
                            $resultado = $miconex->query($scriptSelectProductId);
                            $fila = $resultado->fetch_assoc();
                            $noidsede = $fila['ID_SEDE'];
                            $idsede = intval($noidsede);                                                                                 
                            $nombre = $fila['NOMBRE'];                          
                            $cantidad = $_POST['txtCant'];
                            $PCompra=$_POST['txtPCompra'];
                            $PVmax=$_POST['txtPVmax'];
                            $PVmin=$_POST['txtPVmin'];
                            $fechaRegistro = $_POST['txtFechaIngreso'];                          
                            
                            $scriptInsertProductIn = "INSERT INTO ingreso_prodt (ID_PRODUCTO, ID_SEDE, NOMBRE, CANTIDAD, PRECIO_COMPRA, 
                                                                                PRECIO_VENTAMAX, PRECIO_VENTAMIN, FECHA_REGISTRO)
                                                                VALUES('$idproduct', '$idsede', '$nombre', '$cantidad', '$PCompra', 
                                                                        '$PVmax', '$PVmin', '$fechaRegistro');";

                            $scriptSumaCantProductIn = "SELECT SUM(CANTIDAD) AS CANTIDAD FROM ingreso_prodt WHERE ID_PRODUCTO = '$idproduct' AND ID_SEDE = '$idsede'";
                            $resultado2 = $miconex->query($scriptSumaCantProductIn);
                            $stock = $resultado2->fetch_assoc();
                            $nosuma = $stock['CANTIDAD'];
                            $suma = intval($nosuma+$cantidad);                            
                            $scriptInsertStockProduct = "UPDATE productos_terminados SET STOCK = '$suma' WHERE ID_PRODUCTO = '$idproduct';";                                                                                     
                            $resultado->close();                                                                                    
                            $resultado2->close();

                            if(($miconex->query($scriptInsertStockProduct) === true) and $miconex->query($scriptInsertProductIn) === true){                                
                                ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se registraron correctamente");                                                                                
                                    e.preventDefault();                                                                   
                                    window.location.replace("productos_in.php");                                    
                                </script>                                  
                                <?php                                                              
                            }else{
                                $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                                ?>                                
                                <script>
                                    alert("Error al Registrar datos: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php
                                printf(mysqli_error($miconex));
                                printf(mysqli_errno($miconex));
                            }                                                           
                        }                                                

                        if (isset($_REQUEST['btnModificar'])){
                            $id=$_POST['txtID'];
                            $fechaIngreso = $_POST['txtFechaIngreso'];
                            $sede = $_POST['slctProduct'];
                            $nombre = $_POST['txtNombre'];
                            $UM = $_POST['txtUM'];                            

                            $scriptModificarProduct ="UPDATE productos_terminados SET ID_SEDE = '$sede', FECHA_INGRESO = '$fechaIngreso', NOMBRE = '$nombre', UNIDAD_MEDIDA = '$UM'
                                                                                WHERE ID_PRODUCTO = '$id'";

                            if($miconex->query($scriptModificarProduct) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se actualizaron correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("administradores.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                                ?>
                                <script>
                                    alert("Error al Modificar datos: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }  
                        }

                        if (isset($_REQUEST['btnEliminar'])){                            
                            $idProductEliminar = $_POST['btnEliminar'];
                            $nombreEliminar= $miconex->query("SELECT NOMBRE FROM productos_terminados WHERE ID_PRODUCTO = '$idProductEliminar'");
                            $llamarNombreEliminar = $nombreEliminar->fetch_assoc();                            
                            $scriptEliminarProduct = "DELETE FROM productos_terminados WHERE ID_PRODUCTO = '$idProductEliminar'";
                            if($miconex->query($scriptEliminarProduct) === true){
                                ?>
                                <script>
                                    alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE']; ?>, se borró correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("productos_in.php");                                    
                                </script>  
                                <?php
                            }else{
                                $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                                ?>
                                <script>
                                    alert("Error al Eliminar registro: <?php echo $error; ?>");                                                   
                                </script>                                  
                                <?php               
                            }            
                            $nombreEliminar->close();
                        }
                        
                        if (isset($_REQUEST['btnAgregar'])){

                            ?>
                            <meta http-equiv="refresh" content="0;url=productos_in.php">
                            <?php
                        }

                        if($resultado = $miconex->query($scriptSelectProductIn)){                                                     
                                ?>
                            <div class="div_tabla" style="overflow: auto;">
                                <table border="1" class="tablaRegistros">
                                    <tr>
                                        <td><b>&nbsp;ID</b>&nbsp;</td>
                                        <td><b>&nbsp;Nombre&nbsp;</b></td>
                                        <td><b>&nbsp;Sede</b>&nbsp;</td>
                                        <td><b>&nbsp;Cantidad&nbsp;</b></td>
                                        <td><b>&nbsp;Precio de Compra&nbsp;</b></td>
                                        <td><b>&nbsp;Precio de Venta al Mayor&nbsp;</b></td>
                                        <td><b>&nbsp;Precio de Venta al Menor&nbsp;</b></td>
                                        <td><b>&nbsp;Fecha de Ingreso&nbsp;</b></td>
                                        <td><b>&nbsp;Acción&nbsp;</b></td>
                                    </tr>                            
                            <?php                             
                            while ($fila = $resultado->fetch_assoc()){
                                $idsede = $fila['ID_SEDE'];                                
                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede';";
                                $resultado2 = $miconex->query($scriptSelectNombreSedes);
                                $columSedes = $resultado2->fetch_assoc();                        
                            ?>                    
                                    <form value="<?php echo $fila['ID_INGRESO'];?>" id="<?php echo $fila['ID_INGRESO'];?>" action='productos_in.php' method='post'>
                                        <tr>
                                            <td><b>&nbsp;<?php echo $fila['ID_INGRESO'];?>&nbsp;</b></td>
                                            <td>&nbsp;<?php echo $fila['NOMBRE'];?>&nbsp;</td>                                            
                                            <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>                                            
                                            <td>&nbsp;<?php echo $fila['CANTIDAD'];?>&nbsp;</td>                                           
                                            <td>&nbsp;<?php echo $fila['PRECIO_COMPRA'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['PRECIO_VENTAMAX'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['PRECIO_VENTAMIN'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['FECHA_REGISTRO'];?>&nbsp;</td>
                                            <td class="tdBotonTabla">                                                                                                
                                                <button type="submit" id="<?php echo $fila['ID_INGRESO'];?>" value="<?php echo $fila['ID_INGRESO'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                                <button type="submit" id="<?php echo $fila['ID_INGRESO'];?>" value="<?php echo $fila['ID_INGRESO'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                                            
                                            </td>
                                        </tr>
                                    </form>
                            <?php
                            $resultado2->close();
                            }?>	
                                </table>
                            </div>
                        <?php                    	                  
                            $resultado->close();                            
                        }                        
                        $miconex->close();
                        ?>
                <script>                                             
                    function llenarDatos(e){
                        var id = e.id;
                        console.log(id);
                        var formulario = document.getElementById(id);
                        formulario.submit();
                    }
                    function Confirmar(e){
                    var mensaje = "¿Esta seguro de eliminar este registro?";

                        if (!confirm(mensaje)){                    
                        e.preventDefault();                   
                        }
                    }
                </script>                
            </div>
        </div>
        <script src="../js/predeterminado.js"></script>
    </body>
</html>