// // Matus formular

var outPut;
var apiKey = "Strong12Key";
var input;
var res;

function getValue() {
    var endpoint = "octave/api/command";
    res = escape( document.getElementById("formularId").value) ;
    input = encodeURIComponent(res);
    console.log(input);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //nacitanie dat z octave
            var data = JSON.parse(this.responseText);

            outPut = data.response;
            console.log(outPut);

            document.getElementById("report").innerHTML = outPut;
        }
    };
    //get request na octave api
    var url = endpoint + "?input=" +input + "&apiKey=" + apiKey;
    console.log(url);
    xhttp.open("GET", url, true);
    xhttp.send();
}
