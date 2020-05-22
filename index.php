<?php
require "config.php";
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body onload="changePosition()">
<header>
    <h1 style="text-align:center">Ball & Beam</h1>
</header>

<div class="d-flex justify-content-center my-5 align-content-center flex-wrap">
        <label for="position">r (rozsah 0 - 100 cm) </label>
        <input type="number" name="position" id="positionInput" value="0"  data-placement="bottom" title="Platné hodnoty: 0 - 100" onchange="changePosition()">
        <input type="checkbox" name="animationCheck" id="animationCheck" onchange="toggle(this,'animation-div')" checked>
        <label for="animationCheck">Zobraziť animáciu </label>
        <input type="checkbox" name="graphsCheck" id="graphsCheck" onchange="toggle(this,'myDiv,myDiv2')" checked>
        <label for="graphsCheck">Zobraziť grafy </label>

        <a href="exportToCSV.php"><input type="submit" name="exportCSV" id="exportCSV" value="Export logov do CSV"></a>
        <a href="exportToPDF.php"> <input type="submit" name="exportCSV" id="exportCSV" value="Export logov do PDF"></a>

</div>
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



    <div class="d-flex justify-content-center" id="graphs-container">
        <div id="myDiv"></div>
        <div id="myDiv2"></div>
    </div>

</body>

<script>

</script>


</html>



