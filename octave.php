<?php

require "config.php";


function logStatus($command,$status){
    global $db;
    $timestamp = date("Y-m-d H:i:s");
    $query = "";
    if ($status == false){
        $query = "INSERT INTO logs(timestamp,command,status)
                      VALUES('$timestamp','$command','success')";
    }
    else {
        $query = "INSERT INTO logs(timestamp,command,status,error_info)
                    VALUES('$timestamp','$command','error','nepodarilo sa vykonat prikaz')";
    }
    $db->exec($query);
}

function exportToCSV(){
    //todo
}

function exportToPDF(){
    //todo
}

if (isset($_GET["position"]) && isset($_GET["newInput"])) {
    $r = $_GET['position'];
    $newInput = json_decode($_GET['newInput']);
    $command = "octave $path/gulicka.m $r $newInput[0] $newInput[1] $newInput[2] $newInput[3]";
    $output = null;
    exec($command, $output, $returnVal);

    logStatus($command,empty($output));

    $positions = array();
    $times = array();
    $angles = array();

    $newInput = array();
    foreach ($output as $id => $row) {

        if ($id>=0 && $id<=3){
            array_push($newInput,floatval(trim($row)));
        }
        else {
            $splitRow = preg_split('/\s+/', trim($row));
            if (isset($splitRow[0]) && !empty($splitRow[0])) {
                array_push($positions, floatval($splitRow[0]));
            }
            if (isset($splitRow[1]) && !empty($splitRow[1])) {
                array_push($times, floatval($splitRow[1]));
            }
            if (isset($splitRow[2]) && !empty($splitRow[2])) {
                array_push($angles, floatval($splitRow[2]));
            }
        }
    }

    $out = array();
    $out["positions"] = $positions;
    $out["times"] = $times;
    $out["angles"] = $angles;
    $out["newInput"] = $newInput;

    echo json_encode($out);
}
