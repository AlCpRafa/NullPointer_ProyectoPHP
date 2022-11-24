<?php
try {
    //creamos la variable count la cual indicara que parametro vamos a sustituir, tenemos que inicializar a 1 ya que bindParam empieza a contar desde 1
    $count = 1;
    //creamos la consulta insert
    $query = "INSERT INTO peliculas (pelicula, genero, director, descripcion, url, url_trailer) VALUES (?, (select id from generos where genero LIKE ?), (select id from directores where director LIKE ?), ?, ?, ?);";
    //creamos la conexion a la base de datos
    $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
    //preparamos la sentencia
    if(!$stmt = $bd->prepare($query)){
        echo "<h1>Error al insertar la pelicula</h1>";
        echo "<a href='caratulaPelicula.php'>Volver</a>";
        insertLog("Insert film","Operación fallida");
    }
    //recorremos el array pelicula de manera que sustituiremos cada parametro por cada valor del array
    foreach ($pelicula as &$valor) {
        $stmt->bindParam($count, $valor);
        //aumentamos en 1 el contador para que en la siguiente vuelta modifique el siguiente parametro
        $count++;
    }
    //ejecutamos la sentencia
    if(!$stmt->execute()){
        echo "<h1>Error al insertar la pelicula</h1>";
        echo "<a href='caratulaPelicula.php'>Volver</a>";
        insertLog("Insert film","Operación fallida");
    } else {
        ?>
        <h1>Pelicula agregada correctamente</h1>
        <a href="caratulaPelicula.php">Volver</a>
        <?php
    }
    insertLog("Insert film","Acción realizada correctamente");
} catch (PDOException $exc) {
    echo "<h1>Error al insertar la pelicula</h1>";
    echo "<a href='caratulaPelicula.php'>Volver</a>";
    insertLog("Insert film","Operación fallida: ".$exc->getMessage());
}
