<?php
session_start();
include "../model/conn.php";
include "../controllers/administrar_facturas_controller.php";
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
    <title>Administrar Facturas - La Tienda Del Pintor</title>
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
                            <a class="nav-link active" href="administrar_facturas.php">Facturas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="administrar_usuarios.php">Administrar Usuarios</a>
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
                    <h2><i class="bi bi-receipt"></i> Administrar Facturas</h2>
                    <a href="admin.php" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Volver al Panel
                    </a>
                </div>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Lista de Facturas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID Factura</th>
                                        <th>Usuario</th>
                                        <th>Cliente</th>
                                        <th>Email</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($facturas && $facturas->num_rows > 0): ?>
                                        <?php while($factura = $facturas->fetch_object()): ?>
                                            <tr>
                                                <td><strong>#<?= $factura->id_factura ?></strong></td>
                                                <td><?= $factura->usuario ?></td>
                                                <td><?= $factura->nombre_apellido ?? 'No especificado' ?></td>
                                                <td><?= $factura->email ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($factura->fecha_factura)) ?></td>
                                                <td><span class="text-success fw-bold">$<?= number_format($factura->total, 2) ?></span></td>
                                                <td>
                                                    <a href="detalle_factura.php?id=<?= $factura->id_factura ?>" 
                                                       class="btn btn-info btn-sm">
                                                        <i class="bi bi-eye"></i> Ver Detalles
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="bi bi-receipt display-4 d-block mb-3"></i>
                                                No hay facturas registradas
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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