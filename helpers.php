<?php
function mailToResp($surname, $name, $job){
    require_once("templates/mailToResp.php");
    //mail($to, $subject, $message, $headers);
}

//vire les accents et remplace caractere non alphanumeric par '-'
function checkChars($toCheck){
    $toCheck = strtr($toCheck,
    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $toCheck = preg_replace('/([^.a-z0-9]+)/i', '-', $toCheck);
    return $toCheck;
}

function mailToApprenti($to, $job){
    require_once("templates/mailToApp.php");
    //mail($to, $subject, $message, $headers);
}

function uploadFile(&$candidateData, $pathAnnexes, $file, $name){
    $extension = strtolower(strrchr($file['name'], '.'));
    $validExt = ['.pdf', '.jpeg', '.png', '.jpg'];
    $filename = $name . $extension;

    if(!in_array($extension, $validExt)){
        $erreur = "uploadError";
    }

    if(!isset($erreur)){
        $filename = checkChars($filename);
        move_uploaded_file($file['tmp_name'], $pathAnnexes . $filename);
        $candidateData->fichiers[$name] = $filename;
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
    uploadFile($candidateData, $pathAnnexes, $postedFiles['photo'], "photo-passeport");
    uploadFile($candidateData, $pathAnnexes, $postedFiles['idCard'], "carte-identite");
    uploadFile($candidateData, $pathAnnexes, $postedFiles['cv'], "curriculum-vitae");
    uploadFile($candidateData, $pathAnnexes, $postedFiles['lettre'], "lettre-motivation");

    for($i=1; $i<=9; $i++){
        if(array_key_exists('certifs'.$i, $postedFiles)){
            if(!($postedFiles['certifs'.$i]['name'] == "")) {
                uploadFile($candidateData, $pathAnnexes, $postedFiles['certifs'.$i], "annexe".$i);
            }
        }
    }

    if($candidateData->formation=="polyMecanicien"){
        uploadFile($candidateData, $pathAnnexes, $postedFiles['gimch'], "certificat-gimch");
    }
    if($candidateData->formation=="informaticien"){
        uploadFile($candidateData, $pathAnnexes, $postedFiles['griTestInput'], "certificat-gri");
    }
    return $candidateData;
}

function createPDF ($infos, $path) {
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    foreach($infos as $info => $val) {
        checkArrayValue($info, $val, $pdf);
    }

    $pdf->Output("F", $path . '/informations.pdf');
}

function checkArrayValue ($info, $val, $pdf) {
    if (is_array($val)) {

        $pdf->Cell(0,10,$info . " : ",0,1);

        foreach($val as $key => $value) {
            checkArrayValue ($key, $value, $pdf);
        }
    }
    else {
        $pdf->Cell(0,10,$info . ": " . $val,0,1);
    }
}

function debuglog($message){
    //echo $message;
}
?>