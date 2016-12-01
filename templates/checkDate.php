<?php
date_default_timezone_set('Europe/Zurich');
$year = Date('Y');
$nextyear = $year +1;
//HERE YOU CAN CHANGE THE DATE RANGE
$actualDate = Date("d-m-Y");
$startDayMonth = Date('01-10-');
$endDayMonth = Date('31-03-');
$startDate = Date($startDayMonth.$year);
$endDate = Date($endDayMonth.$nextyear);
$actualDateStamp = strtotime($actualDate);
$startDateStamp = strtotime($startDate);
$endDateStamp = strtotime($endDate);

$parts = explode('/', $_SERVER["SCRIPT_NAME"]);
$file = $parts[count($parts) - 1];

if($file != "denied.php"){
    ($actualDateStamp>$startDateStamp)&&($actualDateStamp<$endDateStamp) ? "" : header("Location: ./denied.php");
}
?>
