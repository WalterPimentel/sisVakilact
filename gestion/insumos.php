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
        <fieldset class="containerGestion">
            <legend>Registrar datos</legend>
            <article>
                    <section>
                        <table>
                            <tr>
                                <td>DNI<p><input type="text" id="txtDNI"></td>
                                <td>Nombre<p><input type="text" id="txtDNI"></td>
                                <td>Apellido Paterno<p><input type="text" id="txtDNI"></td>
                                <td>Apellido Materno<p><input type="text" id="txtDNI"></td>
                                <td>Puesto<p><input type="text" id="txtDNI"></td>
                            </tr>
                            <tr>
                                <td>Correo<p><input type="text" id="txtDNI"></td>
                                <td>Telefono<p><input type="text" id="txtDNI"></td>
                                <td>Ruc<p><input type="text" id="txtDNI"></td>
                                <td>Fecha de Ingreso<p><input type="date" id="txtDNI"></td>
                                <td>Fecha de Salida<p><input type="date" id="txtDNI" disabled></td>
                            </tr>
                            <tr>
                                <td>Sedes
                                    <form>
                                        <select class="seleccion">
                                            <option selected="selected">Jauja</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td></td> 
                            </tr>
                        </table>
                    </section>
                </article>
        </fieldset>
        <p class="textoBuscar">Buscar</p><p><input type="text" id="txtBuscar" class="txtBuscar">
        </div>
    </div>
</body>
</html>