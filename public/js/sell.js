let main = document.getElementById("main");
let h1 = document.createElement("h1");
h1.innerText = "Verkaufen";
h1.className = "my-5";
main.appendChild(h1);
let form = document.createElement("form");
form.name = "sell";
form.method = "post";
main.appendChild(form);

let csrfToken = document.head.querySelector("meta[name='csrf-token']").content;

let formInnerHTML = '<input type="hidden" name="_token" value="' + csrfToken + '">';
formInnerHTML += "<div class='form-group'>";
formInnerHTML += "<label for='name'>Name</label>";
formInnerHTML += "<input class='form-control' type='text' id='name' name='name'>";
formInnerHTML += "</div>";
formInnerHTML += "<div class='form-group'>";
formInnerHTML += "<label for='name'>Beschreibung</label>";
formInnerHTML += "<textarea class='form-control' type='text' id='description' name='description'></textarea>";
formInnerHTML += "</div>";
formInnerHTML += "<div class='form-group'>";
formInnerHTML += "<label for='price'>Preis</label>";
formInnerHTML += "<input class='form-control' type='number' id='price' name='price'>";
formInnerHTML += "</div>";
formInnerHTML += "<button type='submit' class='btn btn-primary'>Abschicken</button>";

form.innerHTML = formInnerHTML;
//form.onsubmit = () {}

form.onsubmit = function validateForm() {
    let name = document.forms["sell"]["name"].value;
    let description = document.forms["sell"]["description"].value;
    let price = document.forms["sell"]["price"].value;
    if (name == "") {
        alert("Produktname muss angegeben werden");
        return false;
    } else if (description == "") {
        alert("Bitte beschreibe das Produkt kurz");
        return false;
    } else if (price == 0) {
        alert("Der Preis muss 0 überschreiten");
        return false;
    }
}