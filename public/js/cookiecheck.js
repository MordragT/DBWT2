let localStorage = window.localStorage;
//RESET COOKIEANFRAGE
//localStorage.removeItem('cookie_enabled');

if(localStorage.getItem("cookie_enabled") === null){
    localStorage.setItem("cookie_enabled", "false");
}

if(localStorage.getItem("cookie_enabled") === "false"){

    var p1 = document.createElement('p');
    p1.innerText = "Sind Sie mit der Verwendung von Cookies einverstanden ? ";

    var button_yes = document.createElement('button');
    button_yes.setAttribute('class',"button_position");
    button_yes.innerText = "JA";
    button_yes.onclick = function() {   localStorage.setItem("cookie_enabled", "true");
        document.getElementById("cookie_query").style.display = "none";
    };

    var button_no = document.createElement('button');
    button_no.setAttribute('class',"button_position");
    button_no.innerText = "NEIN";
    button_no.onclick = function() {   document.getElementById("cookie_query").style.display = "none"; };

    document.getElementById("cookie_query").appendChild(p1);
    document.getElementById("cookie_query").appendChild(button_yes);
    document.getElementById("cookie_query").appendChild(button_no);
}
