<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
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
                <form action="" method="post">
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
                    </div>
                </form>
            </article>
            <article class="login__art">
                <h2>Registrate: </h2>
                <form action="" method="post">
                    <div class="login__cont">
                        <label for="name">Nombre de usuario: </label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="login__cont">
                        <label for="setpass">Establece la contrasena: </label>
                        <input type="password" name="setpass" id="setpass">
                    </div>
                    <div class="login__cont">
                        <input type="reset" value="Reset">
                        <input type="submit" value="Enviar">
                    </div>
                </form>
            </article>
        </section>
    </main>
</body>

</html>