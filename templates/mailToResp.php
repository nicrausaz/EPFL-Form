<?php
if( count(get_included_files()) == 1 ) exit("Direct access not permitted.");

$to = ''; // formation.apprentis@epfl.ch
$subject = 'Nouvelle Candidature';

$message = "Candidat: ".$surname." ".$name."\n\n".
"Apprentissage: ".$job."\n\n".
"Consulter la candidature sur: "."\\\\scxdata\\apprentis$\\candidatures\\nouvelles";

$headers = 'From: noreply+formulaireApprentis@epfl.ch' . "\r\n" .
'Reply-To: formation.apprentis@epfl.ch' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
?>