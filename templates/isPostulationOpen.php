<?php
if( count(get_included_files()) == 1 ) exit("Direct access not permitted.");

$isOpen = true;
if(!$isOpen){
    header("Location: ./views/denied.php");
}
?>