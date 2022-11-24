<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';

function mostrarRol() {
    if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin") {
        echo $_SESSION["rol"];
    } else {
        echo "Cliente";
    }
}
?>

<footer class="footer">
    <h2>Nivel de usuario: <?php mostrarRol(); ?></h2>
</footer>

