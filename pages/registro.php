<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';
session_start();
destroyUserSession();
destroyErrorLog();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/headerfooter.css">
        <link rel="stylesheet" href="../css/login.css"/>
        <title>Login</title>
    </head>

    <body>
        <?php require_once '../resources/header.php'; ?>
        <main class="main">
            <section class="login">
                <article class="login__art">
                    <h2 class="login__title">Registrate: </h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="login__cont">
                            <label for="user">Nombre de usuario: </label>
                            <input type="text" name="user" id="user" required="required">
                        </div>
                        <div class="login__cont">
                            <label for="password">Establece la contrasena: </label>
                            <input type="password" required="required" name="password" id="password">
                        </div>
                        <div class="login__cont">
                            <label for="email">Introduce el email: </label>
                            <input required="required" type="email" id="email" name="email">
                        </div>
                        <div class="login__cont">
                            <div class="botonera">
                                <input class="btn" type="reset" value="Reset">
                                <input class="btn" type="submit" value="Enviar">
                                <a class="btn" href="../index.php">Login</a>
                            </div>
                        </div>
                        <?php registro($username, $password, $email); ?>
                    </form>
                </article>
            </section>
        </main>
        <?php require_once '../resources/footer.php'; ?>
    </body>

</html>
