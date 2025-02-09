<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitema de ventas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">


</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Sistema de Ventas</h1>
        <p class="lead">Gestión de productos</p>
    </header>

    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>CÓDIGO</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>CATEGORÍA</th>
                <th>FECHA DE ELABORACIÓN</th>
                <th>FECHA DE CADUCIDAD</th>
                <th>PROVEEDOR</th>
                <th>RAZÓN SOCIAL</th>
                <th>EDITAR</th>
                <th>ELIMINAR</th>
            </tr>
                

        


            <?php
                //include 'conexion.php';
                include 'conexion.php';

                //CONSULTA SQL PARA VER REGISTROS DE LA BASE DE DATOS
                $sql = "SELECT * FROM vista_productos";
                $resultado = mysqli_query($conexion,$sql);
                $sql2 = "SELECT * FROM proveedores";
                $resultado2 = mysqli_query($conexion,$sql2);

                //RECORRER LOS REGISTROS DE LA BASE DE DATOS
                while($mostrar = mysqli_fetch_array($resultado))
                {

                    $cod_producto = $mostrar['cod_producto'];
                    $nom_producto = $mostrar['nom_producto'];
                    $precio = $mostrar['precio'];
                    $cantidad = $mostrar['cantidad'];
                    $nom_categoria = $mostrar['nom_categoria'];
                    $fecha_elab=$mostrar['fecha_elab'];
                    $fecha_cad = $mostrar['fecha_cad'];
                    $nom_proveedor = $mostrar['nom_proveedor'];
                    $razon_social = $mostrar['razon_social'];

                    echo "
                        <tr>
                            <td>$cod_producto</td>
                            <td>$nom_producto</td>
                            <td>$precio</td>
                            <td>$cantidad</td>
                            <td>$nom_categoria</td>
                            <td>$fecha_elab</td>
                            <td>$fecha_cad</td>
                            <td>$nom_proveedor</td>
                            <td>$razon_social</td>
                            <td><a href='editar.php?cod_producto=$cod_producto'>EDITAR</a></td>
                            <td><a href='eliminar.php?cod_producto=$cod_producto' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este producto?\");'>ELIMINAR</a></td>
                        </tr>"; 
                }
            ?>
        </table>
    </div>
</body>
</html>