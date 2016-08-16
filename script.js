//
//DOCUMENT READY
//

// INDEX.PHP BUTTONS ACTIONS
$(document).ready(function () {
    //Create account link
    $('#createAc').click(function () {
        window.open("https://guests.epfl.ch/", '_blank');
    });
    //Form link
    $('#connectB').click(function () {
        document.location.href = "form.php";
    });
    // ICT link
    $('#infoFilieres').click(function () {
        window.open("https://www.ict-berufsbildung.ch/fr/formation-professionnelle/formation-initiale-ict/", '_blank');
    });
    //Add line to school
    i = 1;
    $('#addSch').click(function () {
        if(i == 1){
        document.getElementById('scolaire').innerHTML += '<tr><td><input type="text" name="ecole4" placeholder="Ecole" autocomplete="off"/></td><td><input type="text" name="lieuEcole4" placeholder="Lieu" autocomplete="off"/></td> <td><input type="text" name="niveauEcole4" placeholder="Niveau" autocomplete="off"/></td><td><input type="text" name="anneesEcole4" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
        }
        i++;
        if (i == 3) {
            document.getElementById('scolaire').innerHTML += '<tr><td><input type="text" name="ecole5" placeholder="Ecole" autocomplete="off"/></td><td><input type="text" name="lieuEcole5" placeholder="Lieu" autocomplete="off"/></td> <td><input type="text" name="niveauEcole5" placeholder="Niveau" autocomplete="off"/></td><td><input type="text" name="anneesEcole5" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
            $('#addSch').hide(750);
        }
    });
    //Add line to professionnel
    y = 1;
    $('#addPro').click(function () {
        if(y == 1){
        document.getElementById('activites').innerHTML += '<tr><td><input type="text" name="employeurPro2" placeholder="Employeur" autocomplete="off"/></td><td><input type="text" name="lieuPro2" placeholder="Lieu" autocomplete="off"/></td><td><input type="text" name="activitePro2" placeholder="Activité" autocomplete="off"/></td><td><input type="text" name="anneesPro2" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
        }
        y++;
        if (y == 3) {
            document.getElementById('activites').innerHTML += '<tr><td><input type="text" name="employeurPro3" placeholder="Employeur" autocomplete="off"/></td><td><input type="text" name="lieuPro3" placeholder="Lieu" autocomplete="off"/></td><td><input type="text" name="activitePro3" placeholder="Activité" autocomplete="off"/></td><td><input type="text" name="anneesPro3" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
            $('#addPro').hide(750);
        }
    });

});

// SHOW/HIDE CONTENT ACCORDING TO SELECTED JOB
$(document).ready(function () {
    $("#all").hide()

    $("#jb").change(function () {
        var sele = $("#jb option:selected").text();

        if ((sele == "Polymécanicien-ne CFC") || (sele == "Informaticien-ne CFC") || (sele == "Logisticien-ne CFC") || (sele == "Planificateur-trice éléctricien-ne CFC") || (sele == "Employé-e de commerce CFC") || (sele == "Gardien-ne d'animaux CFC")) {
            $("#all").show(1000)
            $("#infoOnly").hide(0)
            $("#polyOnly").hide(0)

            if (sele == "Informaticien-ne CFC") {
                $("#infoOnly").show(1000)
            }
            if (sele == "Polymécanicien-ne CFC") {
                $("#polyOnly").show(1000)
            }
        } else if ((sele == "Laborantin-e CFC; option biologie") || (sele == "Laborantin-e CFC; option chimie") || (sele == "Laborantin-e en physique CFC")) {
            $("#all").hide(1000)

            if (confirm("Pour les métiers de laborantins, l'inscription se fait au près de ASSOCIATION, cliquer sur ok pour être rediriger...")) {
                window.location.replace("http://apprentis.epfl.ch");
            } else { }
        }
    });

    // CHECK FILE FORMATS
    //WORKING
    $("#photo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        var input = $("#photo");
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $("#formatErrorZone1").html('<p class ="errorMsgs">Format invalide');
        }
    });
    //WORKING
    $("#idCard").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        var input = $("#idCard");
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $("#formatErrorZone2").html('<p class ="errorMsgs">Format invalide');
        }
    });

    $("#cv").change(function () {
        var fileExtension = ['pdf'];
        var input = $("#cv");
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $("formatErrorZone3").html('<p class ="errorMsgs">Format invalide');
            alert("Format non pris en charge, Formats autorisés : " + fileExtension.join(', '));
        }
    });

    $("#lettre").change(function () {
        var fileExtension = ['pdf'];
        var input = $("#lettre");
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $("formatErrorZone4").html('<p class ="errorMsgs">Format invalide');
            alert("Format non pris en charge, Formats autorisés : " + fileExtension.join(', '));
        }
    });
});

//
//CHANGE EVENTS
//
$(document).ready(function () {
    // SHOW/HIDE ACCORDING TO RADIOBUTTON
    $("#maj1").change(function () {
        $("#representants").show(1000);
    });
    $("#maj2").change(function () {
        $("#representants").hide(1000);
    });

    // CHECK DATE INPUT
    $("#birthApp").change(function () {
        userDate = new Date(document.getElementById("birthApp").value);
        now = new Date();
        birthDate = userDate.getTime();
        currentDate = now.getTime();
        currentDays = currentDate / 24 / 60 / 60 / 1000;
        userDays = birthDate / 24 / 60 / 60 / 1000;
        currentDays = Math.floor(currentDays);
        userDays = Math.floor(userDays);
        douzeAns = Math.floor(currentDays - 4383);

        if (currentDays <= userDays) {
            document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide';

        } else if (userDays > douzeAns) {
            document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide, trop jeune';
        }
        else {
            document.getElementById('errorMsg').innerHTML = '';
        }
    });

});
function mOver(obj, zone) {
    $(zone).html("Formats autorisés: ");
}
function mOut(obj, zone) {
    $(zone).html("");
}
