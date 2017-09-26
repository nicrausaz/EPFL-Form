<?php
function mailToResp ($surname, $name, $job){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/mailToResp.php");
    mail($to, $subject, $message, $headers);
}

// vire les accents et remplace caractere non alphanumeric par '-'
function checkChars ($toCheck){
    $toCheck = strtr($toCheck,
    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $toCheck = preg_replace('/([^.a-z0-9]+)/i', '-', $toCheck);
    return $toCheck;
}

function mailToApprenti ($to, $job){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/mailToApp.php");
    mail($to, $subject, $message, $headers);
}

function uploadFile (&$candidateData, $pathAnnexes, $file, $name){
    $extension = strtolower(strrchr($file['name'], '.'));
    $validExt = ['.pdf', '.jpeg', '.png', '.jpg'];
    $filename = $name . $extension;

    //-> move this to dataValidator
    if (!in_array($extension, $validExt)) {
        $erreur = "uploadError";
    }

    if (!isset($erreur)) {
        $filename = checkChars($filename);
        move_uploaded_file($file['tmp_name'], $pathAnnexes . $filename);
        $candidateData->fichiers[$name] = $filename;
    }
}

// Crée le dossier principal est ses 2 sous-dossiers
function createCandidateFolders ($candidateData){
    $paths = $candidateData->getPaths();
    if (!mkdir($paths["pathInfos"], 0777, true)){
        die('Echec lors de la création du dossier informations');
    }
    if (!mkdir($paths["pathAnnexes"], 0777, true)){
        die('Echec lors de la création du dossier annexes');
    }
}

function uploadAllFiles ($pathAnnexes, $postedFiles, $candidateData){
    uploadFile($candidateData, $pathAnnexes, $postedFiles['photo'], "photo-passeport");
    uploadFile($candidateData, $pathAnnexes, $postedFiles['idCard'], "carte-identite");
    uploadFile($candidateData, $pathAnnexes, $postedFiles['cv'], "curriculum-vitae");
    uploadFile($candidateData, $pathAnnexes, $postedFiles['lettre'], "lettre-motivation");

    for ($i=1; $i<=9; $i++) {
        if (array_key_exists('certifs'.$i, $postedFiles)) {
            if (!($postedFiles['certifs'.$i]['name'] == "")) {
                uploadFile($candidateData, $pathAnnexes, $postedFiles['certifs'.$i], "annexe".$i);
            }
        }
    }

    if ($candidateData->formation=="polyMecanicien") {
        uploadFile($candidateData, $pathAnnexes, $postedFiles['gimch'], "certificat-gimch");
    }
    if ($candidateData->formation=="informaticien") {
        uploadFile($candidateData, $pathAnnexes, $postedFiles['griTestInput'], "certificat-gri");
    }
    return $candidateData;
}

function getUserInfos ($secret) {
    $fileContent = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/confirm/tmp/confirm.json"), true);

    foreach ($fileContent as $applicant => $infos) {
        if ($applicant === $secret) {
            return $infos;
        }
    }
}

// MAILCONFIRM.PHP
function addUserInfos ($infos) {
    $data = json_decode(file_get_contents('./confirm/tmp/confirm.json'), true);
    //the file must contain at least one !! TODO

    $newItem = [$infos['secret'] => [
        "lieu" => $infos['lieu'],
        "job" => $infos['job'],
        "mailApp" => $infos['mailApp'],
        "date" => date("d.m.Y")
    ]];

    $result = array_merge($data, $newItem);

    file_put_contents('confirm/tmp/confirm.json', json_encode($result, JSON_PRETTY_PRINT));
}

function createLink ($infos) {
    return "http://epflform.local/confirm/confirm.php?s=" . $infos['secret'];
}

function debuglog ($message){
    //echo $message;
}
?>