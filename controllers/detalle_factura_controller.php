<?php
// Verificar si hay sesión activa
if(!isset($_SESSION['usuario'])) {
    header("Location: ../sesion_registrar/iniciar_sesion.php");
    exit();
}

$id_factura = $_GET['id'] ?? 0;

// Obtener información de la factura
function obtenerFactura($conn, $id_factura) {
    $factura_query = $conn->prepare("
        SELECT f.*, u.usuario, u.nombre_apellido, u.email, u.telefono 
        FROM facturas f 
        JOIN usuarios u ON f.id_usuarios = u.id_usuarios 
        WHERE f.id_factura = ?
    ");

    if ($factura_query) {
        $factura_query->bind_param("i", $id_factura);
        $factura_query->execute();
        return $factura_query->get_result()->fetch_object();
    }
    
    return null;
}

// Obtener detalles de la factura
function obtenerDetallesFactura($conn, $id_factura) {
    $detalles_query = $conn->prepare("
        SELECT df.*, p.nombre_producto, p.imagen 
        FROM detalle_factura df 
        JOIN productos p ON df.id_productos = p.id_productos 
        WHERE df.id_factura = ?
    ");

    if ($detalles_query) {
        $detalles_query->bind_param("i", $id_factura);
        $detalles_query->execute();
        return $detalles_query->get_result();
    }
    
    return null;
}

// Ejecutar las funciones
$factura = obtenerFactura($conn, $id_factura);

if(!$factura) {
    header("Location: administrar_facturas.php");
    exit();
}

$detalles_result = obtenerDetallesFactura($conn, $id_factura);
?>