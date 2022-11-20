<?php
if (!file_exists("resources/conf/config.php")) {
    $conf = fopen("resources/conf/config.php","w");
    fwrite($conf,'<?php
    define("DB_HOST","mysql:dbname=nullPointer;host=127.0.0.1");
    define("DB_USER","nullPointer");
    define("DB_PASS","123");');
    fflush($conf);
    fclose($conf);
}
require_once 'resources/conf/config.php';
try {
    $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
} catch (PDOException $exc) {
    $bd = new PDO("mysql:host=127.0.0.1","root","");
    $query=file_get_contents("resources/conf/script.sql");
    try {
        $stmt = $bd->query($query);
    } catch (PDOException $exc) {
        echo "error al crear la base de datos: ".$exc->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        
        $resultados = [];
        try {
            $bd = new PDO(DB_HOST,DB_USER,DB_PASS);
            if(!$stmt = $bd->prepare("select * from peliculas;")){
                throw new Exception("Error Processing Request", 1);
            }
            if(!$stmt->execute()){
                throw new Exception("Error Processing Request execute", 1);
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($resultados,$row);
            }
        } catch (PDOException $exc) {
            echo "error al crear la base de datos: ".$exc->getMessage();
        }
        $stmt->closeCursor();
        foreach ($resultados as $value) {
            var_dump($resultados);
            echo "<br>";
        }
    ?>
    </body>
</html>