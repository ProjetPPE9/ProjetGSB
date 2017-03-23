<?php


$identifiant = $_GET['identifiant'];
$requeteId="select id from utilisateur where login='".$identifiant."'";
$reqId = $pdo->query($requeteId);
$id = $reqId->fetch();


$requeteMedecin="select * from medecin where idVisiteur='".$id[0]."'";
$reqMedecin = $pdo->query($requeteMedecin);

$medecins = $reqMedecin->fetchAll(PDO::FETCH_ASSOC);


$medecins = json_encode($medecins,JSON_UNESCAPED_UNICODE);


//$essai = array();
//$essai = $medecins[0];
print($medecins);
//print (json_encode($cabinets)); 
//$requeteCabinet="select * from cabinet inner join medecin on cabinet.id=medecin.idCabinet where idVisiteur='".$id[0]."'";

?>