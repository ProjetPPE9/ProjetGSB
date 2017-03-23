<?php

    class PasserelleConnexion {

        public static function connexionBDD(){
            try
            {
               $dsn = 'mysql:host=localhost;dbname=projetgsb';
               $bd = new PDO($dsn, "root", "");
               $bd->query("SET CHARACTER SET utf8");
            }
            catch(PDOException $e)
            {
               $bd = false;
            }

            return $bd;
        }
    }
    
    
        
?>