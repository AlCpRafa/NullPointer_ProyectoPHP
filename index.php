<?php
if (!file_exists("resources/conf/config.php")) {
    $conf = fopen("resources/conf/config.php", "w");
    fwrite($conf, '<?php
    define("DB_HOST","mysql:dbname=nullPointer;host=127.0.0.1");
    define("DB_USER","nullPointer");
    define("DB_PASS","123");');
    fflush($conf);
    fclose($conf);
}
require_once 'resources/conf/config.php';
require_once 'resources/funcionesLoginRegistro.php';
session_start();
destroyUserSession();
try {
    $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
} catch (PDOException $exc) {
    $bd = new PDO("mysql:host=127.0.0.1","root","");
    $query=file_get_contents("resources/conf/script.sql");
    try {
        $stmt = $bd->exec($query);
    } catch (PDOException $exc) {
        echo "error al crear la base de datos: ".$exc->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/headerfooter.css">
        <link rel="stylesheet" href="./css/style.css">
                <link rel="stylesheet" href="./css/login.css">

        <title>Login</title>
    </head>

    <body>
        <header class="header">
            <h1 class="title">NullPointer</h1>
        </header>
        <main class="main">
            <section class="login">
                <article class="login__art">
                    <h2 class="login__title">Iniciar sesion: </h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="login__cont">
                            <label for="user">Nombre de usuario</label>
                            <input type="text" name="user" id="user">
                        </div>
                        <div class="login__cont">
                            <label for="password">Contrasena</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="login__cont">
                            <div class="botonera">
                                <input class="btn" type="reset" value="Reset">
                                <input class="btn" type="submit" value="Enviar">
                                <a class="btn" href="./pages/registro.php">Registro</a>
                            </div>

                        </div>
                    </form>
                </article>
                <?php login($username, $password); ?>
            </section>
        </main>
        <footer class="footer"></footer>
    </body>
</html>
