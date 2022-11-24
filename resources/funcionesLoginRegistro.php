<?php
//Variables para almacenar el nombre y la password del usuario
$username = "";
$password = "";

//Se comprueba si se han mandado valores por POST y se almacenan
if (isset($_POST["user"])) {
    $username = $_POST["user"];
}
if (isset($_POST["password"])) {
    $password = $_POST["password"];
}

/* ---COOKIES--- */
/*Funcion que crea una cookie para controlar las veces que el usuario ha intentado logearse sin exito*/
function errorCookie() {
    if (!isset($_COOKIE["errorlog"])) {
        setcookie("errorlog", 1, time() + 3600 * 24, "/");
    } else {
        $errorlog = (int) $_COOKIE["errorlog"];
        $errorlog++;
        setcookie("errorlog", $errorlog, time() + 3600 * 24, "/");
        echo "<p>Errores de inicio de sesion: $errorlog</p>";
    }
}
/*Funcion para borrar la cookie errorlog*/
function destroyErrorLog() {
    setcookie("errorlog", 0, time() - 3600 * 24, "/");
}

/* ---SESIONES--- */
/*Funcion que crea la sesion y las variables de sesion con el nombre y el rol del usuario*/
function createUserSession($name, $rol) {
    session_start();
    if (!isset($_SESSION["username"])) {
        $_SESSION["username"] = $name;
    }
    if (!isset($_SESSION["rol"])) {
        $_SESSION["rol"] = $rol;
    }
}

/*Funcion que se utiliza en el encabezado para mostrar el nombre del usuario*/
function imprimirNombre() {
    $nombre="";
    if (isset($_SESSION["username"])) {
        $nombre = $_SESSION["username"];
    } else {
        $nombre = "Usuario anonimo";
    }
    return $nombre;
}

/*Funcion que se utiliza para que la sesion finalice pasado un tiempo*/
function timeoutSession() {
    //Se define una contante con un valor de 60
    //Esta constante representa el tiempo maximo sin actividad
    define("TIEMPO_MAX_SESSION", 60);
    //Si ult_actividad esta inicializado y al restar su valor a time() el resultado es mayor a la constante -->
    if (isset($_SESSION["ult_actividad"]) && ((time() - $_SESSION["ult_actividad"]) > TIEMPO_MAX_SESSION)) {
        //Se destruye la sesion
        destroyUserSession();
        //Redirige al usuario al login
        header("Location: ../index.php");
    }
    //Se crea la variable de sesion ult_actividad o se actualiza dandole el valor de time() en ese momento
    $_SESSION["ult_actividad"] = time();
}

/*Funcion que se encarga de destruir la sesion*/
function destroyUserSession() {
    //Elimina todas las variables de $_SESSION
    $_SESSION = array();
    //Destruye la sesion
    session_destroy();
    //Elimina tambien las cookies
    setcookie(session_name(), 0, time()-(3600*24));
}

/* ---BBDD Y CONSULTAS--- */
/*Funcion que se encarga de verificar que el usuario que se haya introducido no se haya registrado ya en la base de datos*/
function selectUser($username) {
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    $searchuser = $bd->prepare("select userName from users where userName=?;");
    $searchuser->execute(array($username));
    if ($searchuser->rowCount() === 0) {
        echo "<p>No se ha encontrado ningun usuario, regitrate por favor</p>";
    } else {
        echo "<p>Contrasena incorrecta</p>";
        errorCookie();
    }
    return $searchuser;
}
/*Funcion que se usa dentro de la funcion de login() para verificar si el nombre de usuario y la contrasena 
introducidos. El funcionamiento es el siguiente: Se realiza una consulta a la tabla de los users
y se establece en la clausula where que el nombre y la contrasena sean los que se han introducido en el formulario.
Si no se encuentra un usuario con la contrasena correspondiente asociada el rowCount sera === 0, de lo contrario sera igual a 1*/
function userList($username, $password) {
    //Se crea la conexion
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    //Se prepara la consulta
    $userquery = $bd->prepare("select userName, password, rol from users where userName=? and password=?;");
    //Se ejecuta pasandole los campos del usuario y la contrasena
    $userquery->execute(array($username, $password));
    //Si rowCount es 0 no hay coincidencias y por tanto no existe el usuario o la contrasena es incorrecta
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
                destroyErrorLog();
                createUserSession($username, $userinfo["rol"]);
                header("Location: ./pages/caratulaPelicula.php");
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo "fallo";
        }
    }
}

/*Funcion que se utiliza en la pagina de registro.php
Funcionamiento: Se asegura de que se haya introducido. */
function registro($username, $password) {
    //Para asegurarnos que no se introducen en la tabla los campos vacios
    if ($username != "" && $password != "") {
        //Se realiza una conexion a la base de datos
        try {
            $searchuser = searchUser($username);
            if ($searchuser->rowCount() === 0) {
                insertUser($username, $password);
                createUserSession($username, null);
                header("Location: ./caratulaPelicula.php");
            } else {
                echo "<h3>El usuario ya existe</h3>";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

/*Funcion que se utiliza dentro de la funcion registro()
Inserta dentro de la tabla users un usuario con su respectivo nombre y contrasena */
function insertUser($username, $password) {
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    //Se prepara la query para insertar un nuevo usuario en la tabla users
    $insert_prep = $bd->prepare("insert into users(userName, password) values (?, ?);");
    //Se ejecuta la query con los valores introducidos por el usuario
    $insert_prep->execute(array($username, $password));
}

/*Funcion que se utiliza dentro de la funcion registro()
Realiza una consulta en la tabla users con el nombre que se le pasa como parametro */
function searchUser($username) {
    $bd = new PDO(DB_HOST, DB_USER, DB_PASS);
    $searchuser = $bd->prepare("select userName from users where userName=?;");
    $searchuser->execute(array($username));
    return $searchuser;
}

