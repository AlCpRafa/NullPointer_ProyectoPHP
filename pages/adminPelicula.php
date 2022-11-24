<?php
//importamos los archivos de configuracion y de funciones
require_once '../resources/funciones.php';
require_once '../resources/conf/config.php';
//iniciamos la sesion para poder recoger los datos del usuario
session_start();
//en la variable $error mostraremos si alguno de los inputs esta vacio, en caso de que todo este correcto la variable sera una cadena vacia
$error = "";
$delete = filter_input(INPUT_GET,"delete");
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/headerfooter.css">
        <link rel="stylesheet" href="../css/login.css">
        <title>Fichas</title>
    </head>
<body>
    <?php include_once '../resources/header.php'; ?>
    <main class="main">
<?php
//Lo primero que tenemos que hacer es comprobar que el usuario ha iniciado sesion y que el usuario sea administrador, en caso de no cumplir alguno de los requisitos le mandaremos al index
    if(isset($_SESSION["rol"]) && $_SESSION["rol"]==="admin"){
        //Recogemos $_GET para comprobar si se ha pasado el id de una pelicula
        $id = filter_input(INPUT_GET,"id");
        //Recogemos $_POST para comprobar si se ha introducido informacion en el formulario de insercion o modificacion
        $pelicula = filter_input_array(INPUT_POST);
        //comprobamos si existe $id, en caso de existir mostraremos el formulario de modificacion y si no mostraremos el de insercion
        if (isset($id)) {
            //comprobamos si existe la variable delete, en caso de existir cargaremos el fichero para que borre el registro
            if (isset($delete)) {
                require_once 'deletePelicula.php';
            } else {
                //comprobamos si existe el array $pelicula, en caso de existir significaria que se ha introducido datos en el formulario y por lo tanto cargaremos el fichero
                //updateFilm.php donde insertara los datos en la base de datos, si no, cargaremos el formulario de modificacion
                if (isset($pelicula)) {
                    //comprobamos que ninguno de los inputs esten vacios, en caso de que haya alguno vacio modificaremos la variable $error y cargaremos de nuevo el formulario
                    if (checkFilmForm($pelicula)) {
                        require_once 'updateFilm.php';
                    } else {
                        $error="Falta algún parámetro";
                        require_once "../resources/templates/updateFilmForm.php";
                    }
                } else {
                    require_once "../resources/templates/updateFilmForm.php";
                }
            }
            
        } else {
            //las comprobaciones para insertar una pelicula son iguales que en modificacion
            if (isset($pelicula)) {
                if (checkFilmForm($pelicula)) {
                    require_once 'insertFilm.php';
                } else {
                    $error="Falta algún parámetro";
                    require_once "../resources/templates/filmForm.php";
                }
            } else {
                require_once "../resources/templates/filmForm.php";
            }
            
        }
        
    } else {
        header("Location:../index.php");
    }
?>
</main>    

<?php include_once '../resources/footer.php'; ?>
</body>
</html>