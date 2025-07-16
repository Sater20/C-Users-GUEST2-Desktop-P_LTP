<?php
    if(!empty($_POST["registrarse"])) {
        $usuario = $_POST["usuario"];
        $nombre_apellido = $_POST["nombre_apellido"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];
        $contraseña = $_POST["contraseña"];
        $confirmar_contraseña = $_POST["confirmar_contraseña"];
        
        if($contraseña !== $confirmar_contraseña) {
            echo "<div class='alert alert-danger'>Las contraseñas no coinciden</div>";
        } else {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            $sqlresgistrar = $conn->query("INSERT INTO usuarios (usuario, nombre_apellido, telefono, email, contraseña) VALUES('$usuario','$nombre_apellido','$telefono','$email','$contraseña')");
            if($sqlresgistrar == true) {
                
                header("location: ../sesion_registrar/iniciar_sesion.php");
            } else {
                echo "<div class='alert alert-danger'>Error al registrar usuario</div>";
            }
        }
    }
?>