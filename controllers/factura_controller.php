<?php
session_start();
include "../model/conn.php";

if(!isset($_SESSION['usuario'])) {
    header("Location: ../sesion_registrar/iniciar_sesion.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario'];
$consulta_usuario = $conn->query("SELECT id_usuarios FROM usuarios WHERE usuario = '$nombre_usuario'");
$datos_usuario = $consulta_usuario->fetch_object();
$id_usuario = $datos_usuario->id_usuarios;

// Obtener productos del carrito
$consulta_carrito = $conn->query("SELECT c.cantidad, c.id_productos, p.precio 
                                  FROM carrito c 
                                  JOIN productos p ON c.id_productos = p.id_productos 
                                  WHERE c.id_usuarios = '$id_usuario'");

if($consulta_carrito->num_rows == 0) {
    header("Location: ../carrito.php");
    exit();
}

// Calcular total
$total = 0;
$productos_carrito = [];
while($producto = $consulta_carrito->fetch_object()) {
    $subtotal = $producto->precio * $producto->cantidad;
    $total += $subtotal;
    $productos_carrito[] = $producto;
}

// Crear factura
$conn->query("INSERT INTO facturas (id_usuarios, total) VALUES ('$id_usuario', '$total')");
$id_factura = $conn->insert_id;

// Agregar detalles de la factura
foreach($productos_carrito as $producto) {
    $subtotal = $producto->precio * $producto->cantidad;
    $conn->query("INSERT INTO detalle_factura (id_factura, id_productos, cantidad, precio_unitario, subtotal) 
                  VALUES ('$id_factura', '$producto->id_productos', '$producto->cantidad', '$producto->precio', '$subtotal')");
}

// Vaciar carrito
$conn->query("DELETE FROM carrito WHERE id_usuarios = '$id_usuario'");

// Redirigir a la factura
header("Location: ../factura.php?id=$id_factura");
exit();
?>