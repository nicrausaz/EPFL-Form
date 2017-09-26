<?php
if( count(get_included_files()) == 1 ) exit("Direct access not permitted.");

    $subject = 'Postulation EPFL';

    $headers = 'From: noreply+formulaireApprentis@epfl.ch' . "\r\n" .
    'Reply-To: nicolas.crausaz@epfl.ch' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $message = "Bonjour," . "\n\n" .
    "\t Merci d'avoir commencé le processus de postulation pour une place d'apprentissage à l'EPFL en tant que " . $LISTJOB[$infos['lieu']][$infos['job']]. ".\n" .
    "Afin de compléter le processus, il est nécessaire de vous munir des documents suivants au format PDF :
    * Lettre de motivation \n
    * Curriculum Vitae avec indication des références \n
    * Copie des bulletins scolaires des 3-4 derniers semestres \n
    * Copies des certificats, diplômes obtenus, attestations de stages \n
    * Copie carte d'identité \n
    * Photo passeport couleur \n";

    if ($infos['job'] === 'polyMecanicien') {
    $message.= "  * Pour les apprentissages de polymécanicien-ne, une attestation de test d'aptitudes GIM-CH est recommandée \n";
    }

    if ($infos['job'] === 'informaticien') {
    $message.= "  * Pour les apprentissages d'informaticien, une attestation de test d'aptitudes GRI est recommandée \n";
    }
?>