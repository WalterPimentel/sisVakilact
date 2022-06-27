<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../imagenes/icono-login.png">
    <title >DashBoard</title>
    <link rel="stylesheet" href="../estilos/estilos.css">
</head>
    <body style="display: flex;">
        <?php                                                           
            require_once("../conexiones.php");
            $miconex= miConexionBD();
            $conectar = ConectarBD();
            if (isset($_REQUEST['btnCancelar'])){
        ?>
                <script>                 
                    e.preventDefault();                                                                                       
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
        <div style="margin-top: 83px;">
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
        <header>
            header
        </header>        
    </body>
</html>