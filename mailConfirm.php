<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/configs/config.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/prePostMail.php");

    $infos = $_POST;
    $infos['secret'] = uniqid() . bin2hex(random_bytes(5));    

    require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/prePostMail.php");

    $message .= createLink($infos);
    
    createLink($infos);

    if (mail($infos['mailApp'], $subject, $message, $headers)) {
        addUserInfos($infos);
    }
    else {
        echo "error";
    }

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
?>