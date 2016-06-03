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
          $job= $_POST['mpt'] ." ". $_POST['groupJob'];
          $infosPerso = $_POST['genreApp']." ".$_POST['nameApp']." ".$_POST['surnameApp']." ".$_POST['adrApp']." ".$_POST['NPAApp']." ".$_POST['telApp']." ".$_POST['phoneApp']
          ." ".$_POST['mailApp']." ".$_POST['birthApp']." ".$_POST['originApp']." ".$_POST['nationApp']." ".$_POST['langApp']." " .$_POST['languesApp'] ;


//Tri des apprentis par métier
        $name = $_POST['nameApp'];
        $surname = $_POST['surnameApp'];
        $job = $_POST['job'];
            if($job=="polyM") {
                echo "Polymec"; 
                $path = '../candidatures/Polymecaniciens/'."new-".$name.$surname.'/';
                createThings($path);
            }else if($job=="info"){
                echo "informaticien";
                $path = '../candidatures/Informaticiens/'."new-".$name.$surname.'/';
                createThings($path);
            }else if($job=="logi"){
                echo "Logisticiens";
                $path = '../candidatures/Logisticiens/'."new-".$name.$surname.'/';
                createThings($path);
            }else if($job=="planElec"){
                echo "";
                $path = '../candidatures/PlanificateurElectricien/'."new-".$name.$surname.'/';
                createThings($path);
            }else if($job=="empCom"){
                echo "EmployesCommerce";
                $path = '../candidatures/EmployesCommerce/'."new-".$name.$surname.'/';
                createThings($path);
            }else if($job=="gardAn"){
                echo "GardiensAnimaux";
                $path = '../candidatures/GardiensAnimaux/'."new-".$name.$surname.'/';
                createThings($path);
            }
            
            //create apprenti's folders
            function createThings($path){
                    $pathtxt = $path."text/";
                    $pathpdf = $path."pdf/";
                    if (!mkdir($path, 0777, true)){
                        die('Echec lors de la création du dossier 1');
                    }
                    if (!mkdir($pathtxt, 0777, true)){
                        die('Echec lors de la création du dossier 2');
                    }
                    if (!mkdir($pathpdf, 0777, true)){
                        die('Echec lors de la création du dossier 3');
                    }else{
                        echo "Dossiers crées";
                    }
                    
                    //create text file for apprenti's infos   
                    $myfile = fopen($path."text/infos.txt", "w") or die("Unable to open file!");
                    fwrite($myfile, $job." ".$infosPerso);
                    fclose($myfile);
                    
                    //pdf upload  
                    $dossier = $pathpdf;
                    $fichier = basename($_FILES['fichier']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['fichier']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload effectué avec succès !';
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
                        $to  = 'nicolas.crausaz@epfl.ch';
                        $subject = 'Test envoi mail PHP';
                        $message = $name.$surname ." ". " a fait une demande de place d'apprentissage.";
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