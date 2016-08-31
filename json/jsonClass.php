<?php
class Doc {
	//1
	public $formation = "";
	public $filiere = "";
	public $maturite = "";
	//2.1
	public $genreApprenti = "";
	public $nomApprenti = "";
	public $prenomApprenti  = "";
	public $addresseApprentiComplete = [];
	public $telFixeApprenti = "";
	public $telMobileApprenti = "";
	public $mailApprenti = "";
	public $dateNaissanceApprenti = "";
	public $origineApprenti = "";
	public $nationaliteApprenti = "";
	public $langueMaternelleApprenti = "";
	// 4 checkboxes
	public $connaissancesLinguistiques = [];
	public $connaissanceFrancais = "";
	//public $connaissanceAllemand = "";
	//public $connaissanceAnglais = "";
	//public $connaissanceAutres = "";
	//2.2
	public $majeur = "";
	public $representants = [];
	//3.1
	public $scolarite = [];
	public $anneeFinScolarite = "";
	//3.2
	public $activitesProfessionnelles = [];
	//3.3
	public $stages = [];
	public $dejaCandidat = "";
	public $anneeCandidature = "";
	//others
	public $datePostulation = "";
}
?>          
