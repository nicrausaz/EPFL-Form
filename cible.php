<!doctype html>
<html lang="fr">
    <head>  
        <meta charset="UTF-8"/>
         <link rel="stylesheet" type="text/css" href="style.css">
         <link rel="icon" type="image/png" href="img/favicon.png" />
         <title>Confirmation</title>
    </head>
    <body>
    <div class="form-style-5">
        
       <?php
       //get apprenti's infos
          $job = $_POST['job']." ".$_POST['mpt'];
          $infosPerso = $_POST['genreApp']." ".$_POST['nameApp']." ".$_POST['surnameApp']." ".$_POST['adrApp']." ".$_POST['NPAApp']." ".$_POST['telApp']." ".$_POST['phoneApp']
          ." ".$_POST['mailApp']." ".$_POST['birthApp']." ".$_POST['originApp']." ".$_POST['nationApp']." ".$_POST['langApp']." " /*.$_POST['languesApp']*/ ;
          //get the rest of infos here 
          //
          //
          $allInfos = $job." ".$infosPerso;
          
    //Tri des apprentis par métier
        $name = $_POST['nameApp'];
        $surname = $_POST['surnameApp'];
        $job = $_POST['job'];
            if($job=="polyM") {
                echo "Polymec"; 
                $path = '../candidatures/Polymecaniciens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$infosPerso);
            }else if($job=="info"){
                echo "informaticien";
                $path = '../candidatures/Informaticiens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$infosPerso);
            }else if($job=="logi"){
                echo "Logisticiens";
                $path = '../candidatures/Logisticiens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$infosPerso);
            }else if($job=="planElec"){
                echo "Planif Elec";
                $path = '../candidatures/PlanificateurElectriciens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$infosPerso);
            }else if($job=="empCom"){
                echo "EmployesCommerce";
                $path = '../candidatures/EmployesCommerce/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$infosPerso);
            }else if($job=="gardAn"){
                echo "GardiensAnimaux";
                $path = '../candidatures/GardiensAnimaux/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$infosPerso);
            }
            
            //create apprenti's folders
            function createThings($path,$name,$surname,$infosPerso){
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
                        echo "Dossiers crées";
                    }
                    
                    //create text file for apprenti's infos   
                    $myfile = fopen($pathInfos."infos.txt", "w") or die("Unable to open file!");
                    fwrite($myfile,$infosPerso);
                    fclose($myfile);

                    //Photo upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['photo']['name']);
                    $extensions = array('.jpg','.jpeg','.png');
                    $extension = strrchr($_FILES['photo']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG ou PNG';
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                        }
                        else{
                            echo 'Echec de l\'upload photo!';
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
                        }
                        else{
                            echo 'Echec de l\'upload CV!';
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
                        }
                        else{
                            echo 'Echec de l\'upload Lettre de motivation!';
                        }
                    }
                    else{
                        echo $erreur;
                    }
            }

                 // mail send 
                        $to  = 'nicolas.crausaz@epfl.ch';
                        $subject = 'Nouvelle demande de place d\'apprentissage';
                        $message = $name." ".$surname ." ". " a fait une demande de place d'apprentissage.";
                        $headers = 'From: formapprentis@epfl.ch' . "\r\n" .
                                    'Reply-To: formapprentis@epfl.ch' . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();
                                    
                        if (mail($to , $subject, $message, $headers)){
                            echo "Mail envoyé";
                        }
                        else{
                            echo "Mail non envoyé";
                        }
                    ?>
        </div>
    </body>
</html>