<!doctype html>
<html lang="fr">
    <head>
    <?php
        include('templates/head.php');
        include('templates/checkDate.php');
        require_once("tequila/tequila.php");
            $oClient = new TequilaClient();
            $oClient->SetApplicationName('Formulaire apprentissage');
            $oClient->SetWantedAttributes(array('uniqueid','firstname','name'));
            $oClient->SetWishedAttributes(array('user'));
            $oClient->SetAllowsFilter('categorie=epfl-guests');
            $oClient->Authenticate();
            $tempSciper = $oClient->getValue('uniqueid');
            $user = $oClient->getValue('user');
            $firstname= $oClient->getValue('firstname');
            $name= $oClient->getValue('name');
            $sKey = $oClient->GetKey();
    ?>
         <title>Formulaire Apprentissage</title>
    </head>
    <body>
        <div class="page-style">
        <?php include('templates/header.php') ?>
        <p class="paracenter">Les champs notés d'un astérisque* doivent être obligatoirement remplis.</p>
        <form method ="post" action="cible.php" enctype="multipart/form-data">
            <fieldset>
                <legend><span class="number">1</span> Apprentissage</legend>
                <label for="job">Je suis intéressé par la formation de*: </label>
                <select name ="job" id="jb" required>
                    <option value="menu" selected disabled>Choisir une formation...</option>
                    <option value="laborantinBiologie">Laborantin-e CFC; option biologie</option>
                    <option value="laborantinChimie">Laborantin-e CFC; option chimie</option>
                    <option value="laborantinPhysique">Laborantin-e CFC; option physique</option>
                    <option value="polyMecanicien">Polymécanicien-ne CFC</option>
                    <option value="informaticien" >Informaticien-ne CFC</option>
                    <option value="logisticien">Logisticien-ne CFC</option>
                    <option value="planificateurElectricien">Planificateur-trice éléctricien-ne CFC</option>
                    <option value="employeCommerce">Employé-e de commerce CFC</option>
                    <option value="gardienAnimaux">Gardien-ne d'animaux CFC</option>
                    <option value="electronicien">Electronicien-ne CFC</option>
                    <option value="interactiveMediaDesigner">Interactive Media Desginer CFC</option>
                </select>
                <input type="text" name="sciperTmp" value="<?php echo $tempSciper;?>" readonly hidden/>
            </fieldset>
            <div id="all" style="display: none;">
                <fieldset>
                    <div id="infoOnly">
                        <?php include('templates/filieresinfos.php') ?>
                    </div>
                    <label for="mpt">Je désire m'inscire en maturité professionelle intégrée*:</label><p>
                    <dl class="radio-list-left">
                        <dd>
                            <input type="radio" name="mpt" id="mpt1" value="false" checked="checked">
                            <label for="mpt1">Non</label>
                        </dd>
                        <dd>
                            <input type="radio" name="mpt" id="mpt2" value="true">
                            <label for="mpt2">Oui</label>
                        </dd>
                    </dl>
                </fieldset>
                <fieldset>
                    <legend><span class="number">2</span> Données </legend>
                        <fieldset>
                            <legend><span class="number">2.1</span> Données personnelles</legend>    
                            <select name="genreApp" id="genreApp">
                                <option value="notSelected" disabled selected> Choisissez un genre*</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                            <input type="text" name="nameApp" placeholder="Nom *" value="<?php echo $name;?>" readonly />
                            <input type="text" name="surnameApp" placeholder="Prénom *" value="<?php echo $firstname;?>" readonly />
                            <input type="text" name="adrApp" placeholder="Rue *" autocomplete="off" minlength="2" maxlength="40" required/>
                            <input type="text" name="NPAApp" placeholder="NPA\Domicile *" autocomplete="off" minlength="2" maxlength="40" required/>
                            <input type="tel" name="telApp" placeholder="Téléphone (+41 21 123 45 67) *" minlength="2" autocomplete="off" maxlength="20" required/>
                            <input type="tel" name="phoneApp" placeholder="Mobile (+41 79 123 45 67) *" autocomplete="off" minlength="2" maxlength="20" required/>
                            <input type="email" name="mailApp" id="mailApp" value="<?php echo $user;?>" readonly />
                            <input type="date" name="birthApp" id="birthApp" placeholder="Date de naissance" required/>
                            <section id="errorMsg"></section>
                            <input type="text" name="originApp" placeholder="Lieu d'origine *" autocomplete="off" minlength="2" maxlength="35" required/>
                            <input type="text" name="nationApp" placeholder="Nationalité *" autocomplete="off" minlength="2" maxlength="30" required/>
                            <input type="text" name="permisEtrangerApp" placeholder="Catégorie de permis pour étrangers " autocomplete="off" maxlength="1"/>
                            <input type="text" name="langApp" placeholder="Langue Maternelle *" autocomplete="off" minlength="2" maxlength="20" required/>
                            <label for="languesApp">Connaissance linguistiques*:</label>
                            <p><input type="checkbox" name="languesApp[]" value="fr" id="french"><label for="french"><span class="ui"></span>Français</label></p>
                            <p><input type="checkbox" name="languesApp[]" value="de" id="german"><label for="german"><span class="ui"></span>Allemand</label></p>
                            <p><input type="checkbox" name="languesApp[]" value="en" id="english"><label for="english"><span class="ui"></span>Anglais</label></p>
                            <p><input type="checkbox" name="languesApp[]" value="others" id="other"><label for="other"><span class="ui"></span>Autres</label></p>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">2.2</span> Réprésentants légaux</legend>    
                            <label for="maj">Avez vous plus de 18 ans?*</label><p>
                            <dl class="radio-list-left">
                                <dd>
                                    <input type="radio" name="maj" id="maj1" value="false" checked="checked">
                                    <label for="maj1">Non</label>
                                </dd>
                                <dd>
                                    <input type="radio" name="maj" id="maj2" value="true">
                                    <label for="maj2">Oui</label>
                                </dd>
                            </dl>
                            <section id="representants">
                                <p>Réprésentant 1:*</p>
                                <select name="genreRep1" id="genreRep1">
                                    <option disabled selected> Choisissez un genre</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                                <input type="text" name="nameRep1" id="nameRep1" placeholder="Nom" autocomplete="off"/>
                                <input type="text" name="surnameRep1" id="surnameRep1" placeholder="Prénom" autocomplete="off"/>
                                <input type="text" name="adrRep1" id="adrRep1" placeholder="Rue" autocomplete="off"/>
                                <input type="text" name="NPARep1" id="NPARep1" placeholder = "NPA\Domicile" autocomplete="off"/>
                                <input type="text" name="telRep1" id="telRep1" placeholder="Téléphone (+41 79 123 45 67)" autocomplete="off"/>
                                <p>Réprésentant 2:*</p>
                                <select name="genreRep2" id="genreRep2">
                                    <option disabled selected> Choisissez un genre</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                                <input type="text" name="nameRep2" id="nameRep2" placeholder="Nom" autocomplete="off"/>
                                <input type="text" name="surnameRep2" id="surnameRep2" placeholder="Prénom" autocomplete="off"/>
                                <input type="text" name="adrRep2" id="adrRep2" placeholder="Rue" autocomplete="off"/>
                                <input type="text" name="NPARep2" id="NPARep2" placeholder = "NPA\Domicile" autocomplete="off"/>
                                <input type="text" name="telRep2" id="telRep2" placeholder="Téléphone (+41 79 123 45 67)" autocomplete="off"/>
                            </section>
                        </fieldset>
                        <legend><span class="number">3</span> Activités</legend>
                        <fieldset>
                            <legend><span class="number">3.1</span> Scolarité</legend>
                            <table id="scolaire">
                                <tr>
                                    <td><input type="text" name="ecole1" placeholder="Ecole" autocomplete="off"/></td>
                                    <td><input type="text" name="lieuEcole1" placeholder="Lieu" autocomplete="off"/></td>
                                    <td><input type="text" name="niveauEcole1" placeholder="Niveau" autocomplete="off"/></td>
                                    <td><input type="text" name="anneesEcole1" placeholder="de-à (années)" autocomplete="off"/></td>  
                                </tr>
                                <tr>
                                    <td><input type="text" name="ecole2" placeholder="Ecole" autocomplete="off"/></td>
                                    <td><input type="text" name="lieuEcole2" placeholder="Lieu" autocomplete="off"/></td>
                                    <td><input type="text" name="niveauEcole2" placeholder="Niveau" autocomplete="off"/></td>
                                    <td><input type="text" name="anneesEcole2" placeholder="de-à (années)" autocomplete="off"/></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="ecole3" placeholder="Ecole" autocomplete="off"/></td>
                                    <td><input type="text" name="lieuEcole3" placeholder="Lieu" autocomplete="off"/></td>
                                    <td><input type="text" name="niveauEcole3" placeholder="Niveau" autocomplete="off"/></td>
                                    <td><input type="text" name="anneesEcole3" placeholder="de-à (années)" autocomplete="off"/></td>
                                </tr>
                            </table>
                            <input type="text" name="anneeFin" id="anneeFin" placeholder="Année de fin de scolarité" autocomplete="off" maxlength="4"/>
                            <section id="anneeFinError"></section>
                            <button type ="button" id="addSch" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3.2</span> Activités professionelles</legend>
                            <p>Formations / apprentissages aprés la scolarité.</p>
                            <table id="activites">
                                <tr>
                                    <td><input type="text" name="employeurPro1" placeholder="Employeur" autocomplete="off"/></td>
                                    <td><input type="text" name="lieuPro1" placeholder="Lieu" autocomplete="off"/></td>
                                    <td><input type="text" name="activitePro1" placeholder="Activité" autocomplete="off"/></td>
                                    <td><input type="text" name="anneesPro1" placeholder="de-à (années)" autocomplete="off"/></td>
                                </tr>
                            </table>
                            <button type ="button" id="addPro" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3.3</span> Stages</legend>
                            <table id="stages">
                                <tr>
                                    <td><input type="text" name="activiteStage1" placeholder="Métier" autocomplete="off"></td>
                                    <td><input type="text" name="entrepriseStage1" placeholder="Entreprise" autocomplete="off"></td>                
                                </tr>
                                <tr>
                                    <td><input type="text" name="activiteStage2" placeholder="Métier" autocomplete="off"></td>
                                    <td><input type="text" name="entrepriseStage2" placeholder="Entreprise" autocomplete="off"></td>
                                </tr>
                            </table>
                            <button type ="button" id="addStage" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                            <p>Avez-vous déjà été candidat à l'EPFL?</p>
                            <dl class="radio-list-left">
                                <dd>
                                    <input type="radio" name="dejaCand" id="dejaCand1" value="false" checked="checked">
                                    <label for="dejaCand1">Non</label>
                                </dd>
                                <dd>
                                    <input type="radio" name="dejaCand" id="dejaCand2" value="true">
                                    <label for="dejaCand2">Oui</label>
                                </dd>
                            </dl>
                            <input type="text" name="dejaCandAnnee" id="dejaCandAnnee" placeholder="Année de candidature*" maxlength="4" style="display: none;"/>
                            <section id="dejaCandError"></section>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">4</span> Annexes </legend>
                            <p>Merci de joindre tous les fichiers demandés, en respectant les formats (si les formats ne sont pas respectés, les fichiers ne seront pas pris en compte). Veuillez également nommer différemment chaque fichiers et éviter les espaces dans leurs noms.</p>

                            <label for="photo">Photo passeport <strong>couleur:*</strong></label>
                            <div class="tooltip">
                                <label class="file" title="" id="photoLabel">
                                    <input type="file" name="photo" id="photo" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone1"></section>
                            </div>
                            <label for="idCard">Copie carte d'indentité / passeport:*</label>
                            <div class="tooltip">
                                <label class="file" title="" id="idCardLabel">
                                    <input type="file" name="idCard" id="idCard" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone2"></section>
                            </div>
                            <label for="cv">Curriculum Vitae:*</label>
                            <div class="tooltip">
                                <label class="file" title="" id="CVLabel" >
                                    <input type="file" name="cv" id="cv" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone3"></section>
                            </div>
                            <label for="lettre">Lettre de motivation:*</label>
                            <div class="tooltip">
                                <label class="file" title="" id="lettreLabel" >
                                    <input type="file" name="lettre" id="lettre" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
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
                                        <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                        <p></p>
                                        <section id="formatErrorZone5"></section>
                                    </div>
                                </td></tr>
                            </table>
                            <button type ="button" id="addInputFile" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter un annexe
                            </button>
                            <div id="polyOnly">
                                <label for="gimch">Attestation de tests d'aptitudes GIM-CH (polymécanicien):*</label>
                                <div class="tooltip">
                                    <label class="file" title="" id="gimchLabel" >
                                        <input type="file" name="gimch" id="gimch" onchange="changeTitleFile(this)"/>
                                    </label>
                                    <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                    <p></p>
                                    <section id="formatErrorZone6"></section>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div id="condDiv">
                                <input type="checkbox" value="conditionsAcc" id="conditions" required />
                                <label for="conditions" id="condLabel"><span class="ui"></span>Accepter les <a href="conditions.php" target="_blank"> conditions*</a></label>
                                <p></p>
                            </div>
                        </fieldset>
                        <input type="submit" value="Terminer"/>
                    </div>
                </fieldset>
            </div>
        </form>
    </body>
</html>