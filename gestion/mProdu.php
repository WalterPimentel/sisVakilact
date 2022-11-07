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
                if($_SESSION['ID_ROL'] != 3){
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
                var fecha = new Date();
                var mes = fecha.getMonth()+1;
                var dia = fecha.getDate();
                var ano = fecha.getFullYear();
                if(dia<10)
                    dia='0'+dia;
                if(mes<10)
                    mes='0'+mes
                document.getElementById('fechaActual').value=ano+"-"+mes+"-"+dia;
            }
        </script>  
        <div style="margin-top: 35px;">
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
                    </tbody>
                </Table>
            </nav>
            <article class="article1">
                        Men&uacute; Principal
            </article>
            <nav class="nav2">
                <table class="tablaLateral">
                        <tr class="trLateral">
                            <td onclick = "location='pAdmin.php'" class="linkLateral">Página Principal</td>
                        <tr class="trLateral">
                            <td  onclick = "location='productos.php'" class="linkLateral">Productos</td>
                        <tr class="trLateral">                    
                            <td  onclick = "location='productos_in.php'" class="linkLateral">Ingreso Productos</td>
                        <tr class="trLateral">
                            <td  onclick = "location='proveedores.php'" class="linkLateral">Proveedores</td>
                        <tr class="trLateral">
                            <td  onclick = "location='insumos.php'" class="linkLateral">Insumos</td>
                        <tr class="trLateral">
                            <td  onclick = "location='insumos_in.php'" class="linkLateral">Ingreso Insumos</td>
                        <tr class="trLateral">
                            <td  onclick = "location='insumos_out.php'" class="linkLateral">Salida Insumos</td>
                </table>
            </nav>
        </div>
        <header>
                <img src="../imagenes/icono-logo.png" class="logo">
        </header>
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