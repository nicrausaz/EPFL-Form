<!doctype html>
<html lang="fr">
    <head>  
        <?php include('templates/head.php') ?>
        <title>Accès Refusé</title>
    </head>
    <body style="text-align: center">
    <div class="page-style">
    <?php include('templates/header.php');
    $actualDate = Date('d-m-Y');
    $actualStamp = strtotime($actualDate);
    $actualYear = Date('Y');
    $startDate = Date('01-09-'.$actualYear);
    $endDate = Date('01-12-'.$actualYear);
    $endStamp = strtotime($endDate);
    if($actualStamp > $endStamp){
        $actualYear = Date('Y')+1;
        $startDate = Date('01-09-'.$actualYear);
        $endDate = Date('01-12-'.$actualYear);
    }
    ?> 
        <h1 style="color:red">Accès Refusé</h1>
        <p>La période des postulations n'a pas démarré.</p>
        Revenez entre le <?php echo $startDate ?> et le <?php echo $endDate ?> .
        <p></p>
        <button type ="button" id="retourHome" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
            Retour à l'accueil
        </button>
    </body>
</html>