<?php
/**
 * 
 *
 * @author Eloy
 *
 * @version 
 *
 */
function generarMarcaAgua($rutaImagenOriginal, $rutaMarcaAgua) {
    // Cargar la imagen de marca de agua
    $marcaAgua = imagecreatefrompng($rutaMarcaAgua);
    
    // Redimensionar la marca de agua a un ancho de 50 píxeles
    $marcaAgua = imagescale($marcaAgua, 50);
    
    // Permitir transparencia en la marca de agua
    imagealphablending($marcaAgua, false);
    imagesavealpha($marcaAgua, true);
    
    // Obtener dimensiones de la marca de agua
    $marcaWidth = imagesx($marcaAgua);
    $marcaHeight = imagesy($marcaAgua);
    
    // Aplicar filtro de transparencia a la marca de agua
    imagefilter($marcaAgua, IMG_FILTER_COLORIZE, 0, 0, 0, 60);
    
    // Cargar la imagen original (suponiendo que es siempre PNG en este caso)
    $image = imagecreatefrompng($rutaImagenOriginal);
    
    // Obtener dimensiones de la imagen original
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    // Copiar la marca de agua sobre la imagen original en la esquina inferior derecha
    $destX = $imageWidth - $marcaWidth - 10; // Margen de 10px desde la derecha
    $destY = $imageHeight - $marcaHeight - 10; // Margen de 10px desde abajo
    imagecopy($image, $marcaAgua, $destX, $destY, 0, 0, $marcaWidth, $marcaHeight);
    
    // Mostrar la imagen en el navegador sin guardarla
    header('Content-Type: image/png');
    imagepng($image);

    // Liberar memoria
    imagedestroy($image);
    imagedestroy($marcaAgua);
}

