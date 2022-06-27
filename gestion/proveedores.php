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
            require("../index.php");
            $miconex= miConexionBD();
            $scriptSelectProve = "SELECT * FROM proveedores";
            if (isset($_REQUEST['btnCancelar'])){
        ?>
                <script>                 
                    e.preventDefault();                                                                   
                    window.location.replace("proveedores.php");
                </script>                                            
        <?php
            }
        ?>
        <script>            
            window.onload = function(){
                var fecha = new Date(); //Fecha actual
                var mes = fecha.getMonth()+1; //obteniendo mes
                var dia = fecha.getDate(); //obteniendo dia
                var ano = fecha.getFullYear(); //obteniendo año
                if(dia<10)
                    dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                    mes='0'+mes //agrega cero si el menor de 10
                document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
            }
        </script>                                                         
        <header>
            header
        </header>
        <div class="divGeneral">
            <div>
                <nav class="nav1">
                    Usuario
                </nav>
                <article class="article1">
                            Men&uacute; Principal
                </article>
                <nav class="nav2">
                    <table class="tablaLateral"> 
                        <tr class="trLateral">
                            <td><a href="dashboard.php" class="link">DashBoard</a></td>
                        <tr class="trLateral">
                            <td><a href="administradores.php" class="link">Administradores</a></td>
                        <tr class="trLateral"> 
                            <td><a href="vendedor.php" class="link">Vendedor</a></td>
                        <tr class="trLateral">
                            <td><a href="sedes.php" class="link">Sedes</a></td>
                        <tr class="trLateral">
                            <td><a href="productos.php" class="link">Productos</a></td>
                        <tr class="trLateral">                    
                            <td><a href="productos_in.php" class="link">Ingreso Productos</a></td>
                        <tr class="trLateral">
                            <td><a href="clientes.php" class="link">Clientes</a></td>
                        <tr class="trLateral">
                            <td><a href="ventas.php" class="link">Ventas</a></td>
                        <tr class="trLateral">
                            <td><a href="proveedores.php" class="link">Proveedores</a></td>
                        <tr class="trLateral">
                            <td><a href="insumos.php" class="link">Insumos</a></td>
                        <tr class="trLateral">
                            <td><a href="insumos_in.php" class="link">Ingreso Insumos</a></td>
                    </table>
                </nav>
            </div>
            <div class="divGestion">                            
                    <div class="divRegsitro">
                        <form action="proveedores.php" method="POST">
                            <fieldset class="containerGestion">
                                <legend>Registrar datos</legend>
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
                                    <tr>
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
                            while ($fila = $resultado->fetch_assoc()){                   
                            ?>                    
                                    <form value="<?php echo $fila['ID_PROVEDOR'];?>" id="<?php echo $fila['ID_PROVEDOR'];?>" action='proveedores.php' method='post'>
                                        <tr>
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