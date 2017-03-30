<?php

include_once 'PasserelleConnexion.php';
$bd=PasserelleConnexion::connexionBDD();
$bd->query("SET CHARACTER SET utf8");

//$login=$_GET['login'];
//$mdp=$_GET['mdp'];
$requeteId=$bd->prepare("Select numversion "
        . "from version ");

$requeteId->execute();
$id = $requeteId->fetch();


print (json_encode($id[0]));

?>