<?php
session_start();
include "../model/conn.php";

if(isset($_POST['agregar_carrito'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_usuario = $_SESSION['usuario'];
    
    // Obtener id_usuarios
    $consulta_usuario = $conn->query("SELECT id_usuarios FROM usuarios WHERE usuario = '$nombre_usuario'");
    
    if($consulta_usuario && $consulta_usuario->num_rows > 0) {
        $datos_usuario = $consulta_usuario->fetch_object();
        $id_usuario = $datos_usuario->id_usuarios;
        
        $cantidad = $_POST['cantidad'] ?? 1;
        
        // Verificar si el producto ya está en el carrito
        $verificar_producto = $conn->query("SELECT * FROM carrito WHERE id_usuarios = '$id_usuario' AND id_productos = '$id_producto'");
        
        if($verificar_producto && $verificar_producto->num_rows > 0) {
            // Si ya existe, actualizar cantidad
            $conn->query("UPDATE carrito SET cantidad = cantidad + $cantidad WHERE id_usuarios = '$id_usuario' AND id_productos = '$id_producto'");
        } else {
            // Si no existe, insertar nuevo
            $conn->query("INSERT INTO carrito (id_usuarios, id_productos, cantidad) VALUES ('$id_usuario', '$id_producto', '$cantidad')");
        }
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if(isset($_GET['eliminar'])) {
    $id_carrito = $_GET['eliminar'];
    $conn->query("DELETE FROM carrito WHERE id_carrito = '$id_carrito'");
    header("Location: ../carrito.php");
    exit();
}
?>
