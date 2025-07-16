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
      <header id="encabezado" class="mb-4">

    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
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
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
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
        <input class="form-control me-2  border-danger" type="text" name="resultado" placeholder="Buscar" aria-label="Buscar"/>
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
<body >

<div class="container">
    <div class="row g-4">
        <?php
        include "../model/conn.php";
        include "../controllers/eliminar_producto.php";
        $sql = $conn->query("select * from productos");
        while ($item = $sql->fetch_object()){ ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <img src="../<?= $item->imagen ?>" class="card-img-top" alt="<?= $item->nombre_producto ?>" style="height: 200px; object-fit: contain; background-color: #f8f9fa;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold text-truncate" title="<?= $item->nombre_producto ?>">
                            <?= $item->nombre_producto ?>
                        </h6>
                        <div class="mt-auto">
                            <div class="mb-3">
                                <span class="h5 text-success fw-bold mb-0">$<?= number_format($item->precio, 2) ?></span>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="editar_admin.php?id_producto=<?= $item->id_productos?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a onclick="return confirm('¿Seguro que deseas borrar el producto?')" 
                                   href="admin.php?id_productos=<?= $item->id_productos?>" 
                                   class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>



    
</body>
</html>