<?php

include_once 'PasserelleConnexion.php';
$bd=PasserelleConnexion::connexionBDD(); 
$bd->query("SET CHARACTER SET utf8");

$id=$_GET['id'];

$requeteCabinet=$bd->prepare("select * "
        . "from cabinet "
        . "inner join medecin on cabinet.id=medecin.idCabinet "
        . "where idVisiteur=:id");
$requeteCabinet->bindValue(':id',$id);

$requeteCabinet->execute();
$cabinets = $requeteCabinet->fetchAll();

$cabinets = json_encode($cabinets,JSON_UNESCAPED_UNICODE);

print ($cabinets); 


?>
