<?php

include("vues/v_sommaire.php");
include("vues/v_messageDate.php");
$idVisiteur = $_SESSION['idVisiteur'];
$date = getDateFormate(date("d-m-Y"));
$numAnnee =substr( $date,0,4);
$numMois =substr( $date,4,2);
$numJour = substr( $date,6,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisirFrais':{
		if($pdo->estPremierFraisMois($idVisiteur,$date)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$date);
		}
		break;
	}
	case 'validerMajFraisForfait':{
                
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$date,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent �tre num�riques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
                $dateFrais = getDateFormateFr($dateFrais);
		$idFraisForfait = $_REQUEST['cbFrais'];
                $quantite = $_REQUEST['txtQuantite'];
		$montant = $_REQUEST['txtMontant'];
		//valideInfosFrais($dateFrais,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisForfait($idVisiteur,$dateFrais,$idFraisForfait,$quantite,$montant);
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisForfait($idFrais);
		break;
	}
}


$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$date);
$listeFraisForfait = $pdo->getListeFraisForfait();
$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$date);

include("vues/v_listeFraisForfait.php");

?>