<?php
/**
 * @author Eloy
 *
 * @version 2.0
 */
 if(!empty($_POST)){
    echo '<div>';
    $comp_dni = '/^\d{8}[a-zA-Z]{1}$/'; // 8 números seguidos de una letra
    $comp_nombre = '/[a-zA-Z]{3,20}/';//letras min3 max20
    $comp_apellido1 = '/[a-zA-Z]{3,20}/';//letras min3 max20
    $comp_apellido2 = '/[a-zA-Z]{3,20}/';//letras min3 max20
    $comp_mail='/@/';//con un @
    $comp_dir='/^[a-zA-Z0-9\s,.#-]{5,100}$/';//
    $comp_telefono='/[0-9]{9}/';//
    $comp_fecha='/^\d{1,2}-\d{1,2}-\d{4}$/';//fecha
    if(!preg_match($comp_dni, $_POST['dni'])){
        echo 'el campo DNI no es aceptable, tiene que contener 8 numeros seguidos de una letra <br>';
        $error='error';
    }
    if(!preg_match($comp_nombre, $_POST['nombre'])){
        echo 'el campo Nombre no es aceptable, tiene que contener entre 3 y 20 letras<br>';
        $error='error';
    }
    if(!preg_match($comp_apellido1, $_POST['apellido1'])){
        echo 'el campo Apellido no es aceptable, tiene que contener entre 3 y 20 letras<br>';
        $error='error';
    }
    if(!preg_match($comp_apellido2, $_POST['apellido2'])){
       
        if(empty($_POST['apellido2'])){


        } else {
            echo 'el campo Apellido no es aceptable, tiene que contener entre 3 y 20 letras<br>';
            $error='error';
        }
    }
    if(!preg_match($comp_mail, $_POST['mail'])){
        echo 'el campo Mail no es aceptable, tiene que incluir una @<br>';
        $error='error';
    }
    if(!preg_match($comp_dir, $_POST['direccion'])){
        echo 'el campo Dirección no es aceptable, no tiene que estar vacio<br>';
        $error='error';
    }
    if(!preg_match($comp_telefono, $_POST['telefono'])){
        echo 'el campo Telefono no es aceptable, tiene que tener 9 numeros<br>';
        $error='error';
    }
    if(!preg_match($comp_fecha, $_POST['fecha'])){
        echo 'el campo Fecha no es aceptable, tiene que seguir el formato DD-MM-AAAA usando "-"<br>';
        $error='error';
    }
   
    /**
     * Recorda el isset o si no falla
     */
    if(!empty($_FILES['fileDocum'])){
        if (isset($_FILES['filePhoto']) && $_FILES['filePhoto']['error'] != UPLOAD_ERR_OK) {
            $error='error';
            echo 'Error: ';
            switch ($_FILES['filePhoto']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo 'El fichero es demasiado pesado';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo 'El fichero no se ha podido subir por completo';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo 'No se ha subido ningún fichero';
                    break;
                default:
                    echo 'Error indeterminado';
                    break;
            }
        }
            if ($_FILES['filePhoto']['type'] != 'image/jpeg' && $_FILES['filePhoto']['type'] != 'image/png') {
                echo 'La imagen tiene que ser un jpg o un png';
                $error = 'error';
            }else{
                /**
                 * Recorda posar tmp_name per a que identifique el string del nom i revisar
                 * Tambe gastar rutes absolutes
                 */
                if (is_uploaded_file($_FILES['filePhoto']['tmp_name'])===true) { 
                    $rutaImagen = $_SERVER['DOCUMENT_ROOT'] .'/images/candidates/' . $_POST['dni'] . '.png';
                    if (!move_uploaded_file($_FILES['filePhoto']['tmp_name'], $rutaImagen)) {
                        echo 'Error: No se pudo guardar el fichero.<br>';
                        $error = 'error';
                    }else{
                        $originalImage = imagecreatefrompng('./images/candidates/' . $_POST['dni'] . '.png');
                        // Obtener las dimensiones originales de la imagen
                        $originalWidth = imagesx($originalImage);
                        $originalHeight = imagesy($originalImage);
                        // Calcular el nuevo tamaño (por ejemplo, la mitad del tamaño original)
                        $newWidth = intval($originalWidth / 2);
                        $newHeight = intval($originalHeight / 2);
                        // Crear una nueva imagen con las nuevas dimensiones
                        $newImage = imagecreatetruecolor($newWidth, $newHeight);
                        // Redimensionar la imagen original y copiarla a la nueva imagen
                        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
                        // Guardar la miniatura como un archivo PNG
                        imagepng($newImage, $_SERVER['DOCUMENT_ROOT'] . '/images/candidates/peques/' . $_POST['dni'] . '-thumbnail.png');
                    }
                }
            }
    }else{
    $error = 'error';
    echo 'Tienes que introducir la imagen en formato png o jpg <br>';
}
    if(!empty($_FILES['fileDocum'])){
        if (isset($_FILES['fileDocum']) && $_FILES['fileDocum']['error'] != UPLOAD_ERR_OK) {
            $error='error';
            echo 'Error: ';
            switch ($_FILES['fileDocum']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo 'El fichero es demasiado pesado';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo 'El fichero no se ha podido subir por completo';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo 'No se ha subido ningún fichero';
                    break;
                    echo 'Error indeterminado';
                    break;
            }
        }

        if ($_FILES['fileDocum']['type'] != 'application/pdf') {
            echo 'El documento tiene que ser un PDF';
            $error = 'error';
        }else{
            if (is_uploaded_file($_FILES['fileDocum']['tmp_name'])===true) { 
                $rutaDocum = $_SERVER['DOCUMENT_ROOT'] .'/cvs/' . $_POST['dni'] .'-'.$_POST['nombre'].'-'. $_POST['apellido1'].'.pdf';
                if (!move_uploaded_file($_FILES['fileDocum']['tmp_name'], $rutaDocum)) {
                    echo 'Error: No se pudo guardar el fichero.<br>';
                    $error = 'error';
            }
        }
    }
    }else{
        $error = 'error';
        echo 'Tienes que introducir el curriculum en pdf <br>';
    }




    echo '</div>';
    if(empty($error)){
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Index</title>
        </head>
        <body>
            <h1>Registro completado correctmente</h1>
            <br>
            <a href="indexEloy.php">Volver al inicio</a><br>
            <a href="candidatos.php">Ver candidatos</a>
            <footer>
                <div>Eloy Estevens Romero</div>
                <img st src="/images/yo.jpg" alt="fotoEloy" >
            </footer>
        </body>
        </html>';
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h1>Formulario</h1>
<!--                               recorda del [encrype="from-data"] o no pilla el archiu -->
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni" value="<?= (isset($_POST['dni']))?$_POST['dni']:''?>">
        <br>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= (isset($_POST['nombre']))?$_POST['nombre']:''?>">
        <br>
        <label for="apellido1">Primer apellido</label>
        <input type="text" name="apellido1" id="apellido1" value="<?= (isset($_POST['apellido1']))?$_POST['apellido1']:''?>">
        <br>
        <label for="apellido2">Segundo apellido</label>
        <input type="text" name="apellido2" id="apellido2" value="<?= (isset($_POST['apellido2']))?$_POST['apellido2']:''?>">
        <br>
        <label for="mail">Mail</label>
        <input type="text" name="mail" id="mail" value="<?= (isset($_POST['mail']))?$_POST['mail']:''?>">
        <br>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" value="<?= (isset($_POST['direccion']))?$_POST['direccion']:''?>">
        <br>
        <label for="telefono">telefono</label>
        <input type="text" name="telefono" id="telefono" value="<?= (isset($_POST['telefono']))?$_POST['telefono']:''?>">
        <br>
        <label for="fecha">Fecha de nacimiento</label>
        <input type="text" name="fecha" id="fecha" value="<?= (isset($_POST['fecha']))?$_POST['fecha']:''?>">
        <br>
        <label for="filePhoto">Introduce una imagen</label><br>
        <input type="file" name="filePhoto" id="filePhoto">
        <br>
        <label for="fileDocum">Introduce un PDF del curriculum</label> <br>
        <input type="file" name="fileDocum" id="fileDocum">
        <br>
        <input type="submit" value="Enviar">
    </form>
    <br>
    <footer>
        <div>Eloy Estevens Romero</div>
        <img st src="/images/yo.jpg" alt="fotoEloy" >
    </footer>
</body>
</html>

