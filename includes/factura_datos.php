<?php
if(!isset($_SESSION['usuario']) || !isset($_GET['id'])) {
    header("Location: sesion_registrar/iniciar_sesion.php");
    exit();
}

$id_factura = $_GET['id'];
$nombre_usuario = $_SESSION['usuario'];

// Obtener datos de la factura
$consulta_factura = $conn->query("SELECT f.*, u.usuario, u.email 
                                  FROM facturas f 
                                  JOIN usuarios u ON f.id_usuarios = u.id_usuarios 
                                  WHERE f.id_factura = '$id_factura'");
$factura = $consulta_factura->fetch_object();

// Verificar que la factura pertenece al usuario
$consulta_usuario = $conn->query("SELECT id_usuarios FROM usuarios WHERE usuario = '$nombre_usuario'");
$datos_usuario = $consulta_usuario->fetch_object();

if($factura->id_usuarios != $datos_usuario->id_usuarios) {
    header("Location: inicio_usuario.php");
    exit();
}

// Obtener detalles de la factura
$consulta_detalles = $conn->query("SELECT df.*, p.nombre_producto, p.imagen 
                                   FROM detalle_factura df 
                                   JOIN productos p ON df.id_productos = p.id_productos 
                                   WHERE df.id_factura = '$id_factura'");
?>