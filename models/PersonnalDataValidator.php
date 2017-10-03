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
        $this->isMailValid();
        $this->isFormationValid();
        $this->isEcoleValid();
        $this->anneeFinScolariteValid();

        return count($this->errors) === 0;
    }

    private function filiereValid () {
        if ($this->personnalData->formation == "informaticien") {
            if (is_null($this->personnalData->filiere) || $this->personnalData->filiere == "") {
                $this->errors['filiere'] = 'Filiere non valide';
            }
        }
    }

    private function dataRequiredIsValid () {
        if (is_null($this->personnalData->genreApprenti) || $this->personnalData->genreApprenti == "" || $this->personnalData->genreApprenti =="notSelected") {
            $this->errors['genreApprenti'] = 'Genre non selectionné';
        }
        $toValid = array("nomApprenti" => $this->personnalData->nomApprenti,
        "prenomApprenti" => $this->personnalData->prenomApprenti,
        "formation" => $this->personnalData->formation,
        "lieu" => $this->personnalData->lieu,
        "maturite" => $this->personnalData->maturite,
        "addresseApprentiComplete" => $this->personnalData->addresseApprentiComplete,
        "telFixeApprenti" => $this->personnalData->telFixeApprenti,
        "telMobileApprenti" => $this->personnalData->telMobileApprenti,
        "mailApprenti" => $this->personnalData->mailApprenti,
        "dateNaissanceApprenti" => $this->personnalData->dateNaissanceApprenti,
        "origineApprenti" => $this->personnalData->origineApprenti,
        "nationaliteApprenti" => $this->personnalData->nationaliteApprenti,
        "langueMaternelleApprenti" => $this->personnalData->langueMaternelleApprenti,
        "numeroAVS" => $this->personnalData->numeroAVS);

        $this->isBirthDateValid(date($this->personnalData->dateNaissanceApprenti));

        foreach ($toValid as $valid) {
            $this->isRequired($valid);
        }
    }

    private function isBirthDateValid ($birthDate) {
        $birthYear = date('Y', strtotime($birthDate));
        $actualYear = date('Y');

        if (($birthYear > $actualYear - 60) && ($birthYear <= $actualYear - 13)) {
        }
        else {
            $this->errors['dateNaissanceApprenti'] = 'Date de naissance non valide';
        }
    }

    private function isRequired ($dataToCheck) {
        if (is_null($dataToCheck) || $dataToCheck=="") {
            $this->errors[$dataNameToCheck] = $dataNameToCheck . " manquant(e)";
        }
    }

    private function representantValid () {
        if($this->personnalData->majeur == 'false'){
            //non majeur
            if(count($this->personnalData->representants) < 1){
                $this->errors['representants'] = 'Représentants non valides';
            } else {
                // Check les valeurs rentrée par representants
            }
        } else {
            //majeur
            if(count($this->personnalData->representants) != 0){
                $this->errors['representants'] = 'Trop de représentants';
            }
        }
    }
    private function dejaCandValid(){
        if($this->personnalData->dejaCandidat == 'true'){
            if($this->personnalData->anneeCandidature == ""){
                $this->errors['anneeCandidature'] = 'Année de candidature non valide';
            }else if(!is_numeric($this->personnalData->anneeCandidature)){
                $this->errors['anneeCandidature'] = 'Année de candidature non valide';
            }
        }
    }
    private function isMailValid(){
        if (!filter_var($this->personnalData->mailApprenti, FILTER_VALIDATE_EMAIL)) {
            $this->errors['adresseMail'] = "Addresse mail non valide";
        }
    }
    private function isFormationValid(){
        if (!array_key_exists($this->personnalData->formation, $this->personnalData->getFormations())) {
            $this->errors['formation'] = 'Formation non valide';
        }
    }
    private function isEcoleValid(){
        if(count($this->personnalData->scolarite)< 2){
            $this->errors['ecole'] = 'Informations école non valides';
        }
    }
    private function anneeFinScolariteValid(){
        $dateToCheck = $this->personnalData->anneeFinScolarite;

        if(!is_null($dateToCheck) || $dateToCheck==""){
            if(!is_numeric($dateToCheck)){
                $this->errors['anneeFinScolarite'] = 'Année de fin de scolarité non valide';
            }
        }
    }
}
?>