<?php

if(!empty($_POST["iniciar_sesion"])) {
    $usuario = $_POST["usuario"];
    $contraseña_ingresada = $_POST["contraseña"];
    
    $sql = $conn->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
    $user = $sql->fetch_object();
    
    if($user && (($user->admin == 1 && $contraseña_ingresada == $user->contraseña) || password_verify($contraseña_ingresada, $user->contraseña))) {
        session_start();
        $_SESSION['usuario'] = $user->usuario;
        
        if($user->admin == 1) {
            header("Location: ../admin/admin.php");
            exit();
        } else {
            header("Location: ../inicio_usuario.php");
            exit();
        }
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}

?>