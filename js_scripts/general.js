/******************************* pomocne funkcie [Petra] ******************************/

//prepinanie vlastnosti "display"
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

//prepinanie vlastnosti "visibility"
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


//prevod z radianov na stupne
function rad2deg(radians){
    return radians * (180/Math.PI);
}