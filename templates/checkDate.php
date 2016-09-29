<?php
date_default_timezone_set('Europe/Zurich');
$year = Date('Y');
$actualDate = Date("d-m-Y");
$startDayMonth = Date('01-09-');
$endDayMonth = Date('01-12-');
$startDate = Date($startDayMonth.$year);
$endDate = Date($endDayMonth.$year);
$actualDateStamp = strtotime($actualDate);
$startDateStamp = strtotime($startDate);
$endDateStamp = strtotime($endDate);

if(($actualDateStamp>$startDateStamp)&&($actualDateStamp<$endDateStamp)){
}else{
    header("Location: ./denied.php");
}
?>
