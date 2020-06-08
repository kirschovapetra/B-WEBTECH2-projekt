<?php
require "config.php";
$key = isset($_POST['apiKey'])? $_POST['apiKey'] : "";

$valid = ($key === $apiKey);
?>
<!--Matus-->
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Car</title>

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

    <script src="js_scripts/general.js"></script>
    <script src="js_scripts/vehicleDamping.js"></script>
</head>
<body>
<header class="navbar-light bg-light">
    <h1>VEHICLE DAMPING</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
          <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index_english.php" class="nav-link">HOME</a></li>
            <li class="nav-item"><a href="command_english.php" class="nav-link">EXECUTE COMMAND</a></li>
            <li class="nav-item"><a href="ballbeam_english.php" class="nav-link">BALL</a></li>
            <li class="nav-item"><a href="plane_english.php" class="nav-link">PLANE</a></li>
            <li class="nav-item"><a href="pendulum_english.php" class="nav-link">PENDULUM</a></li>
            <li class="active nav-item"><a href="damping_english.php" class="nav-link">CAR</a></li>
            <li class="nav-item"><a href="statistika_english.php" class="nav-link">STATISTIC</a></li>
            <li class="nav-item"><a href="damping.php" class="nav-link">SK</a></li>
        </ul>
    </nav>
</header>



<div class="d-flex justify-content-center align-content-center flex-wrap flex-column">

    <div class="d-flex justify-content-center my-5 align-content-center flex-wrap form-inline">

        <form class="form-group" action="damping_english.php" method="POST">
            <label for="position" class="control-label"><b>API key: </b> </label>
            <input class="form-control" type="text" name="apiKey" id="apiKey" value="<?=$key?>">
            <input type="submit" class="btn btn-primary" name="apiKeySubmit" id="apiKeySubmit" value="OK">
        </form>

    </div>
    <div class="valid-key-show d-flex justify-content-center my-5 align-content-center flex-wrap form-inline">

        <div class="form-group">
            <label for="position" class="control-label"><b>Obstacle size (-20 to 30 cm):</b> </label>
            <input class="form-control" type="number" name="position" id="positionObstacle" value="0"  data-placement="bottom" title="Obstacle size from -20 to 30" onchange="changeGraph('en',<?=$valid?>)">
        </div>
        <div class="form-group">
            <div class="checkbox-inline">
                <label class="control-label"><input type="checkbox"  name="animationCheck" id="animationCheck" onchange="toggleDisplay(this.checked,'animation-toggle')" checked>Show animation</label>
            </div>
            <div class="checkbox-inline">
                <label class="control-label"><input type="checkbox" name="graphsCheck" id="graphsCheck" onchange="toggleDisplay(this.checked,'graph-toggle')" checked>Show graphs</label>
            </div>
        </div>

    </div>
</div>


<!--animacia-->
<div class="d-flex justify-content-center flex-wrap">

    <div id="animation-div" class="animation-toggle valid-key-show "  >
        <svg
            xmlns:svg="http://www.w3.org/2000/svg"
            xmlns="http://www.w3.org/2000/svg"
            id="svg8"
            version="1.1"
            viewBox="0 0 210 125"
            preserveAspectRatio="xMinYMin"

            width="100%">
            <defs id="defs2" />

            <g id="carContruction">
                <rect id="holder" x="27.573978" y="38" height="31.31575" width="105.25" fill="#1a1a1a"/>
                <ellipse id="wheelBlankA" rx="14.298918" ry="15.100728" cy="76.30546" cx="49.578491" fill="#FFFFFF" />
                <ellipse id="wheelBlankB" rx="14.298918" ry="15.100728" cy="76.30546" cx="109.578491" fill="#FFFFFF" />
                <ellipse id="wheelA" rx="12.298918" ry="13.100728" cy="76.30546" cx="49.578491" fill="#c0c0c0" />
                <ellipse id="wheelB" rx="12.298918" ry="13.100728" cy="76.30546" cx="109.578491" fill="#c0c0c0" />
                <rect id="rect20" y="32.321527" x="45.168548" height="12.027128" width="9.621702" fill="#00ff00"/>
            </g>
        </svg>

    </div>
</div>



<!--grafy-->
<div class="d-flex justify-content-center " id="graphs-container">
    <div class="graph-toggle valid-key-show" id="graph1"></div>
    <div class="graph-toggle valid-key-show" id="graph2"></div>
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
    $valid = ($key === $apiKey);
    $encodedValid = json_encode($valid);
    echo "<script>";
    echo "toggleVisibility($encodedValid,'valid-key-show');";
    echo "</script>";
}
?>
</body>
</html>

