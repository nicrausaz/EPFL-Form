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
         $job= $_POST['mpt'] ." ". $_POST['groupJob'];
          
            
          $infosPerso = $_POST['genreApp']." ".$_POST['nameApp']." ".$_POST['surnameApp']." ".$_POST['adrApp']." ".$_POST['NPAApp']." ".$_POST['telApp']." ".$_POST['phoneApp']
          ." ".$_POST['mailApp']." ".$_POST['birthApp']." ".$_POST['originApp']." ".$_POST['nationApp']." ".$_POST['langApp']." " .$_POST['languesApp'] ;

           $myfile = fopen("../candidatures/text/infos.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $job.$infosPerso);
            fwrite($myfile, $job.$infosPerso);
            fclose($myfile);
   
                $name = $_POST['nameApp'];
                $surname = $_POST['surnameApp'];
                $path = '../candidatures/'.$name.$surname.'/';

                    if (!mkdir($path, 0777, true)) {
                        die('Echec lors de la création du dossier');
                    }
     
                    $dossier = '../candidatures/pdf/';
                    $fichier = basename($_FILES['fichier']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['fichier']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions))
                    {
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur))
                    {
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload effectué avec succès !';
                        }
                        else
                        {
                            echo 'Echec de l\'upload !';
                        }
                    }
                    else
                    {
                        echo $erreur;
                    }
                 
                    ?>
    </div>
    </body>

</html>