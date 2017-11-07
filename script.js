$(document).ready(function () {
    initButtonsAction();
    if (location.pathname.split("/").slice(-1)[0] == "form.php") {
        initJobChange();
        initButtonsAction();
        initAddChildButtons();
        initAddRadioButtonEvent();
        initDateChecker();
        initDatepicker();
        clearFiles();
        checkRequired();
    }
});

function checkDate() {
    var birthdate = moment(document.getElementById("birthApp").value, "DD/MM/YYYY")._d;
    var cur = new Date();
    var diff = cur - birthdate; // This is the difference in milliseconds
    var age = Math.floor(diff / 31536000000); // Divide by 1000*60*60*24*365

    if (age <= 12 || birthdate.getFullYear() < 1910 || age > 60) {
        document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide';
    }
    else {
        document.getElementById('errorMsg').innerHTML = '';
    }
}

function initDateChecker() {
    $("#birthApp").change(function () {
        checkDate();
    });

    $("#dejaCandAnnee").change(function () {
        checkYearDate("#dejaCandAnnee", "#dejaCandError", 0);
    });
    $("#anneeFin").change(function () {
        checkYearDate("#anneeFin", "#anneeFinError", 1);
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

function checkFileFormat(obj) {
    var errorSection = obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling;
    var fileExtension = ['pdf', 'jpeg', 'png', 'jpg'];

    if (fileExtension.indexOf(obj.value.split('.').pop().toLowerCase()) == -1) {
        //extension invalide
        errorSection.innerHTML = '<p class ="errorMsgs">Format invalide</p>';
        clearFileInput(obj);
    } else {
        //extension valide
        errorSection.innerHTML = '';
    }
}

function checkYearDate(toCheckValue, errorZone, coefficiantYear) {
    var inputYear = $(toCheckValue).val();
    var currentYear = (new Date).getFullYear() + coefficiantYear;

    if ((inputYear != parseInt(inputYear, 10)) || (currentYear < inputYear) || (inputYear.length != 4)) {
        $(errorZone).html('<p class ="errorMsgs">Date invalide');
    } else {
        $(errorZone).html("");
    }
}

function initButtonsAction() {
    $('#createAc').click(function () {
        window.open("https://guests.epfl.ch/selfaddform", '_blank');
    });
    $('#connectB').click(function () {
        document.location.href = "form.php";
    });
    $('#infoFilieres').click(function () {
        window.open("https://www.ict-berufsbildung.ch/fr/formation-professionnelle/formation-initiale-ict/", '_blank');
    });
    $('#infoMpt').click(function () {
        window.open("https://orientation.ch/dyn/show/3309", '_blank');
    });
    $('#retourHome').click(function () {
        document.location.href = "http://apprentis.epfl.ch/";
        // logout
    });
    $('#retourFormulaire').click(function () {
        history.go(-1);
    });
}

function initAddChildButtons() {
    $('#addSch').click(function () {
        var template = '<tr><td><label for="ecole{i}">Ecole:</label><input type="text" name="ecole{i}" id="ecole{i}" placeholder="Ecole"/></td><td><label for="lieuEcole{i}">Lieu:</label><input type="text" name="lieuEcole{i}" id="lieuEcole{i}" placeholder="Lieu"/></td><td><label for="niveauEcole{i}">Niveau:</label><input type="text" name="niveauEcole{i}" id="niveauEcole{i}" placeholder="Niveau"/></td><td><label for="anneesEcole{i}">Années:</label><input type="text" name="anneesEcole{i}" id="name="anneesEcole{i}" placeholder="de-à"/></td></tr>';
        addChildren('#scolaire', 6, template, '#addSch');
    });

    $('#addPro').click(function () {
        var template = '<tr><td><label for="employeurPro{i}">Employeur:</label><input type="text" name="employeurPro{i}" id="employeurPro{i}" placeholder="Employeur"/></td><td><label for="lieuPro{i}">Lieu:</label><input type="text" name="lieuPro{i}" id="lieuPro{i}" placeholder="Lieu"/></td><td><label for="activitePro{i}">Activité:</label><input type="text" name="activitePro{i}" id="activitePro{i}" placeholder="Activité"/></td><td><label for="anneesPro{i}">Années:</label><input type="text" name="anneesPro{i}" id="anneesPro{i}" placeholder="de-à"/></td></tr>';
        addChildren('#activites', 4, template, '#addPro');
    });

    $('#addStage').click(function () {
        var template = '<tr><td><label for="activiteStage{i}">Métier:</label><input type="text" name="activiteStage{i}" id="activiteStage{i}" placeholder="Métier"></td><td><label for="entrepriseStage{i}">Entreprise:</label><input type="text" name="entrepriseStage{i}" id="entrepriseStage{i}" placeholder="Entreprise"></td></tr>';
        addChildren('#stages', 5, template, '#addStage');
    });

    $('#addInputFile').click(function () {
        var nextIndex = $('#newCertifZone > tbody').children().size() + 1;
        var zoneId = nextIndex + 7;
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

function setMajState() {
    $('#maj1')[0].checked ? $("#representants").show(1000) : $("#representants").hide(1000);
}

function setDejaCandState() {
    if ($('#dejaCand1')[0].checked) {
        $("#dejaCandAnnee").hide(750);
        $("#dejaCandAnnee").val("");
        $("#dejaCandError").html("");
    } else {
        $("#dejaCandAnnee").show(750);
    }
}

function setLieuState() {
    if ($('#lieuLausanne')[0].checked) {
        $("#jbLausanne").show(0);
        $("#jbSion").hide(0);
    }
    else if ($('#lieuSion')[0].checked) {
        $("#jbSion").show(0);
        $("#jbLausanne").hide(0);
    }
}

function initAddRadioButtonEvent() {
    $('#maj1').change(setMajState);
    $('#maj2').change(setMajState);
    setMajState();

    $("#dejaCand1").change(setDejaCandState);
    $("#dejaCand2").change(setDejaCandState);
    setDejaCandState();

    $('#lieuLausanne').change(setLieuState);
    $('#lieuSion').change(setLieuState);
}

function clearRepresentants() {
    for (i = 1; i <= 2; i++) {
        $("#genreRep" + i + " :nth-child(1)").prop('selected', true);
        $("#nameRep" + i).val("");
        $("#surnameRep" + i).val("");
        $("#adrRep" + i).val("");
        $("#NPARep" + i).val("");
        $("#telRep" + i).val("");
    }
}

function initDatepicker() {
    $.datepicker.setDefaults($.datepicker.regional["fr"]);
    $("#birthApp").datepicker({ minDate: '-60y', maxDate: '-13y', dateFormat: "dd/mm/yy" });
}

function getFormation() {
    if ($('#lieuLausanne').is(":checked")) {
        return $("#jbLausanne option:selected")[0].value;
    }
    else {
        return $("#jbSion option:selected")[0].value;
    }
}

function initJobChange() {
    $(".jobSelectors").change(function () {
        var selectedFormation = getFormation();
        showPolyAndInfoDivs(selectedFormation);

        // var laborantPeople = ["laborantinChimie", "laborantinPhysique", "laborantinBiologie"];

        // if (laborantPeople.indexOf(selectedFormation) == -1) {
        //     showPolyAndInfoDivs(selectedFormation);

        // } else {
        //     $("#all").hide(1000);

        //     if (confirm("Pour les métiers de laborantins, l'inscription se fait auprès de l'AVML, cliquer sur ok pour être redirigé-e.")) {
        //         window.location.replace("https://wp.unil.ch/avml/");
        //     }
        // }
    });
    $("#lieux").change(function () {
        var selectedFormation = getFormation();
        showPolyAndInfoDivs(selectedFormation);
    });
}

function showOnFormReturn(lieu) {
    if (lieu == 'Lausanne') {
        var selectedFormation = $("#jbLausanne option:selected")[0].value;
    }
    else if (lieu == 'Sion') {
        var selectedFormation = $("#jbSion option:selected")[0].value;
    }
    showListJob(lieu)
    showPolyAndInfoDivs(selectedFormation);
}
function showListJob(lieu) {
    if (lieu == 'Lausanne') {
        $("#jbSion").hide();
        $("#jbLausanne").show();
    }
    else if (lieu == 'Sion') {
        $("#jbSion").show();
        $("#jbLausanne").hide();
    }
}
function showPolyAndInfoDivs(selectedFormation) {
    if (selectedFormation != "menu") {
        $("#all").show(1000);
        selectedFormation == "informaticien" ? $("#infoOnly").show(1000) : $("#infoOnly").hide(500);
        selectedFormation == "informaticien" ? $("#griTest").show(1000) : $("#griTest").hide(500);
        selectedFormation == "polyMecanicien" ? $("#polyOnly").show(1000) : $("#polyOnly").hide(500);
    }
}
function clearFileInput(fileInput) {
    $(fileInput).wrap('<form>').closest('form').get(0).reset();
    $(fileInput).unwrap();
}

function clearFileLabel(fileInputLabel) {
    $(fileInputLabel)[0].title = "Aucun fichier choisi";
}

function clearFiles() {
    $("#files input").each(function (input) {
        clearFileInput(this);
    });

    $("#files label").each(function (input) {
        clearFileLabel(this);
    });
}

function checkRequired() {
    $("form").submit(function (e) {

        $($(this).find("[data-required]")).each(function () {
            if ($(this).val() == '') {
                alert("Certains champs requis n'ont pas été remplis.");
                e.preventDefault();
                return false;
            }
        });
        return true;
    });
}