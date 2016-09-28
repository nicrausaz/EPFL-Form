$(document).ready(function () {


    $('#createAc').click(function () {
        window.open("https://guests.epfl.ch/", '_blank');
    });

    $('#connectB').click(function () {
        document.location.href = "form.php";
    });

    $('#infoFilieres').click(function () {
        window.open("https://www.ict-berufsbildung.ch/fr/formation-professionnelle/formation-initiale-ict/", '_blank');
    });
    $('#retourHome').click(function () {
        document.location.href = "http://apprentis.epfl.ch/";
    });

    $('#addSch').click(function () {
        var i = $('#scolaire > tbody').children().size() + 1;
        if (i < 6) {
            $('#scolaire').append('<tr><td><input type="text" name="ecole' + i + '" placeholder="Ecole" autocomplete="off"/></td><td><input type="text" name="lieuEcole' + i + '" placeholder="Lieu" autocomplete="off"/></td> <td><input type="text" name="niveauEcole' + i + '" placeholder="Niveau" autocomplete="off"/></td><td><input type="text" name="anneesEcole' + i + '" placeholder="de-à(années)" autocomplete="off"/></td></tr>');
            if (i == 5) {
                $('#addSch').hide(750);
            }
        }
    });

    $('#addPro').click(function () {
        var y = $('#activites > tbody').children().size() + 1;
        if (y < 4) {
            $('#activites').append('<tr><td><input type="text" name="employeurPro' + y + '" placeholder="Employeur" autocomplete="off"/></td><td><input type="text" name="lieuPro' + y + '" placeholder="Lieu" autocomplete="off"/></td><td><input type="text" name="activitePro' + y + '" placeholder="Activité" autocomplete="off"/></td><td><input type="text" name="anneesPro' + y + '" placeholder="de-à(années)" autocomplete="off"/></td></tr>');
            if (y == 3) {
                $('#addPro').hide(750);
            }
        }
    });

    $('#addStage').click(function () {
        var x = $('#stages > tbody').children().size() + 1;
        if (x < 6) {
            $('#stages').append('<tr><td><input type="text" name="activiteStage' + x + '" placeholder="Métier" autocomplete="off"></td><td><input type="text" name="entrepriseStage' + x + '" placeholder="Entreprise" autocomplete="off"></td></tr>');
            if (x == 4) {
                $('#addStage').hide(750);
            }
        }
    });
    $('#addInputFile').click(function () {
        var z = $('#newCertifZone > tbody').children().size() + 2;
        var zoneId = z + 5;
        $("*").off();
        $.getScript("script.js");
        if (z < 10) {
            $('#newCertifZone').append('<tr><td><label class="file" title="" id="certifLabel' + z + '"><input type="file" name="certifs' + z + '" id="certifs' + z + '" onchange="changeTitleFile(this)" /></label><div class="mdl-tooltip mdl-tooltip--large" for= "certifLabel' + z + '">Formats autorisés: pdf-jpg-jpeg-png </div><p></p><section id="formatErrorZone' + zoneId + '"></section></td></tr>');
            componentHandler.upgradeDom();
            if (z == 9) {
                $('#addInputFile').hide(750);
            }
        }
    });

    $("#jb").change(function () {
        var selectedFormation = $("#jb option:selected")[0].value;
        var infoPeople = ["informaticien"];
        var polyPeople = ["polyMecanicien"];
        var laborantPeople = ["laborantinChimie", "laborantinPhysique", "laborantinBiologie"];
        var globalPeople = ["polyMecanicien", "informaticien", "logisticien", "planificateurElectricien", "employeCommerce", "gardienAnimaux", "interactiveMediaDesigner", "electronicien"];

        if (globalPeople.indexOf(selectedFormation) != -1) {
            $("#all").show(1000);
            $("#infoOnly").hide(0);
            $("#polyOnly").hide(0);
            $("#dejaCandAnnee").hide(0);

            if (infoPeople.indexOf(selectedFormation) != -1) {
                $("#infoOnly").show(1000);
            }
            if (polyPeople.indexOf(selectedFormation) != -1) {
                $("#polyOnly").show(1000);
            }
        } else if (laborantPeople.indexOf(selectedFormation) != -1) {
            $("#all").hide(1000);

            if (confirm("Pour les métiers de laborantins, l'inscription se fait auprès de l'AVML, cliquer sur ok pour être redirigé-e.")) {
                window.location.replace("https://wp.unil.ch/avml/");
            } else { }
        }
    });

    $("#photo").change(function () {
        showFormatErrorMsg("#photo", "#formatErrorZone1");
    });
    $("#idCard").change(function () {
        showFormatErrorMsg("#idCard", "#formatErrorZone2");
    });
    $("#cv").change(function () {
        showFormatErrorMsg("#cv", "#formatErrorZone3");
    });
    $("#lettre").change(function () {
        showFormatErrorMsg("#lettre", "#formatErrorZone4");
    });
    $("#gimch").change(function () {
        showFormatErrorMsg("#gimch", "#formatErrorZone6");
    });
    $("#certifs1").change(function () {
        showFormatErrorMsg("#certifs1", "#formatErrorZone5");
    });
    $("#certifs2").change(function () {
        showFormatErrorMsg("#certifs2", "#formatErrorZone7");
    });
    $("#certifs3").change(function () {
        showFormatErrorMsg("#certifs3", "#formatErrorZone8");
    });
    $("#certifs4").change(function () {
        showFormatErrorMsg("#certifs4", "#formatErrorZone9");
    });
    $("#certifs5").change(function () {
        showFormatErrorMsg("#certifs5", "#formatErrorZone10");
    });
    $("#certifs6").change(function () {
        showFormatErrorMsg("#certifs6", "#formatErrorZone11");
    });
    $("#certifs7").change(function () {
        showFormatErrorMsg("#certifs7", "#formatErrorZone12");
    });
    $("#certifs8").change(function () {
        showFormatErrorMsg("#certifs8", "#formatErrorZone13");
    });
    $("#certifs9").change(function () {
        showFormatErrorMsg("#certifs9", "#formatErrorZone14");
    });

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
function showFormatErrorMsg(inputFile, formatErrorZoneId) {
    var fileExtension = ['pdf','jpg','jpeg','png'];
    if (fileExtension.indexOf($(inputFile).val().split('.').pop().toLowerCase()) == -1) {
        $(formatErrorZoneId).html('<p class ="errorMsgs">Format invalide</p>');
    } else {
        $(formatErrorZoneId).html('');
    }
}
function changeTitleFile(objFile) {
    objFile.parentNode.setAttribute('title', objFile.value.replace(/^.*[\\/]/, ''));
}