// document.getElementById("ball").setAttribute('cx', 0.25*600+25+4.5+"px");

var times = [];
var positions = [];
var angles = [];
var newInput = [0,0,0,0];
var index = 0;
var interval = null;
var alreadyPlayed = false;
//od 0 do 0.97
//document.getElementById("ball").setAttribute('cx', 0.25*600+25+9+"px");


function plot(){
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

    var layout1 = {
        title:'Poloha guličky'
    };
    var layout2 = {
        title:'Výchylka uhla v radiánoch',
        yaxis: {
            showexponent: 'all',
            exponentformat: 'e'
        }
    };

    Plotly.newPlot('myDiv', data1, layout1);
    Plotly.newPlot('myDiv2', data2, layout2);
}


function changePosition(){
    var position = document.getElementById("positionInput").value;
    if (position != null) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                console.log(data.newInput)
                newInput = data.newInput;
                positions = data.positions;
                angles = data.angles;
                times = data.times;
                plot();

                index = 0;
                alreadyPlayed = false;
                interval = setInterval(animate,30);

            }
        };
        var url = "octave.php?position=" + position+"&newInput="+JSON.stringify(newInput);

        xhttp.open("GET", url, true);
        xhttp.send();
    }
}

function rad2deg(radians)
{
    var pi = Math.PI;
    return radians * (180/pi);
}

function animate(){
    //1m ... 600px

    if(index >= positions.length){
        index = 0;
        alreadyPlayed = true;
        clearInterval(interval);
    }

    if (!alreadyPlayed) {
        var translation = positions[index] * 600 + 25 + 9;
        var rotation = rad2deg(angles[index]);
       // var rotation = Math.PI/6;

        document.getElementById("ballbeam").style.transformOrigin = "left center";
        document.getElementById("ballbeam").style.transform = "rotate("+rotation*100+"deg)";
        document.getElementById("ball").setAttribute('cx', translation + "px");

        console.log(rotation);
        // console.log("time: " + (index / 100).toFixed(2) + " index: " + index + " x:" + translation);
        index++;
    }
}