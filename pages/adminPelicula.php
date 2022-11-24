<?php
require_once '../resources/funciones.php';
require_once '../resources/conf/config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/headerfooter.css">
        <link rel="stylesheet" href="../css/admin.css">
        <title>Document</title>
    </head>
    <body>
        <?php require_once '../resources/header.php';?>
        <main class="main">
            <?php
//            if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin") {
                $id = filter_input(INPUT_GET, "id");
                $pelicula = filter_input_array(INPUT_POST);
                if (isset($id)) {
                    if (isset($pelicula)) {
                        require_once 'updateFilm.php';
                    } else {
                        require_once "../resources/templates/updateFilmForm.php";
                    }
                } else {
                    if (isset($pelicula)) {
                        require_once 'insertFilm.php';
                    } else {
                        require_once "../resources/templates/filmForm.php";
                    }
                }
//            } else {
//                header("Location:../index.php");
//            }
//            ?>
        </main>
        <?php require_once '../resources/footer.php';?>
    </body>
</html>