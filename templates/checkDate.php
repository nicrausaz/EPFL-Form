<?php
date_default_timezone_set('Europe/Zurich');
$year = Date("Y");
$actualDate = Date('02-09-2016');
$startDate = Date('01-09'.$year);
$endDate = Date('01-09'.$year);
$actualDate = strtotime($actualDate);
echo $actualDate."\n";
$startDate = strtotime($startDate);
echo $startDate."\n";
$endDate = strtotime($endDate);
echo $endDate."\n";

if(($actualDate>$startDate)&&($actualDate<$endDate)){
    
}else{
    //header("Location: ./denied.php");
    echo "error";
}
?>
