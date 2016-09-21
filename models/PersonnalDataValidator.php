<?php
require_once('PersonnalData.php');

class PersonnalDataValidator {
	private $personnalData;
    private $errors = array();

    public function __construct(PersonnalData $personnalData)
    {
        $this->personnalData = $personnalData;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        $this->representantValid();
        return count($this->errors) === 0;
    }

    private function representantValid(){
        if($this->personnalData->majeur == 'maj-non'){
            if($this->personnalData->representants.count() == 0){
                $this->errors['representant'] = 'Representant non valide!';
            } 
        } 
    }
}
?>       