<!doctype html>
<html lang="fr">
    <head>  
         <?php 
            include('templates/head.php');
            include('templates/checkDate.php');
         ?>
         <title>Confirmation</title>
    </head>
    <body>
    <div class="page-style">
        <?php
            include('helpers.php');
            require_once("models/PersonnalData.php");
            require_once("models/PersonnalDataValidator.php");
            include('templates/header.php');

            //TODO: chargement et contrôle variables postées (toutes)
            $candidateData = new PersonnalData();
            //Remplir les infos;
            $candidateData->tempSciper = $_POST['sciperTmp'];
            $candidateData->formation = $_POST['job'];
            $candidateData->filiere = $_POST['filInfo'];
            $candidateData->maturite = $_POST['mpt'];
            $candidateData->genreApprenti = $_POST['genreApp']; 
            $candidateData->nomApprenti = $_POST['nameApp'];
            $candidateData->prenomApprenti = $_POST['surnameApp'];
            $candidateData->addresseApprentiComplete = array("rue"=>$_POST['adrApp'],"NPA"=>$_POST['NPAApp']);
            $candidateData->telFixeApprenti  = $_POST['telApp'];
            $candidateData->telMobileApprenti  = $_POST['phoneApp'];
            $candidateData->mailApprenti = $_POST['mailApp'];
            $candidateData->dateNaissanceApprenti = $_POST['birthApp'];
            $candidateData->origineApprenti = $_POST['originApp'];
            $candidateData->nationaliteApprenti = $_POST['nationApp'];
            $candidateData->permisEtranger = $_POST['permisEtrangerApp'];
            $candidateData->langueMaternelleApprenti = $_POST['langApp'];

            if(isset($_POST['languesApp']) && !empty($_POST['languesApp'])){
                foreach($_POST['languesApp'] as $lang[]);
                //TODO: check tableau ne pas utiliser l'index
                $candidateData->connaissancesLinguistiques[] = array("francais"=> $lang[0], "allemand"=> $lang[1], "anglais"=> $lang[2], "autre"=> $lang[3]);
            }
            $candidateData->majeur = $_POST['maj'];
                if($_POST['maj'] == "false"){
                    $rep1  = array("genre"=>$_POST['genreRep1'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep1'],"addresse"=> array("rue"=>$_POST['adrRep1'],"NPA"=>$_POST['NPARep1']),"telephone"=>$_POST['telRep1']);    
                    $rep2  = array("genre"=>$_POST['genreRep2'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep2'],"addresse"=> array("rue"=>$_POST['adrRep2'],"NPA"=>$_POST['NPARep2']),"telephone"=>$_POST['telRep2']);
                    $candidateData->representants = array($rep1, $rep2);
                }

                $scolarite1 = array("ecole"=>$_POST['ecole1'],"lieu"=>$_POST['lieuEcole1'],"niveau"=>$_POST['niveauEcole1'],"annees"=>$_POST['anneesEcole1']);
                $scolarite2 = array("ecole"=>$_POST['ecole2'],"lieu"=>$_POST['lieuEcole2'],"niveau"=>$_POST['niveauEcole2'],"annees"=>$_POST['anneesEcole2']);
                $scolarite3 = array("ecole"=>$_POST['ecole3'],"lieu"=>$_POST['lieuEcole3'],"niveau"=>$_POST['niveauEcole3'],"annees"=>$_POST['anneesEcole3']);
                $scolarite4 = array("ecole"=>$_POST['ecole4'],"lieu"=>$_POST['lieuEcole4'],"niveau"=>$_POST['niveauEcole4'],"annees"=>$_POST['anneesEcole4']);
                $scolarite5 = array("ecole"=>$_POST['ecole5'],"lieu"=>$_POST['lieuEcole5'],"niveau"=>$_POST['niveauEcole5'],"annees"=>$_POST['anneesEcole5']);
                $candidateData->scolarite = array($scolarite1, $scolarite2, $scolarite3, $scolarite4, $scolarite5);
                $candidateData->anneeFinScolarite = $_POST['anneeFin'];

                $activiteProfessionelle1 = array("employeur"=>$_POST['employeurPro1'],"lieu"=>$_POST['lieuPro1'],"activite"=>$_POST['activitePro1'],"annees"=>$_POST['anneesPro1']);
                $activiteProfessionelle2 = array("employeur"=>$_POST['employeurPro2'],"lieu"=>$_POST['lieuPro2'],"activite"=>$_POST['activitePro2'],"annees"=>$_POST['anneesPro2']);
                $activiteProfessionelle3 = array("employeur"=>$_POST['employeurPro3'],"lieu"=>$_POST['lieuPro3'],"activite"=>$_POST['activitePro3'],"annees"=>$_POST['anneesPro3']);
                $candidateData->activitesProfessionnelles = array($activiteProfessionelle1, $activiteProfessionelle2, $activiteProfessionelle3);

                $stage1 = array("metier"=>$_POST['activiteStage1'],"employeur"=>$_POST['entrepriseStage1']);
                $stage2 = array("metier"=>$_POST['activiteStage2'],"employeur"=>$_POST['entrepriseStage2']);
                $stage3 = array("metier"=>$_POST['activiteStage3'],"employeur"=>$_POST['entrepriseStage3']);
                $stage4 = array("metier"=>$_POST['activiteStage4'],"employeur"=>$_POST['entrepriseStage4']);
                $candidateData->stages = array($stage1, $stage2, $stage3, $stage4);

                $candidateData->dejaCandidat = $_POST['dejaCand'];
                
                if($_POST['dejaCand'] == "true"){
                    $candidateData->anneeCandidature = $_POST['dejaCandAnnee'];
                }

            $validator = new PersonnalDataValitor($candidateData);
            if($validator->isValid()){
                $name = $_POST['nameApp'];
                $surname = $_POST['surnameApp'];
                $sciper = $_POST['sciperTmp'];
                $sciper = checkChars($sciper);
                $job = $_POST['job'];
                $mail = $_POST['mailApp'];
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $mail = "InvalidMailFormat";
                }
                $dateNow = date('j-n-o--'.'h-i-s');
                $folderName = $sciper."--".$dateNow."--".$mail;
                $rootpath = '\\\\scxdata\\apprentis$\\candidatures\\nouvelles\\';
                $orientations = array(
                        "polyMecanicien" => "Polymecaniciens",
                        "informaticien" => "Informaticiens",
                        "logisticien" => "Logisticiens",
                        "planificateurElectricien" => "PlanificateurElectriciens",
                        "employeCommerce" => "EmployesCommerce",
                        "gardienAnimaux" => "GardiensAnimaux",
                        "electronicien" => "Electoniciens",
                        "interactiveMediaDesigner" => "InteractiveMediaDesigners"
                );

                $path = '';
                if (array_key_exists($job, $orientations)) {
                    $path = $rootpath.$orientations[$job].'/'.$folderName.'/';
                }
                if ($path != '' && !file_exists($path)) {
                    $pathInfos = $path."informations/";
                        $pathAnnexes = $path."annexes/";

                        if (!mkdir($path, 0777, true)){
                            die('Echec lors de la création du dossier candidat');
                        }
                        if (!mkdir($pathInfos, 0777, true)){
                            die('Echec lors de la création du dossier informations');
                        }
                        if (!mkdir($pathAnnexes, 0777, true)){
                            die('Echec lors de la création du dossier annexes');
                        } else {  
                            $candidateData = new PersonnalData();
                            $candidateData->formation = $_POST['job'];
                            if($_POST['job'] == "informaticien"){
                                $candidateData->filiere = $_POST['filInfo'];
                            }

                            $candidateData->maturite = $_POST['mpt'];
                            $candidateData->genreApprenti  = $_POST['genreApp'];
                            $candidateData->nomApprenti  = $_POST['nameApp'];
                            $candidateData->prenomApprenti  = $_POST['surnameApp'];
                            $candidateData->addresseApprentiComplete = array("rue"=>$_POST['adrApp'],"NPA"=>$_POST['NPAApp']);
                            $candidateData->telFixeApprenti  = $_POST['telApp'];
                            $candidateData->telMobileApprenti  = $_POST['phoneApp'];
                            $candidateData->mailApprenti  = $_POST['mailApp'];
                            $candidateData->dateNaissanceApprenti  = $_POST['birthApp'];
                            $candidateData->origineApprenti  = $_POST['originApp'];
                            $candidateData->nationaliteApprenti  = $_POST['nationApp'];
                            $candidateData->permisEtranger = $_POST['permisEtrangerApp'];
                            $candidateData->langueMaternelleApprenti  = $_POST['langApp'];
                            
                            if(isset($_POST['languesApp']) && !empty($_POST['languesApp'])){
                                foreach($_POST['languesApp'] as $lang[]);
                                //TODO: check tableau ne pas utiliser l'index
                                $candidateData->connaissancesLinguistiques[] = array("francais"=> $lang[0], "allemand"=> $lang[1], "anglais"=> $lang[2], "autre"=> $lang[3]);
                            }

                            $candidateData->majeur = $_POST['maj'];
                            
                            if($_POST['maj'] == "false"){
                                $rep1  = array("genre"=>$_POST['genreRep1'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep1'],"addresse"=> array("rue"=>$_POST['adrRep1'],"NPA"=>$_POST['NPARep1']),"telephone"=>$_POST['telRep1']);    
                                $rep2  = array("genre"=>$_POST['genreRep2'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep2'],"addresse"=> array("rue"=>$_POST['adrRep2'],"NPA"=>$_POST['NPARep2']),"telephone"=>$_POST['telRep2']);
                                $candidateData->representants = array($rep1, $rep2);
                            }

                            $scolarite1 = array("ecole"=>$_POST['ecole1'],"lieu"=>$_POST['lieuEcole1'],"niveau"=>$_POST['niveauEcole1'],"annees"=>$_POST['anneesEcole1']);
                            $scolarite2 = array("ecole"=>$_POST['ecole2'],"lieu"=>$_POST['lieuEcole2'],"niveau"=>$_POST['niveauEcole2'],"annees"=>$_POST['anneesEcole2']);
                            $scolarite3 = array("ecole"=>$_POST['ecole3'],"lieu"=>$_POST['lieuEcole3'],"niveau"=>$_POST['niveauEcole3'],"annees"=>$_POST['anneesEcole3']);
                            $scolarite4 = array("ecole"=>$_POST['ecole4'],"lieu"=>$_POST['lieuEcole4'],"niveau"=>$_POST['niveauEcole4'],"annees"=>$_POST['anneesEcole4']);
                            $scolarite5 = array("ecole"=>$_POST['ecole5'],"lieu"=>$_POST['lieuEcole5'],"niveau"=>$_POST['niveauEcole5'],"annees"=>$_POST['anneesEcole5']);
                            $candidateData->scolarite = array($scolarite1, $scolarite2, $scolarite3, $scolarite4, $scolarite5);
                            $candidateData->anneeFinScolarite = $_POST['anneeFin'];

                            $activiteProfessionelle1 = array("employeur"=>$_POST['employeurPro1'],"lieu"=>$_POST['lieuPro1'],"activite"=>$_POST['activitePro1'],"annees"=>$_POST['anneesPro1']);
                            $activiteProfessionelle2 = array("employeur"=>$_POST['employeurPro2'],"lieu"=>$_POST['lieuPro2'],"activite"=>$_POST['activitePro2'],"annees"=>$_POST['anneesPro2']);
                            $activiteProfessionelle3 = array("employeur"=>$_POST['employeurPro3'],"lieu"=>$_POST['lieuPro3'],"activite"=>$_POST['activitePro3'],"annees"=>$_POST['anneesPro3']);
                            $candidateData->activitesProfessionnelles = array($activiteProfessionelle1, $activiteProfessionelle2, $activiteProfessionelle3);

                            $stage1 = array("metier"=>$_POST['activiteStage1'],"employeur"=>$_POST['entrepriseStage1']);
                            $stage2 = array("metier"=>$_POST['activiteStage2'],"employeur"=>$_POST['entrepriseStage2']);
                            $stage3 = array("metier"=>$_POST['activiteStage3'],"employeur"=>$_POST['entrepriseStage3']);
                            $stage4 = array("metier"=>$_POST['activiteStage4'],"employeur"=>$_POST['entrepriseStage4']);
                            $candidateData->stages = array($stage1, $stage2, $stage3, $stage4);

                            $candidateData->dejaCandidat = $_POST['dejaCand'];
                            
                            if($_POST['dejaCand'] == "true"){
                                $candidateData->anneeCandidature = $_POST['dejaCandAnnee'];
                            }
                            
                            $candidateData->datePostulation = date('j-n-o--'.'h:i:s');
                            $encodedJson = (json_encode($candidateData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
                            file_put_contents($pathInfos.'/informations.json', $encodedJson);

                            uploadFile($pathAnnexes, $_FILES['photo']);
                            uploadFile($pathAnnexes, $_FILES['idCard']);
                            uploadFile($pathAnnexes, $_FILES['cv']);
                            uploadFile($pathAnnexes, $_FILES['lettre']);

                            if(!($_FILES['certifs1']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs1']);
                            }
                            if(!($_FILES['certifs2']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs2']);
                            }
                            if(!($_FILES['certifs3']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs3']);
                            }
                            if(!($_FILES['certifs4']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs4']);
                            }
                            if(!($_FILES['certifs5']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs5']);
                            }
                            if(!($_FILES['certifs6']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs6']);
                            }
                            if(!($_FILES['certifs7']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs7']);
                            }
                            if(!($_FILES['certifs8']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs8']);
                            }
                            if(!($_FILES['certifs9']['name'] == "")) {
                                uploadFile($pathAnnexes, $_FILES['certifs9']);
                            }
                            
                            if($_POST['job']=="polyMecanicien"){
                                uploadFile($pathAnnexes, $_FILES['gimch']);
                            }

                            mailToResp($surname, $name, $job);
                            mailToApprenti($mail);
                        }
                }
            } else {
                //redirect errors
                //error list
                $validator->errors();
                echo "Erreur(s)";
                //echo "<script>alert(\"des erreurs se sont produites\")</script>"; 
            }
         ?>

            <h1><?php echo $surname," ", $name,"," ?></h1>
            <h4>Votre demande à bien été enregistrée, vous allez bientôt recevoir un e-mail confirmant votre postulation.</h4>
            <button type ="button" id="retourHome" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                Retour à l'accueil
            </button>
        </div>
    </body>
</html>
