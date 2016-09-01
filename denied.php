<!doctype html>
<html lang="fr">
    <head>  
        <?php include('templates/head.php') ?>
        <title>Accès Refusé</title>
    </head>
    <body style="text-align: center">
    <div class="form-style-5">
    <?php include('templates/header.php');
    $actualDate = Date('d-m-Y');
    $actualYear = Date('-Y');
    $startDate = Date('01-09').$actualDate;
    $endDate = Date('01-02').$actualDate;
    ?> 
        <h1>Accès Refusé</h1>
        <p>La période des postulations n'a pas démarré.</p>
        <?php echo $actualDate ?>
        Revenez entre le <?php echo $startDate ?> et le <?php echo $endDate ?> .
    </body>
</html>