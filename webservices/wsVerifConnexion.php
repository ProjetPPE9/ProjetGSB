<?php

    //inclut la classe 
    include_once('PasserelleConnexion.php');
    
    //permet la connexion à la BDD
    $verif=PasserelleConnexion::connexionBDD();
    
    
    var_dump($verif);
    //json_encode($verif);
    //echo json_decode($verif);
    
    
?>