<!doctype html>
<html lang="fr">
    <head>  
         <?php 
            include("templates/head.php");
            include("templates/checkDate.php");
            require_once("helpers.php");
            require_once("models/PersonnalData.php");
            require_once("models/PersonnalDataValidator.php");
         ?>
         <title>Confirmation</title>
    </head>
    <body>
    <div class="page-style">
        <?php
            
            include('templates/header.php');

            //Init personnalData with postedData
            $candidateData = new PersonnalData($_POST);
            debuglog("personnalData initiallised");
            //TODO: chargement et contrôle variables postées (toutes)
            $validator = new PersonnalDataValitor($candidateData);
            debuglog("PersonnalDataValitor initiallised");

            if($validator->isValid()){
                debuglog("validator->isValid");
                createCandidateFolders($candidateData,$validator->formations);

                $encodedJson = (json_encode($candidateData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
                file_put_contents($pathInfos.'/informations.json', $encodedJson);

                uploadAllFiles($pathAnnexes, $_FILES, $candidateData);

                mailToResp($candidateData->prenomApprenti, $candidateData->nomApprenti, $candidateData->formation);
                mailToApprenti($candidateData->mailApprenti);
            }else{
                debuglog("!validator->isValid");
                //redirect errors
                //error list
                print_r($validator->errors());
            }
        ?>
            <h1><?php echo $candidateData->prenomApprenti," ", $candidateData->nomApprenti,"," ?></h1>
            <h4>Votre demande à bien été enregistrée, vous allez bientôt recevoir un e-mail confirmant votre postulation.</h4>
            <button type ="button" id="retourHome" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                Retour à l'accueil
            </button>
        </div>
    </body>
</html>
