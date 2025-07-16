<?php
session_start();
include "model/conn.php";

if(!isset($_SESSION['usuario'])) {
    header("Location: sesion_registrar/iniciar_sesion.php");
    exit();
}

$usuario_actual = $_SESSION['usuario'];
$mensaje = "";

// Obtener datos del usuario
$sql = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$sql->bind_param("s", $usuario_actual);
$sql->execute();
$resultado = $sql->get_result();
$usuario_data = $resultado->fetch_assoc();

// Procesar actualización de perfil
if(isset($_POST['actualizar_perfil'])) {
    $nombre_apellido = $_POST['nombre_apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    $update_sql = $conn->prepare("UPDATE usuarios SET nombre_apellido = ?, email = ?, telefono = ? WHERE usuario = ?");
    $update_sql->bind_param("ssss", $nombre_apellido, $email, $telefono, $usuario_actual);
    
    if($update_sql->execute()) {
        $mensaje = "<div class='alert alert-success'>Perfil actualizado correctamente</div>";
        // Actualizar datos para mostrar
        $sql->execute();
        $resultado = $sql->get_result();
        $usuario_data = $resultado->fetch_assoc();
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al actualizar el perfil</div>";
    }
}

// Procesar cambio de contraseña
if(isset($_POST['cambiar_clave'])) {
    $clave_actual = $_POST['clave_actual'];
    $nueva_clave = $_POST['nueva_clave'];
    $confirmar_clave = $_POST['confirmar_clave'];
    
    if(password_verify($clave_actual, $usuario_data['contraseña'])) {
        if($nueva_clave === $confirmar_clave) {
            $clave_hash = password_hash($nueva_clave, PASSWORD_DEFAULT);
            $update_clave = $conn->prepare("UPDATE usuarios SET contraseña = ? WHERE usuario = ?");
            $update_clave->bind_param("ss", $clave_hash, $usuario_actual);
            
            if($update_clave->execute()) {
                $mensaje = "<div class='alert alert-success'>Contraseña cambiada correctamente</div>";
            } else {
                $mensaje = "<div class='alert alert-danger'>Error al cambiar la contraseña</div>";
            }
        } else {
            $mensaje = "<div class='alert alert-danger'>Las nuevas contraseñas no coinciden</div>";
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>La contraseña actual es incorrecta</div>";
    }
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
    <title>Mi Perfil - La Tienda Del Pintor</title>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h4><i class="bi bi-person-circle"></i> Mi Perfil</h4>
                    </div>
                    <div class="card-body">
                        <?= $mensaje ?>
                        
                        <!-- Pestañas -->
                        <ul class="nav nav-tabs" id="perfilTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">
                                    <i class="bi bi-person"></i> Información Personal
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="clave-tab" data-bs-toggle="tab" data-bs-target="#clave" type="button">
                                    <i class="bi bi-key"></i> Cambiar Contraseña
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content mt-3" id="perfilTabsContent">
                            <!-- Información Personal -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Usuario</label>
                                            <input type="text" class="form-control" value="<?= $usuario_data['usuario'] ?>" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nombre y Apellido</label>
                                            <input type="text" class="form-control" name="nombre_apellido" value="<?= $usuario_data['nombre_apellido'] ?? '' ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?= $usuario_data['email'] ?? '' ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" value="<?= $usuario_data['telefono'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="actualizar_perfil" class="btn btn-warning">
                                            <i class="bi bi-check-circle"></i> Actualizar Perfil
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Cambiar Contraseña -->
                            <div class="tab-pane fade" id="clave" role="tabpanel">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Contraseña Actual</label>
                                        <input type="password" class="form-control" name="clave_actual" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nueva Contraseña</label>
                                        <input type="password" class="form-control" name="nueva_clave" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirmar Nueva Contraseña</label>
                                        <input type="password" class="form-control" name="confirmar_clave" required>
                                    </div>
                                    <button type="submit" name="cambiar_clave" class="btn btn-warning">
                                        <i class="bi bi-key"></i> Cambiar Contraseña
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>