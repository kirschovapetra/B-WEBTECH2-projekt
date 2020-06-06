<?php
require "config.php";
$key = isset($_POST['apiKey'])? $_POST['apiKey'] : "";

$valid = ($key == $apiKey);
?>
<!-- Plane [Nika] -->
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Plane</title>

    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- js -->
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="js_scripts/plane_script.js"></script>
</head>

<body>
<header class="navbar-light bg-light">
    <h1>PLANE</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index_english.php" class="nav-link">HOME</a></li>
            <li class="nav-item"><a href="ballbeam_english.php" class="nav-link">BALL</a></li>
            <li class="active nav-item"><a href="plane_english.php" class="nav-link">PLANE</a></li>
            <li class="nav-item"><a href="pendulum_english.php" class="nav-link">PENDULUM</a></li>
            <li class="nav-item"><a href="#" class="nav-link">CAR</a></li>
            <li class="nav-item"><a href="plane.php" class="nav-link">SK</a></li>
        </ul>
    </nav>
</header>

<!-- vstup -->
<div class="d-flex justify-content-center align-content-center flex-wrap flex-column">

    <div class="d-flex justify-content-center my-5 align-content-center flex-wrap form-inline">

        <form class="form-group" action="plane_english.php" method="POST">
            <label for="position" class="control-label"><b>API key: </b> </label>
            <input autofocus class="form-control" type="text" name="apiKey" id="apiKey" value="<?=$key?>">
            <input type="submit" class="btn btn-primary" name="apiKeySubmit" id="apiKeySubmit" value="OK">
        </form>

    </div>

    <h3>If the number is positive the plane will go up, if it's negative then it will go down.</h3>

    <div class="valid-key-show d-flex justify-content-center my-5 align-content-center flex-wrap form-inline">

        <div class="form-group">
            <label for="position" class="control-label"><b>Position (from -50 to 50):</b> </label>
            <input class="form-control" type="number" name="position" id="positionInput" value="0"  data-placement="bottom" title="Range: from -50 to 50" onchange="changePosition('en',<?=$valid?>)">
        </div>
        <<div class="form-group">
            <div class="checkbox-inline">
                <label class="control-label"><input type="checkbox"  name="animationCheck" id="animationCheck" onchange="toggleDisplay(this.checked,'animation-toggle')" checked>Show animation</label>
            </div>
            <div class="checkbox-inline">
                <label class="control-label"><input type="checkbox" name="graphsCheck" id="graphsCheck" onchange="toggleDisplay(this.checked,'graph-toggle')" checked>Show graphs</label>
            </div>
        </div>
    </div>
</div>

<!-- animacia -->
<div class="d-flex justify-content-center flex-wrap">
    <div id="animation-div" class="animation-toggle valid-key-show">
        <div id="planeSVG">
            <svg
                    xmlns:svg="http://www.w3.org/2000/svg"
                    xmlns="http://www.w3.org/2000/svg"
                    id="svg20"

                    viewBox="0 0 1920 969"
                    preserveAspectRatio="xMinYMin"
                    width="100%"
                    version="1.1">
                <defs
                        id="defs24" />
                <g
                        id="wholePlain">
                    <text
                            id="elevator"
                            y="483"
                            x="25"
                            xml:space="preserve"><tspan
                                style="font-size:85.3333px;line-height:1.25;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-family:Papyrus;-inkscape-font-specification:Papyrus;fill:#de8787"
                        >KLAPKA</tspan></text>
                    <text
                            xml:space="preserve"
                            style="font-size:275.57px;line-height:1.25;font-family:Chiller;-inkscape-font-specification:Chiller;stroke-width:1.43526"
                            x="496.44391"
                            y="555.13879"
                            id="plain"><tspan
                                style="stroke-width:1.43526">LIETADLO</tspan></text>
                </g>
            </svg>
        </div>
    </div>
</div>


<!-- grafy -->
<div class="d-flex justify-content-center flex-wrap" id="graphs-container">
    <div class="graph-toggle valid-key-show" id="positionGraph"></div>
    <div class="graph-toggle valid-key-show" id="angleGraph"></div>
</div>


<footer class="page-footer font-small mt-5 bg-light">
    <div class="footer-copyright text-center py-3">
        Copyright &copy; 2020 Simona Lopatniková, Petra Kirschová, Matúš Hudák, Veronika Szabóová<br>
        Faculty of Electrical Engineering and Information Technology STU in Bratislava
    </div>
</footer>


<?php
if (isset($_POST["apiKeySubmit"])){
    $key = $_POST["apiKey"];
    $valid = ($key == $apiKey);
    $encodedValid = json_encode($valid);
    echo "<script>";
    echo "toggleVisibility($encodedValid,'valid-key-show');";
    echo "changePosition('sk',$encodedValid);";
    echo "</script>";
}
?>
</body>
</html>
