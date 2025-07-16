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
    
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-6">
                <img class="img-fluid detalle-producto-imagen" src="../<?= $item_producto->imagen?>" alt="<?= $item_producto->nombre_producto ?>" style="max-height: 400px; object-fit: contain; background-color: #f8f9fa; width: 100%;">
            </div>
            <div class="col-lg-6 mt-5">
                <h2 class="fw-bold"><?= $item_producto->nombre_producto?></h2>
                <p class="mt-4 text-muted"><?= $item_producto->descripcion?></p>
                <h3 class="mt-4 text-success fw-bold">$<?= number_format($item_producto->precio, 2)?></h3>
                <div class="mt-4">
                    <a href="../sesion_registrar/iniciar_sesion.php" class="btn btn-warning btn-lg mb-3 w-100">
                        <i class="bi bi-cart-plus"></i> Añadir al carrito
                    </a>
                    <a href="../sesion_registrar/iniciar_sesion.php" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-bag-fill"></i> Comprar Ahora
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container py-5">
            <div class="row">
                <!-- Logo y Descripción -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="../logo/ltp.png" alt="La Tienda Del Pintor" style="height: 50px;" class="me-3">
                        <h5 class="mb-0">La Tienda Del Pintor</h5>
                    </div>
                    <p class="text-muted">Tu tienda de confianza para pinturas, plomería y ferretería. Calidad garantizada y los mejores precios del mercado.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="facebook text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="whatsapp text-white"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="twitter text-white"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                
                <!-- Servicios -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Servicios</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Envío a Domicilio</a></li>
                        <li><a href="#">Asesoría Técnica</a></li>
                        <li><a href="#">Instalación</a></li>
                        <li><a href="#">Garantía</a></li>
                        <li><a href="#">Devoluciones</a></li>
                    </ul>
                </div>
                
                <!-- Información -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Información</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Sobre Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Sucursales</a></li>
                        <li><a href="#">Trabaja con Nosotros</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                
                <!-- Legal -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Política de Cookies</a></li>
                        <li><a href="#">Aviso Legal</a></li>
                    </ul>
                </div>
                
                <!-- Contacto -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Contacto</h5>
                    <div class="contact-info">
                        <p><i class="bi bi-geo-alt me-2"></i>Calle Principal #123</p>
                        <p><i class="bi bi-telephone me-2"></i>+57 300 123 4567</p>
                        <p><i class="bi bi-envelope me-2"></i>info@tiendadelpintor.com</p>
                        <p><i class="bi bi-clock me-2"></i>Lun - Sáb: 8:00 - 18:00</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">&copy; 2024 La Tienda Del Pintor. Todos los derechos reservados.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted">Hecho con ❤️ para nuestros clientes</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>