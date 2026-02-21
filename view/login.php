<?php

require_once "config.php";
require_once "../controller/usuarioController.php";

$usuarioController = new UsuarioController();
$errormsg = $usuarioController->autenticarController();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <link rel="icon" href="img/logo.ico">
    <title>AulaTime</title>
</head>

<body class="login-body">
    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-left">
                <img src="img/imagen (1).png" alt="AulaTime" />
                <div id="aviso">
                    <h3>HAZ CLIC Y RESERVA</h3>
                    La forma más práctica y simple de reservar salones, laboratorios y otros espacios.
                </div>
            </div>

            <div class="login-right">
                <img src="img/imagen.png" alt="Sistema de Reservas de Salas de Aula" class="login-logo" />
                <p class="login-version">Versión <strong>1.0</strong></p>

                <?php if ($errormsg): ?>
                    <p class="login-error"><?php echo htmlspecialchars($errormsg); ?></p>
                <?php endif; ?>

                <form action="login.php" method="post" name="Formulario">
                    <div class="login-field">
                        <label for="n_control">Número de Control</label>
                        <input type="text" name="n_control" id="n_control" placeholder="Número de Control" autocomplete="username" />
                    </div>

                    <div class="login-field">
                        <label for="contraseña">Contraseña</label>
                        <div class="password-wrapper">
                            <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" autocomplete="current-password" />
                            <button type="button" id="togglePassword" class="toggle-password" onclick="togglePasswordVisibility()" aria-label="Mostrar/ocultar contraseña">👁️</button>
                        </div>
                    </div>

                    <input type="submit" name="entrar" value="Entrar" class="btn-login" />
                </form>
            </div>

        </div>

        <div id="rodape">
            El sistema ha sido creado por los alumnos del <a href="https://www.matamoros.tecnm.mx/">Instituto Tecnológico de Matamoros</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('contraseña');
            const toggleButton = document.getElementById('togglePassword');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = '🙈';
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = '👁️';
            }
        }
    </script>
</body>

</html>