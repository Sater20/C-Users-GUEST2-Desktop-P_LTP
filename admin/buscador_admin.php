
<?php

    $resultado = $_GET["resultado"];

?>

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
          <a class="nav-link active" aria-current="page" href="admin.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="añadir_prudcto.php">Nuevo Producto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Facturas</a>
        </li>
      </ul>
        <form class="d-flex mx-auto" method="GET" action="buscador_admin.php">
        <input class="form-control me-2  border-danger" type="text" name="resultado" placeholder="Buscar" aria-label="Buscar"/>
        <button class="btn btn-outline-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
  </div>
</nav>
       
    </header>
<body >
    <h3>Resultados De "<?php echo $resultado?>"</h3>
<div style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr; margin-left: 20px; row-gap: 20px;" class="d-grid gap-3 my-5 mt-5 ">
    <?php
    include "../model/conn.php";
     $sql = $conn->query("select * from productos where nombre_producto like '%$resultado%' ");
     while ($item = $sql->fetch_object()){ ?>
       <div class="card" style="width: 18rem; border: 2px solid #4682B4; height: 100%; display: flex; flex-direction: column;">
       <img src="../<?= $item->imagen ?>" class="card-img-top" alt="...">
       <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column;">
      <div class="card_nombre_producto">
       <h5 class="card-title" style="font-weight: bold;"><?= $item->nombre_producto ?></h5>
       </div>
       <p class="card-text" style="font-weight: bold;">$ <?= $item->precio ?></p>
       <div style="margin-top: auto;">
       <a href="editar_admin.php?id_producto=<?= $item->id_productos?>" class="btn btn-small btn-warning"><i class="bi bi-pencil-square"></i></a>
       <a onclick="return confirm('¿seguro que deseas borrar el producto?')" href="admin.php?id_productos=<?= $item->id_productos?>" class="btn btn-small btn-danger"><i class="bi bi-trash"></i></a>
       </div>
  </div>
</div>
 
 <?php 
     }
      $resultadoCantidad = mysqli_num_rows($sql);
      if( $resultadoCantidad < 1 ){
      echo "<p>No hay resultados</p>";
     }

 ?>
</div>



    
</body>
</html>