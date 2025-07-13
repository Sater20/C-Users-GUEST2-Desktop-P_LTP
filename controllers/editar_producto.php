<?php
    if(!empty($_POST["btnactualizar"])){
        if(!empty($_POST["nombre_producto"]) and !empty($_POST["precio"]) and !empty($_POST["cantidad"]) and !empty($_POST["descripcion"])){
            
            $id_productos = $_POST["id_productos"];
            $nombre_producto = $_POST["nombre_producto"];
            $precio = $_POST["precio"];
            $cantidad = $_POST["cantidad"];
            $descripcion  = $_POST["descripcion"];
            
           
            if(!empty($_FILES["imagen"]["name"])){
                $imagen_temp = $_FILES["imagen"]["tmp_name"];
                $imagen_nombre = $_FILES["imagen"]["name"];
                $imagen_tipo = strtolower(pathinfo($imagen_nombre, PATHINFO_EXTENSION));
                
                if( $imagen_tipo == "png" or  $imagen_tipo == "jpeg" or  $imagen_tipo == "jpg"){
                    $nuevo_nombre = "productos_" . $id_productos . "." .  $imagen_tipo;
                    $ruta_destino = "../assets/productos/" . $nuevo_nombre;
                    
                    if(move_uploaded_file($imagen_temp, $ruta_destino)){
                        $sql = $conn ->query("update productos set nombre_producto='$nombre_producto' , imagen='assets/productos/$nuevo_nombre' , precio='$precio' , cantidad='$cantidad' , descripcion='$descripcion' where id_productos= $id_productos");
                    } else {
                        echo "<div class='alert alert-danger'>Error al subir la imagen</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Formato No Permitido</div>";
                }
                
            } else {
                $sql = $conn ->query("update productos set nombre_producto='$nombre_producto' , precio='$precio' , cantidad='$cantidad' , descripcion='$descripcion' where id_productos= $id_productos");
            }

        if($sql == true){
                header("location: ../admin.php");
            } else {
                echo "<div class='alert alert-danger'>Error Al Actualizar El Producto</div>";
            }

        } else {
            echo "<div class='alert alert-warning'>Casilla Vacia</div>";
        }



    }

?>