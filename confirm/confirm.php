
<?php
    echo $_GET['mail'];
    $JSONstring = json_encode(["mail" => $_GET['mail'], "status" => "confirmed"], JSON_PRETTY_PRINT);
    createTempFile($JSONstring);

    function createTempFile ($JSONstring) {
        $content = file_get_contents('tmp/confirm.json');
        $content .= $JSONstring;
        
        $fp = fopen('tmp/confirm.json', 'w');
        
        fwrite($fp, $content . ",");
        fclose($fp);
    }
?>
