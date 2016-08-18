<?php
class Doc {
	public $firstname = "";
	public $lastname  = "";
}

$name="nicolas";
$doc = new Doc();
$doc->firstname = $name;
$doc->lastname  = "bar";

$encodedJson = json_encode($doc);

echo $encodedJson;
file_put_contents('informations.json', $encodedJson);
?>