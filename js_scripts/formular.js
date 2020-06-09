/******************************* zadavanie prikazu do Octave [Matus, Petra] ******************************/
var outPut;
var input;

function getValue(lang) {
    var endpoint = "octave/api/command";
    var apiKey = document.getElementById("apiKey").value;
    //zakodovanie vstupu
    input = encodeURIComponent( document.getElementById("formularId").value).replace(/'/g, "%27") ;

    console.log(endpoint + "?input=" +input + "&apiKey=" + apiKey);

    $.get({
        url: endpoint + "?input=" +input + "&apiKey=" + apiKey,
        success: function (data) {
            //nacitanie dat z octave

            outPut = data.response;

            var toPrint = "";

            for (var i in outPut){
                toPrint += outPut[i]+"<br>";
            }
            if (lang === 'en'){
                if(outPut.length === 0){
                    toPrint = "You entered incorrect command";
                }
            }else{
                if (outPut.length === 0){
                    toPrint = "Zadali ste nesprávny príkaz";
                }
            }
            document.getElementById("report").innerHTML = "<pre>"+toPrint+"</pre>";
        }
    });

}
