<?php
    include 'conexion.php';

    // Verificamos si el código del producto está presente en la URL
    if(isset($_GET['cod_producto'])){
        $cod_producto = $_GET['cod_producto'];

        // Consulta para obtener los detalles del producto
        $sql = "SELECT * FROM vista_productos WHERE cod_producto = '$cod_producto'";
        $resultado = mysqli_query($conexion, $sql);
        $producto = mysqli_fetch_array($resultado);

        $sql2 = "SELECT * FROM productos WHERE cod_producto = '$cod_producto'";
        $resultado2 = mysqli_query($conexion, $sql2);
        $producto2 = mysqli_fetch_array($resultado2);
        
       

        // Si no existe el producto con el código proporcionado, redirigir o mostrar un error
        if (!$producto) {
            echo "Producto no encontrado.";
            exit;
        }
    } else {
        echo "Código de producto no proporcionado.";
        exit;
    }

    

    // Verificamos si se ha enviado el formulario para actualizar el producto
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibimos los datos del formulario
        $nom_producto = $_POST['nom_producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $cod_categoria = $_POST['nom_categoria'];
        $fecha_elab = $_POST['fecha_elab'];
        $fecha_cad = $_POST['fecha_cad'];
        $cod_proveedor = $_POST['nom_proveedor'];
        $razon_social = $_POST['razon_social'];
        
        // Actualizamos los datos en la base de datos
        $update_sql = "UPDATE productos SET 
                            nom_producto = '$nom_producto',
                            precio = '$precio',
                            cantidad = '$cantidad',
                            cod_categoria = '$cod_categoria',
                            fecha_elab = '$fecha_elab',
                            fecha_cad = '$fecha_cad'
                        WHERE cod_producto = '$cod_producto'";

        if (mysqli_query($conexion, $update_sql)) {
            echo "Producto actualizado correctamente.";
            header("Location: index.php"); // Redirige a la página principal o donde desees
        } else {
            echo "Error al actualizar el producto: " . mysqli_error($conexion);
        }
    }

    // Consulta para obtener las categorías disponibles
    $categorias_sql = "SELECT cod_categoria, nom_categoria FROM categorias";
    $categorias_resultado = mysqli_query($conexion, $categorias_sql);

    // Consulta para obtener los proveedores disponibles
    $proveedores_sql = "SELECT cod_proveedor, nom_proveedor FROM proveedores";
    $proveedores_resultado = mysqli_query($conexion, $proveedores_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Sistema de Ventas</h1>
        <p class="lead">Gestión de productos</p>
    </header>
    <div class="container py-3">
        <h2>Editar Producto</h2>
        <form action="editar.php?cod_producto=<?php echo $cod_producto; ?>" method="POST">
            <div class="form-group">
                <label for="nom_producto">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nom_producto" name="nom_producto" value="<?php echo $producto['nom_producto']; ?>" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nom_categoria">Categoría:</label>
                <select class="form-control" id="nom_categoria" name="nom_categoria" required>
                    <?php while ($categoria = mysqli_fetch_array($categorias_resultado)): ?>
                        <option value="<?php echo $categoria['cod_categoria']; ?>" 
                            <?php echo ($producto2['cod_categoria'] === $categoria['cod_categoria']) ? 'selected' : ''; ?>>
                            <?php echo $categoria['cod_categoria'] . " - " . $categoria['nom_categoria']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_elab">Fecha de Elaboración:</label>
                <input type="date" class="form-control" id="fecha_elab" name="fecha_elab" value="<?php echo $producto['fecha_elab']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_cad">Fecha de Caducidad:</label>
                <input type="date" class="form-control" id="fecha_cad" name="fecha_cad" value="<?php echo $producto['fecha_cad']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
</body>
</html>
