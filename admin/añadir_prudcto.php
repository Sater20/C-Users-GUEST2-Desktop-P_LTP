<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a4063c8cf8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/estilo.css">
    <title>Añadir Nuevo Producto</title>
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
          <a class="nav-link active" aria-current="page" href="../admin/admin.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin/añadir_prudcto.php">Nuevo Producto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Factura</a>
        </li>
      </ul>
      <form class="d-flex mx-auto" role="Buscar">
        <input class="form-control me-2 border-danger" type="Buscar" placeholder="Buscar" aria-label="Buscar"/>
        <button class="btn btn-outline-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></i></button>
      </form>
    </div>
  </div>
</nav>
       
    </header>

<body class="bg-light">
   
    <?php 
    include "../model/conn.php";
    include "../controllers/añadir_producto_controller.php";
    
    ?>
    <form method="POST" class="container mt-5" enctype="multipart/form-data">
         <h3 class="text-center">Añadir Producto</h3>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="mb-3">
                    <label for="nombre_producto" class="form-label text-danger">Nombre del producto</label>
                    <input type="text" class="form-control border-warning text-black" name="nombre_producto" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label text-danger">Precio del producto</label>
                    <input type="number" class="form-control border-warning text-black" name="precio" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label text-danger">Cantidad</label>
                    <input type="number" class="form-control border-warning text-black" name="cantidad" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label text-danger">Imagen del producto</label>
                    <input type="file" class="form-control border-warning text-danger" name="imagen" accept="image" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label text-danger">Descripción</label>
                    <textarea name="descripcion" class="form-control border-warning text-black" rows="6" maxlength="1000" required></textarea>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-warning" name="Añadir" value="ok">Añadir</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>