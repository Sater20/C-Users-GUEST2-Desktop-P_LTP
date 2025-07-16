<?php
// Verificar si hay sesión activa
if(!isset($_SESSION['usuario'])) {
    header("Location: ../sesion_registrar/iniciar_sesion.php");
    exit();
}

$mensaje = '';

// Procesar acciones de usuario
function procesarAccionUsuario($conn) {
    $mensaje = '';
    
    if(isset($_GET['accion']) && isset($_GET['id_usuario'])) {
        $id_usuario = $_GET['id_usuario'];
        
        if($_GET['accion'] == 'hacer_admin') {
            $sql = $conn->prepare("UPDATE usuarios SET admin = 1 WHERE id_usuarios = ?");
            $sql->bind_param("i", $id_usuario);
            if($sql->execute()) {
                $mensaje = "<div class='alert alert-success'>Usuario promovido a administrador correctamente</div>";
            } else {
                $mensaje = "<div class='alert alert-danger'>Error al promover usuario</div>";
            }
        }
        
        if($_GET['accion'] == 'eliminar') {
            $sql = $conn->prepare("DELETE FROM usuarios WHERE id_usuarios = ?");
            $sql->bind_param("i", $id_usuario);
            if($sql->execute()) {
                $mensaje = "<div class='alert alert-success'>Usuario eliminado correctamente</div>";
            } else {
                $mensaje = "<div class='alert alert-danger'>Error al eliminar usuario</div>";
            }
        }
    }
    
    return $mensaje;
}

// Obtener todos los usuarios
function obtenerUsuarios($conn) {
    return $conn->query("SELECT * FROM usuarios ORDER BY id_usuarios DESC");
}

// Ejecutar las funciones
$mensaje = procesarAccionUsuario($conn);
$usuarios = obtenerUsuarios($conn);
?>