$(document).ready(function () {

    initRadioChanges();

    $("#baseForm").submit(function (e) {

        if (!(checkMail() && checkJobSelection())) {
            alert("Certains champs requis n'ont pas été remplis.");
            e.preventDefault();
        }
    });

    function checkJobSelection() {
        if ($('#lieuLausanne')[0].checked && $("#jbLausanne").prop('selectedIndex') == 0) {
            return false;
        }
        else if ($('#lieuSion')[0].checked && $("#jbSion").prop('selectedIndex') == 0) {
            return false;
        }
        else {
            return true;
        }
    }

    function checkMail() {
        if ($("#mailApp").val() == "") {
            return false;
        }
        else {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test($("#mailApp").val());
        }
    }

    function initRadioChanges() {
        $('#lieuLausanne').change(function () {
            if ($('#lieuLausanne')[0].checked) {
                $("#jbLausanne").show(0);
                $("#jbSion").hide(0);
            }
            else if ($('#lieuSion')[0].checked) {
                $("#jbSion").show(0);
                $("#jbLausanne").hide(0);
            }
        });

        $('#lieuSion').click(function () {
            if ($('#lieuLausanne')[0].checked) {
                $("#jbLausanne").show(0);
                $("#jbSion").hide(0);
            }
            else if ($('#lieuSion')[0].checked) {
                $("#jbSion").show(0);
                $("#jbLausanne").hide(0);
            }
        });
    }
})