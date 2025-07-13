<?php

    if(!empty($_POST["Añadir"])){

        $imagen = $_FILES["imagen"]["tmp_name"];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_tipo = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));
        $imagen_peso = $_FILES["imagen"]["size"];
        $directorio = "assets/productos/";

        if($imagen_tipo == "jpg" or $imagen_tipo == "png" or $imagen_tipo == "jpeg"){

            $nombre_producto = $_POST["nombre_producto"];
            $precio = $_POST["precio"];
            $cantidad = $_POST["cantidad"];
            $descripcion = $_POST["descripcion"];
            $sql = $conn->query(" insert into productos (nombre_producto, imagen, precio, cantidad ,descripcion) values('$nombre_producto','',$precio , $cantidad , '$descripcion') ");
            $id_productos = $conn->insert_id;

            $ruta = $directorio . "productos_" . $id_productos . "." . $imagen_tipo;
            $actualizar_sql = $conn->query(" update productos set imagen = '$ruta' where id_productos = $id_productos ");
            move_uploaded_file($imagen, '../'.$ruta);

            

            if($actualizar_sql == true){
                header("location: ../admin/admin.php");
            } else {
                echo "<div class='alert alert-danger'>Error al crear el producto</div>";
            }

        } else {
            echo "<div class='alert alert-warning'>Formato no valido</div>";
        }



    }

?>