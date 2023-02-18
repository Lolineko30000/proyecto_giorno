<?php

class DB{

      #conexion a la base de datos local
      private static function connect(){
            $base_de_datos = new PDO('mysql:host=127.0.0.1;dbname=proyecto_final;charset=utf8','root','');
            $base_de_datos ->  setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $base_de_datos;
      }

      #query de a la base de datos
      public static function query($query, $params = array()){
            $statement = self::connect()->prepare($query);
            $statement -> execute($params);

            #en caso de retornar algo o bien hacer un select
            if(explode(' ',$query)[0] == 'SELECT'){
                $data = $statement->fetchAll();
                return $data;
            }
      }

}
?>
