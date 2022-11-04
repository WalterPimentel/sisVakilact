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
            
            $userSession = new UserSession();
            $user = new User();

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
                            <td colspan="2"><a href="../includes/logout.php"><button class="btnLateral" style="margin-top: 4px;">Cerrar sesión</button></a></td>
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
                    <form method="POST">
                        <tr class="trLateral">
                            <td><button type="submit" name="btnPrincipal" class="btnLateral">Página Principal</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnUsuarios" class="btnLateral">Usuarios</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnSedes" class="btnLateral">Sedes</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnProductos" class="btnLateral">Productos</button></a></td>
                        <tr class="trLateral">                    
                            <td><button type="submit" name="btnInproductos" class="btnLateral">Ingreso Productos</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnClientes" class="btnLateral">Clientes</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnVentas" class="btnLateral">Ventas</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnProveedores" class="btnLateral">Proveedores</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnInsumos" class="btnLateral">Insumos</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnInInsumos" class="btnLateral">Ingreso Insumos</button></a></td>
                        <tr class="trLateral">
                            <td><button type="submit" name="btnOutInsumos" class="btnLateral">Salida Insumos</button></a></td>
                    </form>
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
        if(isset($_POST['btnPrincipal'])){
            include_once 'home.php';
        }elseif(isset($_POST['btnUsuarios'])){
            include_once 'usuarios.php';
        }elseif(isset($_POST['btnSedes'])){
            include_once 'sedes.php';
        }elseif(isset($_POST['btnProductos'])){
            include_once 'productos.php';
        }elseif(isset($_POST['btnInproductos'])){
            include_once 'productos_in.php';
        }elseif(isset($_POST['btnClientes'])){
            include_once 'clientes.php';
        }elseif(isset($_POST['btnVentas'])){
            include_once 'ventas.php';
        }elseif(isset($_POST['btnProveedores'])){
            include_once 'proveedores.php';
        }elseif(isset($_POST['btnInsumos'])){
            include_once 'insumos.php';
        }elseif(isset($_POST['btnInInsumos'])){
            include_once 'insumos_in.php';
        }elseif(isset($_POST['btnOutInsumos'])){
            include_once 'insumos_out.php';
        }
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