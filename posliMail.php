<?php
// [Simona]

require "config.php";

$jazyk = $_GET["jazyk"];
$email = $_GET["email"];
$predmet = array("en"=>"Statistic","sk"=>"Štatistika");
$select = "SELECT * FROM statistika";
$result = $db->query($select);

$text = "";
foreach ($result as $row){
    $text.=$row[$jazyk] . ": " .$row["pocet"] . "\r\n";
}

if(!mail($email,$predmet[$jazyk],$text,"From: simona.lopatnikova@gmail.com")){

    echo "nefunguje";
}

?>
