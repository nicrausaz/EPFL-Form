<!doctype html>
<html lang="fr">
    <head> 
    <?php include('templates/head.php');
            ini_set("display_errors",0);error_reporting(0);
             /////////////////
            //TEQUILA LOGON//
           /////////////////
            require_once("tequila/tequila.php");
            $oClient = new TequilaClient();
            $oClient->SetApplicationName('Formulaire apprentissage');
            $oClient->SetWantedAttributes(array('uniqueId','firstname','name'));
            $oClient->SetWishedAttributes(array('user'));
            $oClient->SetAllowsFilter('categorie=epfl-guests');
            $oClient->Authenticate();
            $user = $oClient->getValue('user');
            $firstname= $oClient->getValue('firstname');
            $name= $oClient->getValue('name');
            $sKey = $oClient->GetKey();
            ?>
         <!--<script src="myscripts.js"></script>-->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
         <script>
             $(document).ready(function(){ 
                $("#all").hide()
                
                    $("#jb").change(function(){
                      var sele = $("#jb option:selected").text();
                      
                        if((sele=="Polymécanicien-ne CFC")||(sele=="Informaticien-ne CFC")||(sele=="Logisticien-ne CFC")||(sele=="Planificateur-trice éléctricien-ne CFC")||(sele=="Employé-e de commerce CFC")||(sele=="Gardien-ne d'animaux CFC")){
                            $("#all").show(1000)
                            $("#infoOnly").hide(0)
                            $("#polyOnly").hide(0)
                            
                            if(sele=="Informaticien-ne CFC"){
                                $("#infoOnly").show(1000)
                            }
                            if(sele=="Polymécanicien-ne CFC"){
                                $("#polyOnly").show(1000)
                            }

                        }else if((sele=="Laborantin-e CFC; option biologie")||(sele=="Laborantin-e CFC; option chimie")||(sele=="Laborantin-e en physique CFC")){
                            $("#all").hide(1000)

                            if(confirm("Pour les métiers de laborantins, l'inscription se fait au près de ASSOCIATION, cliquer sur ok pour être rediriger...")){
                                window.location.replace("http://apprentis.epfl.ch");
                            }else{}
                        }
                        });

                       $("#photo").change(function(){
                        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                        var input = $("#photo");
                        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            alert("Format non pris en charge, Formats autorisés : "+fileExtension.join(', '));
                            }
                        });
                        
                        $("#cv").change(function() {
                        var fileExtension = ['pdf'];
                        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            alert("Format non pris en charge, Formats autorisés : "+fileExtension.join(', '));
                            }
                        });

                        $("#lettre").change(function() {
                        var fileExtension = ['pdf'];
                        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            alert("Format non pris en charge, Formats autorisés : "+fileExtension.join(', '));
                            }
                        });
                        });
            </script>

         <title>Formulaire Apprentissage</title>
         <meta name="description" content="Formulaire candidature apprentissage EPFL"/>
    </head>
    <body>
        <div class="form-style-5">
        <?php include('templates/header.php') ?>
           <p class="paracenter">Les champs notés d'un astérisque* doivent être obligatoirement remplis.
        </fieldset>
        <form method ="post" action="cible.php" enctype="multipart/form-data">
        <fieldset>  
            <!-- DONNEES APPRENTISSAGE-->
            <legend><span class="number">1</span> Apprentissage</legend>
            
            <label for="job">Je suis intéressé par le métier de*: </label>
            <select name ="job" id="jb" required>
                <option value="menu" selected disabled>Choisir un métier...</option>
                <option value="laboBio">Laborantin-e CFC; option biologie</option>
                <option value="laboCh">Laborantin-e CFC; option chimie</option>
                <option value="laboPhy">Laborantin-e en physique CFC</option>
                <option value="polyM">Polymécanicien-ne CFC</option>
                <option value="info">Informaticien-ne CFC</option>
                <option value="logi">Logisticien-ne CFC</option>
                <option value="planElec">Planificateur-trice éléctricien-ne CFC</option>
                <option value="empCom">Employé-e de commerce CFC</option>
                <option value="gardAn">Gardien-ne d'animaux CFC</option>
            </select>
           </fieldset>

           <div id="all">
           <fieldset>
           <div id="infoOnly">
              <?php include('templates/filieresinfos.php') ?>
            </div>

            <label for="mpt">Je désire m'inscire en maturité professionelle intégrée*:</label><p>
            <dl class="radio-list-left">
            <dd>
                <input type="radio" name="mpt" id="mpt1" value="Matu-non" checked="checked">
                <label for="mpt1">Non</label>
            </dd>
            <dd>
                <input type="radio" name="mpt" id="mpt2" value="Matu-oui">
                <label for="mpt2">Oui</label>
            </dd>
            </dl>
            <div>
            <p>
          </fieldset>
          <fieldset>

            <legend><span class="number">2</span> Données </legend>
            <fieldset>
            <legend><span class="number">2.1</span> Données personnelles</legend>    
                
               <!-- DONNEES APPRENTIS-->
               
            <select name="genreApp" id="genreApp">
                <option disabled selected> Choisissez un genre*</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
            
            <input type="text" name="nameApp" placeholder="Nom *" value="<?php echo $name; ?>" readonly />
            <input type="text" name="surnameApp" placeholder="Prénom *" value="<?php echo $firstname; ?>" readonly />
            <input type="text" name="adrApp" placeholder="Adresse *" autocomplete="off" minlength="2" maxlength="40" required/>
            <input type="text" name="NPAApp" placeholder="NPA\Domicile *" autocomplete="off" minlength="2" maxlength="40" required/>
            <input type="tel" name="telApp" placeholder="Téléphone (+41 21 123 45 67) *" minlength="2" autocomplete="off" maxlength="20" required/>
            <input type="tel" name="phoneApp" placeholder="Mobile (+41 79 123 45 67) *" autocomplete="off" minlength="2" maxlength="20" required/>
            <input type="email" name="mailApp" id="mailApp" value="<?php echo $user; ?>" readonly />
            <input type="date" name="birthApp" id="birthApp" required/>
            <section id="errorMsg"></section>
            <input type="text" name="originApp" placeholder="Lieu d'origine *" autocomplete="off" minlength="2" maxlength="30" required/>
            <input type="text" name="nationApp" placeholder="Nationalité *" autocomplete="off" minlength="2" maxlength="30" required/>
            <input type="text" name="langApp" placeholder="Langue Maternelle *" autocomplete="off" minlength="2" maxlength="20" required/>
            
            <label for="languesApp">Connaissance linguistiques*:</label>
            <p><input type="checkbox" name="check_list[]" id="french" value="Français" /><label for="french"><span class="ui"></span>Français</label></p>
            <p><input type="checkbox" name="check_list[]" id="german" value="Allemand"/><label for="german"><span class="ui"></span>Allemand</label></p>
            <p><input type="checkbox" name="check_list[]" id="english" value="Anglais"/><label for="english"><span class="ui"></span>Anglais</label></p>
            <p><input type="checkbox" name="check_list[]" id="other" value="Autres"/><label for="other"><span class="ui"></span>Autres</label></p>

        </fieldset>
        <fieldset>
            <legend><span class="number">2.2</span> Réprésentants légaux</legend>    
             <label for="maj">Avez vous plus de 18 ans?</label><p>
            <dl class="radio-list-left">
            <dd>
                <input type="radio" name="maj" id="maj1" value="maj-non" checked="checked">
                <label for="maj1">Non</label>
            </dd>
            <dd>
                <input type="radio" name="maj" id="maj2" value="maj-oui">
                <label for="maj2">Oui</label>
            </dd>
            </dl>
            <section id="representants">
                <!-- DONNEES REPRESENTANT 1-->
              Réprésentant 1:<p>
            <select name="genreRep1" >
                <option disabled selected> Choisissez un genre</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>

            <input type="text" name="nameRep1" placeholder="Nom" autocomplete="off"/>
            <input type="text" name="surnameRep1" placeholder="Prénom" autocomplete="off"/>
             <input type="text" name="adrRep1" placeholder="Adresse" autocomplete="off"/>
            <input type="text" name="NPARep1" placeholder = "NPA\Domicile"autocomplete="off"/>
            <input type="text" name="telRep1" placeholder="Téléphone" autocomplete="off"/>
            
             Réprésentant 2:<p>
                <!-- DONNEES REPRESENTANT 2-->
            <select name="genreRep2" >
                <option disabled selected> Choisissez un genre</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
            
            <input type="text" name="nameRep2" placeholder="Nom" autocomplete="off"/>
            <input type="text" name="surnameRep2" placeholder="Prénom" autocomplete="off"/>
             <input type="text" name="adrRep2" placeholder="Adresse" autocomplete="off"/>
            <input type="text" name="NPARep2" placeholder = "NPA\Domicile"autocomplete="off"/>
            <input type="text" name="telRep2" placeholder="Téléphone" autocomplete="off"/>   
        </fieldset>
        </section>
         <!-- ACIVITES-->
        <legend><span class="number">3</span> Activités</legend>
        <fieldset>
            <legend><span class="number">3.1</span> Scolarité</legend>
                <input type="text" name="anneeFin" placeholder="Année de fin de scolarité*" autocomplete="off"/>
                <table id="scolaire">
                    <tr>
                        <td><input type="text" name="ecole1" placeholder="Ecole" autocomplete="off"/></td>
                        <td><input type="text" name="lieu1" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="niveau1" placeholder="Niveau" autocomplete="off"/></td>
                        <td><input type="text" name="annees1" placeholder="de-à(années)" autocomplete="off"/></td>  
                    </tr>
                    <section id="test">
                    </section>
                    <!--
                    <tr id="lSch1">
                        <td><input type="text" name="ecole2" placeholder="Ecole" autocomplete="off"/></td>
                        <td><input type="text" name="lieu2" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="niveau2" placeholder="Niveau" autocomplete="off"/></td>
                        <td><input type="text" name="annees2" placeholder="de-à(années)" autocomplete="off"/></td>
                    </tr>
                     <tr id="lSch2">
                        <td><input type="text" name="ecole3" placeholder="Ecole" autocomplete="off"/></td>
                        <td><input type="text" name="lieu3" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="niveau3" placeholder="Niveau" autocomplete="off"/></td>
                        <td><input type="text" name="annees3" placeholder="de-à(années)" autocomplete="off"/></td>
                    </tr>-->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="button" id="addSch" value="Ajouter une ligne"/></td>
                    </tr>
                </table>
                 
                
        </fieldset>
        <fieldset>
            <legend><span class="number">3.2</span> Activités professionelles</legend>
            <table id="activites">
                    <tr>
                        <td><input type="text" name="employeur1" placeholder="Employeur" autocomplete="off"/></td>
                        <td><input type="text" name="lieu4" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="activite1" placeholder="Activité" autocomplete="off"/></td>
                        <td><input type="text" name="annees4" placeholder="de-à(années)" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="employeur2" placeholder="Employeur" autocomplete="off"/></td>
                        <td><input type="text" name="lieu5" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="activite1" placeholder="Activité" autocomplete="off"/></td>
                        <td><input type="text" name="annees5" placeholder="de-à(années)" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="button" id="addPro" value="Ajouter une ligne" class="indexB"/></td>
                    </tr>
                </table>

        </fieldset>
        <fieldset>
            <legend><span class="number">3.3</span> Stages</legend>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                
            </tr>
            <tr>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>  
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <!--<td><input type="button" id="addStage" value="Ajouter une ligne" class="indexB"/></td>-->
        </fieldset>
        <!-- ANNEXES-->
        <fieldset>
        </fieldset>
        <legend><span class="number">4</span> Annexes à fournir</legend>
        Merci de joindre tous les fichiers demandés, en respectant les formats. Veuillez également nommer différemment les fichiers et éviter les espaces dans leurs noms.<p>

        <label for="photo">Photo passeport <strong>couleur:</strong></label> 
        <label class="file" title=""><input type="file" name="photo" id="photo" onchange="changeInFileTitle()" /></label>

        <label for="idCard">Copie carte d'indentité:</label>
        <label class="file" title=""><input type="file" name="idCard" id="idCard" onchange="changeInFileTitle()" /></label>

        <label for="CV">Curriculum Vitae:</label>
        <label class="file" title=""><input type="file" name="cv" id="cv" onchange="this.parentNode.setAttribute('title', this.value.replace(/^.*[\\/]/, ''))" /></label>
                
        <label for="lettre">Lettre de motivation:</label>
        <label class="file" title=""><input type="file" name="lettre" id="lettre" onchange="this.parentNode.setAttribute('title', this.value.replace(/^.*[\\/]/, ''))" /></label>

        <!-- BULLETINS NOTES --> <!--TOGET-->

        <!-- CERTIFICATS --><!--TOGET-->

        <div id="polyOnly">
        <label for="gimch">Attestation de tests d'aptitudes GIM-CH (polymécanicien):</label><!--TOGET-->
        <label class="file" title=""><input type="file" name="gimch" id="gimch" onchange="this.parentNode.setAttribute('title', this.value.replace(/^.*[\\/]/, ''))" /></label>
        </div> 
        </fieldset> 
        <fieldset>  
        <p><input type="checkbox" value="conditionsAcc" id="conditions" required/><label for="conditions"><span class="ui"></span>Accepter les <a href="conditions.php"> conditions</label></p>

        <input type="submit" value="Terminer">
        </fieldset>
        </div>
        </form>
        </div>
    </body>
    <script>
    //
    $("#maj1").change(function(){
        $("#representants").show(1000);
    });
    $("#maj2").change(function(){
        $("#representants").hide(1000);
    });
    //
    //
     $("#birthApp").change(function(){
        userDate = new Date(document.getElementById("birthApp").value);
        now = new Date();
        birthDate = userDate.getTime();
        currentDate = now.getTime();
        currentDays = currentDate/24/60/60/1000;
        userDays = birthDate/24/60/60/1000;
        currentDays = Math.floor(currentDays);
        userDays = Math.floor(userDays);
        douzeAns = Math.floor(currentDays - 4383);

        if(currentDays <= userDays){
            document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide';

        }else if(userDays>douzeAns) {
            document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide, trop jeune';
        }
        else{
            document.getElementById('errorMsg').innerHTML = '';
        }
        });
    //
    //
    $('#addSch').click(function(){
        var div = $('<div>Yolo</div>');
        div.appendTo('#test');
    });
    //
    //
    /*function changeInFileTitle(){
        this.setAttribute('title', this.value.replace(/^.*[\\/]/, '')) //not working for now in a function
    }*/
    /*function getTodayDate(){

    }*/
       /* function addLpro(){
            //ajouter une ligne par clic
        }*/
    </script>
</html>