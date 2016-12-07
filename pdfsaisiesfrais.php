<?php
session_start();
require_once ("include/class.pdogsb.inc.php");
require_once ("include/fct.inc.php");
require("fpdf.php");
$pdo1 = PdoGsb::getPdoGsb();
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date('d/m/y'));

class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/gsb.png',2,2,40);//
        // Saut de ligne
        $this->Ln();
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(0,5,"Recapitulatif des fiches de frais de ".utf8_decode($_SESSION['prenom']).' '.utf8_decode($_SESSION['nom']));
    }

// Activation de la classe
    function entete_table($position_entete){
        global $pdf;
        $pdf->SetDrawColor(183); // Couleur du fond
        $pdf->SetFillColor(221); // Couleur des filets
        $pdf->SetTextColor(0); // Couleur du texte
        $pdf->SetY($position_entete);
        $pdf->SetX(2);//Marge gauche
        $pdf->Cell(41,10,'Date',1,0,'C',TRUE);//Cell(Largeur, Hauteur, Texte à afficher, bordure[1=oui/0=non], 0 pour aller à droite de la cellule, c pour centrer, TRUE pour colorier le fond de la cellule) 
        $pdf->SetX(43); // 2+41
        $pdf->Cell(41,10,'Type de Frais',1,0,'C',TRUE);
        $pdf->SetX(84); // 43+41
        $pdf->Cell(41,10,'Description',1,0,'C',TRUE);
        $pdf->SetX(125); // 84+41
        $pdf->Cell(41,10,'Quantite',1,0,'C',TRUE);
        $pdf->SetX(166); // 125+41
        $pdf->Cell(41,10,'Montant',1,0,'C',TRUE);
        $pdf->Ln(); // Retour à la ligne
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);
$intervalleH = 30;
//$position_detail = 66;
$pdf->Text(50,8,"Recapitulatif des fiches de frais de ".utf8_decode($_SESSION['prenom']).' '.utf8_decode($_SESSION['nom']));
$pdf->entete_table($intervalleH);

/*$lesforfait = $pdo1->getLesFraisForfait($idVisiteur,$mois);
foreach ($lesforfait as $unfraisf)
{
    $pdf->SetY($position_detail);
    $pdf->SetX(2);
    $pdf->MultiCell(41,10,$unfraisf['date'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(43);
    $pdf->MultiCell(41,10,utf8_decode("Frais Forfaitisé"),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(84);
    $pdf->MultiCell(41,10,utf8_decode(aide($unfraisf['description'])),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(125);
    $pdf->MultiCell(41,10,$unfraisf['quantite'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(166);
    $pdf->MultiCell(41,10,utf8_decode($unfraisf['montant']." euros "),1,'C');
    $position_detail += 12;
}*/

$leshorsforfait = $pdo1->getLesFraisHorsForfait($idVisiteur,$mois); 
foreach ($leshorsforfait as $unfraishf)
{
    $pdf->SetY($position_detail);
    $pdf->SetX(2);
    $pdf->MultiCell(41,10,$unfraishf['date'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(43);
    $pdf->MultiCell(41,10,"Frais Hors Forfait",1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(84);
    $pdf->MultiCell(41,10,utf8_decode(aide($unfraishf['libelle'])),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(125);
    $pdf->MultiCell(41,10,"1",1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(166);
    $pdf->MultiCell(41,10,utf8_decode($unfraishf['montant']." euros "),1,'C');
    $position_detail += 12;
}

// Nom du fichier
$nom = 'Mes Fiches de Frais.pdf';
    
ob_end_clean();
    
// Création du PDF
$pdf->Output($nom,'I');

