/************************************* Ball & beam [Petra] *************************************/

var times = []
var positions = [];
var angles = [];
var newInput = [0,0,0,0];
var index = 0;
var interval = null;
var alreadyPlayed = false;

//vykreslenie grafov
function plot(lang){
    var trace1 = {
        x: times,
        y: positions,
        mode: 'lines',
        type: 'scatter',
        line: {'shape': 'spline', 'smoothing': 1.3}
    };

    var trace2 = {
        x: times,
        y: angles,
        mode: 'lines',
        type: 'scatter',
        line: {'shape': 'spline', 'smoothing': 1.3}
    };


    var data1 = [trace1];
    var data2 = [trace2];

    var layout1,layout2;

    if (lang === 'en'){
        layout1 = {
            title:'Ball position',
            xaxis:{
                title:"Time [s]"
            },
            yaxis:{
                title:"Position [m]"
            }
        };
        layout2 = {
            title:'Beam angle in radians',
            xaxis:{
                title:"Time [s]"
            },
            yaxis: {
                showexponent: 'all',
                exponentformat: 'e',
                title:"Angle [rad]"
            }
        };
    }
    else {
        layout1 = {
            title:'Poloha guličky',
            xaxis:{
                title:"Čas [s]"
            },
            yaxis:{
                title:"Poloha [m]"
            }
        };
        layout2 = {
            title:'Výchylka uhla v radiánoch',
            xaxis:{
                title:"Čas [s]"
            },
            yaxis: {
                showexponent: 'all',
                exponentformat: 'e',
                title:"Uhol [rad]"
            }
        };
    }



    Plotly.newPlot('positionGraph', data1, layout1);
    Plotly.newPlot('angleGraph', data2, layout2);
}

function changePosition(lang){
    var endpoint = "http://147.175.121.210:8056/zaver_zad/octave/api/animation";

    //tooltip - defaultne nie je viditelny
    $('#positionInput').tooltip({trigger:"manual"}).tooltip('hide');

    //nacitanie vstupu
    var position = document.getElementById("positionInput").value;

    //rozsah pozicie je 0-100
    if (!isNaN(position) && position>=0 && position<=100) {

        //prevod pozicie z cm na m
        position/=100;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //nacitanie dat z octave
                var data = JSON.parse(this.responseText);

                newInput = data.newInput;
                positions = data.positions;
                angles = data.angles;
                times = data.times;

                plot(lang); //grafy

                //spustenie casovaca - posuvanie gulicky
                index = 0;
                alreadyPlayed = false;
                interval = setInterval(move,30);
            }
        };

        //get request na octave api
        var url = endpoint+"?type=ballbeam&position=" + position + "&newInput=" + JSON.stringify(newInput);
        console.log(url);
        xhttp.open("GET", url, true);
        xhttp.send();
    }
    else {
        //tooltip sa zobrazi ked sa zadaju nespravne hodnoty
        $('#positionInput').tooltip('show');
    }
}

//prevod z radianov na stupne
function rad2deg(radians){
    return radians * (180/Math.PI);
}

//posun lopticky
function move(){
    //ked prejde cele pole, tak sa vynuluje stav
    if(index >= positions.length){
        index = 0;
        alreadyPlayed = true;
        clearInterval(interval);
    }

    if (!alreadyPlayed) {
        var translation = positions[index] * 600 + 25 + 9; //hodnota z octave upravena aby sa zmestila do svg
        var rotation = rad2deg(angles[index]); //hodnota z octave

        document.getElementById("ballbeam").style.transformOrigin = "left center"; //bod rotacie tyce
        document.getElementById("ballbeam").style.transform = "rotate("+rotation*100+"deg)"; //rotacia
        document.getElementById("ball").setAttribute('cx', translation + "px"); //presun gulicky na novu x suradnicu
        index++;
    }
}

//prepinanie zobrazenia animacie a grafov
function toggle(check,target) {
    var targets = target.split(","); //target moze mat aj viacero poloziek oddelenych ciarkou (napr. 'positionGraph,angleGraph')

     if (check.checked){
         for (var i in targets)
             document.getElementById(targets[i]).style.display="block";
    }
    else {
        for (var i in targets)
            document.getElementById(targets[i]).style.display="none";
    }
}
