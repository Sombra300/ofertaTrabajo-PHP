<?php
/**
 *
 * @author Eloy
 *
 * @version 
 *
 */
function generarMarcaAgua($rutaImagenOriginal, $rutaMarcaAgua) {
    // Verificar si el archivo de la imagen original existe
    if (!file_exists($rutaImagenOriginal) || !is_readable($rutaImagenOriginal)) {}
    
    // Verificar si el archivo de la marca de agua existe
    if (!file_exists($rutaMarcaAgua) || !is_readable($rutaMarcaAgua)) {}
    
    // Cargar la imagen de marca de agua
    $marcaAgua = imagecreatefrompng($rutaMarcaAgua);
    if ($marcaAgua === false) {}

    //  la marca de agua a un ancho de 50 píxeles
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
    if ($image === false) {

    }

    // Obtener dimensiones de la imagen original
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    // Copiar la marca de agua sobre la imagen original en la esquina inferior derecha
    $destX = $imageWidth - $marcaWidth - 10; 
    $destY = $imageHeight - $marcaHeight - 10;
    imagecopy($image, $marcaAgua, $destX, $destY, 0, 0, $marcaWidth, $marcaHeight);

    // Guardar la imagen en una variable
    ob_start(); // Iniciar el buffer de salida
    imagepng($image);
    $imageData = ob_get_clean(); // Obtener el contenido del buffer

  
    $base64Image = 'data:image/png;base64,' . base64_encode($imageData);

    // Liberar memoria
    imagedestroy($image);
    imagedestroy($marcaAgua);

    return $base64Image;

}