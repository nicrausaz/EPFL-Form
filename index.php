<!doctype html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <?php 
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/head.php');
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/isPostulationOpen.php');
        ?>
    </head>
    <body>
    <div class="page-style">
        <?php include($_SERVER['DOCUMENT_ROOT'] .'/templates/header.php');?>
        <form method ="post" action="mailConfirm.php" enctype="multipart/form-data">

            <p class="paracenter">Veuillez entrer les informations suivantes</p>
            <fieldset>

                <label for="lieu">Je désire effectuer ma formation à:</label><p>
                <dl class="radio-list-left">
                    <dd>
                        <input type="radio" name="lieu" id="lieuLausanne" value="Lausanne" checked>
                        <label for="lieuLausanne">EPFL Lausanne</label>
                    </dd>
                    <dd>
                        <input type="radio" name="lieu" id="lieuSion" value="Sion">
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

            <input type="submit" value="Continuer"/>
        </form>
    </div>
    </body>
</html>
