<?php

    $resultado = $_GET["resultado"];

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
      <form class="d-flex mx-auto" method="GET" action="buscador_p_usuario.php">
        <input class="form-control me-2  border-danger" type="text" name="resultado" placeholder="Buscar" aria-label="Buscar"/>
        <button class="btn btn-outline-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>
</nav>
       
    </header>
<body >
    
    
     <div id="carouselExampleInterval" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="7000">
      <img src="slider/SLIDER1.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="slider/SLIDER2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="slider/SLIDER3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>  

<div style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr; margin-left: 20px; row-gap: 20px;" class="d-grid gap-3 my-5 mt-5 ">
    <?php
    include "model/conn.php";
     $sql = $conn->query("select * from productos where nombre_producto like '%$resultado%' ");
     while ($item = $sql->fetch_object()){ ?>
       <div class="card" style="width: 18rem; border: 2px solid #4682B4; height: 100%; display: flex; flex-direction: column;">
       <img src="<?= $item->imagen ?>" class="card-img-top" alt="...">
       <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column;">
      <div class="card_nombre_producto">
       <h5 class="card-title" style="font-weight: bold;"><?= $item->nombre_producto ?></h5>
       </div>
       <p class="card-text" style="font-weight: bold;">$ <?= $item->precio ?></p>
       <div style="margin-top: auto;">
         <a href="iniciar_sesion.php" class="btn btn-warning btn-sm mb-2 w-100">Añadir al carrito <i class="bi bi-cart4"></i></a>
         <a href="detalle_producto.php?id_produtos=<?= $item->id_productos?>"  class="btn btn-outline-secondary btn-sm w-100">Ver detalle</a>
       </div>
  </div>
</div>
 
 <?php 
     }
      $resulCantidad = mysqli_num_rows($sql);
      if( $resulCantidad < 1 ){
      echo "<p>No hay resultados</p>";
     }
   ?>
</div>


    
</body>
</html>