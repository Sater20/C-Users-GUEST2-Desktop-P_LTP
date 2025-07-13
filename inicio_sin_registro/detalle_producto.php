<?php
    $id_producto = $_GET["id_produtos"];
    include "../model/conn.php";
    $producto = $conn->query( "select * from productos where id_productos = $id_producto");
    $item_producto = $producto->fetch_object();
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
          <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
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
           <li class="nav-item">
           <a class="nav-link" href="../sesion_registrar/registrate.php">Registrarme</a>
        </li>
      </ul>
      <ul class="navbar-nav me-3">
           <li class="nav-item">
           <a class="nav-link" href="../sesion_registrar/iniciar_sesion.php">Iniciar Sesion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </header>
<body>
    
        <div class="row my-3">
            <div class="col-lg-6">
                <img class="img-fluid detalle-producto-imagen" src="../<?= $item_producto->imagen?>" alt="<?= $item_producto->nombre_producto ?>">
            </div>
            <div class="col-lg-6 mt-5">
                <h2><?= $item_producto->nombre_producto?></h2>
                <p class="mt-4"><?= $item_producto->descripcion?></p>
                <h3 class="mt-2">$<?= $item_producto->precio?></h3>
                <a href="../sesion_registrar/iniciar_sesion.php" class="btn btn-danger btn-sm mb-2 w-65">Añadir al carrito <i class="bi bi-cart4"></i></a>
                <a href="../sesion_registrar/iniciar_sesion.php" class="btn btn-primary btn-sm mb-2 w-65">Comprar Ahora <i class="bi bi-bag-fill"></i></i></a>
            </div>
        </div>
    
</body>
</html>