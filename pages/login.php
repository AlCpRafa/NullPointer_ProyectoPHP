<?php
require_once '../resources/conf/config.php';
//Variables para almacenar el usuario y la password del usuario
$username = "";
$password = "";
//Se comprueba si se han mandado valores por POST y se almacenan
if (isset($_POST["user"])) {
    $username = $_POST["user"];
}
if (isset($_POST["password"])) {
    $password = $_POST["password"];
}
//Siempre y cuando estos campos no esten en blanco se porcede a realizar la consulta de los campos en la bbdd
if ($username != "" && $password != "") {
    try {
        //Se crea la conexion
        $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
        //Se prepara la consulta
        $userquery = $bd->prepare("select userName, password, rol from users where userName=? and password=?;");
        //Se ejecuta pasandole los campos del usuario y la contrasena
        $userquery->execute(array($username, $password));
        //Si rowCount es 0 no hay coincidencias y por tanto no existe el usuario o la contrasena es incorrecta
        echo $userquery->rowCount();
        if ($userquery->rowCount() === 0) {
            $searchuser = $bd->prepare("select userName from users where userName=?;");
            $searchuser->execute(array($username));
            echo $searchuser->rowCount();
            if ($searchuser->rowCount() === 0) {
                echo "No se ha encontrado ningun usuario, regitrate por favor";
            } else {
                echo "Contrasena incorrecta";
            }
        } else {
            echo "Login Correcto";
        }
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
        echo "fallo";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
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
                    </form>
                </article>
            </section>
        </main>
        <footer class="footer">
            <h2>Footer</h2>
        </footer>
    </body>
</html>


