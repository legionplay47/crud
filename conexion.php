<?php
    $servidor = "base-remota-js-unesum-4799.i.aivencloud.com";
    $usuario = "avnadmin";
    $clave = "AVNS_N01Ed-jlicU5A6P8k1q";
    $base_datos = "ventas-productos";
    $port = 20112;
    

    $conexion = new mysqli($servidor, $usuario, $clave, $base_datos, $port);


    if (!$conexion)
    {
        die("conexion fallida: " . mysqli_connect_error($conexion));
    }
    else
    {
        //echo "Conectado correctamente!";
    }

?>