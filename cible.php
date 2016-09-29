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
            //Init
            $validator = new PersonnalDataValidator($candidateData);
            debuglog("PersonnalDataValitor initiallised");

            if($validator->isValid()){
                debuglog("validator->isValid");
                createCandidateFolders($candidateData);

                $encodedJson = (json_encode($candidateData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
                file_put_contents($candidateData->getPaths()["pathInfos"].'/informations.json', $encodedJson);

                uploadAllFiles($candidateData->getPaths()["pathAnnexes"], $_FILES, $candidateData);

                mailToResp($candidateData->prenomApprenti, $candidateData->nomApprenti, $candidateData->formation);
                mailToApprenti($candidateData->mailApprenti);

                include("templates/confirmationText.php");
            }else{
                debuglog("!validator->isValid");
                //redirect errors
                //print error list
                include("templates/errorText.php");
                print_r($validator->errors());
                
            }
        ?>
            
        </div>
    </body>
</html>