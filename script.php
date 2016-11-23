<?php

$dsn = 'mysql:host=localhost:81;dbname=projetgsb';
$bd = new PDO($dsn, "root", "");

if($bd != false)
{
	$sql = "SELECT id, mdp FROM utilisateur";

	$req = $bd->query($sql);
	//$ligne = $req->fetch();

	
	while($ligne = $req->fetch(PDO::FETCH_OBJ))
	{
		$mdp = password_hash($ligne['mdp'], PASSWORD_DEFAULT);
		$id = $ligne['id'];
		
		$sql = "UPDATE utilisateur SET mdp = ".'$mdp'." WHERE id = ".'$id';

		$req = $bd->query($sql);
		//$ligne = $req->fetch();
	}
}
else
{
	echo "Erreur";
}
?>