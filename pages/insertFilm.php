<?php
try {
    $count = 1;
    $query = "INSERT INTO peliculas (pelicula, genero, director, descripcion, url, url_trailer) VALUES (?, (select id from generos where genero LIKE ?), (select id from directores where director LIKE ?), ?, ?, ?);";
    $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
    if(!$stmt = $bd->prepare($query)){
        throw new Exception("Error Processing Request", 1);
    }
    foreach ($pelicula as &$valor) {
        $stmt->bindParam($count, $valor);
        $count++;
    }
    if(!$stmt->execute()){
        echo "<h1>Error al insertar la pelicula</h1>";
    } else {
        ?>
        <h1>Pelicula agregada correctamente</h1>
        <a href="../index.php">Volver</a>
        <?php
    }
} catch (PDOException $exc) {
    echo "<h1>Error al insertar la pelicula</h1>";
}