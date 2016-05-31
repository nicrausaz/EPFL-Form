<!doctype html>
<html lang="fr">
    <head>  
        <meta charset="UTF-8"/>
         <link rel="stylesheet" type="text/css" href="style.css">
         <title>Confirmation</title>
    </head>
    <body>
    <div class="form-style-5">
       <?php
          $job= $_POST['mpt'] ." ". $_POST['groupJob'];
          
            
          $infosPerso = $_POST['genreApp']." ".$_POST['nameApp']." ".$_POST['surnameApp']." ".$_POST['adrApp']." ".$_POST['NPAApp']." ".$_POST['telApp']." ".$_POST['phoneApp']
          ." ".$_POST['mailApp']." ".$_POST['birthApp']." ".$_POST['originApp']." ".$_POST['nationApp']." ".$_POST['langApp']." " .$_POST['languesApp'] ;

           $myfile = fopen("results/newfile.txt", "w") or die("Unable to open file!");
            fwrite($myfile, $job.$infosPerso);
            fwrite($myfile, $job.$infosPerso);
            fclose($myfile);
           
        ?>
        <?php
                    $dossier = 'uploads/';
                    $fichier = basename($_FILES['fichier']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['fichier']['name'], '.'); 
                    //Début des vérifications de sécurité...
                    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                    {
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                    {
                        //On formate le nom du fichier ici...
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                        {
                            echo 'Upload effectué avec succès !';
                        }
                        else //Sinon (la fonction renvoie FALSE).
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