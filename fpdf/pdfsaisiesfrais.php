<?php
// Connexion à la BDD
$bddname = 'projetgsb';
$hostname = 'localhost';
$username = 'root';
$password = '';
$db = mysqli_connect ($hostname, $username, $password, $bddname);
//mysql_connect('localhost','root','');
//mysql_select_db('projetgsb');


// Appel de la librairie FPDF
require("fpdf.php");


// Création de la class PDF
class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/gsb.png',8,2,80);
        // Saut de ligne
        $this->Ln(20);
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,'Mes coordonnées - Mon téléphone',0,0,'C');
    }
    
}

// Activation de la classe
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);
    
    
function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(50,8,'Date',1,0,'C',1);
    $pdf->SetX(50); // 8 + 96
    $pdf->Cell(50,8,'Type de Frais',1,0,'C',1);
    $pdf->SetX(100); // 104 + 10
    $pdf->Cell(50,8,'Description',1,0,'C',1);
    $pdf->SetX(150);
    $pdf->Cell(50,8,'Montant',1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}

entete_table($position_entete);

// Nom du fichier
$nom = 'Frais hors forfait-'.$row['mois'].'.pdf';
    
    
    
// Création du PDF
$pdf->Output($nom,'I');

?>