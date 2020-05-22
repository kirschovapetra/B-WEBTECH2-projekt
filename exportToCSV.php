<?php
//https://www.codexworld.com/export-data-to-csv-file-using-php-mysql/
include 'config.php';

$query = $db->query("SELECT * FROM logs ORDER BY id DESC");
$rows = $query->fetchAll();
if(count($rows) > 0){
    $delimiter = ",";
    $filename = "logs_" . date('Y-m-d') . ".csv";
    $f = fopen('php://memory', 'w');

    $columns = array('id', 'timestamp',"command", 'status', 'error_info');
    fputcsv($f, $columns, $delimiter);

    foreach($rows as $row){
        $rowArray = array($row['id'], $row['timestamp'], $row['command'], $row['status'], $row['error_info']);
        fputcsv($f, $rowArray, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
exit;

?>