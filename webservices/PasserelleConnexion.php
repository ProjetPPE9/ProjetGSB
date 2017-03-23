<?php

    class PasserelleConnexion {

        public static function connexionBDD(){
            try
            {
               $dsn = 'mysql:host=localhost;dbname=projetgsb';
               $bd = new PDO('$dsn, charset=utf8', "root", "");
            }
            catch(PDOException $e)
            {
               $bd = false;
            }

            return $bd;
        }
    }
    
    
        
?>