<?php
// [Simona]

require "config.php";

$jazyk = $_POST["jazyk"];
$email = $_POST["email"];
$predmet = array("en"=>"Statistic","sk"=>"Štatistika");
$select = "SELECT * FROM statistika";
$result = $db->query($select);

$text = "";
foreach ($result as $row){
    $text.=$row[$jazyk] . ": " .$row["pocet"] . "\r\n";
}

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "From:Simona Lopatnikova <simona.lopatnikova@gmail.com>\r\n";
$headers .= "X-MSMail-Priority: High\r\n";
$headers .= "Reply-To:simona.lopatnikova@gmail.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

if(!mail($email,$predmet[$jazyk],$text,$headers)){

    echo "nefunguje";
}

?>
