<?php
    include 'conexion.php';

    // Verificamos si el código del producto está presente en la URL
    if(isset($_GET['cod_producto'])){
        $cod_producto = $_GET['cod_producto'];

        // Eliminamos el producto de la base de datos
        $delete_sql = "DELETE FROM productos WHERE cod_producto = '$cod_producto'";

        if (mysqli_query($conexion, $delete_sql)) {
            echo "Producto eliminado correctamente.";
            header("Location: index.php"); // Redirige a la página principal o donde desees
        } else {
            echo "Error al eliminar el producto: " . mysqli_error($conexion);
        }
    } else {
        echo "Código de producto no proporcionado.";
        exit;
    }
?>
