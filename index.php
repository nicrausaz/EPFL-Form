<!doctype html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <?php include('templates/head.php');
        include('templates/isPostulationOpen.php');
        session_unset();
        ?>
    </head>
    <body>
    <div class="page-style">
        <?php include('templates/header.php');?>

        <p class="paracenter">Veuillez suivre les indications suivantes</p>
        <p>Afin de compléter le processus de postulation, il est nécessaire de vous munir des documents suivants au format PDF, PNG, JPEG ou JPG:</p>
        <ul>
            <li>Lettre de motivation</li>
            <li>Curriculum Vitae avec indication des références</li>
            <li>Copie des bulletins scolaires des 3-4 derniers semestres</li>
            <li>Copies des certificats, diplômes obtenus, attestations de stages</li>
            <li>Copie carte d'identité</li>
            <li>Photo passeport couleur</li>
            <li>Si informaticien, le certificat d’aptitude GRI est <strong>recommandé</strong></li>
            <li>Si polymécanicien, le certificat d’aptitude GIM-CH est <strong>recommandé</strong></li>
        </ul>
        Veuillez également prévoir une vingtaine de minutes pour compléter le formulaire.

        <p>Pour débuter, créez un compte en cliquant sur le bouton (remplissez la rubrique "organisation" par "postulation"), confirmez ensuite votre adresse via l’email reçu.</p>
        <p>Une fois votre compte créé et validé, cliquez sur le bouton "Se connecter"</p>

        <button id="createAc" class="index-button-style  mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonIndexStyle">
            Créer un compte
        </button>
        <button id="connectB" class="index-button-style  mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonIndexStyle">
            Se connecter
        </button>
    </div>
    </body>
</html>
