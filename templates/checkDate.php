<?php
date_default_timezone_set('Europe/Zurich');
$year = Date('Y')."\n\n";
$actualDate = Date("d-m-Y")."\n\n";
$startDate = Date('01-09-'.$year)."\n\n";
$endDate = Date('01-12-'.$year)."\n\n";
$actualDate = strtotime($actualDate);
$startDate = strtotime($startDate);
$endDate = strtotime($endDate);

if(($actualDate>$startDate)&&($actualDate<$endDate)){
}else{
    header("Location: ./denied.php");
}
?>
