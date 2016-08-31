<!doctype html>
<html lang="fr">
    <head>  
         <?php include('templates/head.php');
            ini_set("display_errors",0);
            error_reporting(0); ?>
         <title>Confirmation</title>
    </head>
    <body>
    <div class="form-style-5">
       <?php
        //Tri des apprentis par métier
        $name = $_POST['nameApp'];
        $surname = $_POST['surnameApp'];
        $sciper = $_POST['sciperTmp'];
        $job = $_POST['job'];
        $mail = $_POST['mailApp'];
        $dateNow = date('j-n-o--h i-s');
        $folderName = $sciper."--".$dateNow."--".$mail;
        $rootpath = '../candidatures/';
            if($job=="polyM") {
                $path = $rootpath.'Polymecaniciens/'.$folderName.'/';
                createThings($path,$name,$surname);
            }else if($job=="info"){
                $path = $rootpath.'Informaticiens/'.$folderName.'/';
                createThings($path,$name,$surname);
            }else if($job=="logi"){
                $path = $rootpath.'Logisticiens/'.$folderName.'/';
                createThings($path,$name,$surname);
            }else if($job=="planElec"){
                $path = $rootpath.'PlanificateurElectriciens/'.$folderName.'/';
                createThings($path,$name,$surname);
            }else if($job=="empCom"){
                $path = $rootpath.'EmployesCommerce/'.$folderName.'/';
                createThings($path,$name,$surname);
            }else if($job=="gardAn"){
                $path = $rootpath.'GardiensAnimaux/'.$folderName.'/';
                createThings($path,$name,$surname);
            }   
            
            function createThings($path,$name,$surname){
                //create apprenti's folders
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
                    }else{
                        
                        //Get all infos in JSON
                        require_once("json/jsonClass.php");
                        $doc = new Doc();
                        $doc->formation = $_POST['job'];
                        if($_POST['job'] == "info"){
                            $doc->filiere = $_POST['filInfo'];
                        }else{}

                        $doc->maturite = $_POST['mpt'];
                        $doc->genreApprenti  = $_POST['genreApp'];
                        $doc->nomApprenti  = $_POST['nameApp'];
                        $doc->prenomApprenti  = $_POST['surnameApp'];
                        $doc->addresseApprentiComplete = array("rue"=>$_POST['adrApp'],"NPA"=>$_POST['NPAApp']);             
                        $doc->telFixeApprenti  = $_POST['telApp'];
                        $doc->telMobileApprenti  = $_POST['phoneApp'];
                        $doc->mailApprenti  = $_POST['mailApp'];
                        $doc->dateNaissanceApprenti  = $_POST['birthApp'];
                        $doc->origineApprenti  = $_POST['originApp'];
                        $doc->nationaliteApprenti  = $_POST['nationApp'];
                        $doc->langueMaternelleApprenti  = $_POST['langApp'];
                        //GET CHECKBOXES
                        if(isset($_POST['languesApp']) && !empty($_POST['languesApp'])){
                            foreach($_POST['languesApp'] as $lang[]);
                            $doc->connaissanceFrancais = $lang[0];
                            $doc->connaissanceAllemand = $lang[1];
                            $doc->connaissanceAnglais = $lang[2];
                            $doc->connaissanceAutres = $lang[3];
                        }
                        $doc->majeur = $_POST['maj'];
                        if($_POST['maj'] == "maj-non"){
                            $rep1  = array("genre"=>$_POST['genreRep1'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep1'],"addresse"=> array("rue"=>$_POST['adrRep1'],"NPA"=>$_POST['NPARep1']),"telephone"=>$_POST['telRep1']);    
                            $rep2  = array("genre"=>$_POST['genreRep2'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep2'],"addresse"=> array("rue"=>$_POST['adrRep2'],"NPA"=>$_POST['NPARep2']),"telephone"=>$_POST['telRep2']);
                            $doc->representants = array($rep1, $rep2);
                        }else{}
                        $scolarite1 = array("ecole"=>$_POST['ecole1'],"lieu"=>$_POST['lieuEcole1'],"niveau"=>$_POST['niveauEcole1'],"annees"=>$_POST['anneesEcole1']);
                        $scolarite2 = array("ecole"=>$_POST['ecole2'],"lieu"=>$_POST['lieuEcole2'],"niveau"=>$_POST['niveauEcole2'],"annees"=>$_POST['anneesEcole2']);
                        $scolarite3 = array("ecole"=>$_POST['ecole3'],"lieu"=>$_POST['lieuEcole3'],"niveau"=>$_POST['niveauEcole3'],"annees"=>$_POST['anneesEcole3']);
                        $scolarite4 = array("ecole"=>$_POST['ecole4'],"lieu"=>$_POST['lieuEcole4'],"niveau"=>$_POST['niveauEcole4'],"annees"=>$_POST['anneesEcole4']);
                        $scolarite5 = array("ecole"=>$_POST['ecole5'],"lieu"=>$_POST['lieuEcole5'],"niveau"=>$_POST['niveauEcole5'],"annees"=>$_POST['anneesEcole5']);
                        $doc->scolarite = array($scolarite1, $scolarite2, $scolarite3, $scolarite4, $scolarite5);
                        $doc->anneeFinScolarite = $_POST['anneeFin'];

                        $activiteProfessionelle1 = array("employeur"=>$_POST['employeurPro1'],"lieu"=>$_POST['lieuPro1'],"activite"=>$_POST['activitePro1'],"annees"=>$_POST['anneesPro1']);
                        $activiteProfessionelle2 = array("employeur"=>$_POST['employeurPro2'],"lieu"=>$_POST['lieuPro2'],"activite"=>$_POST['activitePro2'],"annees"=>$_POST['anneesPro2']);
                        $activiteProfessionelle3 = array("employeur"=>$_POST['employeurPro3'],"lieu"=>$_POST['lieuPro3'],"activite"=>$_POST['activitePro3'],"annees"=>$_POST['anneesPro3']);
                        $doc->activitesProfessionnelles = array($activiteProfessionelle1, $activiteProfessionelle2, $activiteProfessionelle3);

                        $stage1 = array("metier"=>$_POST['activiteStage1'],"employeur"=>$_POST['entrepriseStage1']);
                        $stage2 = array("metier"=>$_POST['activiteStage2'],"employeur"=>$_POST['entrepriseStage2']);
                        $stage3 = array("metier"=>$_POST['activiteStage3'],"employeur"=>$_POST['entrepriseStage3']);
                        $stage4 = array("metier"=>$_POST['activiteStage4'],"employeur"=>$_POST['entrepriseStage4']);
                        $doc->stages = array($stage1, $stage2, $stage3, $stage4);

                        $doc->dejaCandidat = $_POST['dejaCand'];
                        if($_POST['dejaCand'] == "dejaCand-oui"){
                            $doc->anneeCandidature = $_POST['dejaCandAnnee'];
                        }else{}
                        $doc->datePostulation = date('j-n-o--h:i:s'); //ad +2 to hour
                        $encodedJson = (json_encode($doc));
                        file_put_contents($pathInfos.'/informations.json', $encodedJson);

                        //Upload call
                        uploadFile($pathAnnexes, 'photo', array('.jpg','.jpeg','.png','.pdf','.JPG'));
                        uploadFile($pathAnnexes, 'cv', array('.pdf'));
                        uploadFile($pathAnnexes, 'lettre', array('.pdf'));
                        uploadFile($pathAnnexes, 'idCard', array('.jpg','.jpeg','.png','.pdf','.JPG'));
                        if($_POST['job']=="polyM"){
                            uploadFile($pathAnnexes, 'gimch', array('.pdf'));
                        }     
                }
            }
            function uploadFile($pathAnnexes, $inputName, $extensions){
                    $fichier = basename($_FILES[$inputName]['name']);
                    $extension = strrchr($_FILES[$inputName]['name'], '.');
                        
                    if(!in_array($extension, $extensions)){
                        $erreur = "Echec";
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier,
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        if(move_uploaded_file($_FILES[$inputName]['tmp_name'], $pathAnnexes . $fichier)){
                            echo 'Upload réussi';  
                        }
                        else{
                            echo 'Echec de l\'upload !';
                        }
                    }
                    else{
                        echo $erreur;
                    }
                }
                    // mail send
                /*
                    $to  = 'nicolas.crausaz@epfl.ch';
                    $subject = 'Nouvelle demande de place d\'apprentissage';
                    $message = $name." ".$surname ." ". " a fait une demande de place d'apprentissage.";
                    $headers = 'From: formapprentis@epfl.ch' . "\r\n" .
                                'Reply-To: formapprentis@epfl.ch' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();

                    if($noError == true){
                        if (mail($to, $subject, $message, $headers)){
                                echo "Mail envoyé";
                            }
                            else{
                                echo "Mail non envoyé";
                            }
                    }
                    */
        ?>
         <?php include('templates/header.php') ?>
         <h1><?php echo $surname," ", $name,"," ?></h1>
         <h3>Votre demande à bien été enregistrée, vous allez bientôt recevoir un e-mail confirmant votre postulation.</h3>

        </div>
    </body>
</html>