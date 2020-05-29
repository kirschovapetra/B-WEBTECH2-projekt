<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//prihlasovacie udaje do DB
$hostname = "localhost";
$username = "xkirschova";
$password = "nevynadam_jadrovo";
$dbname = "Skuska_DB";

//pripojenie do DB
$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$path = "../octave_scripts";

$apiKey = "1234";

date_default_timezone_set("Europe/Bratislava");