<!-- statistika-->

<?php
require "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Statistic</title>
</head>

<body>
<header class="navbar-light bg-light">
    <h1>Statistic</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <ul class="nav navbar-nav">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="index_english.php" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="ballbeam_english.php" class="nav-link">BALL</a></li>
                <li class="nav-item"><a href="plane_english.php" class="nav-link">PLANE</a></li>
                <li class="nav-item"><a href="pendulum_english.php" class="nav-link">PENDULUM</a></li>
                <li class="nav-item"><a href="damping_english.php" class="nav-link">CAR</a></li>
                <li class="active nav-item"><a href="statistika_english.php" class="nav-link">STATISTIC</a></li>
                <li class="nav-item"><a href="statistika.php" class="nav-link">SK</a></li>
        </ul>
    </nav>
</header>

<div class="d-flex justify-content-center mt-3">
    <?php
    $select = "SELECT * FROM statistika";
    $result = $db->query($select);
    echo "<div class='tabulka'>";
    echo "<table class=\"table table-bordered\">";
    echo "<thead>";
    echo "<tr>";
    echo  "<th> Model </th>";
    echo "<th> Number of usages </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($result as $row){
        echo "<tr>";
        echo  "<td> ".$row["en"]." </td>";
        echo "<td> ".$row["pocet"]." </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    ?>
</div>

<footer class="page-footer font-small mt-5">
    <div class="footer-copyright text-center py-3">
        Copyright &copy; 2020 Simona Lopatniková, Petra Kirschová, Matúš Hudák, Veronika Szabóová<br>
        Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
    </div>
</footer>

</body>

</html>


