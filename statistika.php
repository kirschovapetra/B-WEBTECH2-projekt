<!-- statistika [Simona]-->

<?php
require "config.php";

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <title>Štatistika</title>
</head>

<body>
<header class="navbar-light bg-light">
    <h1>ŠTATISTIKA</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link">DOMOV</a></li>
            <li class="nav-item"><a href="command.php" class="nav-link">SPUSTIŤ PRÍKAZ</a></li>
            <li class="nav-item"><a href="ballbeam.php" class="nav-link">GULIČKA</a></li>
            <li class="nav-item"><a href="plane.php" class="nav-link">LIETADLO</a></li>
            <li class="nav-item"><a href="pendulum.php" class="nav-link">KYVADLO</a></li>
            <li class="nav-item"><a href="damping.php" class="nav-link">AUTO</a></li>
            <li class="active nav-item"><a href="statistika.php" class="nav-link">ŠTATISTIKA</a></li>
            <li class="nav-item"><a href="documentation.php" class="nav-link">DOKUMENTÁCIA</a></li>
            <li class="nav-item"><a href="statistika_english.php" class="nav-link">EN</a></li>
        </ul>
    </nav>
</header>

<div class="d-flex justify-content-center mt-5">
    <?php
    $select = "SELECT * FROM statistika";
    $result = $db->query($select);
    echo "<div class='tabulka'>";
    echo "<table class=\"table table-bordered\">";
    echo "<thead>";
    echo "<tr>";
    echo  "<th> Model </th>";
    echo "<th> Počet spustení </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($result as $row){
        echo "<tr>";
        echo  "<td> ".$row["sk"]." </td>";
        echo "<td> ".$row["pocet"]." </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    ?>

</div>

<div class="d-flex justify-content-center mt-5 align-content-center flex-wrap form-inline">
    <label><b>email: </b><input class="form-control" type="email" placeholder="Zadajte mail" id="email"></label>
    <button class="btn btn-primary" onclick="posliMail()">Odoslať</button>
</div>
<div class="d-flex justify-content-center mt-1 mb-5 align-content-center flex-wrap">
    <p id="mail">Mail bol úspešne odoslaný :) Prosím, skontrolujte si spam.</p>
    <p id="chyba_mailu">Neplatný mail</p>
</div>


<footer class="page-footer font-small mt-5 bg-light">
    <div class="footer-copyright text-center py-3">
        Copyright &copy; 2020 Simona Lopatniková, Petra Kirschová, Matúš Hudák, Veronika Szabóová<br>
        Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
    </div>
</footer>

<script>
    $("#mail").hide();
    $("#chyba_mailu").hide();
    function posliMail(){
        mail_value = document.getElementById('email').value;
        reg = /^[A-Za-z0-9._%+-]{1,}@[a-zA-Z]{1,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})$/;

        if (reg.test(mail_value) == false) {
            $("#chyba_mailu").show();
            return;
        } else {
            $("#chyba_mailu").hide();
        }

        $.ajax({
            url: "posliMail.php",
            method: "POST",
            data: {jazyk: document.getElementsByTagName('html')[0]['lang'], email: mail_value},
            success: function () {
                $("#mail").show();
            }
        })
    }

</script>
</body>

</html>



