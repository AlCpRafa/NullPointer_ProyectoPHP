<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header class="header">
        <h3 class="header__logo">OscarFlix</h3>
    </header>
    <main class="main">
        <section class="login">
            <article class="login__art">
                <h2>Iniciar sesion: </h2>
                <form action="" method="post">
                    <label for="user">Nombre de usuario</label>
                    <input type="text" name="user" id="user">
                    <label for="password">Contrasena</label>
                    <input type="password" name="password" id="password">
                    <input type="reset" value="Reset">
                    <input type="submit" value="Enviar">
                </form>
            </article>
            <article class="login__art">
                <h2>Registrate: </h2>
                <form action="" method="post">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name">
                    <label for="surname">Apellidos: </label>
                    <input type="text" name="surnmame" id="surname">
                    <label for="email">Correo electronico: </label>
                    <input type="email" name="email" id="email">
                    <label for="setpass">Establece la contrasena: </label>
                    <input type="password" name="setpass" id="setpass">
                    <input type="reset" value="Reset">
                    <input type="submit" value="Enviar">
                </form>
            </article>
        </section>
    </main>
</body>
</html>