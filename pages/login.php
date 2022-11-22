<?php
require_once '../resources/conf/config.php';
require_once '../resources/funcionesLoginRegistro.php';
destroyUserSession();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/style.css">
        <title>Login</title>
    </head>

    <body>
        <header class="header">
            <h3 class="header__logo">Oscardede</h3>
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
                            <input type="reset" value="Reset">
                            <input type="submit" value="Enviar">
                            <a href="./registro.php">Registro</a>
                        </div>
                        <?php login($username, $password); ?>
                    </form>
                </article>
            </section>
        </main>
        <footer class="footer">
            <h2>Footer</h2>
        </footer>
    </body>
</html>


