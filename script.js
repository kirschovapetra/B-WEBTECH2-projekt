
var times = [];
var positions = [];
var angles = [];
var newInput = [0,0,0,0];
var index = 0;
var interval = null;
var alreadyPlayed = false;

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
    $('#positionInput').tooltip({trigger:"manual"});

    $('#positionInput').tooltip('hide');

    var position = document.getElementById("positionInput").value;
    if (position != null && !isNaN(position) && position>=0 && position<=100) {

        position/=100;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
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
        console.log(url);
        xhttp.open("GET", url, true);
        xhttp.send();
    }
    else {
        $('#positionInput').tooltip('show');
    }
}

function rad2deg(radians){
    return radians * (180/Math.PI);
}

function animate(){

    if(index >= positions.length){
        index = 0;
        alreadyPlayed = true;
        clearInterval(interval);
    }

    if (!alreadyPlayed) {
        var translation = positions[index] * 600 + 25 + 9;
        var rotation = rad2deg(angles[index]);

        document.getElementById("ballbeam").style.transformOrigin = "left center";
        document.getElementById("ballbeam").style.transform = "rotate("+rotation*100+"deg)";
        document.getElementById("ball").setAttribute('cx', translation + "px");
        index++;
    }
}

function toggle(check,target) {
    var targets = target.split(",");

     if (check.checked){
         for (var i in targets)
             document.getElementById(targets[i]).style.display="block";
    }
    else {
        for (var i in targets)
            document.getElementById(targets[i]).style.display="none";
    }
}

