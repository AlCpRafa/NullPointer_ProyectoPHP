<?php
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
    ?>
    <section class="login">
        <article class="login__art">
            <h1>Actualiza la pelicula: </h1>
            <form action="adminPelicula.php?id=<?= $id ?>" method="post">
                <div class="login__cont">
                    <label for="nombre">Nombre de la pelicula:</label>
                    <input type="text" name="nombre" id="nombre" value="<?= $pelicula[0]["pelicula"] ?>">
                </div>
                <div class="login__cont">
                    <label for="genero">Género</label>
                    <select name="genero" id="genero">
                        <option value=""></option>
                        <?php
                        try {
                            $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
                            $query = "select * from generos;";
                            if (!$stmt = $bd->prepare($query)) {
                                echo "<h1>Error en la consulta</h1>";
                            }
                            if (!$stmt->execute()) {
                                echo "<h1>Error en la consulta</h1>";
                            }
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['genero'] . "'";
                                if ($row["id"] === $pelicula[0]["genero"]) {
                                    echo " selected";
                                }
                                echo ">" . $row['genero'] . "</option>";
                            }
                        } catch (PDOException $exc) {
                            echo "<h1>Error en la consulta</h1>";
                        }
                        ?>
                    </select>
                </div>
                <div class="login__cont">
                    <label for="director">Director:</label>
                    <select name="director" id="director">
                        <option value=""></option>
                        <?php
                        try {
                            $query = "select * from directores;";
                            // $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
                            if (!$stmt = $bd->prepare($query)) {
                                echo "<h1>Error en la consulta</h1>";
                            }
                            if (!$stmt->execute()) {
                                echo "<h1>Error en la consulta</h1>";
                            }
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['director'] . "'";
                                if ($row["id"] === $pelicula[0]["director"]) {
                                    echo " selected";
                                }
                                echo ">" . $row['director'] . "</option>";
                            }
                        } catch (PDOException $exc) {
                            echo "<h1>Error en la consulta</h1>";
                        }
                        ?>
                    </select>
                </div>
                <div class="login__cont">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" cols="30" rows="10"><?= $pelicula[0]["descripcion"] ?></textarea>
                </div>
                <div class="login__cont">
                    <label for="portada">Url de la portada</label>
                    <input type="text" name="portada" id="portada" value="<?= $pelicula[0]["url"] ?>">
                </div>
                <div class="login__cont">
                    <label for="url">Url del trailer</label>
                    <input type="url" name="url" id="url" value="<?= $pelicula[0]["url_trailer"] ?>">
                </div>
                <input type="submit" value="Aceptar">
            </form>
            <?php
        } else {
            ?>
            <h1>La pelicula seleccionada no existe</h1>
            <a href="../index.php">Volver</a>
            <?php
        }
        ?>
    </article>
</section>
