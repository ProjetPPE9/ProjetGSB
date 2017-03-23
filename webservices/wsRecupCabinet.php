<?php

include_once 'PasserelleConnexion.php';
$bd=PasserelleConnexion::connexionBDD(); 
$bd->query("SET CHARACTER SET utf8");

//$login=$_GET['login'];
//$mdp=$_GET['mdp'];
$requeteId=$bd->prepare("Select id "
        . "from utilisateur "
        . "where login= :login and mdp= :mdp");
$requeteId->bindValue('login','dandre');
$requeteId->bindValue('mdp',MD5('oppg5'));

$requeteId->execute();
$id = $requeteId->fetch();

echo $id[0];
$requeteCabinet=$bd->prepare("select * "
        . "from cabinet "
        . "inner join medecin on cabinet.id=medecin.idCabinet "
        . "where idVisiteur=id");
$requeteCabinet->bindValue('id',$id[0]);

$requeteCabinet->execute();
$cabinets = $requeteCabinet->fetchAll();

$cabinets = json_encode($cabinets,JSON_UNESCAPED_UNICODE);
var_dump($cabinets[0]);
print ($cabinets); 


?>
