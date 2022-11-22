<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';
session_start();
destroyErrorLog();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/login.css">
        <title>Login</title>
    </head>

    <body>
        <?php require_once '../resources/header.php';?>
        <main class="main">
            <section class="login">
                <article class="login__art">
                    <h2>Registrate: </h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="login__cont">
                            <label for="name">Nombre de usuario: </label>
                            <input type="text" name="user" id="user">
                        </div>
                        <div class="login__cont">
                            <label for="setpass">Establece la contrasena: </label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="login__cont">
                            <input type="reset" value="Reset">
                            <input type="submit" value="Enviar">
                        </div>
                        <?php registro($username, $password); ?>
                    </form>
                </article>
            </section>
        </main>
    </body>

</html>
