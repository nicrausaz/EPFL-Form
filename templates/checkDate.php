<?php 
$actualDate = Date('Y-m-d');
$startDate = Date('2016-09-01');
$endDate = Date('2016-11-12');
$actualDate = strtotime($actualDate);
$startDate = strtotime($startDate);
$endDate = strtotime($endDate);

if(($actualDate>$startDate)&&($actualDate<$endDate)){
    
}else{
    header("Location: ./denied.php");
}
?>
