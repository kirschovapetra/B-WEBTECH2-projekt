// Matus

var times = [];
var carPositions = [];
var wheelPositions = [];
const MAX_VALUE = 30; //prekazka max hodnota
const MIN_VALUE = -20;   //prekazka min hodnota
var newInput = [0,0,0,0,0];
var index = 0;
var interval = null;
var alreadyPlayed = false;

//Graf
function graph(lang) {
    var nullGraph = {
        x: times,
        y: carPositions,
        mode: 'lines',
        type: 'scatter',
        line: {'shape': 'spline', 'smoothing': 1.3}
    };
    var nullGraph2 = {
        x: times,
        y: wheelPositions,
        mode: 'lines',
        type: 'scatter',
        line: {'shape': 'spline', 'smoothing': 1.3}
    };
    var data1 = [nullGraph];
    var data2 = [nullGraph2];
    var layout1,layout2;

    if (lang === 'en'){
        layout1={
            xaxis:{
                range: [ 0, 5.15 ],
                title: "Time [s]"
            },
            yaxis:{
                showexponent: 'all',
                exponentformat: 'e',
                title:"Obstacle size [m]"
            },
            title:'Car position',
        };

        layout2={
            xaxis:{
                range: [ 0, 5.15 ],
                title: "Time [s]"
            } ,
            yaxis: {
                showexponent: 'all',
                exponentformat: 'e',
                title: "Obstacle size [m]"
            },
            title: 'Wheel position',
        };
    }else {
        layout1={
            xaxis:{
                range: [ 0, 5.15 ],
                title: "Čas [s]"
            },
            yaxis:{
                showexponent: 'all',
                exponentformat: 'e',
                title:"Veľkosť prekážky [m]"
            },
            title:'Pozícia auta',
        };

        layout2={
            xaxis:{
                range: [ 0, 5.15 ],
                title: "Čas [s]"
            } ,
            yaxis: {
                showexponent: 'all',
                exponentformat: 'e',
                title: "Veľkosť prekážky [m]"
            },
            title: 'Pozícia kolesa',
        };
    }


    Plotly.newPlot('graph1',data1,layout1);
    Plotly.newPlot('graph2',data2,layout2);
}

function changeGraph(lang,keyIsValid){ //(lang,keyIsValid)
    var endpoint = "octave/api/animation";

    if (keyIsValid == true) {
        var apiKey = document.getElementById("apiKey").value;

        //tooltip - defaultne nie je viditelny
        $('#positionObstacle').tooltip({trigger: "manual"}).tooltip('hide');


        //nacitanie velkosti prekazky
        var obstacle = document.getElementById("positionObstacle").value;
        console.log(obstacle);

        if (!isNaN(obstacle) && obstacle >= MIN_VALUE && obstacle <= MAX_VALUE) {
            obstacle = obstacle / 100;

            var requestUrl = endpoint + "?type=car&position=" + obstacle + "&newInput=" + JSON.stringify(newInput) + "&apiKey=" + apiKey;
            console.log(requestUrl);

            //get request na octave api
            $.get({
                url: requestUrl,
                success: function (data) {
                    //nacitanie dat z octave
                    newInput = data.newInput;
                    carPositions = data.auto;
                    wheelPositions = data.koleso;
                    times = data.times;

                    graph(lang); //grafy

                    //spustenie casovaca
                    index = 0;
                    alreadyPlayed = false;
                    interval = setInterval(move, 45);
                }
            });

        } else {
            //tooltip sa zobrazi ked sa zadaju nespravne hodnoty
            $('#positionObstacle').tooltip('show');
        }
    }
}

//prevod z radianov na stupne
function rad2deg(radians){
    return radians * (180/Math.PI);
}

//posun kolesa
function move(){
    //ked prejde cele pole, tak sa vynuluje stav
    if(index >= carPositions.length){
        index = 0;
        alreadyPlayed = true;
        clearInterval(interval);
    }

    if (!alreadyPlayed) {
        //auto
        var carPosition = carPositions[index] * 21 +38 ; //hodnota z octave upravena aby sa zmestila do svg, 76.30546 poloha y osi
        var caretPosition2 = carPositions[index] * 21 +32;
        //kolesa
        var wheelPosition = wheelPositions[index] * 210 + 76.30546; //hodnota z octave

        document.getElementById("holder").setAttribute('y',carPosition + "px");
        //zelena vec
        document.getElementById("rect20").setAttribute('y',caretPosition2 + "px");
        //kolesa
        document.getElementById("wheelA").setAttribute('cy', wheelPosition + "px");
        document.getElementById("wheelB").setAttribute('cy', wheelPosition + "px");
        //biele kolesa
        document.getElementById("wheelBlankA").setAttribute('cy', wheelPosition + "px");
        document.getElementById("wheelBlankB").setAttribute('cy', wheelPosition + "px");

        index++;
    }
}

//prepinanie zobrazenia animacie a grafov
function toggleDisplay(show,target) {
    var targets = document.getElementsByClassName(target);

    if (show){
        for (var i = 0; i < targets.length; i++)
            targets[i].style.display="block";
    }
    else {
        for (var i = 0; i < targets.length; i++)
            targets[i].style.display="none";
    }
}

function toggleVisibility(show,target) {
    var targets = document.getElementsByClassName(target);

    if (show) {
        for (var i = 0; i < targets.length; i++)
            targets[i].style.visibility = "visible";
    } else {
        for (var i = 0; i < targets.length; i++)
            targets[i].style.visibility = "hidden";
    }
}