<?php
//t = krok 0.01
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>-->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body onload="changePosition()">
<header>
    <h1 style="text-align:center">Ball & Beam</h1>
</header>


<div class="d-flex justify-content-center my-5">
        <input type="number" name="position" id="positionInput" value="0">
        <input type="submit" name="positionSubmit" id="positionSubmit" value="OK" onclick="changePosition()">
</div>
    <div class="d-flex justify-content-center">
        <div style="width:40%">
            <svg viewBox="0 0 650 400" preserveAspectRatio="xMinYMin" style="border:2px solid black;">
                <g id="ballbeam">
                    <rect id="beam" x="0" y="200" width="625" height="10" fill="lightblue"/>
                    <circle id="ball" cx="<?=0*600+25+9?>" cy="191" r="9" fill="pink"/>
                </g>
                <rect id="base" x="0" y="0" width="25"  height="400" fill="black"/>
            </svg>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div id="myDiv"></div>
        <div id="myDiv2"></div>
    </div>

</body>




</html>



