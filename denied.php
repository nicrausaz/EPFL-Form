<!doctype html>
<html lang="fr">
    <head>
        <?php include('templates/head.php') ?>
        <title>Accès Refusé</title>
    </head>
    <body style="text-align: center">
        <div class="page-style">
            <?php
                include('templates/checkDate.php');
                include('templates/header.php');

                if($actualDateStamp > $endDateStamp){
                    $year = Date('Y')+1;
                    $startDate = Date($startDayMonth.$year);
                    $endDate = Date($endDayMonth.$year);
                }
            ?>
            <h1 style="color:red">Accès Refusé</h1>
            <p>La période des postulations n'a pas démarré.</p>
            <p>Revenez entre le <?php echo $startDate ?> et le <?php echo $endDate ?>.</p>
            <button type ="button" id="retourHome" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                Retour à l'accueil
            </button>
        </div>
    </body>
</html>