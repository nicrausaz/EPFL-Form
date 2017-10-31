<?php
    require_once("tequila/tequila.php");
    $oClient = new TequilaClient();
    $oClient->SetApplicationName('Formulaire apprentissage');
    $oClient->SetWantedAttributes(array('uniqueid','firstname','name'));
    $oClient->SetWishedAttributes(array('user'));
    $oClient->SetAllowsFilter('categorie=epfl-guests');
    $oClient->Authenticate();
    $user = $oClient->getValue('user');
    $firstname= $oClient->getValue('firstname');
    $name= $oClient->getValue('name');
    $sKey = $oClient->GetKey();

    include('templates/isPostulationOpen.php');
    require_once('configs/config.php');
?>
<!doctype html>
    <html lang="fr">
        <head>
            <title>Formulaire Apprentissage</title>
            <?php include('templates/head.php'); ?>
        </head>
    <body>
        <div class="page-style">
        <?php include('templates/header.php') ?>
        <p class="paracenter">Les champs ayant une bordure rouge sont obligatoires</p>
        <form method="post" action="cible.php" enctype="multipart/form-data">
            <fieldset>
                <legend><span class="number">1</span> Apprentissage </legend>

                <div id="lieux">
                <label for="lieu">Je désire effectuer ma formation à:</label>
                    <dl class="radio-list-left">
                        <dd>
                            <input type="radio" name="lieu" id="lieuLausanne" value="Lausanne" <?php echo (!isset($_SESSION['postedForm']['lieu']) || $_SESSION['postedForm']['lieu'] == "Lausanne") ? "checked=\"checked\"" : ''; ?>>
                            <label for="lieuLausanne">EPFL Lausanne</label>
                        </dd>
                        <dd>
                            <input type="radio" name="lieu" id="lieuSion" value="Sion"  <?php echo ($_SESSION['postedForm']['lieu'] == "Sion") ? "checked=\"checked\"" : ''; ?>>
                            <label for="lieuSion">EPFL Valais Sion</label>
                        </dd>
                    </dl>
                </div>
                <label for="job">Je suis intéressé par la formation de: </label>

                <select name="job" id="jbLausanne" class="jobSelectors" data-required>
                    <option value="menu" selected disabled>Choisir une formation...</option>
                    <?php
                        foreach ($LISTJOB['Lausanne'] as $jobKey => $jobVal) {

                            if ($_SESSION['postedForm']['job'] == $jobKey) {
                                echo "<option value='$jobKey' selected='selected'>$jobVal</option>";
                            } else {
                                echo "<option value='$jobKey'>$jobVal</option>";
                            }
                        }
                    ?>
                </select>

                <select name="job" id="jbSion" class="jobSelectors" style="display: none;" data-required>
                    <option value="menu" selected disabled>Choisir une formation...</option>
                    <?php
                        foreach ($LISTJOB['Sion'] as $jobKey => $jobVal) {

                            if ($_SESSION['postedForm']['job'] == $jobKey) {
                                echo "<option value='$jobKey' selected='selected'>$jobVal</option>";
                            } else {
                                echo "<option value='$jobKey'>$jobVal</option>";
                            }
                        }
                    ?>
                </select>
            </fieldset>
            <div id="all" style="display: none;">
                <fieldset>
                    <div id="infoOnly">
                        <?php include('templates/filieresinfos.php') ?>
                    </div>
                    <label for="mpt">Je désire m'inscrire en maturité professionnelle intégrée:</label>
                    <dl class="radio-list-left">
                        <dd>
                            <input type="radio" name="mpt" id="mpt1" value="false" <?php echo (!isset($_SESSION['postedForm']['mpt']) || $_SESSION['postedForm']['mpt'] == "false") ? "checked=\"checked\"" : ''; ?>>
                            <label for="mpt1">Non</label>
                        </dd>
                        <dd>
                            <input type="radio" name="mpt" id="mpt2" value="true" <?php echo ($_SESSION['postedForm']['mpt'] == "true") ? "checked=\"checked\"" : ''; ?>>
                            <label for="mpt2">Oui</label>
                        </dd>
                    </dl>
                    <button type="button" id="infoMpt" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                        Infos sur la maturité
                    </button>
                </fieldset>
                <fieldset>
                    <legend><span class="number">2</span> Données </legend>
                        <fieldset>
                            <legend><span class="number">2.1</span> Données personnelles</legend>
                            <label for="genreApp">Genre:</label>
                            <select name="genreApp" id="genreApp">
                                <option value="notSelected" <?php echo (!isset($_SESSION['postedForm']['genreApp'])) ? "selected" : ''; ?> disabled> Choisissez un genre</option>
                                <option value="Homme" <?php echo ($_SESSION['postedForm']['genreApp'] == "Homme") ? "selected" : ''; ?>>Homme</option>
                                <option value="Femme" <?php echo ($_SESSION['postedForm']['genreApp'] == "Femme") ? "selected" : ''; ?>>Femme</option>
                            </select>
                            <label for="nameApp">Nom:</label><input type="text" name="nameApp" id="nameApp" value="<?php echo $name;?>" readonly />
                            <label for="surnameApp">Prénom:</label><input type="text" name="surnameApp" id="surnameApp" value="<?php echo $firstname;?>" readonly />
                            <label for="adrApp">Rue:</label><input type="text" name="adrApp" id="adrApp" placeholder="Rue" value="<?php echo $_SESSION['postedForm']['adrApp'] != '' ? $_SESSION['postedForm']['adrApp'] : ''; ?>" minlength="2" maxlength="40" data-required/>
                            <label for="NPAApp">NPA et domicile:</label><input type="text" name="NPAApp" id="NPAApp" placeholder = "NPA et domicile" value="<?php echo $_SESSION['postedForm']['NPAApp'] != '' ? $_SESSION['postedForm']['NPAApp'] : ''; ?>"  minlength="2" maxlength="40" data-required/>
                            <label for="telApp">Téléphone:</label><input type="tel" name="telApp" id="telApp" placeholder="+41 79 123 45 67" value="<?php echo $_SESSION['postedForm']['telApp'] != '' ? $_SESSION['postedForm']['telApp'] : ''; ?>" minlength="2"  maxlength="20" data-required/>
                            <label for="mailApp">Email:</label><input type="email" name="mailApp" id="mailApp" value="<?php echo $user;?>" readonly />
                            <label for="birthApp">Date de naissance:</label><input type="text" name="birthApp" id="birthApp" placeholder="jj/mm/aaaa" value="<?php echo $_SESSION['postedForm']['birthApp'] != '' ? $_SESSION['postedForm']['birthApp'] : ''; ?>" data-required />
                            <section id="errorMsg"></section>
                            <label for="originApp">Lieu d'origine:</label><input type="text" name="originApp" id="originApp" placeholder="Lieux d'origine" value="<?php echo $_SESSION['postedForm']['originApp'] != '' ? $_SESSION['postedForm']['originApp'] : ''; ?>" minlength="2" maxlength="35" data-required />
                            <label for="nationApp">Nationalité:</label><input type="text" name="nationApp" id="nationApp" placeholder="Nationalité" value="<?php echo $_SESSION['postedForm']['nationApp'] != '' ? $_SESSION['postedForm']['nationApp'] : ''; ?>" minlength="2" maxlength="30" data-required />
                            <label for="permisEtrangerApp">Catégorie de permis pour étrangers:</label><input type="text" name="permisEtrangerApp" id="permisEtrangerApp" placeholder="Catégorie" value="<?php echo $_SESSION['postedForm']['permisEtrangerApp'] != '' ? $_SESSION['postedForm']['permisEtrangerApp'] : ''; ?>" maxlength="1" />
                            <label for="langApp">Langue maternelle:</label><input type="text" name="langApp" id="langApp" placeholder="Langue" value="<?php echo $_SESSION['postedForm']['langApp'] != '' ? $_SESSION['postedForm']['langApp'] : ''; ?>" minlength="2" maxlength="20" data-required />
                            <label for="avsNumber">Numéro AVS:</label><input type="text" name="avsNumber" id="avsNumber" placeholder="756.1234.5678.97" value="<?php echo $_SESSION['postedForm']['avsNumber'] != '' ? $_SESSION['postedForm']['avsNumber'] : ''; ?>" minlength="2" maxlength="20" data-required />
                            <label for="languesApp">Connaissance linguistiques:</label>
                                <p><input type="checkbox" name="languesApp[]" value="fr" id="french" <?php echo (is_int(array_search('fr', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="french"><span class="ui"></span>Français</label></p>
                                <p><input type="checkbox" name="languesApp[]" value="de" id="german" <?php echo (is_int(array_search('de', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="german"><span class="ui"></span>Allemand</label></p>
                                <p><input type="checkbox" name="languesApp[]" value="en" id="english" <?php echo (is_int(array_search('en', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="english"><span class="ui" ></span>Anglais</label></p>
                                <p><input type="checkbox" name="languesApp[]" value="others" id="other" <?php echo (is_int(array_search('others', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="other"><span class="ui" ></span>Autres</label></p>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">2.2</span> Représentants légaux</legend>
                            <label for="maj">Avez vous plus de 18 ans?</label>
                            <dl class="radio-list-left">
                                <dd>
                                    <input type="radio" name="maj" id="maj1" value="false" <?php echo (!isset($_SESSION['postedForm']['maj']) || $_SESSION['postedForm']['maj'] == "false") ? "checked=\"checked\"" : ''; ?>>
                                    <label for="maj1">Non</label>
                                </dd>
                                <dd>
                                    <input type="radio" name="maj" id="maj2" value="true" <?php echo ($_SESSION['postedForm']['maj'] == "true") ? "checked=\"checked\"" : ''; ?>>
                                    <label for="maj2">Oui</label>
                                </dd>
                            </dl>
                            <section id="representants">
                                <p>Représentant principal:</p>
                                <fieldset>
                                    <label for="genreRep1">Genre:</label>
                                    <select name="genreRep1" id="genreRep1">
                                        <option <?php echo (!isset($_SESSION['postedForm']['genreRep1'])) ? "selected" : ''; ?> disabled> Choisissez un genre</option>
                                        <option value="Homme" <?php echo ($_SESSION['postedForm']['genreRep1'] == "Homme") ? "selected" : ''; ?>>Homme</option>
                                        <option value="Femme" <?php echo ($_SESSION['postedForm']['genreRep1'] == "Femme") ? "selected" : ''; ?>>Femme</option>
                                    </select>
                                    <label for="nameRep1">Nom:</label><input type="text" name="nameRep1" id="nameRep1" placeholder="Nom" value="<?php echo $_SESSION['postedForm']['nameRep1'] != '' ? $_SESSION['postedForm']['nameRep1'] : ''; ?>"/>
                                    <label for="surnameRep1">Prénom:</label><input type="text" name="surnameRep1" id="surnameRep1" placeholder="Prénom" value="<?php echo $_SESSION['postedForm']['surnameRep1'] != '' ? $_SESSION['postedForm']['surnameRep1'] : ''; ?>"/>
                                    <label for="adrRep1">Rue:</label><input type="text" name="adrRep1" id="adrRep1" placeholder="Rue" value="<?php echo $_SESSION['postedForm']['adrRep1'] != '' ? $_SESSION['postedForm']['adrRep1'] : ''; ?>"/>
                                    <label for="NPARep1">NPA et domicile:</label><input type="text" name="NPARep1" id="NPARep1" placeholder = "NPA et domicile" value="<?php echo $_SESSION['postedForm']['NPARep1'] != '' ? $_SESSION['postedForm']['NPARep1'] : ''; ?>"/>
                                    <label for="telRep1">Téléphone:</label><input type="text" name="telRep1" id="telRep1" placeholder="+41 79 123 45 67" value="<?php echo $_SESSION['postedForm']['telRep1'] != '' ? $_SESSION['postedForm']['telRep1'] : ''; ?>"/>
                                </fieldset>
                                <p>Représentant secondaire:</p>
                                <fieldset>
                                    <label for="genreRep2">Genre:</label>
                                    <select name="genreRep2" id="genreRep2">
                                        <option <?php echo (!isset($_SESSION['postedForm']['genreRep2'])) ? "selected" : ''; ?> disabled> Choisissez un genre</option>
                                        <option value="Homme" <?php echo ($_SESSION['postedForm']['genreRep2'] == "Homme") ? "selected" : ''; ?>>Homme</option>
                                        <option value="Femme" <?php echo ($_SESSION['postedForm']['genreRep2'] == "Femme") ? "selected" : ''; ?>>Femme</option>
                                    </select>
                                    <label for="nameRep2">Nom:</label><input type="text" name="nameRep2" id="nameRep2" placeholder="Nom" value="<?php echo $_SESSION['postedForm']['nameRep2'] != '' ? $_SESSION['postedForm']['nameRep2'] : ''; ?>"/>
                                    <label for="surnameRep2">Prénom:</label><input type="text" name="surnameRep2" id="surnameRep2" placeholder="Prénom" value="<?php echo $_SESSION['postedForm']['surnameRep2'] != '' ? $_SESSION['postedForm']['surnameRep2'] : ''; ?>"/>
                                    <label for="adrRep2">Rue:</label><input type="text" name="adrRep2" id="adrRep2" placeholder="Rue" value="<?php echo $_SESSION['postedForm']['adrRep2'] != '' ? $_SESSION['postedForm']['adrRep2'] : ''; ?>"/>
                                    <label for="NPARep2">NPA et domicile:</label><input type="text" name="NPARep2" id="NPARep2" placeholder = "NPA et domicile" value="<?php echo $_SESSION['postedForm']['NPARep2'] != '' ? $_SESSION['postedForm']['NPARep2'] : ''; ?>"/>
                                    <label for="telRep2">Téléphone:</label><input type="text" name="telRep2" id="telRep2" placeholder="+41 79 123 45 67" value="<?php echo $_SESSION['postedForm']['telRep2'] != '' ? $_SESSION['postedForm']['telRep2'] : ''; ?>"/>
                                </fieldset>
                            </section>
                        </fieldset>
                        <legend><span class="number">3</span> Activités</legend>
                        <fieldset>
                            <legend><span class="number">3.1</span> Scolarité</legend>
                            <table id="scolaire">
                                <tr>
                                    <td><label for="ecole1">Ecole:</label><input type="text" name="ecole1" id="ecole1" placeholder="Ecole" value="<?php echo $_SESSION['postedForm']['ecole1'] != '' ? $_SESSION['postedForm']['ecole1'] : ''; ?>" data-required/></td>
                                    <td><label for="lieuEcole1">Lieu:</label><input type="text" name="lieuEcole1" id="lieuEcole1" placeholder="Lieu" value="<?php echo $_SESSION['postedForm']['lieuEcole1'] != '' ? $_SESSION['postedForm']['lieuEcole1'] : ''; ?>" data-required/></td>
                                    <td><label for="niveauEcole1">Niveau:</label><input type="text" name="niveauEcole1" id="niveauEcole1" placeholder="Niveau" value="<?php echo $_SESSION['postedForm']['niveauEcole1'] != '' ? $_SESSION['postedForm']['niveauEcole1'] : ''; ?>" data-required/></td>
                                    <td><label for="anneesEcole1">Années:</label><input type="text" name="anneesEcole1" id="anneesEcole1" placeholder="de-à" value="<?php echo $_SESSION['postedForm']['anneesEcole1'] != '' ? $_SESSION['postedForm']['anneesEcole1'] : ''; ?>" data-required/></td>
                                </tr>
                                <tr>
                                    <td><label for="ecole2">Ecole:</label><input type="text" name="ecole2" placeholder="Ecole" value="<?php echo $_SESSION['postedForm']['ecole2'] != '' ? $_SESSION['postedForm']['ecole2'] : ''; ?>" data-required/></td>
                                    <td><label for="lieuEcole2">Lieu:</label><input type="text" name="lieuEcole2" placeholder="Lieu" value="<?php echo $_SESSION['postedForm']['lieuEcole2'] != '' ? $_SESSION['postedForm']['lieuEcole2'] : ''; ?>" data-required/></td>
                                    <td><label for="niveauEcole2">Niveau:</label><input type="text" name="niveauEcole2" placeholder="Niveau" value="<?php echo $_SESSION['postedForm']['niveauEcole2'] != '' ? $_SESSION['postedForm']['niveauEcole2'] : ''; ?>" data-required/></td>
                                    <td><label for="anneesEcole2">Années:</label><input type="text" name="anneesEcole2" placeholder="de-à" value="<?php echo $_SESSION['postedForm']['anneesEcole2'] != '' ? $_SESSION['postedForm']['anneesEcole2'] : ''; ?>" data-required/></td>
                                </tr>
                                <?php
                                for($i = 3; $i < 6; $i++){
                                    if($_SESSION['postedForm']['ecole'.$i]){
                                ?>
                                <tr>
                                    <td><label for="ecole<?php echo $i ?>">Ecole:</label><input type="text" name="ecole<?php echo $i ?>" id="ecole<?php echo $i ?>" placeholder="Ecole" value="<?php echo $_SESSION['postedForm']['ecole'.$i] ?>"/></td>
                                    <td><label for="lieuEcole<?php echo $i ?>">Lieu:</label><input type="text" name="lieuEcole<?php echo $i ?>" id="lieuEcole<?php echo $i ?>" placeholder="Lieu" value="<?php echo $_SESSION['postedForm']['lieuEcole'.$i] ?>" ></td>
                                    <td><label for="niveauEcole<?php echo $i ?>">Niveau:</label><input type="text" name="niveauEcole<?php echo $i ?>" id="niveauEcole<?php echo $i ?>" placeholder="Niveau" value="<?php echo $_SESSION['postedForm']['niveauEcole'.$i] ?>"></td>
                                    <td><label for="anneesEcole<?php echo $i ?>">Années:</label><input type="text" name="anneesEcole<?php echo $i ?>" id="anneesEcole<?php echo $i ?>" placeholder="de-à" value="<?php echo $_SESSION['postedForm']['anneesEcole'.$i] ?>"></td>
                                </tr>
                                <?php }} ?>

                            </table>
                            <label for="anneeFin">Année de fin de scolarité:</label>
                            <input type="text" name="anneeFin" id="anneeFin" placeholder="Année" value="<?php echo $_SESSION['postedForm']['anneeFin'] != '' ? $_SESSION['postedForm']['anneeFin'] : ''; ?>" maxlength="4" data-required/>
                            <section id="anneeFinError"></section>
                            <button type="button" id="addSch" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3.2</span> Activités professionnelles</legend>
                            <p>Formations / apprentissages après la scolarité.</p>
                            <table id="activites">
                                <tr>
                                    <td><label for="employeurPro1">Employeur:</label><input type="text" name="employeurPro1" id="employeurPro1" placeholder="Employeur" value="<?php echo $_SESSION['postedForm']['employeurPro1'] != '' ? $_SESSION['postedForm']['employeurPro1'] : ''; ?>"/></td>
                                    <td><label for="lieuPro1">Lieu:</label><input type="text" name="lieuPro1" id="lieuPro1" placeholder="Lieu" value="<?php echo $_SESSION['postedForm']['lieuPro1'] != '' ? $_SESSION['postedForm']['lieuPro1'] : ''; ?>"/></td>
                                    <td><label for="activitePro1">Activité:</label><input type="text" name="activitePro1" id="activitePro1" placeholder="Activité" value="<?php echo $_SESSION['postedForm']['activitePro1'] != '' ? $_SESSION['postedForm']['activitePro1'] : ''; ?>"/></td>
                                    <td><label for="anneesPro1">Années:</label><input type="text" name="anneesPro1" id="anneesPro1" placeholder="de-à" value="<?php echo $_SESSION['postedForm']['anneesPro1'] != '' ? $_SESSION['postedForm']['anneesPro1'] : ''; ?>"/></td>
                                </tr>
                                <?php
                                for($i = 2; $i < 4; $i++){
                                    if($_SESSION['postedForm']['employeurPro'.$i]){
                                ?>
                                <tr>
                                    <td><label for="employeurPro<?php echo $i ?>">Employeur:</label><input type="text" name="employeurPro<?php echo $i ?>" id="employeurPro<?php echo $i ?>" placeholder="Employeur" value="<?php echo $_SESSION['postedForm']['employeurPro'.$i] ?>"/></td>
                                    <td><label for="lieuPro<?php echo $i ?>">Lieu:</label><input type="text" name="lieuPro<?php echo $i ?>" id="lieuPro<?php echo $i ?>" placeholder="Lieu" value="<?php echo $_SESSION['postedForm']['lieuPro'.$i] ?>" ></td>
                                    <td><label for="activitePro<?php echo $i ?>">Activité:</label><input type="text" name="activitePro<?php echo $i ?>" id="activitePro<?php echo $i ?>" placeholder="Activité" value="<?php echo $_SESSION['postedForm']['activitePro'.$i] ?>"></td>
                                    <td><label for="anneesPro<?php echo $i ?>">Années:</label><input type="text" name="anneesPro<?php echo $i ?>" id="anneesPro<?php echo $i ?>" placeholder="de-à" value="<?php echo $_SESSION['postedForm']['anneesPro'.$i] ?>"></td>
                                </tr>
                                <?php }} ?>
                            </table>
                            <button type="button" id="addPro" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3.3</span> Stages</legend>
                            <table id="stages">
                                <tr>
                                    <td><label for="activiteStage1">Métier:</label><input type="text" name="activiteStage1" id="activiteStage1" placeholder="Métier" value="<?php echo $_SESSION['postedForm']['activiteStage1'] != '' ? $_SESSION['postedForm']['activiteStage1'] : ''; ?>"></td>
                                    <td><label for="entrepriseStage1">Entreprise:</label><input type="text" name="entrepriseStage1" id="entrepriseStage1" placeholder="Entreprise" value="<?php echo $_SESSION['postedForm']['entrepriseStage1'] != '' ? $_SESSION['postedForm']['entrepriseStage1'] : ''; ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="activiteStage2">Métier:</label><input type="text" name="activiteStage2" id="activiteStage2" placeholder="Métier" value="<?php echo $_SESSION['postedForm']['activiteStage2'] != '' ? $_SESSION['postedForm']['activiteStage2'] : ''; ?>"></td>
                                    <td><label for="entrepriseStage2">Entreprise:</label><input type="text" name="entrepriseStage2" id="entrepriseStage2" placeholder="Entreprise" value="<?php echo $_SESSION['postedForm']['entrepriseStage2'] != '' ? $_SESSION['postedForm']['entrepriseStage2'] : ''; ?>"></td>
                                </tr>
                                <?php
                                for($i = 2; $i < 4; $i++){
                                    if($_SESSION['postedForm']['activiteStage'.$i]){
                                ?>
                                <tr>
                                    <td><label for="activiteStage<?php echo $i ?>">Métier:</label><input type="text" name="activiteStage<?php echo $i ?>" id="activiteStage<?php echo $i ?>" placeholder="Métier" value="<?php echo $_SESSION['postedForm']['activiteStage'.$i] ?>"/></td>
                                    <td><label for="entrepriseStage<?php echo $i ?>">Entreprise:</label><input type="text" name="entrepriseStage<?php echo $i ?>" id="entrepriseStage<?php echo $i ?>" placeholder="Entreprise" value="<?php echo $_SESSION['postedForm']['entrepriseStage'.$i] ?>" ></td>
                                </tr>
                                <?php }} ?>
                            </table>
                            <button type="button" id="addStage" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                            <p>Avez-vous déjà été candidat à l'EPFL?</p>
                            <dl class="radio-list-left">
                                <dd>
                                    <input type="radio" name="dejaCand" id="dejaCand1" value="false" <?php echo (!isset($_SESSION['postedForm']['dejaCand']) || $_SESSION['postedForm']['dejaCand'] == "false") ? "checked=\"checked\"" : ''; ?>>
                                    <label for="dejaCand1">Non</label>
                                </dd>
                                <dd>
                                    <input type="radio" name="dejaCand" id="dejaCand2" value="true" <?php echo ($_SESSION['postedForm']['dejaCand'] == "true") ? "checked=\"checked\"" : ''; ?>/>
                                    <label for="dejaCand2">Oui</label>
                                </dd>
                            </dl>
                            <label for="dejaCandAnnee">Année de candidature:</label>
                            <input type="text" name="dejaCandAnnee" id="dejaCandAnnee" placeholder="Année" value="<?php echo $_SESSION['postedForm']['dejaCandAnnee'] != '' ? $_SESSION['postedForm']['dejaCandAnnee'] : ''; ?>" maxlength="4" style="display: none;"/>
                            <section id="dejaCandError"></section>
                        </fieldset>
                        <fieldset id="files">
                            <legend><span class="number">4</span> Annexes </legend>
                            <p>Merci de joindre tous les fichiers demandés, en respectant les formats (si les formats ne sont pas respectés, les fichiers ne seront pas pris en compte).</p>

                            <label for="photo">Photo passeport <strong>couleur:</strong></label>
                            <div class="tooltip">
                                <label class="file" title="" id="photoLabel">
                                    <input type="file" name="photo" id="photo" onchange="changeTitleFile(this)" data-required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone1"></section>
                            </div>
                            <label for="idCard">Copie carte d'indentité / passeport:</label>
                            <div class="tooltip">
                                <label class="file" title="" id="idCardLabel">
                                    <input type="file" name="idCard" id="idCard" onchange="changeTitleFile(this)" data-required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone2"></section>
                            </div>
                            <label for="cv">Curriculum Vitae:</label>
                            <div class="tooltip">
                                <label class="file" title="" id="CVLabel" >
                                    <input type="file" name="cv" id="cv" onchange="changeTitleFile(this)" data-required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone3"></section>
                            </div>
                            <label for="lettre">Lettre de motivation:</label>
                            <div class="tooltip">
                                <label class="file" title="" id="lettreLabel" >
                                    <input type="file" name="lettre" id="lettre" onchange="changeTitleFile(this)" data-required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone4"></section>
                            </div>

                            <label for="certifs1">Certificats, diplômes et bulletins de notes des derniers 3-4 semestres:</label>
                            <table id="newCertifZone">
                                <tr><td>
                                    <div class="tooltip">
                                        <label class="file" title="" id="certifLabel1">
                                            <input type="file" name="certifs1" id="certifs1" onchange="changeTitleFile(this)" />
                                        </label>
                                        <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                        <p></p>
                                        <section id="formatErrorZone7"></section>
                                    </div>
                                </td></tr>
                            </table>
                            <button type ="button" id="addInputFile" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une annexe
                            </button>
                            <div id="polyOnly">
                                <label for="gimch">Attestation de tests d'aptitudes GIM-CH (polymécanicien):</label>
                                <div class="tooltip">
                                    <label class="file" title="" id="gimchLabel" >
                                        <input type="file" name="gimch" id="gimch" onchange="changeTitleFile(this)"/>
                                    </label>
                                    <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                    <p></p>
                                    <section id="formatErrorZone5"></section>
                                </div>
                            </div>
                            <div id="griTest">
                                <label for="griTestInput">Attestation de tests d'aptitudes GRI (informaticien):</label>
                                <div class="tooltip">
                                    <label class="file" title="" id="griTestInputLabel" >
                                        <input type="file" name="griTestInput" id="griTestInput" onchange="changeTitleFile(this)"/>
                                    </label>
                                    <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span>
                                    <p></p>
                                    <section id="formatErrorZone6"></section>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div id="condDiv">
                                <input type="checkbox" value="conditionsAcc" id="conditions" data-required/>
                                <label for="conditions" id="condLabel"><span class="ui"></span>Accepter les <a href="conditions.php" target="_blank"> conditions</a></label>
                                <p></p>
                            </div>
                        </fieldset>
                        <input type="submit" value="Terminer"/>
                    </div>
                </fieldset>
            </form>
        </div>
        <script> lieu='<?php echo $_SESSION['postedForm']['lieu'] ;?>';</script>
        <?php
            if ($_SESSION['formError']) {
                echo "<script>showOnFormReturn(lieu);</script>";
            }
            // require_once('templates/footer.php');
        ?>
    </body>
</html>