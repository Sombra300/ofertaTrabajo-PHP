<?php
/**
 * 
 *
 * @author Eloy
 *
 * @version 2.0
 */

// Incluir el archivo que contiene la función para generar la marca de agua
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/generaMarcaAgua.inc.php';

// Directorio donde están las imágenes originales y el archivo de marca de agua
$directorioImagenes = $_SERVER['DOCUMENT_ROOT'] . '/images/candidates/';
$directorioMarcaAgua = $_SERVER['DOCUMENT_ROOT'] . '/images/marca.png';

// Escanear el directorio para obtener todas las imágenes
$imagenes = array_diff(scandir($directorioImagenes), array('..', '.'));


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatos - Imágenes con Marca de Agua</title>
</head>
<body>
    <h1>Imágenes de Candidatos con Marca de Agua</h1>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php
        // Procesa cada imagen en el directorio
        foreach ($imagenes as $imagen) {
            // Ruta completa de la imagen original
            $rutaImagenOriginal = $directorioImagenes . $imagen;

            // Crear la ruta donde se guardará la nueva imagen con marca de agua
            $rutaImagenConMarca = $directorioImagenes . 'marca_' . $imagen;

            // Generar la imagen con marca de agua si no existe ya
            if (!file_exists($rutaImagenConMarca)) {
                generarMarcaAgua($rutaImagenOriginal, $directorioMarcaAgua, $rutaImagenConMarca);
            }

            // Mostrar cada imagen con marca de agua en el navegador dentro de la estructura HTML
            echo '<div style="border: 1px solid #ddd; padding: 10px; text-align: center;">';
            echo '<img src="/images/candidates/marca_' . $imagen . '" alt="Imagen con marca de agua" style="width: 200px; height: auto;">';
            echo '<p>' . htmlspecialchars($imagen) . '</p>';
            echo '</div>';
        }
        ?>
    </div>
    <br>
    <a href="indexEloy.php">Participar en la oferta</a>
</body>
</html>