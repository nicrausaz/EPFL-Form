<?php
date_default_timezone_set('Europe/Zurich');
$year = Date('Y');
$actualDate = Date("d-m-Y");
$startDate = Date('01-09-'.$year);
$endDate = Date('01-12-'.$year);
$actualDate = strtotime($actualDate);
$startDate = strtotime($startDate);
$endDate = strtotime($endDate);

if(($actualDate>$startDate)&&($actualDate<$endDate)){
}else{
    header("Location: ./denied.php");
}
?>
