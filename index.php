<!doctype html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/head.php');
            include($_SERVER['DOCUMENT_ROOT'] . '/templates/isPostulationOpen.php');
            require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/config.php');
        ?>
        <script src="/scripts/script_index.js"></script>
    </head>
    <body>
    <div class="page-style">
        <?php include($_SERVER['DOCUMENT_ROOT'] .'/templates/header.php');?>
        <form method ="post" action="mailConfirm.php" enctype="multipart/form-data" id="baseForm">

            <p class="paracenter">Veuillez entrer les informations suivantes</p>
            <fieldset>
                <div id="lieux">
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
                </div>

                <label for="job">Je suis intéressé par la formation de: </label>

                <select name="job" id="jbLausanne" data-required>
                    <option value="menu" selected disabled>Choisir une formation...</option>
                    <?php
                        foreach ($LISTJOB['Lausanne'] as $jobKey => $jobVal) {
                            echo "<option value=".$jobKey.">$jobVal</option>";
                        }
                    ?>
                </select>


                <select name="job" id="jbSion" style="display: none;" data-required>
                    <option value="menu" selected disabled>Choisir une formation...</option>
                    <?php
                        foreach ($LISTJOB['Sion'] as $jobKey => $jobVal) {
                            echo "<option value=".$jobKey.">$jobVal</option>";
                        }
                    ?>
                </select>

                <input type="email" name="mailApp" id="mailApp" placeholder="Adresse email"/>
            </fieldset>

            <input type="submit" value="Continuer"/>
        </form>
    </div>
    </body>
</html>

<script>

</script>