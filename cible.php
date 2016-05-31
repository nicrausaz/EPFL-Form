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
    </div>
    </body>

</html>