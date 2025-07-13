<?php
    include "../model/conn.php";
    include "../controllers/verificacion_sesion.php";
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
    <link rel="stylesheet" href="../style/inicio_sesion.css">
    <title>La Tienda Del Pintor</title>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesion</h1>
        <form method="POST">
            <div class="input-box">
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="contraseña" placeholder="Contraseña" required>
                <i class="bi bi-lock-fill" id="togglePassword" onclick="visibilidad_contraseña()" style="cursor: pointer;"></i>
            </div>
            <div class="recordar-contraseña">
                <label><input type="checkbox">Recordar</label>
                <a href="" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="btn" name="iniciar_sesion" value="ok">Ingresar</button>
            <p class="registar-link">¿Aun no tienes cuenta?<a 
            href="registrate.php">Registrate</a></p>
        </form>
    </div>
    
    <script>
        function visibilidad_contraseña() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-unlock-fill';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-lock-fill';
            }
        }
    </script>
</body>
</html>