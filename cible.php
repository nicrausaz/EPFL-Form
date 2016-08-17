<!doctype html>
<html lang="fr">
    <head>  
         <?php include('templates/head.php');?>
         <title>Confirmation</title>
    </head>
    <body>
    <div class="form-style-5">
        
       <?php
       /*function getConnLing(){
            if(!empty($_POST['check_list'])){
                foreach($_POST['check_list'] as $check){
                   //echo $check;
                }
            }
       }
        //$connLing = array($_POST['check_list']);
        echo $connLing;
       */
          //get first infos
          $apprentiInfos = [$_POST['job'],$_POST['mpt'],$_POST['genreApp'],$_POST['nameApp'],$_POST['surnameApp'],$_POST['adrApp'],$_POST['NPAApp'],$_POST['telApp'],$_POST['phoneApp'],$_POST['mailApp'],$_POST['birthApp'],$_POST['originApp'],$_POST['nationApp'],$_POST['langApp']];
   
        //Tri des apprentis par métier
        $name = $_POST['nameApp'];
        $surname = $_POST['surnameApp'];
        $job = $_POST['job'];
        $rootpath = '../candidatures/';

        //$path = sprintf('../candidatures/%s/new-%s%s/', $rootpath, $formFolder, $name, $surname);

            if($job=="polyM") {
                //echo "Polymec"; 
                $path = $rootpath.'Polymecaniciens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="info"){
                //echo "informaticien";
                $apprentiInfos[1] =  $_POST['filInfo'];
                $path = $rootpath.'Informaticiens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="logi"){
                //echo "Logisticiens";
                $path = $rootpath.'Logisticiens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="planElec"){
                //echo "Planif Elec";
                $path = $rootpath.'PlanificateurElectriciens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="empCom"){
                //echo "EmployesCommerce";
                $path = $rootpath.'EmployesCommerce/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="gardAn"){
                //echo "GardiensAnimaux";
                $path = $rootpath.'GardiensAnimaux/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }   
            
            function createThings($path,$name,$surname,$apprentiInfos){
                //create apprenti's folders
                    $pathInfos = $path."informations/";
                    $pathAnnexes = $path."annexes/";

                    if (!mkdir($path, 0777, true)){
                         die('Echec lors de la création du dossier candidat');
                          $noError = false;
                    }
                    if (!mkdir($pathInfos, 0777, true)){
                        die('Echec lors de la création du dossier informations');
                        $noError = false;
                    }
                    if (!mkdir($pathAnnexes, 0777, true)){
                        die('Echec lors de la création du dossier annexes');
                    }else{
                        echo "Dossiers crées";
                        $noError = true;
                    }
                //Get infos
                $major = $_POST['maj'];
                if($major=="maj-non"){
                    $respInfos = [$_POST['nameRep1'],$_POST['surnameRep1'],$_POST['adrRep1'],$_POST['NPARep1'],$_POST['telRep1'],
                    $_POST['nameRep2'],$_POST['surnameRep2'],$_POST['adrRep2'],$_POST['NPARep2'],$_POST['telRep2']];
                }else{
                    $respInfos = $major;
                }

                $schoolActivites = [$_POST['ecole1'],$_POST['lieuEcole1'],$_POST['niveauEcole1'],$_POST['anneesEcole1'],
                $_POST['ecole2'],$_POST['lieuEcole2'],$_POST['niveauEcole2'],$_POST['anneesEcole2'],
                $_POST['ecole3'],$_POST['lieuEcole3'],$_POST['niveauEcole3'],$_POST['anneesEcole3'],
                $_POST['ecole4'],$_POST['lieuEcole4'],$_POST['niveauEcole4'],$_POST['anneesEcole4'],
                $_POST['ecole5'],$_POST['lieuEcole5'],$_POST['niveauEcole5'],$_POST['anneesEcole5'],$_POST['anneeFin']];

                $proActivites = [$_POST['employeurPro1'],$_POST['lieuPro1'],$_POST['activitePro1'],$_POST['anneesPro1'],
                $_POST['employeurPro2'],$_POST['lieuPro2'],$_POST['activitePro2'],$_POST['anneesPro2'],
                $_POST['employeurPro3'],$_POST['lieuPro3'],$_POST['activitePro3'],$_POST['anneesPro3']];

                $stagesActivites = [$_POST['activiteStage1'],$_POST['entrepriseStage1'],$_POST['activiteStage2'],$_POST['entrepriseStage2'],
                $_POST['activiteStage3'],$_POST['entrepriseStage3'],$_POST['activiteStage4'],$_POST['entrepriseStage4']];

                $dejaCand = $_POST['dejaCand'];
                if($dejaCand =="dejaCand-oui"){
                    $candYear = [$dejaCand,$_POST['dejaCandAnnee']];
                }else{
                    $candYear = $dejaCand;
                }
                //Put infos in CSV File
                    $fp = fopen("$pathInfos/infos.csv", "w");
                    fputcsv($fp, $apprentiInfos);
                    fputcsv($fp, $respInfos);
                    fputcsv($fp, $schoolActivites);
                    fputcsv($fp, $proActivites);
                    fputcsv($fp, $stagesActivites);
                    fputcsv($fp, $candYear);
                    fclose($fp);

                    //Photo upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['photo']['name']);
                    $extensions = array('.jpg','.jpeg','.png','.pdf');
                    $extension = strrchr($_FILES['photo']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG, PNG ou PDF';
                        //$noError = false;
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                            
                        }
                        else{
                            echo 'Echec de l\'upload photo!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }
                    
                    //CV upload  
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['cv']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['cv']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['cv']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload CV!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }

                    // Lettre upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['lettre']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['lettre']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['lettre']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload Lettre de motivation!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }

                    // ID card upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['idCard']['name']);
                    $extensions = array('.jpg','.jpeg','.png','.pdf');
                    $extension = strrchr($_FILES['idCard']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG ou PNG';
                        //$noError = false;
                    }
                    //
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['idCard']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload idCard!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }


                    //GIM-CH upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['photo']['name']);
                    $extensions = array('.jpg','.jpeg','.png','.pdf');
                    $extension = strrchr($_FILES['photo']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG ou PNG';
                        //$noError = false;
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload gim-ch!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }
                    
                    // mail send
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
            }
        ?>
        </div>
    </body>
</html>