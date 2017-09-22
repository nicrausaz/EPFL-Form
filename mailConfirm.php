<?php
    $infos = $_POST;

    $headers = 'From: noreply+formulaireApprentis@epfl.ch' . "\r\n" .
    'Reply-To: nicolas.crausaz@epfl.ch' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $message = "Bonjour," . "\n\n" .
    "Merci de confirmer votre adresse en cliquant sur le lien: " . createLink ($infos);

    mail($infos['mailApp'], 'Confirmation', $message, $headers);


    function createLink ($infos) {
        return "http://epflform.local/confirm/confirm.php?mail=" . $infos['mailApp'];
    }
?>