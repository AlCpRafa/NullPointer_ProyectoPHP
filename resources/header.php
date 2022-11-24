<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';
?>

<header class="header">
    <img src="../assets/images/popcorn.png" alt="logo" class="header__img">
    <h2><?php echo imprimirNombre(); ?></h2>
    <div class="insertar">
    <?php
        if (isset($_SESSION["rol"])&&$_SESSION["rol"]==="admin") {
            echo "<a href='adminPelicula.php'>Insertar pelicula</a>";
        }
    ?>
    </div>
    <div>
        <?php
            if(isset($_SESSION["username"])){
                echo "<a href='closeSession.php'>Salir</a>";
            }
        ?>
    </div>
</header>
