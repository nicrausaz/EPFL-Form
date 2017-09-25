<?php
if( count(get_included_files()) == 1 ) exit("Direct access not permitted.");
print "<pre>";
print_r($_SESSION);
print_r($_FILES);
print "</pre>"
?>