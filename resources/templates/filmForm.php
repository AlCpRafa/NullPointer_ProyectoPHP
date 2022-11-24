<section class="login">
    <h1 class="login__title">Inserta la pelicula: </h1>
    <article class="login__art">
        <form action="adminPelicula.php" method="post">
    <div>
        <label for="nombre">Nombre de la pelicula:</label>
        <input type="text" name="nombre" id="nombre">
    </div>
    <div class="login__cont">
        <label for="genero">Género</label>
        <select name="genero" id="genero">
            <option value=""></option>
        <?php
                try {
                    $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
                    $query = "select * from generos;";
                    if(!$stmt = $bd->prepare($query)){
                        echo "<h1>Error en la consulta</h1>";
                    }
                    if(!$stmt->execute()){
                        echo "<h1>Error en la consulta</h1>";
                    }
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['genero']."'>".$row['genero']."</option>";
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
                    if(!$stmt = $bd->prepare($query)){
                        echo "<h1>Error en la consulta</h1>";
                    }
                    if(!$stmt->execute()){
                        echo "<h1>Error en la consulta</h1>";
                    }
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$row['director']."'>".$row['director']."</option>";
                    }
                } catch (PDOException $exc) {
                    echo "<h1>Error en la consulta</h1>";
                }
            ?>
        </select>
    </div>
    <div class="login__cont">
        <label for="observaciones">Observaciones</label>
        <textarea name="observaciones" id="observaciones" cols="30" rows="10"></textarea>
    </div>
    <div class="login__cont">
        <label for="portada">Url de la portada</label>
        <input type="text" name="portada" id="portada">
    </div>
    <div class="login__cont">
        <label for="url">Url del trailer</label>
        <input type="url" name="url" id="url">
    </div>
    <input type="submit" value="Aceptar">
</form>
    </article>
</section>
