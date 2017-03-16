<?php

    try
    {
       $dsn = 'mysql:host=localhost;dbname=projetgsb';
       $bd = new PDO($dsn, "root", "");
    }
    catch(PDOException $e)
    {
       $bd = false;
    }

    json_encode($bd);
    echo json_decode($bd);
        
?>