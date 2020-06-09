<!-- uvodna stranka - EN -->

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

        <script src="js_scripts/general.js"></script>
        <script src="js_scripts/formular.js"></script>
        <title>Home</title>
    </head>

    <body>
        <header class="navbar-light bg-light">
            <h1>HOME</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                <ul class="nav navbar-nav">
                    <li class="active nav-item"><a href="index_english.php" class="nav-link">HOME</a></li>
                    <li class="nav-item"><a href="command_english.php" class="nav-link">EXECUTE COMMAND</a></li>
                    <li class="nav-item"><a href="ballbeam_english.php" class="nav-link">BALL</a></li>
                    <li class="nav-item"><a href="plane_english.php" class="nav-link">PLANE</a></li>
                    <li class="nav-item"><a href="pendulum_english.php" class="nav-link">PENDULUM</a></li>
                    <li class="nav-item"><a href="damping_english.php" class="nav-link">CAR</a></li>
                    <li class="nav-item"><a href="statistika_english.php" class="nav-link">STATISTIC</a></li>
                    <li class="nav-item"><a href="documentation_english.php" class="nav-link">DOCUMENTATION</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">SK</a></li>
                </ul>
            </nav>
        </header>

        <h3 class="text-center mt-5">Export logs</h3>
        <div class="d-flex justify-content-center mt-3 mb-5">
            <a href="export/exportToCSV.php?lang=en"><input type="submit" class="btn btn-primary" name="exportCSV" id="exportCSV" value="Export logs to CSV"></a>
            <a href="export/exportToPDF.php?lang=en"> <input type="submit" class="btn btn-primary" name="exportPDF" id="exportPDF" value="Export logs to PDF"></a>
        </div>

        <hr>
        <div class="d-flex justify-content-center mt-3 mb-5">
            <p>All types of the animations have their own type what helps us determine which animation do we want to run.
                <br>
                These commands run once we change the starting number. If we open Inspect in our browser the logs from the commands can be found under the Console tab.
                <br>
                Example after changing the starting number to 20:<br>
                <i>Ball, Pendulum, Car</i><br>
                <b>octave/api/animation?type=ballbeam&position=0.2&newInput=[0,0,0,0]&apiKey=Strong12Key</b><br>
                Difference between the commands is the part after type=. In case of the balls you can see on the example it is set to ballbeam,<br> in case of pendulum it will be pendulum and in case of the car it will be set to car.<br> The number we entered to the field is saved in the position, now we set it to 20 so position=0.2.
                <br>
                <i>Plane:</i><br>
                <b>octave/api/animation?type=plane&position=-0.2&newInput=[0,0,0]&apiKey=Strong12Key</b><br>
                The plane is a little bit different since we wanted to have positive numbers when the plane is taking off and negative numbers when going down<br> so we needed to change them up, that is why the 20 we filled into the field is set to -0.2 in the command.
                <br><br>
                <b>octave/api/command?input=1%2B1&apiKey=Strong12Key</b><br>
                Function returns result from octave after executing the specified command that was set in the field. <br>In the example you can see we put 1+1 into the field and pressed Execute command. The result was ans=2.</p>
        </div>
        <hr>

        <h3 class="text-center mt-5">Task division</h3>
        <div class="d-flex justify-content-center mt-3 mb-5">
            <table class="table table-bordered" style="width:70%">
                <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>Simona Lopatniková</th>
                    <th>Petra Kirschová</th>
                    <th>Veronika Szabóová</th>
                    <th>Matúš Hudák</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="description">Api</td>
                    <td class="check">&#10004;</td>
                    <td class="check">&#10004;</td>
                    <td class="check">&#10004;</td>
                    <td class="check">&#10004;</td>
                </tr>
                <tr>
                    <td class="description">Animation - ball and beam</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Animation - plane</td>
                    <td></td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Animation - pendulum</td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Animation - car</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="check">&#10004;</td>
                </tr>
                <tr>
                    <td class="description">Octave command execution</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                </tr>
                <tr>
                    <td class="description">Statistics + send e-mail</td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Logging + export logs to csv, pdf</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Api description + export to pdf</td>
                    <td></td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Technical documentation</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>

        </div>



        <footer class="page-footer font-small mt-5 bg-light">
            <div class="footer-copyright text-center py-3">
                Copyright &copy; 2020 Simona Lopatniková, Petra Kirschová, Matúš Hudák, Veronika Szabóová<br>
                Faculty of Electrical Engineering and Information Technology STU in Bratislava
            </div>
        </footer>

    </body>

</html>



