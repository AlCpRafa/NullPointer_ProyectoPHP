<?php
/**
* @param: $pelicula
* @return: boolean $valid
* Esta funcion recorrerá el array (sera un array donde tendremos guardados los inputs del formulario) y comprobara si hay algun input vacio, en caso de que lo haya modificara para que la variable
* $valid valga false. Al final retornara $valid.
*/
function checkFilmForm($pelicula){
    $valid = true;
    foreach ($pelicula as $value) {
        if($value===""){
            $valid=false;
        }
    }
    return $valid;
}
/**
 * @param: $usuario
 * Esta funcion recibira como parametro $usuario que sera un array con los inputs del registro y mandara un email con los datos introducidos en el formulario 
 */
function eMail($usuario){
    $body = "Usuario: ".$usuario['name']."\n contraseña: ".$usuario['setpass'];
    mail($usuario["email"],"Registro NullPointer",$body);
}
/**
 * @param: $accion
 * @param: $resultado
 * Esta funcion recibira como parametros una accion y el resultado de dicha accion e insertara en la tabla logs de la base de datos el usuario que ha realizado la accion, la fecha en la que 
 * se ha realizado, la accion realizada y el resultado. 
 */
function insertLog($accion,$resultado) {
    $fecha = getdate();
    $date = $fecha['year']."-".$fecha['mon']."-".$fecha['mday']." ".$fecha['hours'].":".$fecha['minutes'].":".$fecha['seconds'];
    // $_SESSION['username']
    if ($accion===""||$resultado==="") {
        throw new Exception("La accion o el resultado no puede estar vacio.", 1);
    } else {
        try {
            $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
            $query = "INSERT INTO logs (usuario, fecha, accion, resultado) VALUES (?, ?, ?, ?);";
            if(!$stmt = $bd->prepare($query)){
                throw new Exception("Error Processing Request", 1);
            }
            $stmt->bindParam(1, $_SESSION['username']);
            $stmt->bindParam(2, $date);
            $stmt->bindParam(3, $accion);
            $stmt->bindParam(4, $resultado);
            if(!$stmt->execute()){
                throw new Exception("<h1>Error al insertar la pelicula</h1>");
            }
        } catch (PDOException $exc) {
            throw new Exception("Error en la operacion: ".$exc->getMessage());
        }
    }
}
/**
 * @param: $id
 * @return: boolean $result
 * esta funcion comprobara que la pelicula con el id pasado por parametros existe, si existe $result valdra true y si no false. Por ultimo retorna $result
 */
function checkFilm($id) {
    $pelicula = [];
    $result = false;
    try {
        $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
        if(!$stmt = $bd->prepare("select * from peliculas where id = ?;")){
        echo "<h1>Error en la consulta</h1>";
        }
        $stmt->bindParam(1,$id);
        if(!$stmt->execute()){
        echo "<h1>Error en la consulta</h1>";
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($pelicula,$row);
        }
} catch (PDOException $exc) {
        echo "<h1>Error en la consulta</h1>";
}
$stmt->closeCursor();
if(count($pelicula)!==0){
    $result=true;
}
return $result;
}
/**
 * @return: boolean $valid
 * Esta funcion comprobara que el usuario haya iniciado sesion y que el usuario sea administrador
 */
function checkAdmin(){
    $valid = false;
    if(isset($_SESSION["rol"])&& $_SESSION["rol"]==="admin"){
        $valid = true;
    } 
    return $valid;
}