<?php

require_once "config.php";
require_once "../controller/usuarioController.php";

$usuarioController = new UsuarioController();
$errormsg = $usuarioController->autenticarController();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <link rel="icon" href="img/logo.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AulaTime</title>

    <style type="text/css">
        body,
        td,
        th {
            font-family: "Time New Roman", Time New Roman;
        }
    </style>
</head>

<body>
    <form action="login.php" method="post" name="Formulario">

        <div id="content">

            <div id="esquerdo">
                <img src="img/imagen (1).png" width="325" height="335" style="display: block; margin: 0 auto;" />
                <div id="aviso">

                    <strong>
                        <h3>HAZ CLIC Y RESERVA</h3>
                    </strong>
                    La forma más pr&aacute;ctica y simple de reservar salones, laborat&oacute;rios y otros espacios.
                </div>

            </div>

            <div id="direito">

                <br />
                <br />
                <img src="img/imagen.png" alt="Sistema de Reservas de Salas de Aula" title="Sistema de Reservas de Salas de Aula" width="310" height="72" />
                <br />
                <br />
                Version <strong>1.0</strong>&nbsp;<br />
                <span style="color:#900"><?php echo $errormsg; ?></span><br />

                <input type="text" name="n_control" id="n_control" placeholder="Número de Control" />
                <br />
                <br />

                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña" />
                    <button type="button" id="togglePassword" onclick="togglePasswordVisibility()">👁️</button>
                </div>
                <br />
                <br />

                <input type="submit" name="entrar" value="Entrar" class="btn1" />

            </div>
        </div>

        <div id="rodape">

            El sistema ha sido creado por los alumnos del <a href="https://www.matamoros.tecnm.mx/">Instituto Tecnologico de Matamoros</a>

        </div>

    </form>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('contraseña');
            const toggleButton = document.getElementById('togglePassword');

            // Cambiar entre 'password' y 'text'
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = '🙈'; // Cambiar ícono a "ocultar"
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = '👁️'; // Cambiar ícono a "mostrar"
            }
        }
    </script>
</body>

</html>