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

        include_once '../includes/conexiones.php';
        include_once '../includes/admin_session.php';
        include_once '../includes/admin.php';

        ?>
        <div style="display: none;">
        <?php

        $userSession = new UserSession();
        $user = new User();

        ?>
        </div>
        <?php

        if($_SESSION['ID_ROL'] == 1){
            require_once 'home.php';   
        }elseif($_SESSION['ID_ROL'] == 2){
            require_once 'principal.php';  
        }else{
            header("location: ../index.php");
        }

        $miconex  = miConexionBD();
        $conectar = ConectarBD();
        $scriptSelectProduct = "SELECT * FROM productos_terminados ORDER BY NOMBRE ASC";
        $scriptSelectProductIn = "SELECT * FROM ingreso_prodt ORDER BY ID_INGRESO DESC";
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
        <div class="divGeneral">            
            <div class="divGestion">                            
                <div class="divRegsitro">
                    <form action="productos_in.php" method="POST">
                        <h1>Gestión Entrada de Productos</h1>
                        <fieldset class="containerGestion">
                            <article class="fondoWhite">
                                <section class="fondoWhite">                   
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
                                            <td class="tdGestion">Cantidad<input type="number" name="txtCant" min="1"></td>
                                            <td class="tdGestion">Precio de Compra<input type="number" name="txtPCompra" min="0"></td>
                                            <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" id="fechaActual"></td>                                                                                                                                                                          
                                        </tr>                                            
                                        <tr>
                                            <td class="tdGestion" colspan="4">
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
                                                    <select class="seleccion" name="slctProduct" disabled>
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
                                            <td class="tdGestion">Cantidad<input type="text"  name="txtCant" value="<?php echo $llenado['CANTIDAD'];?>" min="1" disabled ></td>
                                            <td class="tdGestion">Precio de Compra<input type="number" name="txtPCompra"value="<?php echo $llenado['PRECIO_COMPRA'];?>" min="0" ></td>                                                                                                  
                                            <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['FECHA_REGISTRO'];?>"></td>
                                        </tr>                                         
                                        <tr>
                                            <td class="tdGestion" colspan="4">
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
                        $idproduct = $_POST['slctProduct'];
                        $scriptSelectProductId ="SELECT ID_SEDE, NOMBRE, STOCK FROM productos_terminados WHERE ID_PRODUCTO = '$idproduct';";
                        $resultado = $miconex->query($scriptSelectProductId);
                        $fila = $resultado->fetch_assoc();                        
                        $idsede = $fila['ID_SEDE'];                                                                                                         
                        $cantidad = $_POST['txtCant'];
                        $PCompra=$_POST['txtPCompra'];
                        $fechaRegistro = $_POST['txtFechaIngreso'];                          
                        
                        $scriptInsertProductIn = "INSERT INTO ingreso_prodt (ID_PRODUCTO, ID_SEDE, CANTIDAD, PRECIO_COMPRA, FECHA_REGISTRO)
                                                            VALUES('$idproduct', '$idsede', '$cantidad', '$PCompra', '$fechaRegistro');";

                        //$scriptSumaCantProductIn = "SELECT SUM(CANTIDAD) AS CANTIDAD FROM ingreso_prodt WHERE ID_PRODUCTO = '$idproduct' AND ID_SEDE = '$idsede'";
                        $stockP = intval($fila['STOCK']);
                        //$resultado2 = $miconex->query($scriptSumaCantProductIn);
                        //$stock = $resultado2->fetch_assoc();
                        //$nosuma = $stock['CANTIDAD'];
                        $suma = intval($cantidad+$stockP);                            
                        $scriptInsertStockProduct = "UPDATE productos_terminados SET STOCK = '$suma' WHERE ID_PRODUCTO = '$idproduct';";                                                                                     
                        $resultado->close();                                                                                    
                        //$resultado2->close();

                        if(($miconex->query($scriptInsertStockProduct) === true) and $miconex->query($scriptInsertProductIn) === true){                                
                            ?>
                            <script>
                                alert("¡Exito!, Los datos se registraron correctamente");                                                                                
                                e.preventDefault();                                                                   
                                window.location.replace("productos_in.php");                                    
                            </script>
                            <meta http-equiv="refresh" content="0;url=productos_in.php">                                  
                            <?php                                                              
                        }else{
                            $error = $miconex->error." Error número: ".mysqli_errno($miconex);
                            ?>                                
                            <script>
                                alert("Error al Registrar datos: <?php echo $error; ?>");                                                   
                            </script>                                  
                            <?php
                        }                                                           
                    }                                                
                                            
                    if (isset($_REQUEST['btnModificar'])){
                        $id= $_POST['txtID'];

                        $PCompra=$_POST['txtPCompra'];
                        $fechaRegistro = $_POST['txtFechaIngreso'];                            

                        $scriptModificarProduct ="UPDATE ingreso_prodt SET PRECIO_COMPRA = '$PCompra', FECHA_REGISTRO = '$fechaRegistro'
                                                                            WHERE ID_INGRESO = '$id'";                                                                        

                        if($miconex->query($scriptModificarProduct) === true){
                ?>
                            <script>
                                alert("¡Exito!, Los datos se actualizaron correctamente");                 
                                e.preventDefault();                                                                   
                                window.location.replace("administradores.php");                                    
                            </script>
                            <meta http-equiv="refresh" content="0;url=productos_in.php">
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
                        $scriptSelectCanridadIngreso= $miconex->query("SELECT CANTIDAD, ID_PRODUCTO FROM ingreso_prodt WHERE ID_INGRESO = '$idProductEliminar'");
                        $cantidadSale = $scriptSelectCanridadIngreso->fetch_assoc();
                        $sustraendo = intval($cantidadSale['CANTIDAD']);
                        $idProduct=$cantidadSale['ID_PRODUCTO'];

                        $nombreEliminar= $miconex->query("SELECT NOMBRE, STOCK FROM productos_terminados WHERE ID_PRODUCTO = '$idProduct'");
                        $llamarNombreEliminar = $nombreEliminar->fetch_assoc();
                        $minunedo = intval($llamarNombreEliminar['STOCK']);
                        $stock= intval($minunedo-$sustraendo);
                        $ScriptRestarStock="UPDATE productos_terminados SET STOCK = '$stock' WHERE ID_PRODUCTO = '$idProduct'";
                                        
                        $scriptEliminarProduct = "DELETE FROM ingreso_prodt WHERE ID_INGRESO = '$idProductEliminar'";

                        if($miconex->query($scriptEliminarProduct) === true and $miconex->query($ScriptRestarStock) === true){
                            ?>
                            <script>
                                alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE']; ?>, se borró correctamente");                 
                                e.preventDefault();                                                                   
                                window.location.replace("productos_in.php");                                    
                            </script>
                            <meta http-equiv="refresh" content="0;url=productos_in.php">                                 
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
                        $scriptSelectCanridadIngreso->close();
                    }                        

                    if($resultado = $miconex->query($scriptSelectProductIn)){                                                     
                            ?>
                        <div class="div_tabla" style="overflow: auto;">
                            <table border="1" class="tablaRegistros">
                                <tr bgcolor="4C4C4C" style="color: white;">
                                    <td><b>&nbsp;ID</b>&nbsp;</td>
                                    <td><b>&nbsp;Nombre&nbsp;</b></td>
                                    <td><b>&nbsp;Sede</b>&nbsp;</td>
                                    <td><b>&nbsp;Cant.&nbsp;</b></td>
                                    <td><b>&nbsp;P. Compra&nbsp;</b></td>
                                    <td><b>&nbsp;F. Ingreso&nbsp;</b></td>
                                    <td><b>&nbsp;Acción&nbsp;</b></td>
                                </tr>                            
                        <?php
                        $c=1;                             
                        while ($fila = $resultado->fetch_assoc() and $c >= 1){

                            $idsede = $fila['ID_SEDE'];                                                                  
                            $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede';";
                            $resultado2 = $miconex->query($scriptSelectNombreSedes);
                            $columSedes = $resultado2->fetch_assoc();
                            
                            $idproduct = $fila['ID_PRODUCTO'];
                            $scriptSelectNombreProduct = "SELECT NOMBRE FROM productos_terminados WHERE ID_PRODUCTO = '$idproduct'";
                            $resultado3 = $miconex->query($scriptSelectNombreProduct);
                            $columProdutc = $resultado3->fetch_assoc();

                        ?>                    
                                <form value="<?php echo $fila['ID_INGRESO'];?>" id="<?php echo $fila['ID_INGRESO'];?>" action='productos_in.php' method='post'>
                                    <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">                                            
                                        <td style="display: none;"><?php $c++; ?></td>
                                        <td><b>&nbsp;<?php echo $fila['ID_INGRESO'];?>&nbsp;</b></td>
                                        <td>&nbsp;<?php echo $columProdutc['NOMBRE'];?>&nbsp;</td>                                            
                                        <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>                                            
                                        <td>&nbsp;<?php echo $fila['CANTIDAD'];?>&nbsp;</td>                                           
                                        <td>&nbsp;<?php echo "S/. ".$fila['PRECIO_COMPRA'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['FECHA_REGISTRO'];?>&nbsp;</td>
                                        <td class="tdBotonTabla">                                                                                                
                                            <button type="submit" id="<?php echo $fila['ID_INGRESO'];?>" value="<?php echo $fila['ID_INGRESO'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                            <button type="submit" id="<?php echo $fila['ID_INGRESO'];?>" value="<?php echo $fila['ID_INGRESO'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                                            
                                        </td>
                                    </tr>
                                </form>
                        <?php
                        $resultado2->close();
                        $resultado3->close();
                        }?>	
                            </table>
                        </div>
                    <?php                    	                  
                        $resultado->close();                            
                    }                        
                    $miconex->close();
                    ?>
                <br>
                <table align="center">
                    <tbody>
                        <tr>
                            <td>
                                <form action="reporte.php" method="POST">
                                    <button type="submit" name="btnReporteInProducts" class="Botones">Reporte en PDF</button>            
                                </form>
                            </td>
                            <td>
                                <form action="reporteXL.php" method="POST">
                                    <button type="submit" name="btnReporteInProductsxl" class="Botones">Reporte en Excel</button>            
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>                
            </div>
        </div>
        <script src="../js/predeterminado.js"></script>     
        <script src="../js/funciones.js"></script>
    </body>
</html>