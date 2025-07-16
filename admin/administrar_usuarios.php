<?php
session_start();
include "../model/conn.php";
include "../controllers/administrar_usuarios_controller.php";
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
    <link rel="stylesheet" href="../style/estilo.css">
    <title>Administrar Usuarios - La Tienda Del Pintor</title>
</head>
<body>
    <header id="encabezado" class="mb-4">
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
                            <a class="nav-link" href="admin.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="añadir_prudcto.php">Nuevo Producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="administrar_facturas.php">Facturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="administrar_usuarios.php">Administrar Usuarios</a>
                        </li>
                    </ul>
                    <form class="d-flex mx-auto" method="GET" action="buscador_admin.php">
                        <input class="form-control me-2 border-danger" type="text" name="resultado" placeholder="Buscar" aria-label="Buscar"/>
                        <button class="btn btn-outline-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <ul class="navbar-nav me-3">
                        <li class="nav-item">
                            <a class="nav-link" href="../sesion_registrar/iniciar_sesion.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-people"></i> Administrar Usuarios</h2>
                    <a href="admin.php" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Volver al Panel
                    </a>
                </div>
                
                <?php if(isset($mensaje)) echo $mensaje; ?>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Lista de Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($usuario = $usuarios->fetch_object()): ?>
                                        <tr>
                                            <td><?= $usuario->id_usuarios ?></td>
                                            <td><strong><?= $usuario->usuario ?></strong></td>
                                            <td><?= $usuario->nombre_apellido ?? 'No especificado' ?></td>
                                            <td><?= $usuario->email ?></td>
                                            <td><?= $usuario->telefono ?? 'No especificado' ?></td>
                                            <td>
                                                <?php if($usuario->admin == 1): ?>
                                                    <span class="badge bg-success">Administrador</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Usuario</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($usuario->admin != 1): ?>
                                                    <a href="?accion=hacer_admin&id_usuario=<?= $usuario->id_usuarios ?>" 
                                                       class="btn btn-warning btn-sm me-2"
                                                       onclick="return confirm('¿Estás seguro de promover este usuario a administrador?')">
                                                        <i class="bi bi-shield-check"></i> Hacer Admin
                                                    </a>
                                                <?php endif; ?>
                                                
                                                <a href="?accion=eliminar&id_usuario=<?= $usuario->id_usuarios ?>" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>