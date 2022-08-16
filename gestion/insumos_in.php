<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >Insumos</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>    
    <body>
        <?php

use LDAP\Result;

            require_once("../index.php");
            $scriptSelectInsum = "SELECT * FROM insumos ORDER BY NOMBRE_PRODCUTO ASC";
            $scriptSelectInsumIn = "SELECT * FROM insumos_in ORDER BY ID_inINSUMO DESC";
            if (isset($_REQUEST['btnCancelar'])){
                ?>
                <meta http-equiv="refresh" content="0;url=insumos_in.php">                                    
                <?php
            }
        ?>
        <div class="divGeneral" style="margin-top: 100px;">            
            <div class="divGestion">                            
                <div class="divRegsitro">
                    <form action="insumos_in.php" method="POST">
                        <h1>Gestión Entrada de Insumos</h1>
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
                                                        if($resultado = mysqli_query($miconex, $scriptSelectInsum)){   
                                                            while ($fila = mysqli_fetch_assoc($resultado)){
                                                                $idsede = $fila['ID_SEDE'];                                
                                                                $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                                                $resultado2 = mysqli_query($miconex, $scriptSelectNombreSedes);
                                                                $columSedes = mysqli_fetch_assoc($resultado2);                                                                    
                                                                ?>                                                                
                                                                <option value="<?php echo $fila['ID_INSUMO'];?>"><?php echo $fila['NOMBRE_PRODCUTO'];?> - <?php echo $columSedes['NOMBRE'];?></option>
                                                                <?php    
                                                            }                                                             
                                                        }
                                                        ?>
                                                    </select>
                                                </form>
                                            </td>                                                 
                                            <td class="tdGestion">Cantidad<input type="number" name="txtCant" min="1" required></td>
                                            <td class="tdGestion">Precio de Compra<input type="number" name="txtPC" min="0" step="any" required></td>
                                            <td class="tdGestion">Proveedor                                                                                           
                                                <select class="seleccion" name="slctProve">
                                                    <?php
                                                    $scriptSelectProv = "SELECT ID_PROVEDOR, RAZON_SOCIAL FROM proveedores";                                                                                                
                                                    $stmt2 = mysqli_query($miconex, $scriptSelectProv);                                          
                                                    while($dats = mysqli_fetch_assoc($stmt2)){                                                                                                                             
                                                        ?>
                                                        <option value="<?php echo $dats['ID_PROVEDOR'];  ?>"><?php echo $dats['RAZON_SOCIAL']; ?></option>
                                                        <?php                                                            
                                                    }
                                                    $stmt2=null;
                                                    $conectar2=null;
                                                    ?>
                                                </select>                                               
                                            </td>
                                            <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" id="fechaActual"></td>                                                                                                                                                                          
                                        </tr>                                            
                                        <tr>
                                            <td class="tdGestion" colspan="5">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                        </tr>
                                    </table>
                                                <?php 
                                                }elseif(isset($_REQUEST['btnEditar'])){

                                                    $IDINGRESO = $_POST['btnEditar'];
                                                    $scriptSelectIngresoporID = "SELECT * FROM insumos_in WHERE ID_inINSUMO ='$IDINGRESO'";                                             
                                                    $llenarDatosIngreso = mysqli_query($miconex, $scriptSelectIngresoporID);
                                                    $llenado = mysqli_fetch_assoc($llenarDatosIngreso);

                                                    $idsede = $llenado['ID_SEDE'];
                                                    $idinsum = $llenado['ID_INSUMO'];

                                                    $scriptSelectInsumporIDnoDef = "SELECT * FROM insumos WHERE NOT ID_INSUMO ='$idinsum'";
                                                    $scriptSelectInsumoporIDDef = "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO ='$idinsum'";
                                                    $scriptSelectSedeporIDDef = "SELECT NOMBRE FROM sedes WHERE ID_SEDE ='$idsede'";

                                                ?>
                                    <table>
                                        <input type="hidden" name="txtID" value="<?php echo $llenado['ID_inINSUMO'];?>">                                            
                                        <tr>                                                
                                            <td class="tdGestion">Producto Entrante y Lugar
                                                <form>                                            
                                                    <select class="seleccion" name="slctProduct" disabled>
                                                        <?php
                                                            if($resultado = mysqli_query($miconex, $scriptSelectInsumporIDnoDef)){

                                                                $resultado2=mysqli_query($miconex, $scriptSelectInsumoporIDDef);
                                                                $llenarInsumDef= mysqli_fetch_assoc($resultado2);
                                                                $resultado3=mysqli_query($miconex, $scriptSelectSedeporIDDef);
                                                                $llenarSedeDef= mysqli_fetch_assoc($resultado3);
                                                                ?>
                                                                <option value="<?php echo $llenado['ID_inINSUMO'];?>" selected><?php echo $llenarInsumDef['NOMBRE_PRODCUTO'];?> - <?php echo $llenarSedeDef['NOMBRE'];?></option>
                                                                <?php
                                                                while ($fila = mysqli_fetch_assoc($resultado)){
                                                                    $idsede = $fila['ID_SEDE'];
                                                                    $idinsum = $fila['ID_INSUMO'];
                                                                    
                                                                    $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede'";
                                                                    $resultado4 = mysqli_query($miconex, $scriptSelectNombreSedes);
                                                                    $columSedes = mysqli_fetch_assoc($resultado4);

                                                                    $scriptSelectNombreInsum = "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO = '$idinsum'";
                                                                    $resultado5 = mysqli_query($miconex, $scriptSelectNombreInsum);
                                                                    $columInsum = mysqli_fetch_assoc($resultado5);                                                                    
                                                                    ?>                                                                
                                                                    <option value="<?php echo $llenado['ID_INGRESO'];?>"><?php echo $columInsum['NOMBRE_PRODCUTO'];?> - <?php echo $columSedes['NOMBRE'];?></option>
                                                                    <?php                                                                          
                                                                } 
                                                            }
                                                        ?>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="tdGestion">Cantidad<input type="text"  name="txtCant" value="<?php echo $llenado['CANTIDAD'];?>" min="1" disabled ></td>
                                            <td class="tdGestion">Precio de Compra<input type="number" name="txtPC"value="<?php echo $llenado['P_COMPRA'];?>" min="0" step="any" ></td>
                                            <td class="tdGestion">Proveedor                                         
                                                <select class="seleccion" name="slctProve">
                                                    <?php
                                                        $scriptSelectSedesDef = "SELECT ID_PROVEDOR, RAZON_SOCIAL FROM proveedores WHERE ID_PROVEDOR = '$llenado[ID_PROVEDOR]'";  
                                                        $stmt2 = mysqli_query($miconex, $scriptSelectSedesDef);
                                                        $llenado2 = mysqli_fetch_assoc($stmt2); 
                                                    ?>
                                                    <option value="<?php echo $llenado2['ID_PROVEDOR'];  ?>" selected><?php echo $llenado2['RAZON_SOCIAL']; ?></option>                                                            
                                                    <?php
                                                    $scriptSelectProvee = "SELECT ID_PROVEDOR, RAZON_SOCIAL FROM proveedores WHERE NOT ID_PROVEDOR = '$llenado[ID_PROVEDOR]'";                                                                                                
                                                    $stmt = $conectar->prepare($scriptSelectProvee);
                                                    $ejecucion = $stmt->execute();
                                                    $datos=$stmt->fetchAll(\PDO::FETCH_OBJ);                                                
                                                    foreach($datos as $dato){
                                                        ?>
                                                        <option value="<?php print($dato->ID_PROVEDOR);  ?>"><?php print($dato->RAZON_SOCIAL); ?></option>
                                                        <?php                                                                  
                                                    }
                                                    $stmt=null;
                                                    $conectar=null;
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="tdGestion">Fecha de Ingreso<input type="date" name="txtFechaIngreso" value="<?php echo $llenado['F_INGRESO'];?>"></td>
                                        </tr>                                         
                                        <tr>
                                            <td class="tdGestion" colspan="6">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                            <?php
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
                        $idinsum = $_POST['slctProduct'];
                        $scriptSelectProductId ="SELECT ID_SEDE, NOMBRE_PRODCUTO, STOCK FROM insumos WHERE ID_INSUMO = '$idinsum';";
                        $resultado = mysqli_query($miconex, $scriptSelectProductId);
                        $fila = mysqli_fetch_assoc($resultado);                        
                        $idsede = $fila['ID_SEDE'];                                                                                                         
                        $cantidad = intval($_POST['txtCant']);
                        $prov = $_POST['slctProve'];
                        $PCompra=$_POST['txtPC'];
                        $fechaRegistro = $_POST['txtFechaIngreso'];                
                        
                        $scriptInsertInsumIn = "INSERT INTO insumos_in (ID_INSUMO, ID_SEDE, CANTIDAD, ID_PROVEDOR, P_COMPRA, F_INGRESO)
                                                            VALUES ('$idinsum', '$idsede', '$cantidad', '$prov', '$PCompra', '$fechaRegistro');";

                        $stockP = intval($fila['STOCK']);
                        $suma = intval($cantidad+$stockP);                            
                        $scriptInsertStockInsum = "UPDATE insumos SET STOCK = '$suma' WHERE ID_INSUMO = '$idinsum';";


                        if((mysqli_query($miconex, $scriptInsertStockInsum) === true) and mysqli_query($miconex, $scriptInsertInsumIn) === true){                                
                            ?>
                            <script>
                                alert("¡Exito!, Los datos se registraron correctamente");                                                                                                                   
                            </script>
                            <meta http-equiv="refresh" content="0;url=insumos_in.php">                                  
                            <?php                                                              
                        }else{
                            $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                            ?>                                
                            <script>
                                alert("Error al Registrar datos: <?php echo $error; ?>");                                                   
                            </script>                                  
                            <?php
                        }                                                           
                    }                                                
                                            
                    if (isset($_REQUEST['btnModificar'])){
                        $id= $_POST['txtID'];

                        $PCompra=$_POST['txtPC'];
                        $prov = $_POST['slctProve'];
                        $fechaRegistro = $_POST['txtFechaIngreso'];                            

                        $scriptModificarProduct ="UPDATE insumos_in SET P_COMPRA = '$PCompra', ID_PROVEDOR = '$prov', F_INGRESO = '$fechaRegistro'
                                                                            WHERE ID_inINSUMO = '$id'";                                                                        

                        if(mysqli_query($miconex, $scriptModificarProduct) === true){
                ?>
                            <script>
                                alert("¡Exito!, Los datos se actualizaron correctamente");                                    
                            </script>
                            <meta http-equiv="refresh" content="0;url=insumos_in.php">
                            <?php
                        }else{
                            $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                            ?>
                            <script>
                                alert("Error al Modificar datos: <?php echo $error; ?>");                                                   
                            </script>                                  
                            <?php               
                        }  
                    }

                    if (isset($_REQUEST['btnEliminar'])){   
                        
                        $idinsumEliminar = $_POST['btnEliminar'];
                        $scriptSelectCanridadIngreso= mysqli_query($miconex, "SELECT CANTIDAD, ID_INSUMO FROM insumos_in WHERE ID_inINSUMO = '$idinsumEliminar'");
                        $cantidadSale = mysqli_fetch_assoc($scriptSelectCanridadIngreso);
                        $sustraendo = intval($cantidadSale['CANTIDAD']);
                        $idinsum=$cantidadSale['ID_INSUMO'];

                        $nombreEliminar= mysqli_query($miconex, "SELECT NOMBRE_PRODCUTO, STOCK FROM insumos WHERE ID_INSUMO = '$idinsum'");
                        $llamarNombreEliminar = mysqli_fetch_assoc($nombreEliminar);
                        $minunedo = intval($llamarNombreEliminar['STOCK']);
                        $stock= intval($minunedo-$sustraendo);
                        $ScriptRestarStock="UPDATE insumos SET STOCK = '$stock' WHERE ID_INSUMO = '$idinsum'";
                                        
                        $scriptEliminarInsum = "DELETE FROM insumos_in WHERE ID_inINSUMO = '$idinsumEliminar'";

                        if(mysqli_query($miconex, $scriptEliminarInsum) === true and mysqli_query($miconex, $ScriptRestarStock) === true){
                            ?>
                            <script>
                                alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE_PRODCUTO']; ?>, se borró correctamente");                                                   
                            </script>
                            <meta http-equiv="refresh" content="0;url=insumos_in.php">                                 
                            <?php
                        }else{
                            $error = mysqli_error($miconex)." Error número: ".mysqli_errno($miconex);
                            ?>
                            <script>
                                alert("Error al Eliminar registro: <?php echo $error; ?>");                                                   
                            </script>                                                                  
                            <?php               
                        }            
                    }                        

                    if($resultado = mysqli_query($miconex, $scriptSelectInsumIn)){                                                     
                            ?>
                        <div class="div_tabla" style="overflow: auto;">
                            <table border="1" class="tablaRegistros">
                                <tr bgcolor="4C4C4C" style="color: white;">
                                    <td><b>&nbsp;ID</b>&nbsp;</td>
                                    <td><b>&nbsp;Nombre&nbsp;</b></td>
                                    <td><b>&nbsp;Sede</b>&nbsp;</td>
                                    <td><b>&nbsp;Cant.&nbsp;</b></td>
                                    <td><b>&nbsp;P. Compra&nbsp;</b></td>
                                    <td><b>&nbsp;Proveedor&nbsp;</b></td>
                                    <td><b>&nbsp;F. Ingreso&nbsp;</b></td>
                                    <td><b>&nbsp;Acción&nbsp;</b></td>
                                </tr>                            
                        <?php
                        $c=1;                             
                        while ($fila = mysqli_fetch_assoc($resultado) and $c >= 1){

                            $idsede = $fila['ID_SEDE'];                                                                  
                            $scriptSelectNombreSedes = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idsede';";
                            $resultado2 = mysqli_query($miconex, $scriptSelectNombreSedes);
                            $columSedes = mysqli_fetch_assoc($resultado2);
                            
                            $idinsum = $fila['ID_INSUMO'];
                            $scriptSelectNombreInsum = "SELECT NOMBRE_PRODCUTO FROM insumos WHERE ID_INSUMO = '$idinsum'";
                            $resultado3 = mysqli_query($miconex, $scriptSelectNombreInsum);
                            $columInsum = mysqli_fetch_assoc($resultado3);

                            $idprov = $fila['ID_PROVEDOR'];
                            $ejecutariDProv = mysqli_query($miconex, "SELECT RAZON_SOCIAL FROM proveedores WHERE ID_PROVEDOR = '$idprov'");
                            $nombreProv = mysqli_fetch_assoc($ejecutariDProv);

                        ?>                    
                                <form value="<?php echo $fila['ID_inINSUMO'];?>" id="<?php echo $fila['ID_inINSUMO'];?>" action='insumos_in.php' method='post'>
                                    <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">                                            
                                        <td style="display: none;"><?php $c++; ?></td>
                                        <td><b>&nbsp;<?php echo $fila['ID_inINSUMO'];?>&nbsp;</b></td>
                                        <td>&nbsp;<?php echo $columInsum['NOMBRE_PRODCUTO'];?>&nbsp;</td>                                            
                                        <td>&nbsp;<?php echo $columSedes['NOMBRE'];?>&nbsp;</td>                                            
                                        <td>&nbsp;<?php echo $fila['CANTIDAD'];?>&nbsp;</td>                                           
                                        <td>&nbsp;<?php echo "S/. ".$fila['P_COMPRA'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $nombreProv['RAZON_SOCIAL'];?>&nbsp;</td>
                                        <td>&nbsp;<?php echo $fila['F_INGRESO'];?>&nbsp;</td>
                                        <td class="tdBotonTabla">                                                                                                
                                            <button type="submit" id="<?php echo $fila['ID_inINSUMO'];?>" value="<?php echo $fila['ID_inINSUMO'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                            <button type="submit" id="<?php echo $fila['ID_inINSUMO'];?>" value="<?php echo $fila['ID_inINSUMO'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                                            
                                        </td>
                                    </tr>
                                </form>
                        <?php
                        }?>	
                            </table>
                        </div>
                    <?php                    	                                        
                    }                        
                    mysqli_close($miconex);
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
        <script src="../js/funciones.js"></script>
    </body>
</html>