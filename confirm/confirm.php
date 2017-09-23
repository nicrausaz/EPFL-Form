
<?php
    if ($_GET['s']) {

        $applicantID = checkSecret($_GET['s']);

        if ($applicantID !== "notfound") {
            echo generateFormURL($applicantID);
        }
        else {
            echo "wrong"; // error: Bad secret, not valid
        }
    }
    else {
        echo "bad request"; // error: Bad URL, missing secret
    }

    function checkSecret($secret) {
        $fileContent = json_decode(file_get_contents("./tmp/confirm.json"), true);
        foreach ($fileContent['applicants'] as $applicant => $infos) {
            if ($infos['secret'] === $secret) {
                return $applicant;
            }
            else {
                return "notfound";
            }
        }
    }

    function generateFormURL ($applicantID) {
        return "http://epfl-form.local/form.php?id=". $applicantID;
    }
?>
