<!-- uvodna stranka - EN [Simona]-->

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
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="js_scripts/general.js"></script>
    <script src="js_scripts/formular.js"></script>
    <title>Documentation</title>
</head>

<body>
<header class="navbar-light bg-light">
    <h1>DOCUMENTATION</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="index_english.php" class="nav-link">HOME</a></li>
            <li class="nav-item"><a href="command_english.php" class="nav-link">EXECUTE COMMAND</a></li>
            <li class="nav-item"><a href="ballbeam_english.php" class="nav-link">BALL</a></li>
            <li class="nav-item"><a href="plane_english.php" class="nav-link">PLANE</a></li>
            <li class="nav-item"><a href="pendulum_english.php" class="nav-link">PENDULUM</a></li>
            <li class="nav-item"><a href="damping_english.php" class="nav-link">CAR</a></li>
            <li class="nav-item"><a href="statistika_english.php" class="nav-link">STATISTIC</a></li>
            <li class="active nav-item"><a href="documentation_english.php" class="nav-link">DOCUMENTATION</a></li>
            <li class="nav-item"><a href="documentation.php" class="nav-link">SK</a></li>
        </ul>
    </nav>
</header>

<div class="text mt-4">
    <u>Authors:</u>
    <ul>
        <li>Petra Kirschová</li>
        <li>Simona Lopatniková</li>
        <li>Veronika Szabóová</li>
        <li>Matúš Hudák</li>
    </ul>
    <p>Github repository: <a href="https://github.com/pepak1234/webtech2">HERE</a></p>

    <u>Sendmail installation:</u> <br>
    <code>sudo apt-get install sendmail</code><br>
    <code>sudo sendmailconfig</code><br>

    <br><u>Edit /etc/hosts: </u><br>
    127.0.0.1 localhost <span class="zvyrazni">localhost.localdomain os-webtech3-1</span><br>

    <br><u>Octave installation: </u><br>
    <code>sudo apt install octave</code><br>

    <br><u>Inštalácia liboctave-dev (required to install packages from octave forge): </u><br>
    <code>sudo apt install liboctave-dev</code><br>

    <br><u>Control package installation: </u><br>
    <code>sudo pkg install -global -forge control</code><br>

    <br><p><u>Animations:</u></p>
    <p><b>Inverted Pendulum:</b></p>
    <ul>
        <li>input: required new position of the pendulum r</li>
        <li>output: current position of the pendulum x (:, 1)</li>
        <li>current pendulum angle (vertical bar inclination - angle in radians) x (:, 3)</li>
    </ul>
    <p><u>More details: </u> <a href="http://ctms.engin.umich.edu/CTMS/index.php?example=InvertedPendulum&section=SystemModeling">HERE</a></p>

    <p><b>Ball:</b></p>
    <ul>
        <li>input: required new position of the ball on the rod r</li>
        <li>output: current ball position N*x (:,1)</li>
        <li>current bar inclination (angle in radians) x(:,3)</li>
    </ul>
    <p><u>More details: </u> <a href="http://ctms.engin.umich.edu/CTMS/index.php?example=Suspension&section=SystemModeling">HERE</a></p>

    <p><b>Vehicle damping</b></p>
    <ul>
        <li>input: required height of the jump obstacle r</li>
        <li>output: current vehicle position x(:,1) </li>
        <li>current wheel position x(:,3)</li>
    </ul>
    <p><u>More details: </u> <a href="http://ctms.engin.umich.edu/CTMS/index.php?example=BallBeam&section=SystemModeling">HERE</a></p>

    <p><b>Plane: </b></p>
    <ul>
        <li>input: required new aircraft pitch r</li>
        <li>output: current aircraft pitch x(:,3)</li>
        <li>current tilt of the rear flap r*ones(size(t))*N-x*K'</li>
    </ul>
    <p><u>More details: </u> <a href="http://ctms.engin.umich.edu/CTMS/index.php?example=AircraftPitch&section=SystemModeling">HERE</a></p>
</div>


<footer class="page-footer font-small mt-5 bg-light">
    <div class="footer-copyright text-center py-3">
        Copyright &copy; 2020 Simona Lopatniková, Petra Kirschová, Matúš Hudák, Veronika Szabóová<br>
        Faculty of Electrical Engineering and Information Technology STU in Bratislava
    </div>
</footer>

</body>

</html>



