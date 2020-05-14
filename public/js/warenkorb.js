let warenkorb_title = document.createElement("h3");
warenkorb_title.innerText = "Warenkorb";
warenkorb_title.style.marginTop = "50px";

// Warenkorb Tabelle erzeugen
let div_table = document.createElement("div");
let table = document.createElement("table");
table.setAttribute("class", "table table-striped");
table.setAttribute("id", "warenkorb_table");
let tr_head = document.createElement("tr");

function th_warenkorb(name) {
    let th = document.createElement("th");
    th.innerText = name;
    th.style.paddingRight = "20px";
    tr_head.appendChild(th);
}

th_warenkorb("ID");
th_warenkorb("Name");
th_warenkorb("Price");
th_warenkorb(" ");
table.appendChild(tr_head);

document.getElementById("main").prepend(div_table);
div_table.appendChild(warenkorb_title);
div_table.appendChild(table);

// Füge eine neue Tabellenüberschrift bei den Artikeln hinzu
let th_warenkorb_articles = document.createElement("th");
th_warenkorb_articles.setAttribute("class", "col");
th_warenkorb_articles.innerText = "Warenkorb";
document.getElementById('table_head').appendChild(th_warenkorb_articles);

// Insert Data into new column
let buy_articles = document.getElementsByClassName('buy_object');

for (let i = 0; i < buy_articles.length; i++) {

    // create "+" button with click event
    let buy_button = document.createElement("button");
    buy_button.setAttribute("class", "buy_button");
    buy_button.innerText = "+";
    buy_button.addEventListener('click', addWarenkorbClicked);

    let td_button = document.createElement("td");
    td_button.appendChild(buy_button);
    buy_articles[i].appendChild(td_button);

}

// Füge Artikel in der Datenbank ein und aktualisiere die Ausgabe des Warenkorbs
function addWarenkorbClicked(event) {
    console.log("TEST");
    let buy_button = event.target;
    let article = buy_button.parentElement.parentElement;

    // Wäre natürlich schöner wenn man den Reihen Klassennamen geben würde
    let article_infos = article.getElementsByTagName('td');

    article_id = article_infos[0].innerText;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', "/api/shoppingcart");
    xhr.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                alert("Artikel wurde erfolgreich Ihrem Warenkorb hinzugefügt ");
                aktualisiereWarenkorb();
            } else {
                alert("FEHLER");
                console.error(xhr.statusText);
            }
        }
    };
    xhr.send('id=' + article_id);

    if (isLoggedIn()) {
        aktualisiereWarenkorb();
    }
}

// Ruft die passenden Warenkorb Artikel aus der Datenbank raus und
// ruft mit diesen als Parameter die Funktion warenkorbAusgabe auf
function aktualisiereWarenkorb() {

    var xhr = new XMLHttpRequest();
    xhr.open('GET', "/shoppingcart_items");
    xhr.setRequestHeader('Content-Type',
        'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let items = JSON.parse(xhr.responseText);
                console.log(items);
                warenkorbAusgabe(items);
            } else {
                console.error(xhr.statusText);
            }
        }
    };
    xhr.send();
}

// Gibt die gegebenen Warenkorb Artikel im Parameter auf der Benutzeroberfläche aus
function warenkorbAusgabe(items) {

    //Lösche den body der Tabelle, falls er schon existiert
    t_body_r = table.getElementsByTagName('tbody');
    if (t_body_r[0] != null) {
        t_body_r[0].remove();
    }

    let t_body = document.createElement("tbody");
    table.appendChild(t_body);

    for (let i = 0; i < items.length; ++i) {

        let tr = document.createElement("tr");

        let td_id = document.createElement("td");
        td_id.innerText = items[i]['ab_article_id'];

        let td_name = document.createElement("td");
        td_name.innerText = items[i]['ab_name'];

        let td_price = document.createElement("td");
        td_price.innerText = items[i]['ab_price'];

        let td_delete = document.createElement("td");

        let td_warenkorb = document.createElement("td");
        td_warenkorb.innerText = items[i]['ab_shoppingcart_id'];
        td_warenkorb.style = "display:none";

        let delete_button = document.createElement("button");
        delete_button.innerText = "-";
        delete_button.addEventListener('click', removeWarenkorbClicked);

        td_delete.appendChild(delete_button);
        tr.appendChild(td_id);
        tr.appendChild(td_name);
        tr.appendChild(td_price);
        tr.appendChild(td_delete);
        tr.appendChild(td_warenkorb);

        t_body.appendChild(tr);
    }

}

// Löscht den Warenkorbartikel aus der Datenbank
function removeWarenkorbClicked(event) {

    let delete_button = event.target;
    let tr_article = delete_button.parentElement.parentElement;
    let td_article = tr_article.getElementsByTagName('td');
    let td_id = td_article[0].innerText;
    let td_warenkorb = td_article[4].innerText;

    var xhr = new XMLHttpRequest();
    xhr.open('DELETE', "/api/shoppingcart/" + td_warenkorb + "/articles/" + td_id);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                aktualisiereWarenkorb();
            } else {
                console.error(xhr.statusText);
                alert(xhr.responseText);
            }
        }
    };
    xhr.send();

    if (isLoggedIn()) {
        aktualisiereWarenkorb();
    }
}

function isLoggedIn() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/isloggedin");
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                return true;
            } else {
                return false;
            }
        }
    }
}
