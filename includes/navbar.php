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
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'inicio_usuario.php') ? 'active' : '' ?>" href="inicio_usuario.php">Inicio</a>
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
                    <input class="form-control me-2 border-danger" type="text" name="resultado" placeholder="Buscar" aria-label="Buscar" value="<?= isset($_GET['resultado']) ? htmlspecialchars($_GET['resultado']) : '' ?>"/>
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