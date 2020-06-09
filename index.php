<!-- uvodna stranka -->

<?php

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
        <title>Domov</title>
    </head>

    <body>
        <header class="navbar-light bg-light">
            <h1>DOMOV</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
                <ul class="nav navbar-nav">
                    <li class="active nav-item"><a href="index.php" class="nav-link">DOMOV</a></li>
                    <li class="nav-item"><a href="command.php" class="nav-link">SPUSTIŤ PRÍKAZ</a></li>
                    <li class="nav-item"><a href="ballbeam.php" class="nav-link">GULIČKA</a></li>
                    <li class="nav-item"><a href="plane.php" class="nav-link">LIETADLO</a></li>
                    <li class="nav-item"><a href="pendulum.php" class="nav-link">KYVADLO</a></li>
                    <li class="nav-item"><a href="damping.php" class="nav-link">AUTO</a></li>
                    <li class="nav-item"><a href="statistika.php" class="nav-link">ŠTATISTIKA</a></li>
                    <li class="nav-item"><a href="documentation.php" class="nav-link">DOKUMENTÁCIA</a></li>
                    <li class="nav-item"><a href="index_english.php" class="nav-link">EN</a></li>
                </ul>
            </nav>
        </header>


        <h3 class="text-center mt-5">Export logov</h3>
        <div class="d-flex justify-content-center mt-3 mb-5">
            <a href="export/exportToCSV.php?lang=sk"><input type="submit" class="btn btn-primary" name="exportCSV" id="exportCSV" value="Export logov do CSV"></a>
            <a href="export/exportToPDF.php?lang=sk"> <input type="submit" class="btn btn-primary" name="exportPDF" id="exportPDF" value="Export logov do PDF"></a>
        </div>

        <hr>
        <h3 class="text-center mt-5">Popis API</h3>
        <div class="d-flex justify-content-center mt-3 mb-5">
        <p>Všetky možnosti animácie: gulička, lietadlo, kývadlo aj auto majú vlastný typ, pomocou čoho sa naša aplikácia rozhoduje ktorý príkaz ideme vykonať.
            <br>
        Tieto príkazy zbehnú, ak sa pristúpime k animáciám a zmeníme počiatočnú hodnotu. Ak otvoríme inspect stránky tak tieto výpisy nájdeme v Console.
        <br>
            Príklad na výpisy po zadaní hodnoty 20:<br>
        <i>Gulička, Kyvadlo, Auto</i><br>
        <b>octave/api/animation?type=ballbeam&position=0.2&newInput=[0,0,0,0]&apiKey=Strong12Key</b><br>
        Zmena medzi príkazmi je hodnota za type =. V prípade gulicky sa tam doplní hodnota ballbeam, v prípade kyvadla a v prípade auta tam ide car. <br>Zadaná hodnota sa uloží do position, teda ak sme zadali 20, tak sa to uloží ako position=0.2.
            <br>
        <i>Lietadlo:</i><br>
        <b>octave/api/animation?type=plane&position=-0.2&newInput=[0,0,0]&apiKey=Strong12Key</b><br>
        V prípade lietadla hodnoty position sú obrátené. Ak do poľa zadáme hodnotu 20, tak príklad zbehne s hodnotou -20, <br>aby pri kladných hodnotách lietadlo išiel hore, a pri záporných išiel dole.
            <br><br>
        <b>octave/api/command?input=1%2B1&apiKey=Strong12Key</b><br>
            Funkcia vráti výsledok z octave po vykonaní zadaného príkazu. Na príklade vidíme ako vyzerá ak zadám 1+1 do pola. Výsledná hodnota je ans = 2</p>
        </div>

        <div class="d-flex justify-content-center mt-3 mb-5">
            <a href="export/nikaExportSK.php"> <input type="submit" class="btn btn-primary" name="exportNika" id="exportNika" value="Exportovať informácie do PDF"></a>
        </div>
        <hr>
        <h3 class="text-center mt-5">Rozdelenie úloh</h3>
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
                    <td class="description">Animácia - gulička</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Animácia - lietadlo</td>
                    <td></td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Animácia - kyvadlo</td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Animácia - auto</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="check">&#10004;</td>
                </tr>
                <tr>
                    <td class="description">Spustenie octave príkazu</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                </tr>
                <tr>
                    <td class="description">Štatistika + odoslanie e-mailu</td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Zápis logov do databázy + export logov do csv, pdf</td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Popis api + export do pdf</td>
                    <td></td>
                    <td></td>
                    <td class="check">&#10004;</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="description">Technická dokumentácia</td>
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
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
            </div>
        </footer>


    </body>

</html>



