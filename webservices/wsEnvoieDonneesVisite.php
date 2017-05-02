<?php

include_once 'PasserelleConnexion.php';
$bd=PasserelleConnexion::connexionBDD();
$bd->query("SET CHARACTER SET utf8");

$date = $_GET['date'];
$rdv = $_GET['rdv'];
$heureArriveeCabinet = $_GET['heureArriveeCabinet'];
$heureDebutEntretien = $_GET['heureDebutEntretien'];
$heureDepartCabinet = $_GET['heureDepartCabinet'];
$idVisiteur = $_GET['idVisiteur'];
$idMedecin = $_GET['idMedecin'];
//$requete=$bd->prepare("INSERT INTO Visite (date, rdv, heureArriveeCabinet, heureDebutEntretien, heureDepartCabinet, idVisiteur, idMedecin)  "
//        . "VALUES ('2017-05-02',0, '10:00:00', '11:00:00', '12:00:00', 'a17', 1)");

$requete=$bd->prepare("INSERT INTO Visite (date, rdv, heureArriveeCabinet, heureDebutEntretien, heureDepartCabinet, idVisiteur, idMedecin)  "
        . "VALUES ('$date', $rdv, '$heureArriveeCabinet', '$heureDebutEntretien', '$heureDepartCabinet', '$idVisiteur', $idMedecin)");

$requete->execute();
//$id = $requete->fetch();


//print (json_encode($id[0]));

?>