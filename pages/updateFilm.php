<?php
$id = filter_input(INPUT_GET, "id");
if (isset($id)) {
        $pelicula = [];
        try {
                $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
                if(!$stmt = $bd->prepare("select * from peliculas where id = ?;")){
                echo "<h1>Error en la consulta</h1>";
                }
                $stmt->bindParam(1,$id);
                if(!$stmt->execute()){
                echo "<h1>Error en la consulta</h1>";
                }
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($pelicula,$row);
                }
        } catch (PDOException $exc) {
                echo "<h1>Error en la consulta</h1>";
        }
        $stmt->closeCursor();
        // var_dump($pelicula[0]);
        if(count($pelicula)!==0){
                $pelicula=filter_input_array(INPUT_POST);
                try {
                $count = 1;
                $query = "UPDATE peliculas SET pelicula=?, genero=(select id from generos where genero LIKE ?), director=(select id from directores where director LIKE ?),descripcion=?,url=?,url_trailer=? WHERE id = ?;";
                $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
                if(!$stmt = $bd->prepare($query)){
                        echo "<h1>Error al modificar la pelicula</h1>";
                }
                foreach ($pelicula as &$valor) {
                        $stmt->bindParam($count, $valor);
                        $count++;
                }
                $stmt->bindParam($count, $id);
                if(!$stmt->execute()){
                        echo "<h1>Error al modificar la pelicula</h1>";
                } else {
                        ?>
                                <h1>Pelicula agregada correctamente</h1>
                                <a href="../index.php">Volver</a>
                        <?php
                }
                } catch (PDOException $exc) {
                        echo "<h1>Error al modificar la pelicula: ".$exc->getMessage()."</h1>";
                }
        }  else {
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