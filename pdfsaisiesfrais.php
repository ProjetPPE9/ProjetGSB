<?php
session_start();
require_once ("include/class.pdogsb.inc.php");
require_once ("include/fct.inc.php");
require("fpdf.php");
$pdo1 = PdoGsb::getPdoGsb();
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date('d/m/y'));
//$mois=  getMois("13/11/2016");// changer
echo $idVisiteur;
echo $mois;
class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/gsb.png',80,2,60);
        // Saut de ligne
        $this->Ln();
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,"Fiches de Frais de ".utf8_decode($_SESSION['nom']).' '.utf8_decode($_SESSION['prenom']));
    }

// Activation de la classe
    function entete_table($position_entete){
        global $pdf;
        $pdf->SetDrawColor(183); // Couleur du fond
        $pdf->SetFillColor(221); // Couleur des filets
        $pdf->SetTextColor(0); // Couleur du texte
        $pdf->SetY($position_entete);
        $pdf->SetX(8);
        $pdf->Cell(40,8,'Date',1,0,'C',1);
        $pdf->SetX(48); // 8 + 96
        $pdf->Cell(40,8,'Type de Frais',1,0,'C',1);
        $pdf->SetX(88); // 104 + 10
        $pdf->Cell(40,8,'Description',1,0,'C',1);
        $pdf->SetX(128); // 104 + 10
        $pdf->Cell(40,8,'Quantite',1,0,'C',1);
        $pdf->SetX(168); // 104 + 10// Retour à la ligne
        $pdf->Cell(40,8,'Montant',1,0,'C',1);
        $pdf->Ln(); // Retour à la ligne
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);
$popo = 58;
$position_detail = 66;
$pdf->Text(80,45,"Fiches de Frais de ".utf8_decode($_SESSION['nom']).' '.utf8_decode($_SESSION['prenom']));
$pdf->entete_table($popo);

$lesforfait = $pdo1->getLesFraisForfait($idVisiteur,$mois);
foreach ($lesforfait as $unfraisf)
{
    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(40,12,$unfraisf['date'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(48);
    $pdf->MultiCell(40,12,utf8_decode("Frais Forfaitisé"),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(88);
    $pdf->MultiCell(40,12,utf8_decode(aide($unfraisf['description'])),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(128);
    $pdf->MultiCell(40,12,$unfraisf['quantite'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(168);
    $pdf->MultiCell(40,12,utf8_decode($unfraisf['montant']." euros "),1,'C');
    $position_detail += 12;
}

$leshorsforfait = $pdo1->getLesFraisHorsForfait($idVisiteur,$mois); 
foreach ($leshorsforfait as $unfraishf)
{
    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(40,12,$unfraishf['date'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(48);
    $pdf->MultiCell(40,12,"Frais Hors Forfait",1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(88);
    $pdf->MultiCell(40,12,utf8_decode(aide($unfraishf['libelle'])),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(128);
    $pdf->MultiCell(40,12,"1",1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(168);
    $pdf->MultiCell(40,12,utf8_decode($unfraishf['montant']." euros "),1,'C');
    $position_detail += 12;
}

// Nom du fichier
$nom = 'Mes Fiches de Frais.pdf';
    
ob_end_clean();
    
// Création du PDF
$pdf->Output($nom,'I');

