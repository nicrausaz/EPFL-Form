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
    $('#addSch').click(function () {
        var i = $('#scolaire > tbody').children().size() + 1;
        console.log(i);
        if (i < 6) {
            $('#scolaire').append('<tr><td><input type="text" name="ecole' + i + '" placeholder="Ecole" autocomplete="off"/></td><td><input type="text" name="lieuEcole' + i + '" placeholder="Lieu" autocomplete="off"/></td> <td><input type="text" name="niveauEcole' + i + '" placeholder="Niveau" autocomplete="off"/></td><td><input type="text" name="anneesEcole' + i + '" placeholder="de-à(années)" autocomplete="off"/></td></tr>');
            if (i == 5) {
                $('#addSch').hide(750);
            }
        }
    });
    //Add line to professionnel
    $('#addPro').click(function () {
        var y = $('#activites > tbody').children().size() + 1;
        console.log(y);
        if (y < 4) {
            $('#activites').append('<tr><td><input type="text" name="employeurPro' + y + '" placeholder="Employeur" autocomplete="off"/></td><td><input type="text" name="lieuPro' + y + '" placeholder="Lieu" autocomplete="off"/></td><td><input type="text" name="activitePro' + y + '" placeholder="Activité" autocomplete="off"/></td><td><input type="text" name="anneesPro' + y + '" placeholder="de-à(années)" autocomplete="off"/></td></tr>');
            if (y == 3) {
                $('#addPro').hide(750);
            }
        }
    });
    //Add line to stages
    $('#addStage').click(function () {
        var x = $('#stages > tbody').children().size() + 1;
        console.log(x);
        if (x < 6) {
            $('#stages').append('<tr><td><input type="text" name="activiteStage' + x + '" placeholder="Métier" autocomplete="off"></td><td><input type="text" name="entrepriseStage' + x + '" placeholder="Entreprise" autocomplete="off"></td></tr>');
            if (x == 4) {
                $('#addStage').hide(750);
            }
        }
    });
    $('#addInputFile').click(function () {
        var z = $('#newCertifZone > tbody').children().size() + 1;
        console.log(z);
        if (z < 6) {
            $('#newCertifZone').append(/*'<label class="file" title="" onmouseover="mOver(this,formatZone'+ z +', jpg-)" onmouseout="mOut(this,formatZone5)"><input type="file" name="dossierFiles" id="dossierFiles" onchange="changeTitleFile(this)" /></label>'*/);
            if (z == 4) {
                $('#addInputFile').hide(750);
            }
        }
    });
    //class = "newInputFile"
    // SHOW/HIDE CONTENT ACCORDING TO SELECTED JOB
    $("#jb").change(function () {
        var selectedFormation = $("#jb option:selected")[0].value;
        var sele = $("#jb option:selected").text();
        var infoPeople = ["info"];
        var polyPeople = ["polyM"];
        var laborantPeople = ["laboCh", "laboPhy", "laboBio"];
        var globalPeople = ["polyM", "info", "logi", "planElec", "empCom", "gardAn"];

        if (globalPeople.indexOf(selectedFormation) != -1) {
            $("#all").show(1000)
            $("#infoOnly").hide(0)
            $("#polyOnly").hide(0)
            $("#dejaCandAnnee").hide(0);

            if (infoPeople.indexOf(selectedFormation) != -1) {
                $("#infoOnly").show(1000)
            }
            if (polyPeople.indexOf(selectedFormation) != -1) {
                $("#polyOnly").show(1000)
            }
        } else if (laborantPeople.indexOf(selectedFormation) != -1) {
            $("#all").hide(1000)

            if (confirm("Pour les métiers de laborantins, l'inscription se fait au près de ASSOCIATION, cliquer sur ok pour être rediriger...")) {
                window.location.replace("http://apprentis.epfl.ch");
            } else { }
        }
    });

    // CHECK FILE FORMATS
    $("#photo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'pdf', 'png'];
        if (fileExtension.indexOf($("#photo").val().split('.').pop().toLowerCase()) == -1) {
            $("#formatErrorZone1").html('<p class ="errorMsgs">Format invalide</p>');
        } else {
            $("#formatErrorZone1").html('');
        }
    });
    $("#idCard").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'pdf', 'png'];
        if (fileExtension.indexOf($("#idCard").val().split('.').pop().toLowerCase()) == -1) {
            $("#formatErrorZone2").html('<p class ="errorMsgs">Format invalide</p>');
        } else {
            $("#formatErrorZone2").html('');
        }
    });
    $("#cv").change(function () {
        var fileExtension = ['pdf'];
        if (fileExtension.indexOf($("#cv").val().split('.').pop().toLowerCase()) == -1) {
            $("#formatErrorZone3").html('<p class ="errorMsgs">Format invalide</p>');
        } else {
            $("#formatErrorZone3").html('');
        }
    });
    $("#lettre").change(function () {
        var fileExtension = ['pdf'];
        var input = $("#lettre");
        if (fileExtension.indexOf($("#lettre").val().split('.').pop().toLowerCase()) == -1) {
            $("#formatErrorZone4").html('<p class ="errorMsgs">Format invalide</p');
        } else {
            $("#formatErrorZone4").html('');
        }
    });
    // SHOW/HIDE ACCORDING TO RADIOBUTTON
    $("#maj1").change(function () {
        $("#representants").show(1000);
    });
    $("#maj2").change(function () {
        $("#representants").hide(1000);
    });

    $("#dejaCand1").change(function () {
        $("#dejaCandAnnee").hide(750);
        $("#dejaCandAnnee").val("");
        $("#dejaCandError").html("");
    });
    $("#dejaCand2").change(function () {
        $("#dejaCandAnnee").show(750);
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
    $("#dejaCandAnnee").change(function () {
        var currentYear = (new Date).getFullYear();
        if (currentYear < $("#dejaCandAnnee").val()) {
            $("#dejaCandError").html('<p class ="errorMsgs">Date invalide');
        } else {
            $("#dejaCandError").html("");
        }
    });
    $("#anneeFin").change(function () {
        var currentYear = (new Date).getFullYear();
        if (currentYear < $("#anneeFin").val()) {
            $("#anneeFinError").html('<p class ="errorMsgs">Date invalide');
        } else {
            $("#anneeFinError").html("");
        }
    });

});

function mOver(obj, zone, formats) {
    $(zone).html("Formats autorisés: " + formats);
}
function mOut(obj, zone) {
    $(zone).html("");
}
function changeTitleFile(objFile) {
    objFile.parentNode.setAttribute('title', objFile.value.replace(/^.*[\\/]/, ''));
}
