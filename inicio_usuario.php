<?php
session_start();
include "model/conn.php";

// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['usuario'])) {
    header("Location: sesion_registrar/iniciar_sesion.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
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
    <title>La Tienda Del Pintor</title>
</head>
      <header id="encabezado" >

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="mb-4 p-4">
     <div class="logo"><img src="logo/ltp.png" alt=""></div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Nosotros</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias
          </a>
          <ul class="dropdown-menu">
            <!-- Las categorías se generarán dinámicamente -->
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
      <ul class="navbar-nav me-3">
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-cart4"></i> Carrito
          </a>
          <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
            <li><div class="dropdown-item-text"><strong>Carrito de Compras</strong></div></li>
            <li><hr class="dropdown-divider"></li>
            
            <?php include 'includes/dropdown_carrito.php'; ?>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center" href="carrito.php">Ver Carrito Completo</a></li>
          </ul>
        </li>
      </ul>

      <ul class="navbar-nav me-3">
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <?= $usuario_actual ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="mi_perfil.php"><i class="bi bi-person"></i> Mi Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sesion_registrar/iniciar_sesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
       
    </header>

<body>
    <!-- Carousel -->
    <div id="carouselExampleInterval" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="7000">
                <img src="slider/SLIDER1.jpeg" class="d-block w-100" alt="Promociones" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h3>¡Ofertas Especiales!</h3>
                    <p>Encuentra los mejores precios en pinturas y herramientas</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="slider/SLIDER2.jpeg" class="d-block w-100" alt="Productos" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h3>Calidad Garantizada</h3>
                    <p>Productos de las mejores marcas para tus proyectos</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="slider/SLIDER3.jpg" class="d-block w-100" alt="Servicios" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h3>Envío Rápido</h3>
                    <p>Recibe tus productos en la comodidad de tu hogar</p>
                </div>
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

    <!-- Sección de Bienvenida -->
    <div class="container mb-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="display-5 fw-bold text-primary mb-3">¡Bienvenido <?= $usuario_actual ?>!</h2>
                <p class="lead text-muted">Descubre nuestra amplia selección de productos para pintura, plomería y ferretería</p>
            </div>
        </div>
    </div>

    <!-- Sección de Productos Destacados -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="fw-bold text-dark mb-4">
                    <i class="bi bi-star-fill text-warning"></i> Productos Destacados
                </h3>
            </div>
        </div>
        
        <div class="row g-4">
            <?php
            $sql = $conn->query("select * from productos LIMIT 8");
            while ($item = $sql->fetch_object()){ ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="position-relative">
                            <img src="<?= $item->imagen ?>" class="card-img-top" alt="<?= $item->nombre_producto ?>" style="height: 200px; object-fit: contain; background-color: #f8f9fa;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning text-dark">Nuevo</span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-bold text-truncate" title="<?= $item->nombre_producto ?>">
                                <?= $item->nombre_producto ?>
                            </h6>
                            <div class="mt-auto">
                                <div class="mb-3">
                                    <span class="h5 text-success fw-bold mb-0">$<?= number_format($item->precio, 2) ?></span>
                                </div>
                                <form method="POST" action="controllers/carrito_controller.php" class="mb-2">
                                    <input type="hidden" name="id_producto" value="<?= $item->id_productos ?>">
                                    <button type="submit" name="agregar_carrito" class="btn btn-warning w-100 fw-bold">
                                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                    </button>
                                </form>
                                <a href="detalle_p_usuario.php?id_produtos=<?= $item->id_productos?>" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-eye"></i> Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        
        <!-- Botón Ver Más Productos -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="#" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-grid"></i> Ver Todos los Productos
                </a>
            </div>
        </div>
    </div>

    <!-- Secciones Dinámicas por Categorías -->
    <div class="container mt-5">
        <?php
        // Obtener todas las categorías únicas
        $sql_categorias = $conn->query("SELECT DISTINCT categoria FROM productos WHERE categoria IS NOT NULL AND categoria != '' ORDER BY categoria");
        
        // Array de iconos y colores para cada categoría
        $categoria_config = [
            'Pinturas' => ['icon' => 'bi-palette', 'color' => 'primary'],
            'Plomeria' => ['icon' => 'bi-wrench', 'color' => 'info'],
            'Ferreteria' => ['icon' => 'bi-tools', 'color' => 'warning'],
            'Electricidad' => ['icon' => 'bi-lightning', 'color' => 'danger'],
            'Jardineria' => ['icon' => 'bi-flower1', 'color' => 'success'],
            'Construccion' => ['icon' => 'bi-building', 'color' => 'secondary']
        ];
        
        while ($categoria_row = $sql_categorias->fetch_object()) {
            $categoria = $categoria_row->categoria;
            
            // Configuración por defecto si no existe en el array
            $icon = isset($categoria_config[$categoria]) ? $categoria_config[$categoria]['icon'] : 'bi-box';
            $color = isset($categoria_config[$categoria]) ? $categoria_config[$categoria]['color'] : 'primary';
        ?>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-bold text-dark mb-0"><?= ucfirst($categoria) ?></h3>
                            <a href="categoria.php?categoria=<?= urlencode($categoria) ?>" class="btn btn-outline-primary">
                                Ver más <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <hr class="border-3 border-warning mt-2 mb-0" style="opacity: 1;">
                    </div>
                    <div class="row g-4">
                        <?php
                        $sql_productos = $conn->prepare("SELECT * FROM productos WHERE categoria = ? LIMIT 4");
                        $sql_productos->bind_param("s", $categoria);
                        $sql_productos->execute();
                        $result = $sql_productos->get_result();
                        
                        while ($item = $result->fetch_object()){ ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card h-100 shadow-sm border-0 product-card">
                                    <img src="<?= $item->imagen ?>" class="card-img-top" alt="<?= $item->nombre_producto ?>" style="height: 200px; object-fit: contain; background-color: #f8f9fa;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title fw-bold text-truncate" title="<?= $item->nombre_producto ?>">
                                            <?= $item->nombre_producto ?>
                                        </h6>
                                        <div class="mt-auto">
                                            <div class="mb-3">
                                                <span class="h5 text-success fw-bold mb-0">$<?= number_format($item->precio, 2) ?></span>
                                            </div>
                                            <form method="POST" action="controllers/carrito_controller.php" class="mb-2">
                                                <input type="hidden" name="id_producto" value="<?= $item->id_productos ?>">
                                                <button type="submit" name="agregar_carrito" class="btn btn-warning w-100 fw-bold">
                                                    <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                                </button>
                                            </form>
                                            <a href="detalle_p_usuario.php?id_produtos=<?= $item->id_productos?>" class="btn btn-outline-primary w-100">
                                                <i class="bi bi-eye"></i> Ver Detalles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Sección de Características -->
    <div class="bg-light py-5 mt-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-truck display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Envío Gratis</h5>
                        <p class="text-muted">En compras mayores a $50</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-shield-check display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Garantía de Calidad</h5>
                        <p class="text-muted">Productos 100% originales</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <i class="bi bi-headset display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Soporte 24/7</h5>
                        <p class="text-muted">Atención al cliente siempre disponible</p>
                    </div>
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
                        <img src="logo/ltp.png" alt="La Tienda Del Pintor" style="height: 50px;" class="me-3">
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