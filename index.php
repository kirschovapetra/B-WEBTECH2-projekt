<!-- Ball & Beam [Petra] -->

<?php
require "config.php";
?>

<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Gulička na tyči</title>

        <!-- css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">

        <!-- js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="ballbeam_script.js"></script>
    </head>

    <body onload="changePosition('sk')">
        <header>
            <h1>GULIČKA NA TYČI</h1>
            <nav class="navbar navbar-expand-lg justify-content-center">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link">SK</a></li>
                    <li class="active nav-item"><a href="ballbeam_english.php" class="nav-link">EN</a></li>
                </ul>
            </nav>
        </header>

        <!-- vstup -->
        <div class="d-flex justify-content-center my-5 align-content-center flex-wrap">
                <label for="position">Poloha guličky (0 - 100 cm) </label>
                <input type="number" name="position" id="positionInput" value="0"  data-placement="bottom" title="Platné hodnoty: 0 - 100" onchange="changePosition('sk')">
                <input type="checkbox" name="animationCheck" id="animationCheck" onchange="toggle(this,'animation-div')" checked>
                <label for="animationCheck">Zobraziť animáciu </label>
                <input type="checkbox" name="graphsCheck" id="graphsCheck" onchange="toggle(this,'positionGraph,angleGraph')" checked>
                <label for="graphsCheck">Zobraziť grafy </label>
                <a href="exportToCSV.php"><input type="submit" name="exportCSV" id="exportCSV" value="Export logov do CSV"></a>
                <a href="exportToPDF.php"> <input type="submit" name="exportCSV" id="exportCSV" value="Export logov do PDF"></a>
        </div>

        <!-- animacia -->
        <div class="d-flex justify-content-center">
            <div id="animation-div">
                <svg viewBox="0 0 700 400" preserveAspectRatio="xMinYMin" id="animation">
                    <g id="ballbeam">
                        <rect id="beam" x="0" y="200" width="675" height="10" fill="lightblue"/>
                        <circle id="ball" cx="<?=0*600+25+9?>" cy="191" r="9" fill="pink"/>
                    </g>
                    <rect id="base" x="0" y="0" width="25"  height="400" fill="black"/>
                </svg>
            </div>
        </div>


        <!-- grafy -->
        <div class="d-flex justify-content-center" id="graphs-container">
            <div id="positionGraph"></div>
            <div id="angleGraph"></div>
        </div>


        <footer class="page-footer font-small mt-5">
            <div class="footer-copyright text-center py-3">
            Copyright &copy; 2020 Simona Lopatniková, Petra Kirschová, Matúš Hudák, Veronika Szabóová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
            </div>
        </footer>

    </body>

</html>



