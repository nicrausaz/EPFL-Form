<?php
require_once('PersonnalData.php');
require_once(__DIR__ . '/../helpers.php');

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
        $this->dataRequiredIsValid();
        $this->representantValid();
        $this->dejaCandValid();
        $this->isValidMail();
        $this->isFormationValid();
        
        return count($this->errors) === 0;
    }

    private function filiereValid(){
        if($this->personnalData->formation == "informaticien"){
            if(is_null($this->personnalData->filiere) || $this->personnalData->filiere == ""){
                 $this->errors['filiere'] = 'Filiere non valide!';
            }
        }
    }

    private function dataRequiredIsValid(){
        if(is_null($this->personnalData->genreApprenti) || $this->personnalData->genreApprenti == "" || $this->personnalData->genreApprenti =="notSelected"){
             $this->errors['genreApp'] = 'Genre non selectionné!';
        }
        $toValid = array("tempSciper" => $this->personnalData->tempSciper,
                            "nomApprenti" => $this->personnalData->nomApprenti,
                            "prenomApprenti" => $this->personnalData->prenomApprenti,
                            "formation" => $this->personnalData->formation,
                            "maturite" => $this->personnalData->maturite,
                            "addresseApprentiComplete" => $this->personnalData->addresseApprentiComplete,
                            "telFixeApprenti" => $this->personnalData->telFixeApprenti,
                            "telMobileApprenti" => $this->personnalData->telMobileApprenti,
                            "mailApprenti" => $this->personnalData->mailApprenti,
                            "dateNaissanceApprenti" => $this->personnalData->dateNaissanceApprenti,
                            "origineApprenti" => $this->personnalData->origineApprenti,
                            "nationaliteApprenti" => $this->personnalData->nationaliteApprenti,
                            "langueMaternelleApprenti" => $this->personnalData->langueMaternelleApprenti);
                        
            foreach($toValid as $valid){
                $this->isRequired($valid);
            }
    }

    private function isRequired($dataToCheck){
        if(is_null($dataToCheck) || $dataToCheck==""){
                    $this->errors[$dataNameToCheck] = "Valeur manquante!";
                }
    }

    private function representantValid(){
        if($this->personnalData->majeur == 'false'){
            //non majeur
            if(count($this->personnalData->representants) != 2){
                $this->errors['representants'] = 'Representants non valides!';
            } else {
               // CHeck les valeur rentrée par representants
            }
        } else {
            //majeur
            if(count($this->personnalData->representants) != 0){
                $this->errors['representants'] = 'Trop un representants!';
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
    private function isValidMail(){
        if (!filter_var($this->personnalData->mailApprenti, FILTER_VALIDATE_EMAIL)) {
            $this->errors['mailValidity'] = "InvalidMailFormat";
        }
    }
    private function isFormationValid(){
        if (!array_key_exists($this->personnalData->formation, $this->personnalData->getFormations())) {
            $this->errors['formation'] = 'Formation invalide';
        }
    }
}
?>