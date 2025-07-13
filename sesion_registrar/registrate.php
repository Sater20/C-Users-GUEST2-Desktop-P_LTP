<?php
    include "../model/conn.php";
    include "../controllers/registrar_usuario_controller.php";
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
    <link rel="stylesheet" href="../style/registrate.css">
    <title>La Tienda Del Pintor</title>
</head>
<body>
    <div class="container">
        <h1>Registrate</h1>
        <form method="POST">
            <div class="input-box">
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class="bi bi-envelope-fill"></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="contraseña" placeholder="Contraseña" required>
                <i class="bi bi-lock-fill" id="togglePassword" onclick="visibilidad_contraseña()" style="cursor: pointer;"></i>
            </div>
            <div class="input-box">
                <input type="password" id="confirmPassword" name="confirmar_contraseña" placeholder="Confirmar Contraseña" required>
                <i class="bi bi-lock-fill" id="toggleConfirmPassword" onclick="visibilidad_confirmacion_contraseña()" style="cursor: pointer;"></i>
            </div>
            <button class="btn" name="registrarse" value="ok">Registrarse</button>
            <p class="sesion-link">¿Ya tienes cuenta?<a 
            href="iniciar_sesion.php">Inicia Sesión</a></p>
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
        
        function visibilidad_confirmacion_contraseña() {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const toggleIcon = document.getElementById('toggleConfirmPassword');
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                toggleIcon.className = 'bi bi-unlock-fill';
            } else {
                confirmPasswordInput.type = 'password';
                toggleIcon.className = 'bi bi-lock-fill';
            }
        }
    </script>
</body>
</html>