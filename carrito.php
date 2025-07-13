<?php
session_start();
include "model/conn.php";

if(!isset($_SESSION['usuario'])) {
    header("Location: sesion_registrar/iniciar_sesion.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario'];
$consulta_usuario = $conn->query("SELECT id_usuarios FROM usuarios WHERE usuario = '$nombre_usuario'");
$datos_usuario = $consulta_usuario->fetch_object();
$id_usuario = $datos_usuario->id_usuarios;

$consulta_productos = $conn->query("SELECT c.id_carrito, c.cantidad, p.nombre_producto, p.precio, p.imagen 
                                   FROM carrito c 
                                   JOIN productos p ON c.id_productos = p.id_productos 
                                   WHERE c.id_usuarios = '$id_usuario'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a4063c8cf8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/estilo.css">
    <title>Mi Carrito - La Tienda Del Pintor</title>
</head>

        <header id="encabezado" >

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="mb-4 p-4">
     <div class="logo"><img src="../logo/ltp.png" alt=""></div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inicio_usuario.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Nosotros</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Pinturas</a></li>
            <li><a class="dropdown-item" href="#">Plomeria</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Ferreteria</a></li>
          </ul>
        </li>
        <li class="nav-item">       
          <a class="nav-link" href="#">Contacto</a>
        </li>
      </ul>
      <form class="d-flex mx-auto" role="Buscar">
        <input class="form-control me-2  border-danger" type="Buscar" placeholder="Buscar" aria-label="Buscar"/>
        <button class="btn btn-outline-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></i></button>
      </form>
       <ul class="navbar-nav me-5">
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <?= $nombre_usuario ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="sesion_registrar/iniciar_sesion.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </header>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Mi Carrito de Compras</h2>
                    <a href="inicio_usuario.php" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Seguir Comprando
                    </a>
                </div>
            </div>
        </div>
        
        <?php if($consulta_productos->num_rows > 0): ?>
            <div class="row">
                <?php 
                $precio_total = 0;
                while($producto = $consulta_productos->fetch_object()): 
                    $subtotal = $producto->precio * $producto->cantidad;
                    $precio_total += $subtotal;
                ?>
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="<?= $producto->imagen ?>" class="img-fluid rounded-start" alt="<?= $producto->nombre_producto ?>" style="height: 150px; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $producto->nombre_producto ?></h5>
                                        <p class="card-text">Precio: $<?= number_format($producto->precio, 2) ?></p>
                                        <p class="card-text">Cantidad: <?= $producto->cantidad ?></p>
                                        <p class="card-text"><strong class="text-success">Subtotal: $<?= number_format($subtotal, 2) ?></strong></p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <a href="controllers/carrito_controller.php?eliminar=<?= $producto->id_carrito ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h4 class="mb-3">Total: <span class="text-success">$<?= number_format($precio_total, 2) ?></span></h4>
                            <a href="controllers/factura_controller.php" class="btn btn-success btn-lg">
                                <i class="bi bi-receipt"></i> Generar Factura
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="card">
                        <div class="card-body py-5">
                            <i class="bi bi-cart-x" style="font-size: 4rem; color: #6c757d;"></i>
                            <h4 class="mt-3">Tu carrito está vacío</h4>
                            <p class="text-muted">¡Agrega algunos productos para comenzar!</p>
                            <a href="inicio_usuario.php" class="btn btn-primary btn-lg">
                                <i class="bi bi-shop"></i> Ir de Compras
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>