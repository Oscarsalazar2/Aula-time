<?php

require_once "seguridad.php";
verificarRol('admin');
require_once "../controller/dashboardController.php";

$dsc = new dashboardController();

// Materia que más tienen reservas
$tabla = $dsc->materiaMasReservasController();

// Cálculo de la tasa de ocupación
$total_horarios = $dsc->totalHorariosController();
$total_reservas = $dsc->totalReservasController();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Reportes</title>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.datetimepicker.full.js"></script>
    <script src="js/dateformat.js"></script>
    <script src="js/lib.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Estilos -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
    <link rel="icon" href="img/logo.ico">


    <style>
        .contenedor-tabla-grafica {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .tabla-container {
            flex: 1;
        }

        #chart_div {
            flex: 1;
            max-width: 500px;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Menú izquierdo -->
    <?php include "menu_izquierdo.php"; ?>

    <!-- Contenido principal -->
    <div class="cuerpo">
        <p>
        <h3>Total de Reservas por Materia</h3>
        </p>

        <!-- Sección combinada: Total de reservas por materia y gráfica -->
        <div class="contenedor-tabla-grafica">
            <!-- Tabla -->
            <div class="table-container">
                <table border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tabla ?>
                    </tbody>
                </table>
            </div>

            <!-- Gráfica -->
            <div id="chart_div"></div>
        </div>
        <a href="generar_pdf.php" target="_blank" class="btn3">Descargar PDF</a>

    </div>

    <script type="text/javascript">
        // Carga de Google Charts
        google.load('visualization', '1.0', {
            'packages': ['corechart']
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Estado');
            data.addColumn('number', 'Cantidad');
            data.addRows([
                ['Ocupado', <?= $total_reservas ?>],
                ['Desocupado', <?= $total_horarios ?>],
            ]);

            var options = {
                title: 'Tasa de ocupación de las salas',
                width: 500,
                height: 500
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>

</html>