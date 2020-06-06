<?php
/*********************************** Octave api [Matus, Simona, Petra, Veronika] **************************************/

include "../config.php";

header("Content-Type:application/json");

if (isset($_GET["apiKey"]) && $_GET["apiKey"] == $apiKey) {
    //data na animacie
    if (isset($_GET["execute"]) && $_GET["execute"] == "animation") {
        executeAnimation();
    } //spustanie normalnych prikazov
    else if (isset($_GET["execute"]) && $_GET["execute"] == "command") {
        executeCommand();
    }

}

function executeCommand() {
    //TODO (Matus)
}


function executeAnimation()    {

    if (isset($_GET["type"])) {
        if ($_GET["type"] == "ballbeam") { // [Petra]
            getBallBeamData();
        } else if ($_GET["type"] == "plane") { // [Nika]
            getPlaneData();
        } else if ($_GET["type"] == "car") { // [Matus]
            getVehicleDampingData();
        } else if ($_GET["type"] == "pendulum") { // [Simona]
            getInvertedPendulumData();
        }
    }
}

//gulicka na tyci [Petra]
function getBallBeamData() {
    global $path;

    if (isset($_GET["position"]) && isset($_GET["newInput"])) {
        $r = $_GET['position']; //nova pozicia
        $newInput = json_decode($_GET['newInput']); //x(size(x,1),:) z predosleho volania

        //spustenie prikazu v octave
        $command = "octave -q $path/gulicka.m $r $newInput[0] $newInput[1] $newInput[2] $newInput[3]";
        exec($command, $octaveOutput, $returnVal);

        //zapis logu do databazy
        logStatus($command, empty($octaveOutput));

        $positions = array();
        $times = array();
        $angles = array();
        $newInput = array();

        //data ziskane z octave
        foreach ($octaveOutput as $id => $row) {
            //x(size(x,1),:)  -> zapise sa do $newInput
            if ($id >= 0 && $id <= 3) {
                array_push($newInput, floatval(trim($row)));
            } //pozicie, casy, uhly
            else {
                $splitRow = preg_split('/\s+/', trim($row)); //odstranenie medzier

                if (isset($splitRow[0]) && !empty($splitRow[0])) {
                    array_push($positions, floatval($splitRow[0])); //pridanie novej pozicie
                }
                if (isset($splitRow[1]) && !empty($splitRow[1])) {
                    array_push($times, floatval($splitRow[1])); //pridanie noveho casu
                }
                if (isset($splitRow[2]) && !empty($splitRow[2])) {
                    array_push($angles, floatval($splitRow[2])); //pridanie noveho uhlu
                }
            }
        }

        //vystup ako asociativne pole
        $out = array();
        $out["positions"] = $positions;
        $out["times"] = $times;
        $out["angles"] = $angles;
        $out["newInput"] = $newInput;


        //vypis
        echo json_encode($out);
    }
}

// inverzne kyvadlo [Simona]
function getInvertedPendulumData(){
    global $path;

    if (isset($_GET["position"]) && isset($_GET["newInput"])) {
        $r = $_GET['position']; //nova pozicia
        $newInput = json_decode($_GET['newInput']); //x(size(x,1),:) z predosleho volania

        //spustenie prikazu v octave
        $command = "octave $path/kyvadlo.m $r $newInput[0] $newInput[1] $newInput[2] $newInput[3]";
        exec($command, $octaveOutput, $returnVal);

        $positions = array();
        $times = array();
        $angles = array();
        $newInput = array();

        //zapis logu do databazy
        logStatus($command, empty($octaveOutput));

        foreach ($octaveOutput as $id => $row) {

            if ($id >= 0 && $id <= 3){
                array_push($newInput,floatval(trim($row)));
            }
            else {
                $splitRow = preg_split('/\s+/', trim($row)); //odstranenie medzier

                if (isset($splitRow[0]) && !empty($splitRow[0])) {
                    array_push($positions, floatval($splitRow[0])); //pridanie novej pozicie
                }
                if (isset($splitRow[1]) && !empty($splitRow[1])) {
                    //https://www.php.net/manual/en/function.number-format.php
                    array_push($times, number_format($splitRow[1], 2, '.', '')); //pridanie noveho casu
                }
                if (isset($splitRow[2]) && !empty($splitRow[2])) {
                    array_push($angles, floatval($splitRow[2])); //pridanie noveho uhlu
                }
            }

        }

        //vystup ako asociativne pole
        $out = array();
        $out["positions"] = $positions;
        $out["times"] = $times;
        $out["angles"] = $angles;
        $out["newInput"] = $newInput;

        //vypis
        echo json_encode($out);
    }
}

