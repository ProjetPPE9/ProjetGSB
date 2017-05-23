<?php

include_once 'PasserelleConnexion.php';
$bd=PasserelleConnexion::connexionBDD();
$bd->query("SET CHARACTER SET utf8");
if ($bd!=false)
{

$login=$_GET['login'];
$mdp=$_GET['mdp'];
$requeteId=$bd->prepare("Select id "
        . "from utilisateur "
        . "where login= :login and mdp= :mdp");
$requeteId->bindValue('login',$login);
$requeteId->bindValue('mdp',MD5($mdp));

$requeteId->execute();
$id = $requeteId->fetch();


print (json_encode($id[0])); 
}
else
{
echo 'échec connexion';
}
?>