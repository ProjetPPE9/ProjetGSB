<?php

include 'wsVerifConnexionBDD.php';
if ($bd!=false)
{
$identifiant = $_GET['identifiant'];
$requeteId="select id from utilisateur where login='".$identifiant."'";
$reqId = $bd->query($requeteId);
$id = $reqId->fetch();


print (json_encode($id)); 
}
else
{
echo $bd;
}
?>