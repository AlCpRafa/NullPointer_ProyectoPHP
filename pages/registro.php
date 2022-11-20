<?php
require_once '../resources/conf/config.php';
//Se declaran las variables en las que se va a almacenar el nombre de usuario y la contrasena
$username = "";
$password = "";
//Se guarda el nombre deel nuevo usuario
if (isset($_POST["name"])) {
    $username = $_POST["name"];
    echo "$username";
}
//Se guarda la contrasena del nuevo usuario
if (isset($_POST["setpass"])) {
    $password = $_POST["setpass"];
    echo "$password";
}
//Para asegurarnos que no se introducen en la tabla los campos vacios
if ($username != "" && $password != "") {
    //Se realiza una conexion a la base de datos
    try {
        $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
        //Se prepara la query para insertar un nuevo usuario en la tabla users
        $insert_prep = $bd->prepare("insert into users(userName, password) values (?, ?);");
        //Se ejecuta la query con los valores introducidos por el usuario
        $insert_prep->execute(array($username, $password));
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}
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
        <header class="header">
            <h3 class="header__logo">Oscardede</h3>
        </header>
        <main class="main">
            <section class="login">
                <article class="login__art">
                    <h2>Registrate: </h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
