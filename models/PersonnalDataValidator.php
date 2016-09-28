<?php
require_once('PersonnalData.php');

class PersonnalDataValidator {
	private $personnalData;
    private $errors = array();

    public function __construct(PersonnalData $personnalData){
        $this->personnalData = $personnalData;
    }

    public function errors(){
        return $this->errors;
    }

    public function isValid(){

        $this->filiereValid();
        $this->baseDataValid();
        $this->representantValid();
        $this->dejaCandValid();
        //check genre
        //check connaissance linguistiques
        //ckeck conditions
        
        return count($this->errors) === 0;
    }

    private function filiereValid(){
        if($this->personnalData->formation == "informaticien"){
            if($this->personnalData->filiere == ""){
                 $this->errors['filiere'] = 'Filiere non valide!';
            }
        }
    }

    private function baseDataValid(){
        $toValid = array($this->personnalData->tempSciper,
                        $this->personnalData->nomApprenti,
                        $this->personnalData->prenomApprenti,
                        $this->personnalData->formation,
                        $this->personnalData->maturite,
                        $this->personnalData->genreApprenti,
                        $this->personnalData->addresseApprentiComplete,
                        $this->personnalData->telFixeApprenti,
                        $this->personnalData->telMobileApprenti,
                        $this->personnalData->mailApprenti,
                        $this->personnalData->dateNaissanceApprenti,
                        $this->personnalData->origineApprenti,
                        $this->personnalData->nationaliteApprenti,
                        $this->personnalData->langueMaternelleApprenti);
                        
            foreach($toValid as $valid);
            echo $valid;
            if($valid==""){
                $this->errors[$valid];
            }
    }

    private function representantValid(){
        if($this->personnalData->majeur == 'false'){
            if($this->personnalData->representants.count() == 0){
                $this->errors['representants'] = 'Representants non valides!';
            }
        }
    }
    
    private function dejaCandValid(){
        if($this->personnalData->dejaCandidat == 'true'){
            if($this->personnalData->anneeCandidature == ""){
                $this->errors['anneeCandidature'] = 'Année de candidature non valide!';
            }else if(!is_numeric($this->personnalData->anneeCandidature)){
                $this->errors['anneeCandidature'] = 'Année de candidature non valide!';
            }
    }
}
}
?>