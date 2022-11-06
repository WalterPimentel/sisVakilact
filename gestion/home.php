<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-logo.png">
    <title >Sistema Web Vakilact</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
    <body style="display: flex;">
        <?php
            include_once '../includes/admin_session.php';
            include_once '../includes/admin.php';
            include_once '../includes/conexiones.php';            
            
            ?>
            <div style="display: none;">
            <?php
    
            $userSession = new UserSession();
            $user = new User();
    
            ?>
            </div>
            <?php
            
            if(isset($_SESSION['CORREO'])){
                $user->setUser($userSession->getCurrentUser());
                $userSession->closeSessionAuto();
                if($_SESSION['ID_ROL'] != 1){
                    //$userSession->closeSession();
                    header("location: ../index.php");
                }
            }else if(!isset($_SESSION['CORREO'])){
                $userSession->closeSession();
                header('location: ../index.php');
            }                      

            $miconex  = miConexionBD();
            $conectar = ConectarBD();
            
            if (isset($_REQUEST['btnCancelar'])){
        ?>
                <script>                 
                    e.preventDefault();                                                                                       
                </script>
                <meta http-equiv="refresh" >
                <!--<meta http-equiv="refresh" content="0;url=productos.php">-->
        <?php
            }
            $idSede = $user->getSede();
            $queryMostrarNombreSede = "SELECT NOMBRE FROM sedes WHERE ID_SEDE = '$idSede'";
            $ejecutarMostrarNombreSede = $miconex->query($queryMostrarNombreSede);
            $nombreSede = $ejecutarMostrarNombreSede->fetch_assoc();

            $idRol = $user->getPuesto();
            $queryMostrarRol = "SELECT ROL FROM roles WHERE ID_ROL = '$idRol'";
            $ejecutarMostrarRol = $miconex->query($queryMostrarRol);
            $Rol = $ejecutarMostrarRol->fetch_assoc();
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
        <div style="margin-top: 83px;">
        <article class="article1">
            Usuario
        </article>
            <nav class="nav1">                            
                <Table style="min-width: 226px; max-width: 226px; margin-left: -7px;">
                    <tbody>
                        <tr style=" text-align: justify;">
                            <td style="font-weight: bold;"><?php echo $user->getNombre(); echo " ".$user->getApellido_p(); echo " ".$user->getApellido_m(); ?></td>
                        </tr>
                        <tr style=" text-align: justify;">                            
                            <td style="color: rgb(32, 201, 151);">Puesto: <?php echo $Rol['ROL']; ?></td>                            
                        </tr>
                        <tr style=" text-align: justify;">
                            <td style="color:rgb(0, 192, 239);">Sede: <?php echo $nombreSede['NOMBRE']; ?></td> 
                        </tr>
                        <tr>                            
                            <td colspan="2"><a href="../includes/logout.php"><button class="btnLateral">Cerrar sesión</button></a></td>
                        </tr>
                        <!--
                        <tr>
                            <td colspan="2"><button style="margin-top: 4px;" value="<?php //echo $idAdmin = $user->getIdAdmin(); ?>">Editar Perfil</button></td>
                        </tr>
                        -->
                    </tbody>
                </Table>
            </nav>
            <article class="article1">
                        Men&uacute; Principal
            </article>
            <nav class="nav2">
                <table class="tablaLateral"> <!-- Para el hosting eliminar "/sisVakilact" para el redirecionamiento -->

                        <tr class="trLateral">
                            <td onclick = "location='home.php'" class="linkLateral">Página Principal</td>
                        <tr class="trLateral">
                            <td onclick = "location='usuarios.php'" class="linkLateral">Usuarios</td>
                        <tr class="trLateral">
                            <td  onclick = "location='sedes.php'" class="linkLateral">Sedes</td>
                        <tr class="trLateral">
                            <td  onclick = "location='productos.php'" class="linkLateral">Productos</td>
                        <tr class="trLateral">                    
                            <td  onclick = "location='productos_in.php'" class="linkLateral">Ingreso Productos</td>
                        <tr class="trLateral">
                            <td  onclick = "location='clientes.php'" class="linkLateral">Clientes</td>
                        <tr class="trLateral">
                            <td  onclick = "location='ventas.php'" class="linkLateral">Ventas</td>
                        <tr class="trLateral">
                            <td  onclick = "location='proveedores.php'" class="linkLateral">Proveedores</td>
                        <tr class="trLateral">
                            <td  onclick = "location='insumos.php'" class="linkLateral">Insumos</td>
                        <tr class="trLateral">
                            <td  onclick = "location='insumos_in.php'" class="linkLateral">Ingreso Insumos</td>
                        <tr class="trLateral">
                            <td  onclick = "location='insumos_out.php'" class="linkLateral">Salida Insumos</td>
                            <!--<button type="submit" name="btnOutInsumos" class="btnLateral">Salida Insumos</button>-->

                </table>
            </nav>
        </div>
        <header>
            <div style="position: absolute; left: 7px; top: 7px;">
                <img src="../imagenes/icono-logo.png" style="width: 100px;">
            </div>
            <div>
                <h1 >Sistema WEB Vakilact</h1>
            </div>
        </header>
        <?php
        /*if(isset($_POST['btnPrincipal'])){            
            header('location: home.php');
        }elseif(isset($_POST['btnUsuarios'])){
            require_once 'usuarios.php';
        }elseif(isset($_POST['btnSedes'])){                        
            require_once 'sedes.php';
        }elseif(isset($_POST['btnProductos'])){                        
            require_once 'productos.php';
        }elseif(isset($_POST['btnInproductos'])){                        
            require_once 'productos_in.php';
        }elseif(isset($_POST['btnClientes'])){                        
            require_once 'clientes.php';
        }elseif(isset($_POST['btnVentas'])){                        
            require_once 'ventas.php';
        }elseif(isset($_POST['btnProveedores'])){                        
            require_once 'proveedores.php';
        }elseif(isset($_POST['btnInsumos'])){                        
            require_once 'insumos.php';
        }elseif(isset($_POST['btnInInsumos'])){            
            require_once 'insumos_in.php';
        }elseif(isset($_POST['btnOutInsumos'])){                        
            require_once 'insumos_out.php';
        }*/
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
    </body>
</html>