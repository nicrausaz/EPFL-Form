<!doctype html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <?php 
            include('templates/head.php');
            include('templates/isPostulationOpen.php');
        ?>
    </head>
    <body>
    <div class="page-style">
        <?php include('templates/header.php');?>

        <p class="paracenter">Veuillez entrer les informations suivantes</p>
        <fieldset>

            <label for="lieu">Je désire effectuer ma formation à:</label><p>
            <dl class="radio-list-left">
                <dd>
                    <input type="radio" name="lieu" id="lieuLausanne" value="false" checked>
                    <label for="lieuLausanne">EPFL Lausanne</label>
                </dd>
                <dd>
                    <input type="radio" name="lieu" id="lieuSion" value="true">
                    <label for="lieuSion">EPFL Valais Sion</label>
                </dd>
            </dl>

            <label for="job">Je suis intéressé par la formation de*: </label>

            <select name ="job" id="jb" data-required>
                <option value="menu" selected disabled>Choisir une formation...</option>
                <option value="laborantinBiologie">Laborantin-e CFC; option biologie</option>
                <option value="laborantinChimie">Laborantin-e CFC; option chimie</option>
                <option value="laborantinPhysique">Laborantin-e CFC; option physique</option>
                <option value="polyMecanicien">Polymécanicien-ne CFC</option>
                <option value="informaticien">Informaticien-ne CFC</option>
                <option value="logisticien">Logisticien-ne CFC</option>
                <option value="planificateurElectricien">Planificateur-trice éléctricien-ne CFC</option>
                <option value="employeCommerce">Employé-e de commerce CFC</option>
                <option value="gardienAnimaux">Gardien-ne d'animaux CFC</option>
                <option value="electronicien">Electronicien-ne CFC</option>
                <option value="interactiveMediaDesigner">Interactive Media Designer CFC</option>
            </select>

            <input type="email" name="mailApp" id="mailApp" placeholder="Adresse email"/>

        </fieldset>
        <button id="connectB" class="index-button-style  mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonIndexStyle">
            Continuer
        </button>
    </div>
    </body>
</html>
