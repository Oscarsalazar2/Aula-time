<?php
function removeBOM($folderPath) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath));

    foreach ($files as $file) {
        if ($file->isFile()) {
            $filePath = $file->getRealPath();
            $content = file_get_contents($filePath);
            $bom = "\xEF\xBB\xBF";
            
            if (substr($content, 0, 3) === $bom) {
                echo "Removing BOM from: $filePath\n";
                file_put_contents($filePath, substr($content, 3));
            }
        }
    }
}

// Ruta del directorio del proyecto (ajusta esto según la ubicación de tus archivos)
$projectPath = __DIR__; // Directorio actual
removeBOM($projectPath);

echo "Proceso completado. El BOM ha sido eliminado de los archivos.";
?>
