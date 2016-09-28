<?php
	require_once('../helpers.php');

	class PersonnalData {
		private $postedData;

		public $tempSciper = "";
		public $formation = "";
		public $filiere = "";
		public $maturite = "false";
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
		public $permisEtranger = "";
		public $langueMaternelleApprenti = "";
		public $connaissancesLinguistiques = "";
		public $majeur = "false";
		public $representants = [];
		public $scolarite = [];
		public $anneeFinScolarite;
		public $activitesProfessionnelles = [];
		public $stages = [];
		public $dejaCandidat = "false";
		public $anneeCandidature = "";
		public $datePostulation = "";
		public $conditionsAcceptee = "false";

		public function __construct($postedData){
			//Remplir les infos;
			$this->$postedData = $postedData;

            $this->tempSciper = checkChars($postedData['sciperTmp']);
            $this->formation = $postedData['job'];
            $this->filiere = $postedData['filInfo'];
            $this->maturite = $postedData['mpt'];
            $this->genreApprenti = $postedData['genreApp']; 
            $this->nomApprenti = $postedData['nameApp'];
            $this->prenomApprenti = $postedData['surnameApp'];
            $this->addresseApprentiComplete = array("rue"=>$postedData['adrApp'],"NPA"=>$postedData['NPAApp']);
            $this->telFixeApprenti  = $postedData['telApp'];
            $this->telMobileApprenti  = $postedData['phoneApp'];
            $this->mailApprenti = $postedData['mailApp'];
            $this->dateNaissanceApprenti = $postedData['birthApp'];
            $this->origineApprenti = $postedData['originApp'];
            $this->nationaliteApprenti = $postedData['nationApp'];
            $this->permisEtranger = $postedData['permisEtrangerApp'];
            $this->langueMaternelleApprenti = $postedData['langApp'];
            $this->setLanguages($postedData['languesApp']);
			$this->majeur = $postedData['maj'];
			if($this->majeur == "false"){
				$this->setRepresentants();
			}
			$this->setScolarite();
			$this->setAcivitesPro();
			$this->setStages();
			$this->setDejacand();

			$this->anneeFinScolarite = $postedData['anneeFin'];
			$this->datePostulation = date('j-n-o--'.'h:i:s');
			
		}

		private function setRepresentants(){
			$rep1  = array("genre"=>$postedData['genreRep1'],"nom"=>$postedData['nameRep1'],"prenom"=>$postedData['surnameRep1'],"addresse"=> array("rue"=>$postedData['adrRep1'],"NPA"=>$postedData['NPARep1']),"telephone"=>$postedData['telRep1']);    
			$rep2  = array("genre"=>$postedData['genreRep2'],"nom"=>$postedData['nameRep1'],"prenom"=>$postedData['surnameRep2'],"addresse"=> array("rue"=>$postedData['adrRep2'],"NPA"=>$postedData['NPARep2']),"telephone"=>$postedData['telRep2']);
			$this->representants = array($rep1, $rep2);
		}

		private function setScolarite(){
			for ($i = 1; $i <= 5; $i++) {
				array_push($this->scolarite, array("ecole"=>$postedData['ecole'.$i],"lieu"=>$postedData['lieuEcole'.$i],"niveau"=>$postedData['niveauEcole'.$i],"annees"=>$postedData['anneesEcole'.$i]));
			}
		}
		private function setAcivitesPro(){
			for ($i = 1; $i <= 3; $i++) {
				array_push($this->activitesProfessionnelles,array("employeur"=>$postedData['employeurPro'.$i],"lieu"=>$postedData['lieuPro'.$i],"activite"=>$postedData['activitePro'.$i],"annees"=>$postedData['anneesPro'.$i]));
			}
		}
		private function setStages(){
			for ($i = 1; $i <= 4; $i++) {
				array_push($this->stages,array("metier"=>$postedData['activiteStage'.$i],"employeur"=>$postedData['entrepriseStage'.$i]));
			}
		}
		private function setDejacand(){
			$this->dejaCandidat = $postedData['dejaCand'];
			if($postedData['dejaCand'] == "true"){
                $candidateData->anneeCandidature = $postedData['dejaCandAnnee'];
            }
		}

		public function setLanguages($languages){
			if(isset($languages) && is_array($languages)){
                $this->connaissancesLinguistiques = $languages;
            } else {
				$this->connaissancesLinguistiques = [];
			}
		}
	}
?>
