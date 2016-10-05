<?php 
    function mailToResp($surname, $name, $job){
        $to  = 'nicolas.crausaz@epfl.ch'; //formation.apprentis@epfl.ch
        $subject = 'Nouvelle Candidature';
        $message = "Candidat: ".$surname." ".$name."\n\n".
                    "Apprentissage: ".$job."\n\n".
                    "Consulter la candidature sur: "."\\\\scxdata\\apprentis$\\candidatures\\nouvelles";

        $headers = 'From: formulaireApprentis@epfl.ch' . "\r\n" .
                    'Reply-To: formulaireApprentis@epfl.ch' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            if (mail($to, $subject, $message, $headers)){
                }
    }
    
    //vire les accents et remplace caractere non alphanumeric par '-' 
    function checkChars($toCheck){
                    $toCheck = strtr($toCheck,
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $toCheck = preg_replace('/([^.a-z0-9]+)/i', '-', $toCheck);
                        return $toCheck;
                }
    function mailToApprenti($to){
        $subject = 'Votre candidature pour une place d\'apprentissage';
        $message =  "Nous venons d'enregistrer votre candidature et vous remercions de votre intérêt pour la "."\n".
                    "formation professionnelle à l’Ecole polytechnique fédérale de Lausanne."."\n\n".
                    "Nous allons étudier votre dossier avec la plus grande attention et nous ne manquerons "."\n".
                    "pas de vous contacter si votre profil répond à nos attentes."."\n\n".
                    "Avec nos meilleures salutations."."\n\n".
                    "Formation Apprentis EPFL";
        $headers = 'From: formulaireApprentis@epfl.ch' . "\r\n" .
                    'Reply-To: formulaireApprentis@epfl.ch' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            if (mail($to, $subject, $message, $headers)){
                }
    }

    function uploadFile($pathAnnexes, $file){
        $fichier = basename($file['name']);
        $extension = strrchr($file['name'], '.');
        $validExt = ['.pdf', '.jpeg', '.png'];

        if(!in_array($extension, $validExt)){
            $erreur = "uploadError";
        }

        if(!isset($erreur)){
            $fichier = checkChars($fichier);
            if(move_uploaded_file($file['tmp_name'], $pathAnnexes . $fichier)){
            }
        }
    }
    //Crée le dossier principal est ses 2 sous-dossiers
    function createCandidateFolders($candidateData){
        $paths = $candidateData->getPaths();
        if (!mkdir($paths["pathInfos"], 0777, true)){
            die('Echec lors de la création du dossier informations');
        }
        if (!mkdir($paths["pathAnnexes"], 0777, true)){
            die('Echec lors de la création du dossier annexes'); 
        }
    }
    function uploadAllFiles($pathAnnexes, $postedFiles, $candidateData){
        uploadFile($pathAnnexes, $postedFiles['photo']);
        uploadFile($pathAnnexes, $postedFiles['idCard']);
        uploadFile($pathAnnexes, $postedFiles['cv']);
        uploadFile($pathAnnexes, $postedFiles['lettre']);
        for($i=1; $i<=9; $i++){
            if(array_key_exists('certifs'.$i, $postedFiles)){
                if(!($postedFiles['certifs'.$i]['name'] == "")) {
                    uploadFile($pathAnnexes, $postedFiles['certifs'.$i]);
                }
            }
        }

        if($candidateData->formation=="polyMecanicien"){
            uploadFile($pathAnnexes, $postedFiles['gimch']);
        }
    }

    function debuglog($message){
        //echo $message;
    }
?>