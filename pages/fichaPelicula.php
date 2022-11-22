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
        <link rel="stylesheet" href="../css/ficha.css">
        <title>Pelis</title>
    </head>
    <body>
        <?php require_once '../resources/header.php';?>
        <main class="main">
            <section class="ficha">
                <article class="poster">
                    <img src="../assets/images/poster_test.jpg" alt="alt" class="poster_img">
                </article>
                <article class="data">
                    <h1>Titulo</h1>
                    <h2>Genero</h2>
                    <p>Descripcion</p>
                    <a href="url">Trailer</a>
                </article>
            </section>
        </main>
        <footer class="footer">
            <h2>SantiFooter</h2>
        </footer>
    </body>
</html>