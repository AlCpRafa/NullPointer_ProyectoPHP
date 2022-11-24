<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/headerfooter.css">
        <link rel="stylesheet" href="../css/ficha.css">
        <title>Fichas</title>
    </head>

    <body>
        <?php require_once '../resources/header.php'; ?>
        <main class="main">
            <?php
            require_once '../resources/conf/config.php';
            require_once '../resources/funcionesLoginRegistro.php';

            $genero = "";
            $director = "";
            session_start();
            timeoutSession();
            $id = $_GET['id'];
            try {
                //--------------Consulta para recuperar peliculas
                $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
                $consulta = "select peliculas.id,pelicula,generos.genero,directores.director,descripcion,url,url_trailer from peliculas inner join generos on peliculas.genero = generos.id inner join directores on directores.id = peliculas.director where peliculas.id = ?;";
                $stmt = $bd->prepare($consulta);
                $stmt->execute(array($id));
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $peliculas[] = $fila;
                }
                $stmt->closeCursor();
                foreach ($peliculas as $value) {
                    echo("<article class='ficha'>");
                    echo("<h2 class='ficha__titulo title'>" . $value['pelicula'] . "</h2>");
                    echo("<section class='ficha__parcial'>");
                    echo("<div class='ficha__total'>");
                    echo("<h2 class='ficha__descripcion title'>Director: " . $value['director'] . "</h2>");
                    echo("<h3 class='ficha__descripcion title'>Genero: " . $value['genero'] . "</h3>");
                    echo("<p class='ficha__descripcion'>" . $value['descripcion'] . "</p>");
                    echo("<a target='auto_blank' href='" . $value['url_trailer'] . "'> <button class='ficha__boton' type='button'>¡Ver trailer!</button></a>");
                    echo("</div>");
                    echo("<div class='ficha__contenedor'>");
                    echo("<img class='section__imagenes' src=../assets/images/caratulas/" . $value['url'] . " alt='caratula de la pelicula'>");
                    echo("</div>");
                    echo("</article>");
                }
            } catch (PDOException $EX) {
                echo ($EX->getMessage());
            }
            ?>
        </main>
        <?php require_once '../resources/footer.php'; ?>
    </body>
</html>


