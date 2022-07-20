
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/imagenes/icono-login.png">
    <title >Login</title>
    <link rel="stylesheet" href="estilos/estilos.css">
</head>
    <body style="display: flex;">
        <?php                                                           
            require_once("includes/conexiones.php");
            $miconex= miConexionBD();
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
            Perfil de Usuario
        </article>
            <nav class="nav1">                            
                <Table border="1" style="min-width: 226px; max-width: 226px; margin-left: -7px;">
                    <tbody>
                        <tr>
                            <td rowspan="3" style="min-width: 59px;">Foto</td>
                            <td>Hugo Walter Vicente</td>
                        </tr>
                        <tr>                            
                            <td>Cargo: </td>                            
                        </tr>
                        <tr>
                            <td>Sede Huancayo</td> 
                        </tr>
                        <tr>                            
                            <td colspan="2"><button style="margin-top: 4px;">Cerrar Sesión</button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><button style="margin-top: 4px;">Editar Perfil</button></td>
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
                        <td><a href="/sisVakilact/gestion/principal.php" class="link">Página Principal</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/administradores.php" class="link">Administradores</a></td>
                    <tr class="trLateral"> 
                        <td><a href="/sisVakilact/gestion/vendedor.php" class="link">Vendedor</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/sedes.php" class="link">Sedes</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/productos.php" class="link">Productos</a></td>
                    <tr class="trLateral">                    
                        <td><a href="/sisVakilact/gestion/productos_in.php" class="link">Ingreso Productos</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/clientes.php" class="link">Clientes</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/ventas.php" class="link">Ventas</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/proveedores.php" class="link">Proveedores</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/insumos.php" class="link">Insumos</a></td>
                    <tr class="trLateral">
                        <td><a href="/sisVakilact/gestion/insumos_in.php" class="link">Ingreso Insumos</a></td>
                </table>
            </nav>
        </div>
        <header>
            Sistema WEB Vakilact
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
        <script src="../js/predeterminado.js"></script>        
    </body>
</html>