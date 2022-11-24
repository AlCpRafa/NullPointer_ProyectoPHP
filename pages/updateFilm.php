<?php
//comprobamos que existe el id
if (isset($id)) {
        //comprobamos que la pelicula con el id seleccionado existe, en caso de no existir mostraremos un error
        if(checkFilm($id)){
                try {
                //inicializamos el contador a 1
                $count = 1;
                //creamos la sentencia
                $query = "UPDATE peliculas SET pelicula=?, genero=(select id from generos where genero LIKE ?), director=(select id from directores where director LIKE ?),descripcion=?,url=?,url_trailer=? WHERE id = ?;";
                //creamos la conexion a la base de datos
                $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
                //preparamos la sentencia
                if(!$stmt = $bd->prepare($query)){
                        echo "<h1 class='title'>Error al modificar la pelicula</h1>";
                        insertLog("Update film","Operación fallida");
                }
                //recorremos el array con la informacion de la pelicula y sustituimos cada parametro por cada valor del array
                foreach ($pelicula as &$valor) {
                        $stmt->bindParam($count, $valor);
                        $count++;
                }
                //sustituimos el ultimo parametro por el id de manera que indicara que pelicula tiene que modificar
                $stmt->bindParam($count, $id);
                //ejecutamos la sentencia
                if(!$stmt->execute()){
                        echo "<h1 class='title'>Error al modificar la pelicula</h1>";
                        insertLog("Update film","Operación fallida");
                } else {
                        ?>
                <h1 class="title">Pelicula modificada correctamente</h1>
                <a class="enlaceblock" href="caratulaPelicula.php">Volver</a>
                        <?php
                insertLog("Update film","Modificación de la pelicula $id realizada correctamente");
                }
                } catch (PDOException $exc) {
                        echo "<h1 class='title'>Error al modificar la pelicula: ".$exc->getMessage()."</h1>";
                        insertLog("Update film","Operación fallida: ".$exc->getMessage());
                }
        }  else {
                ?>
                <h1 class="title">La pelicula seleccionada no existe</h1>
                <a class="enlaceblock" href="caratulaPelicula.php">Volver</a>
                <?php
        }
} else {
?>
                <h1 class="title">Error en la ruta</h1>
<a class="enlaceblock" href="caratulaPelicula.php">Volver</a>
<?php
}
?>