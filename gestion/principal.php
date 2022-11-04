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
                if($_SESSION['ID_ROL'] != 2){
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
                <Table border="1" style="min-width: 226px; max-width: 226px; margin-left: -7px;">
                    <tbody>
                        <tr>
                            <td><?php echo $user->getNombre(); echo " ".$user->getApellido_p(); echo " ".$user->getApellido_m(); ?></td>
                        </tr>
                        <tr>                            
                            <td>Puesto: <?php echo $Rol['ROL']; ?></td>                            
                        </tr>
                        <tr>
                            <td>Sede: <?php echo $nombreSede['NOMBRE']; ?></td> 
                        </tr>
                        <tr>                            
                            <td colspan="2"><a href="../includes/logout.php"><button style="margin-top: 4px;">Cerrar sesión</button></a></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button style="margin-top: 4px;" value="<?php echo $idAdmin = $user->getIdAdmin(); ?>">Editar Perfil</button></td>
                        </tr>
                    </tbody>
                </Table>
            </nav>
            <article class="article1">
                        Men&uacute; Principal
            </article>
            <nav class="nav2">
                <table class="tablaLateral">
                <form method="POST">
                    <tr class="trLateral">
                        <td><button type="submit" name="btnPrincipal" class="btnLateral">Página Principal</button></td>                
                    <tr class="trLateral">
                        <td><button type="submit" name="btnClientes" class="btnLateral">Clientes</button></td>
                    <tr class="trLateral">
                        <td><button type="submit" name="btnVentas" class="btnLateral">Ventas</button></td> 
                        </form>               
                </table>
            </nav>
        </div>
        <header>
            <h1>Sistema WEB Vakilact</h1>
        </header>
        <?php
        if(isset($_POST['btnPrincipal'])){
            include_once 'principal.php';
        }elseif(isset($_POST['btnClientes'])){
            include_once 'clientes.php';
        }elseif(isset($_POST['btnVentas'])){
            include_once 'ventas.php';
        }
        ?>
        <script type="text/javascript">
        
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