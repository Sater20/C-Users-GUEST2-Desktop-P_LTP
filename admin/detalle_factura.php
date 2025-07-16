<?php
session_start();
include "../model/conn.php";
include "../controllers/detalle_factura_controller.php";
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
    <title>Detalle Factura #<?= $factura->id_factura ?> - La Tienda Del Pintor</title>
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
                    <h2><i class="bi bi-receipt"></i> Detalle Factura #<?= $factura->id_factura ?></h2>
                    <a href="administrar_facturas.php" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Volver a Facturas
                    </a>
                </div>
                
                <!-- Información del Cliente -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-person"></i> Información del Cliente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Usuario:</strong> <?= $factura->usuario ?></p>
                                <p><strong>Nombre:</strong> <?= $factura->nombre_apellido ?? 'No especificado' ?></p>
                                <p><strong>Email:</strong> <?= $factura->email ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Teléfono:</strong> <?= $factura->telefono ?? 'No especificado' ?></p>
                                <p><strong>Fecha:</strong> <?= date('d/m/Y H:i:s', strtotime($factura->fecha_factura)) ?></p>
                                <p><strong>Total:</strong> <span class="text-success fw-bold fs-5">$<?= number_format($factura->total, 2) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Productos de la Factura -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-cart"></i> Productos Comprados</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($detalles_result && $detalles_result->num_rows > 0): ?>
                                        <?php while($detalle = $detalles_result->fetch_object()): ?>
                                            <tr>
                                                <td>
                                                    <img src="../<?= $detalle->imagen ?>" alt="<?= $detalle->nombre_producto ?>" 
                                                         style="width: 50px; height: 50px; object-fit: contain;">
                                                </td>
                                                <td><?= $detalle->nombre_producto ?></td>
                                                <td>$<?= number_format($detalle->precio_unitario, 2) ?></td>
                                                <td><?= $detalle->cantidad ?></td>
                                                <td><strong>$<?= number_format($detalle->subtotal, 2) ?></strong></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="bi bi-info-circle"></i> 
                                                Los detalles de productos no están disponibles
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="4" class="text-end">Total:</th>
                                        <th class="text-success fs-5">$<?= number_format($factura->total, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>