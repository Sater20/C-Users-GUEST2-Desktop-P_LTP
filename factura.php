<?php
session_start();
include "model/conn.php";
include "includes/factura_datos.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a4063c8cf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/estilo.css">
    <style>
        @media print {
            header, .btn {
                display: none !important;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                margin-top: 0 !important;
            }
        }
    </style>
    <title>Factura #<?= $factura->id_factura ?> - La Tienda Del Pintor</title>
</head>

         <header id="encabezado" >

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
          <a class="nav-link active" aria-current="page" href="inicio_usuario.php">Inicio</a>
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
      <form class="d-flex mx-auto" role="Buscar">
        <input class="form-control me-2  border-danger" type="Buscar" placeholder="Buscar" aria-label="Buscar"/>
        <button class="btn btn-outline-danger" type="submit"><i class="fa-solid fa-magnifying-glass"></i></i></button>
      </form>
       <ul class="navbar-nav me-5">
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <?= $nombre_usuario ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="sesion_registrar/iniciar_sesion.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </header>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col-6">
                                <img src="logo/ltp.png" alt="La Tienda Del Pintor" style="height: 200px;">
                            </div>
                            <div class="col-6 text-end d-flex flex-column justify-content-end">
                                <h4>Factura #<?= $factura->id_factura ?></h4>
                                <p class="mb-0">Fecha: <?= date('d/m/Y H:i', strtotime($factura->fecha_factura)) ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h5>Datos del Cliente:</h5>
                                <p class="mb-1"><strong>Usuario:</strong> <?= $factura->usuario ?></p>
                                <p class="mb-1"><strong>Email:</strong> <?= $factura->email ?></p>
                                <p class="mb-1"><strong>Estado:</strong> <span class="badge bg-success"><?= ucfirst($factura->estado) ?></span></p>
                            </div>
                        </div>
                        
                        <h5>Productos Comprados:</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unit.</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($detalle = $consulta_detalles->fetch_object()): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= $detalle->imagen ?>" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                                                <?= $detalle->nombre_producto ?>
                                            </div>
                                        </td>
                                        <td><?= $detalle->cantidad ?></td>
                                        <td>$<?= number_format($detalle->precio_unitario, 2) ?></td>
                                        <td>$<?= number_format($detalle->subtotal, 2) ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th colspan="3" class="text-end">TOTAL:</th>
                                        <th>$<?= number_format($factura->total, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button onclick="window.print()" class="btn btn-secondary btn-lg me-3">
                                    <i class="bi bi-printer"></i> Imprimir Factura
                                </button>
                                <button onclick="descargarPDF()" class="btn btn-success btn-lg">
                                    <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <a href="inicio_usuario.php" class="btn btn-primary btn-lg">
                                    <i class="bi bi-house"></i> Volver al Inicio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        function descargarPDF() {
            const { jsPDF } = window.jspdf;
            const factura = document.querySelector('.card');
            const botones = document.querySelectorAll('.btn');
            
            // Ocultar botones temporalmente
            botones.forEach(btn => btn.style.display = 'none');
            
            html2canvas(factura, {
                scale: 2,
                useCORS: true,
                allowTaint: true
            }).then(canvas => {
                // Mostrar botones de nuevo
                botones.forEach(btn => btn.style.display = '');
                
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                
                const imgWidth = 210;
                const pageHeight = 295;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;
                
                let position = 0;
                
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                
                pdf.save('Factura_<?= $factura->id_factura ?>.pdf');
            });
        }
    </script>
</body>
</html>