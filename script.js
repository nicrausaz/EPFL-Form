$(document).ready(function () {
    initButtonsAction();
    initAddChildButtons();
    initAddRadioButtonEvent();
    initDateChecker();

    $("#jb").change(function () {
        var selectedFormation = $("#jb option:selected")[0].value;
        var laborantPeople = ["laborantinChimie", "laborantinPhysique", "laborantinBiologie"];

        if (laborantPeople.indexOf(selectedFormation) == -1) {
            $("#all").show(1000);

            selectedFormation == "informaticien" ? $("#infoOnly").show(1000) : $("#infoOnly").hide(500);
            selectedFormation == "polyMecanicien" ? $("#polyOnly").show(1000) : $("#polyOnly").hide(500);
        } else {
            $("#all").hide(1000);

            if (confirm("Pour les métiers de laborantins, l'inscription se fait auprès de l'AVML, cliquer sur ok pour être redirigé-e.")) {
                window.location.replace("https://wp.unil.ch/avml/");
            }
        }
    });
});

function initDateChecker(){
    $("#birthApp").change(function () {

        var birthdate = new Date(document.getElementById("birthApp").value);
        var cur = new Date();
        var diff = cur-birthdate; // This is the difference in milliseconds
        var age = Math.floor(diff/31536000000); // Divide by 1000*60*60*24*365

        if (age <= 12 || birthdate.getFullYear() < 1910 || age > 60) {
            document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide';
        }
        else {
            document.getElementById('errorMsg').innerHTML = '';
        }
    });

    $("#dejaCandAnnee").change(function () {
        checkYearDate("#dejaCandAnnee", "#dejaCandError");
    });
    $("#anneeFin").change(function () {
        checkYearDate("#anneeFin", "#anneeFinError");
    });
}

function addChildren(parentId, maxItems, childTemplate, addButtonId) {
    var i = $(parentId + ' > tbody').children().size() + 1;
    if (i < maxItems) {
        var fullTemplate = childTemplate.replace(/\{(.*?)\}/g, i);
        $(parentId).append(fullTemplate);
        if (i == maxItems - 1) {
            $(addButtonId).hide(750);
        }
    }
}

function changeTitleFile(objFile) {
    objFile.parentNode.setAttribute('title', objFile.value.replace(/^.*[\\/]/, ''));
    checkFileFormat(objFile);
}

function checkFileFormat(obj){
    var errorSection = obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling;
    var fileExtension = ['pdf', 'jpg', 'jpeg', 'png'];

    if (fileExtension.indexOf(obj.value.split('.').pop().toLowerCase()) == -1) {
        //extension invalide
        errorSection.innerHTML = '<p class ="errorMsgs">Format invalide</p>';
    } else {
        //extension valide
        errorSection.innerHTML = '';
    }
}

function checkYearDate(toCheckValue, errorZone) {
    var inputYear = $(toCheckValue).val();
    var currentYear = (new Date).getFullYear();

    if ((inputYear != parseInt(inputYear, 10)) || (currentYear < inputYear)){
        $(errorZone).html('<p class ="errorMsgs">Date invalide');
    } else {
        $(errorZone).html("");
    }
}

function initButtonsAction(){
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

     $('#addInputFile').click(function () {
        var nextIndex = $('#newCertifZone > tbody').children().size() + 1;
        var zoneId = nextIndex + 6;
        if (nextIndex < 10) {
        $('#newCertifZone').append('<tr><td><div class="tooltip"><label class="file" title="" id="certifLabel' + nextIndex 
                 + '"><input type="file" name="certifs' + nextIndex 
                 + '" id="certifs' + nextIndex 
                 + '" onchange="changeTitleFile(this)" /></label><span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpg-jpeg-png</span><p></p><section id="formatErrorZone' + zoneId 
                 + '"></section></div></td></tr>');
            if (nextIndex == 9) {
                $('#addInputFile').hide(750);
            }
        }
    });
}

function initAddChildButtons(){
     $('#addSch').click(function () {
        var template = '<tr><td><input type="text" name="ecole{i}" placeholder="Ecole" autocomplete="off"/></td><td><input type="text" name="lieuEcole{i}" placeholder="Lieu" autocomplete="off"/></td> <td><input type="text" name="niveauEcole{i}" placeholder="Niveau" autocomplete="off"/></td><td><input type="text" name="anneesEcole{i}" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
        addChildren('#scolaire', 6, template, '#addSch');
    });

    $('#addPro').click(function () {
        var template = '<tr><td><input type="text" name="employeurPro{i}" placeholder="Employeur" autocomplete="off"/></td><td><input type="text" name="lieuPro{i}" placeholder="Lieu" autocomplete="off"/></td><td><input type="text" name="activitePro{i}" placeholder="Activité" autocomplete="off"/></td><td><input type="text" name="anneesPro{i}" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
        addChildren('#activites', 4, template, '#addPro');
    });

    $('#addStage').click(function () {
        var template = '<tr><td><input type="text" name="activiteStage{i}" placeholder="Métier" autocomplete="off"></td><td><input type="text" name="entrepriseStage{i}" placeholder="Entreprise" autocomplete="off"></td></tr>';
        addChildren('#stages', 5, template, '#addStage');
    });

}

function initAddRadioButtonEvent(){
    $("#maj1").change(function () {
        $("#representants").show(1000);
    });
    $("#maj2").change(function () {
        $("#representants").hide(1000);
        clearRepresentants();
    });

    $("#dejaCand1").change(function () {
        $("#dejaCandAnnee").hide(750);
        $("#dejaCandAnnee").val("");
        $("#dejaCandError").html("");
    });
    $("#dejaCand2").change(function () {
        $("#dejaCandAnnee").show(750);
    });
}
function clearRepresentants(){
    for(i = 1; i <= 2; i++){
        $("#genreRep"+i+" :nth-child(1)").prop('selected', true);
        $("#nameRep"+i).val("");
        $("#surnameRep"+i).val("");
        $("#adrRep"+i).val("");
        $("#NPARep"+i).val("");
        $("#telRep"+i).val("");
    }
}