//tlmenie vozidla [Matus]
function getVehicleDampingData(){
    global $path;

    if (isset($_GET["position"]) && isset($_GET["newInput"])) {
        $r = $_GET['position']; //nova pozicia
        $newInput = json_decode($_GET['newInput']); //x(size(x,1),:) z predosleho volania

        //spustenie prikazu v octave
        $command = "octave -q $path/tlmenie.m $r $newInput[0] $newInput[1] $newInput[2] $newInput[3] $newInput[4]";
        exec($command, $octaveOutput, $returnVal);

        logStatus($command, empty($octaveOutput));

        $positions = array();
        $times = array();
        $angles = array();
        $newInput = array();

        //data ziskane z octave
        foreach ($octaveOutput as $id => $row) {
            //x(size(x,1),:)  -> zapise sa do $newInput
            if ($id >= 0 && $id <= 4) {
                array_push($newInput, floatval(trim($row)));
            } //pozicie, casy, uhly
            else {
                $splitRow = preg_split('/\s+/', trim($row)); //odstranenie medzier

                if (isset($splitRow[0]) && !empty($splitRow[0])) {
                    array_push($positions, floatval($splitRow[0])); //pridanie novej pozicie
                }
                if (isset($splitRow[1]) && !empty($splitRow[1])) {
                    array_push($times, floatval($splitRow[1])); //pridanie noveho casu
                }
                if (isset($splitRow[2]) && !empty($splitRow[2])) {
                    array_push($angles, floatval($splitRow[2])); //pridanie noveho uhlu
                }
            }
        }

        //vystup ako asociativne pole
        $out = array();
        $out["auto"] = $positions;
        $out["times"] = $times;
        $out["koleso"] = $angles;
        $out["newInput"] = $newInput;


        //vypis
        echo json_encode($out);
    }
}

//plane [Nika]
function getPlaneData()    {
    global $path;

    if (isset($_GET["position"]) && isset($_GET["newInput"])) {
        $r = $_GET['position']; //nova pozicia
        $newInput = json_decode($_GET['newInput']); //x(size(x,1),:) z predosleho volania

        //spustenie prikazu v octave
        $command = "octave $path/plane.m $r $newInput[0] $newInput[1] $newInput[2]";
        exec($command, $octaveOutput, $returnVal);

        //zapis logu do databazy
        logStatus($command, empty($octaveOutput));

        $positions = array();
        $times = array();
        $angles = array();
        $newInput = array();

        //data ziskane z octave
        foreach ($octaveOutput as $id => $row) {
            //x(size(x,1),:)  -> zapise sa do $newInput
            if ($id >= 0 && $id <= 2) {
                array_push($newInput, floatval(trim($row)));
            } //pozicie, casy, uhly
            else {
                $splitRow = preg_split('/\s+/', trim($row)); //odstranenie medzier

                if (isset($splitRow[0]) && !empty($splitRow[0])) {
                    array_push($positions, floatval($splitRow[0])); //pridanie novej pozicie
                }
                if (isset($splitRow[1]) && !empty($splitRow[1])) {
                    array_push($times, floatval($splitRow[1])); //pridanie noveho casu
                }
                if (isset($splitRow[2]) && !empty($splitRow[2])) {
                    array_push($angles, floatval($splitRow[2])); //pridanie noveho uhlu
                }
            }
        }

        //vystup ako asociativne pole
        $out = array();
        $out["positions"] = $positions;
        $out["times"] = $times;
        $out["angles"] = $angles;
        $out["newInput"] = $newInput;

        //vypis
        echo json_encode($out);
    }
}

//zapis logov do databazy [Petra]
function logStatus($command, $status)    {
    global $db;
    $timestamp = date("Y-m-d H:i:s");

    //prazdny vystup z octave
    if ($status == false) {
        $query = "INSERT INTO logs(timestamp,command,status)
                      VALUES('$timestamp','$command','úspech')";
    } //octave vratil nejake data
    else {
        $query = "INSERT INTO logs(timestamp,command,status,error_info)
                    VALUES('$timestamp','$command','error','nepodarilo sa vykonat prikaz')";
    }
    $db->exec($query);
    
}
