<?php
//comprobamos que exista la variable $id, en caso de existir continuaremos con la operacion, en caso contrario mostraremos un error
if (isset($id)) {
    //ahora comprobaremos que el id de la pelicula sea correcto, si no es correcto mostraremos un error
    if (checkFilm($id)) {
        //creamos las variables con la consulta y la conexion a la base de datos
        try {
            $query = "DELETE FROM peliculas WHERE id = ?;";
            $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
            //preparamos la sentencia
            if (!$stmt = $bd->prepare($query)) {
                echo "<h1 class='title'>Error al borrar la pelicula</h1>";
                insertLog("Delete film", "Operación fallida");
            }
            //sustituimos el parametro por el id
            $stmt->bindParam(1, $id);
            //ejecutamos la consulta
            if (!$stmt->execute()) {
                echo "<h1 class='title'>Error al borrar la pelicula</h1>";
                insertLog("Delete film", "Operación fallida");
            } else {
                ?>
                <h1 class="title">Pelicula borrada correctamente</h1>
                <a href="caratulaPelicula.php">Volver</a>
                <?php
            }
            //insertamos en la tabla logs que se ha borrado la pelicula
            insertLog("Delete film", "La pelicula $id ha sido borrada correctamente");
            //en caso de que haya algun error en alguno de los puntos de la consulta  insertaremos en logs la accion
        } catch (PDOException $exc) {
            echo "<h1 class='title'>Error al borrar la pelicula: " . $exc->getMessage() . "</h1>";
            insertLog("Delete film", "Operación fallida: " . $exc->getMessage());
        }
    } else {
        ?>
        <h1 class="title">La pelicula seleccionada no existe</h1>
        <a href="caratulaPelicula.php">Volver</a>
        <?php
    }
} else {
    ?>
    <h1 class="title">Error en la ruta</h1>
    <a href="caratulaPelicula.php">Volver</a>
    <?php
}
?>