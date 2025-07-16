<?php
// Verificar si hay sesión activa
if(!isset($_SESSION['usuario'])) {
    header("Location: ../sesion_registrar/iniciar_sesion.php");
    exit();
}

// Obtener todas las facturas con información del usuario
function obtenerFacturas($conn) {
    $facturas = $conn->query("
        SELECT f.*, u.usuario, u.nombre_apellido, u.email 
        FROM facturas f 
        JOIN usuarios u ON f.id_usuarios = u.id_usuarios 
        ORDER BY f.fecha_factura DESC
    ");

    if (!$facturas) {
        return (object) ['num_rows' => 0];
    }
    
    return $facturas;
}

// Ejecutar la función
$facturas = obtenerFacturas($conn);
?>