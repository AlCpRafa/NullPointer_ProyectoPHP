<?php
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

//Se crea una cookie para controlar las veces que el usuario ha intentado logearse sin exito
function errorCookie() {
    if (!isset($_COOKIE["errorlog"])) {
        setcookie("errorlog", 1, time() + 3600 * 24, "/");
    } else {
        $errorlog = (int) $_COOKIE["errorlog"];
        $errorlog++;
        setcookie("errorlog", $errorlog, time() + 3600 * 24, "/");
        echo "<p>Errores de inicio de sesion: $errorlog";
    }
}
//Se borra la cookie que almacena el numero de veces que el usuario ha introducido mal la contrasena
function destroyErrorLog() {
    setcookie("errorlog", 0, time() - 3600 * 24, "/");
}

//Crea la sesion
//Dentro de la sesion establece el nombre del usuario
function createUserSession($name, $rol) {
    session_start();
    if (!isset($_SESSION["username"])) {
        $_SESSION["username"] = $name;
    }
    if (!isset($_SESSION["rol"])) {
        $_SESSION["rol"] = $rol;
    }
}
//Funcion 
function imprimirNombre() {
    $nombre="";
    if (isset($_SESSION["username"])) {
        $nombre = $_SESSION["username"];
    } else {
        $nombre = "Usuario anonimo";
    }
    return $nombre;
}
function timeoutSession() {
    define("TIEMPO_MAX_SESSION", 60);
    if (isset($_SESSION["ult_actividad"]) && ((time() - $_SESSION["ult_actividad"]) > TIEMPO_MAX_SESSION)) {
        destroyUserSession();
        header("Location: ./login.php");
    }
    $_SESSION["ult_actividad"] = time();
}

function destroyUserSession() {
    session_start();
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), 0, time()-(3600*24));
}

function selectUser($username) {
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    $searchuser = $bd->prepare("select userName from users where userName=?;");
    $searchuser->execute(array($username));
    if ($searchuser->rowCount() === 0) {
        echo "<h3>No se ha encontrado ningun usuario, regitrate por favor</h3>";
    } else {
        echo "<h3>Contrasena incorrecta</h3>";
        errorCookie();
    }
    return $searchuser;
}

function userList($username, $password) {
    //Se crea la conexion
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    //Se prepara la consulta
    $userquery = $bd->prepare("select userName, password, rol from users where userName=? and password=?;");
    //Se ejecuta pasandole los campos del usuario y la contrasena
    $userquery->execute(array($username, $password));
    //Si rowCount es 0 no hay coincidencias y por tanto no existe el usuario o la contrasena es incorrecta
    echo $userquery->rowCount();
    return $userquery;
}

//Siempre y cuando estos campos no esten en blanco se porcede a realizar la consulta de los campos en la bbdd
function login($username, $password) {
    if ($username != "" && $password != "") {
        try {
            $userquery = userList($username, $password);
            $userinfo="";
            foreach ($userquery as $value) {
                $userinfo = $value;
            }
            if ($userquery->rowCount() === 0) {
                $searchuser = selectUser($username);
            } else {
                var_dump($userinfo["rol"]);
                destroyErrorLog();
                createUserSession($username, $userinfo["rol"]);
                if ($username === "admin") {
                    header("Location: ./adminPage.php");
                } else {
                    header("Location: ./fichaPelicula.php");
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo "fallo";
        }
    }
}

function registro($username, $password) {
    //Para asegurarnos que no se introducen en la tabla los campos vacios
    if ($username != "" && $password != "") {
        //Se realiza una conexion a la base de datos
        try {
            $searchuser = searchUser($username);
            if ($searchuser->rowCount() === 0) {
                insertUser($username, $password);
                createUserSession($username, $userinfo["rol"]);
                header("Location: ./fichaPelicula.php");
            } else {
                echo "<h3>El usuario ya existe</h3>";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

function insertUser($username, $password) {
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    //Se prepara la query para insertar un nuevo usuario en la tabla users
    $insert_prep = $bd->prepare("insert into users(userName, password) values (?, ?);");
    //Se ejecuta la query con los valores introducidos por el usuario
    $insert_prep->execute(array($username, $password));
}

function searchUser($username) {
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    $searchuser = $bd->prepare("select userName from users where userName=?;");
    $searchuser->execute(array($username));
    return $searchuser;
}

