<?php
if(isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['usuario'];
    $consulta_usuario = $conn->query("SELECT id_usuarios FROM usuarios WHERE usuario = '$nombre_usuario'");
    $datos_usuario = $consulta_usuario->fetch_object();
    $id_usuario = $datos_usuario->id_usuarios;
    
    $consulta_carrito = $conn->query("SELECT c.cantidad, p.nombre_producto, p.precio, p.imagen 
                                     FROM carrito c 
                                     JOIN productos p ON c.id_productos = p.id_productos 
                                     WHERE c.id_usuarios = '$id_usuario' LIMIT 3");
    
    if($consulta_carrito->num_rows > 0) {
        $total_precio = 0;
        while($producto_carrito = $consulta_carrito->fetch_object()) {
            $subtotal = $producto_carrito->precio * $producto_carrito->cantidad;
            $total_precio += $subtotal;
?>
            <li>
                <div class="dropdown-item-text d-flex align-items-center">
                    <img src="<?= isset($ruta_imagen) ? $ruta_imagen : '' ?><?= $producto_carrito->imagen ?>" style="width: 40px; height: 40px; object-fit: cover;" class="me-2">
                    <div>
                        <small><?= substr($producto_carrito->nombre_producto, 0, 20) ?>...</small><br>
                        <small>Cant: <?= $producto_carrito->cantidad ?> - $<?= number_format($subtotal, 2) ?></small>
                    </div>
                </div>
            </li>
<?php 
        }
?>
        <li><hr class="dropdown-divider"></li>
        <li><div class="dropdown-item-text text-center"><strong>Total: $<?= number_format($total_precio, 2) ?></strong></div></li>
<?php 
    } else {
?>
        <li><div class="dropdown-item-text">No hay productos en el carrito</div></li>
<?php 
    }
} else {
?>
    <li><div class="dropdown-item-text">Inicia sesión para ver tu carrito</div></li>
<?php 
}
?>