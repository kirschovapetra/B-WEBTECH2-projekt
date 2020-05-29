<?php
//export tabulky "logs" do csv [Petra]

include 'config.php';

$language = $_GET["lang"];
if (isset($language)) {

    //nacitanie udajov z databazy
    $query = $db->query("SELECT * FROM logs ORDER BY id DESC");
    $results = $query->fetchAll();

    //https://www.codexworld.com/export-data-to-csv-file-using-php-mysql/
    if(count($results) > 0){
        //otvorenie suboru
        $f = fopen("php://memory", "w");

        //zapis headeru do csv
        $columns = array("id", "timestamp","command", "status", "error_info");
        fputcsv($f, $columns, ",");

        //zapis riadkov do csv
        foreach($results as $result){
            $row = array($result['id'], $result['timestamp'], $result['command'], $result['status'], $result['error_info']);
            fputcsv($f, $row, ",");
        }

        fseek($f, 0); //posun na zaciatok

        //stiahnutie suboru
        header("Content-Type: text/csv");
        $today = date('Y-m-d');
        if ($language == "en"){
            header("Content-Disposition: attachment; filename=logs_$today.csv;");
        }
        else if ($language == "sk") {
            header("Content-Disposition: attachment; filename=logy_$today.csv;");
        }
        fpassthru($f);
    }
    exit;
}
?>