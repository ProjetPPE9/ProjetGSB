<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}	 
$uc = $_REQUEST['uc'];
switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");break;
	}
	case 'gererFraisForfait' :{
		include("controleurs/c_gererFraisForfait.php");break;
	}
        case 'gererFraisHorsForfait' :{
		include("controleurs/c_gererFraisHorsForfait.php");break;
	}
	case 'etatFrais' :{
		include("controleurs/c_etatFrais.php");break;
	}
	
	
	}
	
	


?>







