<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >Proveedores</title>
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
        }elseif($_SESSION['ID_ROL'] == 3){
            require_once 'mProdu.php';  
        }else{
            header("location: ../index.php");
        }

        $miconex  = miConexionBD();
        $conectar = ConectarBD();  
        $scriptSelectProve = "SELECT * FROM proveedores";
        ?>
        <div class="divGeneral">
            <div class="divGestion">                            
                <div class="divRegsitro">
                    <form action="proveedores.php" method="POST">
                        <h1>Gestión Proveedores</h1>
                        <fieldset class="containerGestion">
                            <article>
                                <section>
                                    <table>
                                        <tr>
                                            <?php 
                                                if (!isset($_REQUEST['btnEditar'])){                                            
                                            ?>
                                            <input type="hidden" name="txtID">
                                            <td class="tdGestion">RUC<input type="text" name="txtRUC" minlength="11" maxlength="11" pattern="[0-9]+" required></td>
                                            <td class="tdGestion">Razón Social<input type="text" name="txtRazonSocial"></td>
                                            <td class="tdGestion">Nombre Contacto<input type="text" name="txtNombreContacto" required></td>
                                        </tr>
                                        <tr>
                                            <td class="tdGestion">Telefono<input type="text" name="txtTelefono" minlength="9" pattern="[0-9]+" required></td>
                                            <td class="tdGestion">Dirección<input type="text" name="txtDireccion"></td>
                                            <td class="tdGestion">Correo<input type="text" name="txtCorreo" placeholder="nombre@dominio.com"></td>                                                                                                                        
                                        </tr>
                                        <tr>                                            
                                            <td class="tdGestion" colspan="3">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones">
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones" disabled>
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                                <?php 
                                                }elseif(isset($_REQUEST['btnEditar'])){
                                                    $IDPROVE = $_POST['btnEditar'];
                                                    $scriptSelectProveporID = "SELECT * FROM proveedores WHERE ID_PROVEDOR ='$IDPROVE'";                                             
                                                    $llenarDatosProve = $miconex->query($scriptSelectProveporID);
                                                    $llenado = $llenarDatosProve->fetch_assoc();
                                                ?>
                                            <input type="hidden" name="txtID" value="<?php echo $llenado['ID_PROVEDOR'];?>">
                                            <td class="tdGestion">RUC<input type="text" name="txtRUC" value="<?php echo $llenado['RUC'];?>" require></td>
                                            <td class="tdGestion">Razón Social<input type="text" name="txtRazonSocial" value="<?php echo $llenado['RAZON_SOCIAL'];?>" require></td>
                                            <td class="tdGestion">Nombre Contacto<input type="text" name="txtNombreContacto" value="<?php echo $llenado['NOMBRE_CONTACTO'];?>" ></td>                                                                                            
                                        </tr>
                                        <tr>
                                            <td class="tdGestion">Telefono<input type="text" minlength="9" pattern="[0-9]+" name="txtTelefono" value="<?php echo $llenado['TELEFONO'];?>"></td>
                                            <td class="tdGestion">Dirección<input type="text" name="txtDireccion" value="<?php echo $llenado['DIRECCION'];?>"></td>
                                            <td class="tdGestion">Correo<input type="text" name="txtCorreo" value="<?php echo $llenado['EMAIL'];?>"></td>                                                                                                                                                                    
                                        </tr>
                                        <tr>
                                            <td class="tdGestion" colspan="3">
                                                <input type="submit" value="Registrar" id="btnRegistrar" name="btnRegistrar" class="Botones" disabled>
                                                <input type="submit" value="Modificar" id="btnModificar" name="btnModificar" class="Botones">
                                                <input type="submit" value="Cancelar" id="btnCancelar" name="btnCancelar" class="Botones">
                                            </td>
                                            <?php
                                                    $llenarDatosProve->close();
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
                    <form action="proveedores.php" method="GET">
                        <input type="text" id="txtBuscar" class="txtBuscar" placeholder="Buscar por DNI, apellido o nombre" maxlength="64">
                        <input type="submit" value="Buscar" name="btnBuscar" class="Botones">
                    </form>
                </div>
                    <?php 
                        if (isset($_REQUEST['btnRegistrar'])){
                            $RUC = $_POST['txtRUC'];
                            $razonSocial = $_POST['txtRazonSocial'];
                            $nombre = $_POST['txtNombreContacto'];
                            $telefono = $_POST['txtTelefono'];
                            $direccion = $_POST['txtDireccion'];
                            $correo = $_POST['txtCorreo'];
                            
                            $scriptInsertProve = "INSERT INTO proveedores (RUC, RAZON_SOCIAL, NOMBRE_CONTACTO, TELEFONO, DIRECCION, EMAIL)
                                                                VALUES('$RUC', '$razonSocial', '$nombre', '$telefono', '$direccion', '$correo')";

                            if($miconex->query($scriptInsertProve) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se registraron correctamente");                                                                                
                                    e.preventDefault();                                                                   
                                    window.location.replace("proveedores.php");                                    
                                </script>                                  
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
                            $id = $_POST['txtID'];
                            $RUC = $_POST['txtRUC'];
                            $razonSocial = $_POST['txtRazonSocial'];
                            $nombre = $_POST['txtNombreContacto'];
                            $telefono = $_POST['txtTelefono'];
                            $direccion = $_POST['txtDireccion'];
                            $correo = $_POST['txtCorreo'];

                            $scriptModificarProve ="UPDATE proveedores SET RUC ='$RUC', RAZON_SOCIAL ='$razonSocial', NOMBRE_CONTACTO ='$nombre', 
                                                                            TELEFONO ='$telefono', DIRECCION ='$direccion', EMAIL ='$correo'
                                                                            WHERE ID_PROVEDOR = '$id'";

                            if($miconex->query($scriptModificarProve) === true){
                    ?>
                                <script>
                                    alert("¡Exito!, Los datos de: <?php echo $nombre; ?>, se actualizaron correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("proveedores.php");                                    
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
                            $idProveEliminar = $_POST['btnEliminar'];
                            $nombreEliminar= $miconex->query("SELECT NOMBRE_CONTACTO FROM proveedores WHERE ID_PROVEDOR = '$idProveEliminar'");
                            $llamarNombreEliminar = $nombreEliminar->fetch_assoc();                            
                            $scriptEliminarProve = "DELETE FROM proveedores WHERE ID_PROVEDOR = '$idProveEliminar'";
                            
                            if($miconex->query($scriptEliminarProve) === true){
                                ?>
                                <script>
                                    alert("¡Exito!, El registro de: <?php echo $llamarNombreEliminar['NOMBRE']; ?>, se borró correctamente");                 
                                    e.preventDefault();                                                                   
                                    window.location.replace("proveedores.php");                                    
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

                        if($resultado = $miconex->query($scriptSelectProve)){                                                     
                                ?>
                            <div class="div_tabla" style="overflow: auto;">
                                <table border="1" class="tablaRegistros">
                                    <tr bgcolor="4C4C4C" style="color: white;">
                                        <td><b>&nbsp;ID&nbsp;</b></td>
                                        <td><b>&nbsp;RUC</b>&nbsp;</td>
                                        <td><b>&nbsp;Razón Social&nbsp;</b></td>
                                        <td><b>&nbsp;Nombre de Contacto&nbsp;</b></td>
                                        <td><b>&nbsp;Teléfono&nbsp;</b></td>
                                        <td><b>&nbsp;Dirección&nbsp;</b></td>
                                        <td><b>&nbsp;Correo&nbsp;</b></td>
                                        <td><b>&nbsp;Accción&nbsp;</b></td>
                                    </tr>                            
                            <?php
                            $c=1;                             
                            while ($fila = $resultado->fetch_assoc() and $c >= 1){                   
                            ?>                    
                                    <form value="<?php echo $fila['ID_PROVEDOR'];?>" id="<?php echo $fila['ID_PROVEDOR'];?>" action='proveedores.php' method='post'>
                                        <tr bgcolor = "<?php if(intval($c)%2==0) echo 'E6E6E6';else echo 'white' ?>">                                            
                                            <td style="display: none;"><?php $c++; ?></td>
                                            <td><b>&nbsp;<?php echo $fila['ID_PROVEDOR'];?>&nbsp;</b></td>
                                            <td>&nbsp;<?php echo $fila['RUC'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['RAZON_SOCIAL'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['NOMBRE_CONTACTO'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['TELEFONO'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['DIRECCION'];?>&nbsp;</td>
                                            <td>&nbsp;<?php echo $fila['EMAIL'];?>&nbsp;</td>
                                            <td class="tdBotonTabla">
                                                <button type="submit" id="<?php echo $fila['ID_PROVEDOR'];?>" value="<?php echo $fila['ID_PROVEDOR'];?>" name="btnEditar" class="btnTabla" onclick="llenarDatos(this)">Editar</button>
                                                <button type="submit" id="<?php echo $fila['ID_PROVEDOR'];?>" value="<?php echo $fila['ID_PROVEDOR'];?>" name="btnEliminar" class="btnTabla" onclick="Confirmar(event)">Borrar</button>                  
                                            </td>
                                        </tr>
                                    </form>
                            <?php
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
                                <form action="fpdf/reportprovee.php" method="POST">
                                    <button type="submit" name="btnReporteProvee" class="Botones">Reporte en PDF</button>            
                                </form>
                            </td>
                            <td>
                                <form action="reportproveexl.php" method="POST">
                                    <button type="submit" name="btnReporteProveexl" class="Botones">Reporte en Excel</button>            
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>                
            </div>
        </div>
        <script src="../js/predeterminado.js"></script>
    </body>
</html>