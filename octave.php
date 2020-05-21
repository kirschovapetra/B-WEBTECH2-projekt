<?php
require "config.php";

if (isset($_GET["position"]) && isset($_GET["newInput"])) {
    $r = $_GET['position'];
    $newInput = json_decode($_GET['newInput']);
    $command = "octave $path/gulicka.m $r $newInput[0] $newInput[1] $newInput[2] $newInput[3]";
//    $command = "octave $path/gulicka.m $r 0 0 0 0";
    $output = null;
    exec($command, $output, $returnVal);
    $positions = array();
    $times = array();
    $angles = array();

//    echo "<pre>";
//    var_dump($output);
//    echo "</pre>";

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
             //   array_push($angles, rad2deg($splitRow[2]));
                array_push($angles, floatval($splitRow[2]));
            }
        }
    }

    $out = array();
    $out["positions"] = $positions;
    $out["times"] = $times;
    $out["angles"] = $angles;
    $out["newInput"] = $newInput;


//echo "<pre>";
//var_dump($out);
//echo "</pre>";
echo json_encode($out);
}
