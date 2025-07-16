<?php
include "../model/conn.php";
$id_productos = isset($_GET["id_producto"]) ? $_GET["id_producto"] : 0;
$sql = $conn->query("select * from productos where id_productos = $id_productos");
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
    <title>Editar Producto - La Tienda Del Pintor</title>
</head>
<body class="bg-light">
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
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <a href="admin.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Volver al Panel
                        </a>
                    </div>
                    <h2 class="mb-3"><i class="bi bi-pencil-square text-primary"></i> Editar Producto</h2>
                    <hr class="border-3 border-warning" style="opacity: 1; width: 200px; margin: 0 auto;">
                </div>

                <?php
                include "../controllers/editar_producto.php";
                if($sql && $sql->num_rows > 0){
                    while( $dato = $sql->fetch_object()){
                ?>
                    <!-- Imagen actual -->
                    <div class="text-center mb-4">
                        <div class="card shadow-sm d-inline-block">
                            <div class="card-header bg-info text-white">
                                <small><i class="bi bi-image"></i> Imagen Actual</small>
                            </div>
                            <div class="card-body p-2">
                                <img src="../<?= $dato->imagen ?>" alt="<?= $dato->nombre_producto ?>" 
                                     class="img-fluid rounded" style="max-height: 150px; object-fit: contain;">
                            </div>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient text-white text-center" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                            <h4 class="mb-0"><i class="bi bi-box-seam"></i> Actualizar Información</h4>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $id_productos ?>">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="nombre_producto" class="form-label fw-bold text-dark">
                                            <i class="bi bi-tag text-primary"></i> Nombre del Producto
                                        </label>
                                        <input type="text" class="form-control form-control-lg border-2" 
                                               name="nombre_producto" id="nombre_producto" 
                                               value="<?= $dato->nombre_producto?>" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="precio" class="form-label fw-bold text-dark">
                                            <i class="bi bi-currency-dollar text-success"></i> Precio del Producto
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-success text-white">$</span>
                                            <input type="number" class="form-control border-2" 
                                                   name="precio" id="precio" step="0.01" 
                                                   value="<?= $dato->precio?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="cantidad" class="form-label fw-bold text-dark">
                                            <i class="bi bi-boxes text-info"></i> Cantidad en Stock
                                        </label>
                                        <input type="number" class="form-control form-control-lg border-2" 
                                               name="cantidad" id="cantidad" 
                                               value="<?= $dato->cantidad?>" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="categoria" class="form-label fw-bold text-dark">
                                            <i class="bi bi-grid text-warning"></i> Categoría
                                        </label>
                                        <select class="form-select form-select-lg border-2" name="categoria" id="categoria">
                                            <option value="">Seleccionar categoría</option>
                                            <option value="Pinturas" <?= (isset($dato->categoria) && $dato->categoria == 'Pinturas') ? 'selected' : '' ?>>Pinturas</option>
                                            <option value="Plomeria" <?= (isset($dato->categoria) && $dato->categoria == 'Plomeria') ? 'selected' : '' ?>>Plomería</option>
                                            <option value="Ferreteria" <?= (isset($dato->categoria) && $dato->categoria == 'Ferreteria') ? 'selected' : '' ?>>Ferretería</option>
                                            <option value="Electricidad" <?= (isset($dato->categoria) && $dato->categoria == 'Electricidad') ? 'selected' : '' ?>>Electricidad</option>
                                            <option value="Jardineria" <?= (isset($dato->categoria) && $dato->categoria == 'Jardineria') ? 'selected' : '' ?>>Jardinería</option>
                                            <option value="Construccion" <?= (isset($dato->categoria) && $dato->categoria == 'Construccion') ? 'selected' : '' ?>>Construcción</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="imagen" class="form-label fw-bold text-dark">
                                        <i class="bi bi-image text-danger"></i> Nueva Imagen (Opcional)
                                    </label>
                                    <input type="file" class="form-control form-control-lg border-2" 
                                           name="imagen" id="imagen" accept="image/*">
                                    <div class="form-text">
                                        <i class="bi bi-info-circle"></i> Deja vacío si no deseas cambiar la imagen actual
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="descripcion" class="form-label fw-bold text-dark">
                                        <i class="bi bi-card-text text-secondary"></i> Descripción del Producto
                                    </label>
                                    <textarea name="descripcion" id="descripcion" 
                                              class="form-control border-2" rows="5" 
                                              maxlength="1000" required><?= $dato->descripcion?></textarea>
                                    <div class="form-text">
                                        <i class="bi bi-pencil"></i> Máximo 1000 caracteres
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-lg px-5 text-white fw-bold" 
                                            name="btnactualizar" value="ok"
                                            style="background: linear-gradient(135deg, #ffc107 0%, #ff8f00 100%); border: none;">
                                        <i class="bi bi-check-circle"></i> Actualizar Producto
                                    </button>
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-shield-check"></i> 
                                            Los cambios se guardarán inmediatamente
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo '<div class="alert alert-danger text-center"><i class="bi bi-exclamation-triangle"></i> Producto no encontrado</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    </style>
</body>
</html>