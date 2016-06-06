<!doctype html>
<html lang="fr">
    <head>  
         <meta charset="UTF-8"/>
         <link rel="stylesheet" type="text/css" href="style.css">
         <link rel="icon" type="image/png" href="img/favicon.png" />
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
         <script>
             
                $(document).ready(function(){
                    $("#fi").hide();
                    $("#fi1").hide();
                    $("#fi2").hide();
                    $("#fi3").hide();
                    $("#fi4").hide();
                    $("#fi5").hide();
                    $("#fin").hide();
                    
                        $("#job").change(function() {
                        if($("#job option:selected").text()=="Laborantin-e CFC; option biologie"){
                            $("#fi").show(1000);
                            $("#fi1").show(1000);
                            $("#fi2").show(1000);
                            $("#fi3").show(1000);
                            $("#fi4").show(1000);
                            $("#fi5").show(1000);
                            $("#fin").show(1000);
                        }
                });
                });
            </script>   
         <title>Formulaire Apprentissage</title>
    </head>
    <body>
    <div class="form-style-5" >
        <form method ="post" action="cible.php" enctype="multipart/form-data">
            
        <fieldset id="photoTitle">
            <img src="./img/FA.png"/ alt="FA" width="300" height="150" id="FAPic" draggable="false"/>
            <img src="./img/epfl.png"/ alt="EPFL" width="300" height="150" id="epflPic" draggable="false"/>
            <p><h2>Candidature pour un Apprentissage</h2>
            Les champs notés d'un astérisque* doivent être obligatoirement remplis.<p>
        </fieldset> 
         
        <fieldset>  
            <!-- DONNEES APPRENTISSAGE-->
            <legend><span class="number">1</span> Apprentissage</legend>
            
            
            <label for="job">Je suis intéressé par le métier de*: </label>
            <select id ="job"" required>
                <option value="menu" selected disabled>Choisir un métier...</option>
                <option value="laboBio">Laborantin-e CFC; option biologie</option> <!-- Laborantin-e CFC; option biologie -->
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
           <fieldset id="fi">
            <label for="mpt">Je désire m'inscire en maturité professionelle intégrée*:</label><p>
            <input type="radio" name="mpt" value="MPT-oui" />Oui
            <input type="radio" name="mpt" value="MPT-non" />Non
            <p>
          </fieldset>
          
          <fieldset id="fi1">
            
            <legend><span class="number">2</span> Données </legend>
            <fieldset>
            <legend><span class="number">2.1</span> Données personnelles</legend>    
                
               <!-- DONNEES APPRENTIS-->
               PHOTO* <!-- ajouter un cadre + upload--><p>
            <select name="genreApp" >
                <option disabled selected > Choisissez un genre*</option>
                <option value="Homme" >Homme</option>
                <option value="Femme" >Femme</option>
            </select>
            
            <input type="text" name="nameApp" placeholder="Nom *" autocomplete="off" required/>
            <input type="text" name="surnameApp" placeholder="Prénom *" autocomplete="off" required/>
            <input type="text" name="adrApp" placeholder="Adresse *" autocomplete="off" />
            <input type="text" name="NPAApp" placeholder="NPA\Domicile *" autocomplete="off" />
            <input type="text" name="telApp" placeholder="Téléphone *" autocomplete="off" />
            <input type="text" name="phoneApp" placeholder="Mobile *" autocomplete="off" />
            <input type="email" name="mailApp" placeholder = "Mail *"autocomplete="off" /> 
            <input type="date" name="birthApp" max="today" />
            <input type="text" name="originApp" placeholder="Lieu d'origine *" autocomplete="off" />
            <input type="text" name="nationApp" placeholder="Nationalité *" autocomplete="off" />
            <input type="text" name="langApp" placeholder="Langue Maternelle *" autocomplete="off" />
            
            <label for="languesApp">Connaissance linguistiques*:</label>
            <input type="checkbox" name="languesApp" value="Français" > Français<p>
            <input type="checkbox" name="languesApp" value="Allemand" >Allemand<p> <!-- check this-->
            <input type="checkbox" name="languesApp" value="Anglais" >Anglais<p>
            <input type="checkbox" name="languesApp" value="Autres" >Autres<p>
        </fieldset>
        <fieldset id="fi2">
            <legend><span class="number">2.2</span> Réprésentants légaux</legend>    
             (Si vous avez moins de 18 ans.)<p>
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
         <!-- ACIVITES-->
        <legend><span class="number">3</span> Activités</legend>
        <fieldset id="fi3">
            <legend><span class="number">3.1</span> Scolarité</legend>
                <table id="scolaire">
                    <tr>
                        <td><input type="text" name="ecole1" placeholder="Ecole" autocomplete="off"/></td>
                        <td><input type="text" name="lieu1" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="niveau1" placeholder="Niveau" autocomplete="off"/></td>
                        <td><input type="text" name="annees1" placeholder="de-à(années)" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="ecole2" placeholder="Ecole" autocomplete="off"/></td>
                        <td><input type="text" name="lieu2" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="niveau2" placeholder="Niveau" autocomplete="off"/></td>
                        <td><input type="text" name="annees2" placeholder="de-à(années)" autocomplete="off"/></td>
                    </tr>
                     <tr>
                        <td><input type="text" name="ecole3" placeholder="Ecole" autocomplete="off"/></td>
                        <td><input type="text" name="lieu3" placeholder="Lieu" autocomplete="off"/></td>
                        <td><input type="text" name="niveau3" placeholder="Niveau" autocomplete="off"/></td>
                        <td><input type="text" name="annees3" placeholder="de-à(années)" autocomplete="off"/></td>
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
                </table>
        </fieldset>
        <fieldset id ="fi4">
            <legend><span class="number">3.3</span> Stages</legend>
            test test test test test
        </fieldset>
        <!-- ANNEXES-->
        <fieldset id="fi5">
        </fieldset>
        <legend><span class="number">4</span> Annexes à fournir</legend>
    
             <label for="fichier">CV (PDF | max. 1 Mo) :</label>
                <input type="file" name="fichier" id="fichier" required/><p>
                                  
        </fieldset> 
        <fieldset id="fin">  
            <input type="checkbox" value="conditionsAcc" id="conditions"/>Accepter les <a href="conditions.php">conditions</a><p>
            <input type="submit" value="Terminer">
        </fieldset>
        </form>
    </div>
   </body>

</html>