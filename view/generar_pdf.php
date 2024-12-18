<?php
require_once '../model/db_mysqli.php'; // Incluir la clase de la base de datos
require_once 'config.php'; // Incluir la clase de configuración de la base de datos
require_once '../tcpdf/tcpdf.php'; // Incluir TCPDF

// Crear una instancia de la clase Database
$cfg = new Database();

// Consultar la vista
$sql = "SELECT * FROM vista_reservas";
$result = $cfg->query($sql); // Usar el método query de la clase Database

// Crear una nueva instancia de TCPDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Reservas');
$pdf->SetTitle('Reporte de Reservas');
$pdf->SetSubject('Reservas por Vista');
$pdf->SetKeywords('Reservas, PDF, Reporte');
$pdf->SetHeaderData('', 0, 'AULATIME', 'Reporte de Reservas');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, 25);
$pdf->SetFont('dejavusans', '', 12);

// Agregar una página al PDF
$pdf->AddPage();

// Generar contenido en HTML para el PDF
$html = '<h1>Reporte de Reservas</h1>';
$html .= '<table border="1" cellpadding="4">
            <thead>
                <tr>
                    <th><strong>Reserva ID</strong></th>
                    <th><strong>Fecha</strong></th>
                    <th><strong>Profesor/Alumno</strong></th>
                    <th><strong>Materia</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Observación</strong></th>
                    <th><strong>Sala</strong></th>
                    <th><strong>Hora</strong></th>
                </tr>
            </thead>
            <tbody>';

// Verificar si hay resultados
if (!empty($result)) {
    $estado_texto = [
        1 => 'Reservada',
        2 => 'Confirmada',
        3 => 'Cancelada'
    ];
    
    foreach ($result as $row) {
        // Formatear datos
        $fecha_formateada = date('d-m-Y', strtotime($row['dia']));
        $estado_formateado = $estado_texto[$row['status']] ?? 'Desconocido';
        
        // Sanitizar datos
        $html .= '<tr>
                    <td>' . htmlspecialchars($row['reserva_id']) . '</td>
                    <td>' . $fecha_formateada . '</td>
                    <td>' . htmlspecialchars($row['Profesor_alumno']) . '</td>
                    <td>' . htmlspecialchars($row['materia']) . '</td>
                    <td>' . htmlspecialchars($estado_formateado) . '</td>
                    <td>' . htmlspecialchars($row['observacion']) . '</td>
                    <td>' . htmlspecialchars($row['sala_nombre']) . '</td>
                    <td>' . htmlspecialchars($row['periodo_hora']) . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr><td colspan="8">No hay resultados disponibles</td></tr>';
}


$html .= '</tbody></table>';

// Escribir el contenido en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF al navegador
$pdf->Output('Reporte_Reservas.pdf', 'I'); // 'I' para mostrar el PDF en el navegador
?>
