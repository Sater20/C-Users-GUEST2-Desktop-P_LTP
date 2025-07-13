<?php
    session_start();
    $id_producto = $_GET["id_produtos"];
    include "model/conn.php";
    $producto = $conn->query( "select * from productos where id_productos = $id_producto");
    $item_producto = $producto->fetch_object();
    $nombre_usuario = $_SESSION['usuario'];
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
    <link rel="stylesheet" href="../style/estilo.css">
    <title>La Tienda Del Pintor</title>
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
           <ul class="navbar-nav me-3">
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-cart4"></i> Carrito
          </a>
          <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
            <li><div class="dropdown-item-text"><strong>Carrito de Compras</strong></div></li>
            <li><hr class="dropdown-divider"></li>
            
            <?php 
            $ruta_imagen = '../';
            include 'includes/dropdown_carrito.php'; 
            ?>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="carrito.php">Ver Carrito Completo</a></li>
          </ul>
        </li>
      </ul>
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
    
        <div class="row my-3">
            <div class="col-lg-6">
                <img class="img-fluid" src="../<?= $item_producto->imagen?>" alt="">
            </div>
            <div class="col-lg-6 mt-5">
                <h2><?= $item_producto->nombre_producto?></h2>
                <p class="mt-4"><?= $item_producto->descripcion?></p>
                <h3 class="mt-2">$<?= $item_producto->precio?></h3>
                <div class="mt-3 mb-3">
                    <div class="d-flex align-items-center">
                        <label for="cantidad" class="me-2">Cantidad:</label>
                        <input type="number" id="cantidad" class="form-control" style="width: 80px;" value="1" min="1" max="<?= $item_producto->stock?>" onchange="validarcantidad()">
                    </div>
                    <small class="text-muted">Disponible: <?= $item_producto->cantidad?></small>
                </div>
                <form method="POST" action="controllers/carrito_controller.php" style="display: inline;">
    <input type="hidden" name="id_producto" value="<?= $item_producto->id_productos ?>">
    <input type="hidden" name="cantidad" id="cantidad_form" value="1">
    <button type="submit" name="agregar_carrito" class="btn btn-danger btn-sm mb-2 w-65">
        Añadir al carrito <i class="bi bi-cart4"></i>
    </button>
</form>
                <a href="" class="btn btn-primary btn-sm mb-2 w-65">Comprar Ahora <i class="bi bi-bag-fill"></i></i></a>
            </div>
        </div>
    
    <script>
        function validarcantidad() {
            const cantidad = document.getElementById('cantidad').value;
            const cantidad_disponible = <?= $item_producto->cantidad?>;
            
            if (parseInt(cantidad) > cantidad_disponible) {
                alert('cantidad no disponible');
                document.getElementById('cantidad').value = cantidad_disponible;
            }
            
            // Actualizar el campo oculto con la cantidad seleccionada
            document.getElementById('cantidad_form').value = cantidad;
        }
    </script>
</body>
</html>