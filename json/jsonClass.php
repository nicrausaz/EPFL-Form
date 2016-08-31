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
	public $rep1 = [];
	public $rep2 = [];
	//3.1
	public $scolarite1 = [];
	public $scolarite2 = [];
	public $scolarite3 = [];
	public $scolarite4 = [];
	public $scolarite5 = [];
	public $anneeFinScolarite = "";
	//3.2
	public $activiteProfessionelle1 = [];
	public $activiteProfessionelle2 = [];
	public $activiteProfessionelle3 = [];
	//3.3
	public $stage1 = [];
	public $stage2 = [];
	public $stage3 = [];
	public $stage4 = [];
	public $dejaCandidat = "";
	public $anneeCandidature = "";
	//others
	public $datePostulation = "";
}
?>          
