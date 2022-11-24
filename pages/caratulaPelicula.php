<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';
session_start();
timeoutSession();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Pelis</title>
    </head>
    <body>
        <?php require_once '../resources/header.php'; ?>
        <main class="main">
            <?php
            $peliculas = [];
            try {
                $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
                $consulta = "select * from peliculas;";
                $stmt = $bd->query($consulta);
                $stmt->execute();
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $peliculas[] = $fila;
                }
                $stmt->closeCursor();
                echo("<section class='section'>");
                foreach ($peliculas as $value) {
                    echo("<a href='ficha.php?id=".$value['id']."'>");
                    echo("<article class='section__card'>");
                    echo("<p class='section__titulo'>" . $value['pelicula'] . "</p>");
                    echo("<img class='section__imagenes' src=../assets/images/caratulas/" . $value['url'] . " alt='caratula de la pelicula'>");
                    echo("</article>");
                    echo("</a>");
                }
                echo("</section>");
            } catch (PDOException $EX) {
                echo ($EX->getMessage());
            }
            ?>
        </main>
    <?php require_once '../resources/footer.php'; ?>
    </body>
</html>