<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/configs/config.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/helpers.php");

    $infos = $_POST;
    $infos['secret'] = uniqid() . bin2hex(random_bytes(5));

    require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/prePostMail.php");

    $message .= createLink($infos);

    if (mail($infos['mailApp'], $subject, $message, $headers)) {
        addUserInfos($infos);
    }
    else {
        echo "error";
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/head.php');
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/isPostulationOpen.php');
        ?>
        <title>Conditions</title>
    </head>
    <body>
    <div class="page-style">
        <?php include('templates/header.php') ?>
        <p><strong>Merci d'avoir commencé le processus de postulation pour une place d'apprentissage à l'EPFL.</strong></p>
        <p><strong>Pour poursuivre la postulation, utilisez le lien contenu dans le mail de confirmation qui vous a été envoyé.</strong></p>

        <label for="cond">Afin de compléter le processus, il est nécessaire de vous munir des documents suivants au format PDF, PNG, JPEG ou JPG:</label>
        <ul id="cond">
            <li>Lettre de motivation</li>
            <li>Curriculum Vitae avec indication des références</li>
            <li>Copie des bulletins scolaires des 3-4 derniers semestres</li>
            <li>Copies des certificats, diplômes obtenus, attestations de stages</li>
            <li>Copie carte d'identité</li>
            <li>Photo passeport couleur</li>
            <li>Pour les apprentissages de polymécanicien-ne, une attestation de test d'aptitudes GIM-CH est <strong>recommandée</strong></li>
            <li>Pour les apprentissages d'informaticien, une attestation de test d'aptitudes GRI est <strong>recommandée</strong></li>
        </ul>

        <legend><strong>Renseignements:</strong></legend>
        <table>
            <tr>
                <td>Francis Perritaz</td>
            </tr>
            <tr>
                <td>Chef formation apprentis</td>
            </tr>
            <tr>
                <td>Téléphone : 021 693 31 19</td>
            </tr>
            <tr>
                <td>formation.apprentis@epfl.ch</td>
            </tr>
            <tr>
                <td>http://apprentis.epfl.ch</td>
            </tr>
        </table>
       <p id="incomplet"> Tout dossier incomplet ou non conforme ne sera pas pris en considération ! </p>
       <p><strong>Vous pouvez quitter cette page.</strong></p>
    </div>
    </body>
</html>