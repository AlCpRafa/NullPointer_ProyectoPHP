<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Document</title>
    </head>
    <body>
        <?php require_once '../resources/header.php';?>
        <form action="" method="post">
            <h1>Agnadir una nueva pelicula</h1>
            <div class="admin__cont">
                <label for="name">Titulo</label>
                <input type="text" name="film_title" id="film_title">
            </div>
            <div class="admin__cont">
                <label for="name">Genero: </label>
                <input type="text" name="film_genre" id="film_genre">
            </div>
            <div class="admin__cont">
                <label for="name">Director: </label>
                <input type="text" name="film_director" id="film_director">
            </div>
            <div class="admin__cont">
                <label for="name">Poster: </label>
                <input name="film_img" type="file" id="film_img" accept="image/png,image/jpeg">
            </div>
            <div class="admin__cont">
                <input type="submit" value="Submit">
                <input type="reset" value="Reset">
            </div>
        </form>
    </body>
</html>