<?php
session_start();
include "model/conn.php";

if(!isset($_SESSION['usuario'])) {
    header("Location: sesion_registrar/iniciar_sesion.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

if(empty($categoria)) {
    header("Location: inicio_usuario.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a4063c8cf8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/estilo.css">
    <title><?= ucfirst($categoria) ?> - La Tienda Del Pintor</title>
</head>
<body>
    <header id="encabezado">
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
                            <a class="nav-link" href="inicio_usuario.php">Inicio</a>
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
                        <input class="form-control me-2 border-danger" type="text" name="resultado" placeholder="Buscar" aria-label="Buscar"/>
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

    <div class="container mt-4">
        <!-- Título de la categoría -->
        <div class="mb-4">
            <h2 class="fw-bold text-dark mb-0"><?= ucfirst($categoria) ?></h2>
            <hr class="border-3 border-warning mt-2 mb-0" style="opacity: 1; width: 200px;">
        </div>

        <!-- Productos -->
        <div class="row g-4">
            <?php
            $sql_productos = $conn->prepare("SELECT * FROM productos WHERE categoria = ? ORDER BY nombre_producto");
            $sql_productos->bind_param("s", $categoria);
            $sql_productos->execute();
            $result = $sql_productos->get_result();
            
            if($result->num_rows > 0) {
                while ($item = $result->fetch_object()){ ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
                <?php }
            } else { ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box display-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No hay productos en esta categoría</h4>
                    <p class="text-muted">Pronto agregaremos más productos</p>
                    <a href="inicio_usuario.php" class="btn btn-primary">Volver al Inicio</a>
                </div>
            <?php } ?>
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