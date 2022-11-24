<?php
require_once '../resources/conf/config.php';
$id = filter_input(INPUT_GET, "id");
if (isset($id)) {
    $pelicula = [];
    try {
        $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
        if (!$stmt = $bd->prepare("select * from peliculas where id = ?;")) {
            echo "<h1>Error en la consulta</h1>";
        }
        $stmt->bindParam(1, $id);
        if (!$stmt->execute()) {
            echo "<h1>Error en la consulta</h1>";
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($pelicula, $row);
        }
    } catch (PDOException $exc) {
        echo "<h1>Error en la consulta</h1>";
    }
    $stmt->closeCursor();
    // var_dump($pelicula[0]);
    if (count($pelicula) !== 0) {
        try {
            $query = "DELETE FROM peliculas WHERE id = ?;";
            $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
            if (!$stmt = $bd->prepare($query)) {
                echo "<h1>Error al borrar la pelicula</h1>";
            }
            $stmt->bindParam(1, $id);
            if (!$stmt->execute()) {
                echo "<h1>Error al borrar la pelicula</h1>";
            } else {
                ?>
                <h1>Pelicula borrada correctamente</h1>
                <a href="../index.php">Volver</a>
                <?php
            }
        } catch (PDOException $exc) {
            echo "<h1>Error al borrar la pelicula: " . $exc->getMessage() . "</h1>";
        }
    } else {
        ?>
        <h1>La pelicula seleccionada no existe</h1>
        <a href="../index.php">Volver</a>
        <?php
    }
} else {
    ?>
    <h1>Error en la ruta</h1>
    <a href="../index.php">Volver</a>
    <?php
}
?>