<?php
    class Bd {
        // Primero creamos el atributo connection de la clase el cual contendra la conexion a la bbdd
        private $conexion=null;
        // En el constructor realizaremos la conexion a la bbdd
        public function __construct(){
            try {
                $this->conexion = new PDO(DB_HOST, DB_USER, DB_PASS);
                // con mysqli_connect_errno() cogeremos el numero de error (en caso de que exista), si existe mostraremos el error
                if (!$this->conexion) {
                    echo "error al conectar con la base de datos";
                }
            } catch (Exception $e) {
                echo $e->getMessage(); 
            }
        }
        // Para realizar un select simplemente con el metodo query de mysqli podemos hacerlo.
        public function select($query="",$param=[]) {
            $i = 1;
            $resultados = [];
            try {
                if(!$stmt = $this->conexion->prepare($query)){
                    throw new Exception("Error Processing Request", 1);
                }
                if(count($param)!=0){
                    foreach ($param as $key) {
                        $stmt->bind_param($i,$key);
                        $i++;
                    }
                }
                if(!$stmt->execute()){
                    throw new Exception("Error Processing Request execute", 1);
                }
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($resultados,$row);
                }
            } catch (Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            $stmt->closeCursor();
            return $resultados;
        }
        public function consulta($query="",$param){
            try {
                $i = 1;
                $resultados = [];
                if(!$stmt = $this->conexion->prepare($query)){
                    throw new Exception("Error Processing Request", 1);
                }
                if(count($param)!=0){
                    foreach ($param as $key) {
                        $stmt->bind_param($i,$key);
                        $i++;
                    }
                }
                if(!$stmt->execute()){
                    throw new Exception("Error Processing Request execute", 1);
                }
            } catch (Exception $e) {
                throw New Exception( $e->getMessage() );
            }
            $stmt->closeCursor();
        }
    }
?>