<?php
/**
 *
 * @author Eloy
 *
 * @version 2.0
 */
 
 include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/generaMarcaAgua.inc.php';
 
 $directorioImagenes = $_SERVER['DOCUMENT_ROOT'] . '/images/candidates/original/';
 $directorioMarcaAgua = $_SERVER['DOCUMENT_ROOT'] . '/images/marca.png';
 //se crea un array para lamacenar temporalmente las imagenes
 $imagenes = array_diff(scandir($directorioImagenes), array('..', '.'));
 
 $imagenesConMarca = [];
 //pasar todas las imagenes a generaMarcaAgua.inc.php
 foreach ($imagenes as $imagen) {
     $rutaImagenOriginal = $directorioImagenes . $imagen;
     $imagenesConMarca[] = generarMarcaAgua($rutaImagenOriginal, $directorioMarcaAgua);
 }
 
 ?>
 <!-- el html con formato-->
 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Candidatos - Imágenes con Marca de Agua</title>
 </head>
 <body>
     <div style="display: flex; flex-wrap: wrap; gap: 20px;">
         <?php
         foreach ($imagenesConMarca as $index => $imagenBase64) {
             echo '<div style="padding: 10px; text-align: center;">';
             echo '<img src="' . $imagenBase64 . '" alt="" style="width: 200px; max-height:350px; height: auto;">';
             echo '</div>';
         }
         ?>
     </div>
     <br>
 </body>
 </html>
 