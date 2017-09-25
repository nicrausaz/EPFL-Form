<?php
    if ($_GET['s']) {

        $applicantID = checkSecret($_GET['s']);

        if ($applicantID != null) {
            $url = generateFormURL($applicantID);
            header("Location: $url");
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

        foreach ($fileContent as $applicant => $infos) {
            if ($applicant === $secret) {
                return $applicant;
            }
        }
    }

    function generateFormURL ($applicantID) {
        return "http://epflform.local/views/form.php?id=". $applicantID;
    }
?>
