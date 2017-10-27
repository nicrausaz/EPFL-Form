<?php
require('./fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('FA.png',10,6,30);
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        // Décalage à droite
        $this->Cell(60);
        // Titre
        $this->Cell(30,10,'Donnees de postulation');

        $this->SetFont('Arial','',15);
        $this->Cell(60);
        $this->Cell(30,10, date('d-m-Y'));

        // Saut de ligne
        $this->Ln(20);
    }


    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
?>
