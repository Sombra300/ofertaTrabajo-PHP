<?php
/**
 * @author Eloy
 * 
 * @version 2.0 
 */
 if(!empty($_POST)){
    echo '<div>';
    $comp_dni = '/^\d{8}[a-zA-Z]{1}$/'; // 5 números seguidos de un guion y una letra
    $comp_nombre = '/[a-zA-Z]{3,20}/';//letras min3 max20
    $comp_apellido1 = '/[a-zA-Z]{3,20}/';//letras min3 max20
    $comp_apellido2 = '/[a-zA-Z]{3,20}/';//letras min3 max20
    $comp_mail='/@/';//con un @
    $comp_dir='/^[a-zA-Z0-9\s,.#-]{5,100}$/';//
    $comp_telefono='/[0-9]{9}/';//
    $comp_fecha='/^\d{1,2}-\d{1,2}-\d{4}$/';//fecha
    if(!preg_match($comp_dni, $_POST['dni'])){
        echo 'el campo DNI no es aceptable, tiene que contener 23 numeros seguidos de una letra <br>';
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

        }else{
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
            <a href="indexEloy.php">Volver al inicio</a>
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
    <form action="#" method="post">
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
        <input type="submit" value="Enviar">
    </form>
    <br>
    <footer>
        <div>Eloy Estevens Romero</div>
        <img st src="/images/yo.jpg" alt="fotoEloy" >
    </footer>
</body>
</html>
