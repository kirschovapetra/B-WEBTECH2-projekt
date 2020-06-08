/************************************* Pendulum [Simona] *************************************/

var kyvadlo;
var canvas;
var auticko;
var t = 0.0;
var staraPozicia = 0;
var staryUhol = 0;
var pozicie = [];
var uhol = [];
var interval;
var zisti = false;
var newInput = [0, 0, 0, 0];
var jazyk;

const MAX_R = 20;
const ADRESA_API = "octave/api/animation";

//nastavenia
$(document).ready(function () {
    document.getElementById("graphs-container").style.display = "none";
    canvas = new fabric.Canvas('canvas');
    canvas.setHeight(500);
    canvas.setWidth(1500);
    canvas.setZoom(0.3);
    canvas.calcOffset();

    jazyk = document.getElementsByTagName('html')[0]['lang'];

    //tooltip - defaultne nie je viditelny
    $('#positionInput').tooltip({trigger: "manual"}).tooltip('hide');

    fabric.loadSVGFromURL('pendulum.svg', function(objects, options) {
            var pole = [];
            var pole2 = [];

            for (var obj of objects){
                if(obj.id == "kyvadlo"){
                    pole2.push(obj);
                    kyvadlo = fabric.util.groupSVGElements(pole2, options);
                    kyvadlo.centeredRotation = true;
                    var center = kyvadlo.getCenterPoint();
                    kyvadlo.originX = 0.5;
                    kyvadlo.originY = 1;
                    kyvadlo.left = center.x;
                    kyvadlo.top = center.y;
                    canvas.add(kyvadlo).renderAll();
                } else {
                    pole.push(obj);
                }

            }
            auticko = fabric.util.groupSVGElements(pole, options);
            canvas.add(auticko).renderAll();
        },
        function(item, object) {
            object.set("id",item.getAttribute('id'));
        }
    );


});

// spustenie animacie
function funkcia2() {
    t = 0;
    interval = setInterval(animacia,50);
}

//animacia
function animacia() {

    var i = Math.round(t/0.05);

    var novaPozicia = pozicie[i];
    var novyUhol = uhol[i];

    var posun = novaPozicia - staraPozicia;
    var posunUhla = novyUhol - staryUhol;

    if(t>10 || isNaN(posun)){
        clearInterval(interval);
        return;
    }

    staraPozicia = novaPozicia;
    staryUhol = novyUhol;

    t = t+0.05;

    auticko.set({left:auticko.get("left")+(posun*100)});

    kyvadlo.set({left:kyvadlo.get("left")+(posun*100)});
    kyvadlo.set({angle:kyvadlo.get("angle")-(posunUhla*(180/Math.PI))});

    // console.log("posun" + posun);
    canvas.renderAll();

}

function prepniZobrazenie(id){
    if(id === "graphs-container" && zisti === false){
        return;
    }
    var div = document.getElementById(id);
    var zobrazenie = div.style.display;
    if(zobrazenie == "none"){
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }

}

function spracovanieR() {
    var apiKey = document.getElementById("apiKey").value;
    var r = parseFloat(document.getElementById("positionInput").value);
    // console.log(ADRESA_API + "?type=pendulum&position=" + r + "&newInput=" + JSON.stringify(newInput));
    if(!isNaN(r)){
        if( r <= MAX_R && r >= 0) {

            $('#positionInput').tooltip({trigger: "manual"}).tooltip('hide');

            $.get({
                url: ADRESA_API + "?type=pendulum&position=" + r + "&newInput=" + JSON.stringify(newInput)+"&apiKey=" + apiKey,
                success: function (data) {
                    // console.log(data);

                    labels = data.times;
                    pozicie = data.positions;
                    uhol = data.angles;

                    newInput = data.newInput;

                    $("#line-chart").remove();
                    $("#graf").append("<canvas id=\"line-chart\" width=\"800\" height=\"450\"></canvas>");

                    if(jazyk == 'sk'){
                        new Chart(document.getElementById("line-chart"), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: pozicie,
                                    label: "Pozícia kyvadla",
                                    borderColor: "#3e95cd",
                                    fill: false
                                }, {
                                    data: uhol,
                                    label: "Uhol vychýlenia kyvadla v radiánoch",
                                    borderColor: "#c45850",
                                    fill: false
                                }
                                ]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: 'Inverzné kyvadlo'
                                }
                            }
                        });
                    }
                    else if(jazyk == 'en'){
                        new Chart(document.getElementById("line-chart"), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: pozicie,
                                    label: "Pendulum position",
                                    borderColor: "#3e95cd",
                                    fill: false
                                }, {
                                    data: uhol,
                                    label: "Pendulum angle in radians",
                                    borderColor: "#c45850",
                                    fill: false
                                }
                                ]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: 'Inverted pendulum'
                                }
                            }
                        });
                    }

                    document.getElementById("graphs-container").style.display = "block";
                    zisti = true;
                    funkcia2();
                }
            });
        }else {
            //tooltip sa zobrazi ked sa zadaju nespravne hodnoty
            $('#positionInput').tooltip('show');
        }
    }
}

function toggleVisibility(show,target) {
    var targets = document.getElementsByClassName(target);

    if (show){
        for (var i = 0; i < targets.length; i++)
            targets[i].style.visibility="visible";
    }
    else {
        for (var i = 0; i < targets.length; i++)
            targets[i].style.visibility="hidden";
    }
}