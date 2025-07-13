<?php
        include "../model/conn.php";
        $id_productos = isset($_GET["id_producto"]) ? $_GET["id_producto"] : 0;
        $sql = $conn->query("select * from productos where id_productos = $id_productos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/a4063c8cf8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
          <a class="nav-link active" aria-current="page" href="../admin.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../admin/añadir_prudcto.php">Nuevo Producto</a>
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
    
    <form method="POST" class="container mt-5" enctype="multipart/form-data">
        <h3 class="text-center">Actualizar Producto</h3>
                <input type="hidden" name="id" value="<?= isset($_GET['id_producto']) ? $_GET['id_producto'] : '' ?>">
                  <?php
                    include "../controllers/editar_producto.php";
                    if($sql && $sql->num_rows > 0){
                      while( $dato = $sql->fetch_object()){
                    ?>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="mb-3">
                    <label for="nombre_producto" class="form-label text-danger">Nombre del producto</label>
                    <input type="text" class="form-control border-warning text-black" name="nombre_producto" value="<?= $dato->nombre_producto?>" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label text-danger">Precio del producto</label>
                    <input type="number" class="form-control border-warning text-black" name="precio" value="<?= $dato->precio?>" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label text-danger">Cantidad</label>
                    <input type="number" class="form-control border-warning text-black" name="cantidad" value="<?= $dato->cantidad?>" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label text-danger">Imagen del producto</label>
                    <input type="file" class="form-control border-warning text-danger" name="imagen" accept="image">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label text-danger">Descripción</label>
                    <textarea name="descripcion" class="form-control border-warning text-black" rows="6" maxlength="1000" required><?= $dato->descripcion?></textarea>
                </div>
                <?php
                    }
                    }
                 ?>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-warning" name="btnactualizar" value="ok">Actualizar</button>
                </div>
            </div>
        </div>
    </form>

</body>
</html>