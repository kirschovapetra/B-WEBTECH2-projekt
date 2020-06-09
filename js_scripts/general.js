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