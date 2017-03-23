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


$requeteMedecin=$bd->prepare("select * "
        . "from medecin "
        . "where idVisiteur= :id");
$requeteMedecin->bindValue('id',$id[0]);

$requeteMedecin->execute();
$medecins = $requeteMedecin->fetchAll();

$medecins = json_encode($medecins,JSON_UNESCAPED_UNICODE);


//$essai = array();
//$essai = $medecins[0];
print($medecins);
//print (json_encode($cabinets)); 
//$requeteCabinet="select * from cabinet inner join medecin on cabinet.id=medecin.idCabinet where idVisiteur='".$id[0]."'";

?>