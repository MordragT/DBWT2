let warenkorb_title = document.createElement("h3");
warenkorb_title.innerText = "Warenkorb";
warenkorb_title.style.marginTop = "50px";

// Warenkorb Tabelle erzeugen
let div_table = document.createElement("div");
let table = document.createElement("table");
table.setAttribute("class","table table-striped");
table.setAttribute("id","warenkorb_table");
let tr_head = document.createElement("tr");

function th_warenkorb(name){
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
th_warenkorb_articles.setAttribute("class","col");
th_warenkorb_articles.innerText = "Warenkorb";
document.getElementById('table_head').appendChild(th_warenkorb_articles);

// Insert Data into new column
let buy_articles = document.getElementsByClassName('buy_object');

for (let i = 0; i < buy_articles.length; i++ ){

    // create "+" button with click event
    let buy_button = document.createElement("button");
    buy_button.setAttribute("class","buy_button");
    buy_button.innerText = "+";
    buy_button.addEventListener('click',addWarenkorbClicked);

    let td_button = document.createElement("td");
    td_button.appendChild(buy_button);

    buy_articles[i].appendChild(td_button);

}

aktualisiereWarenkorb();

function addWarenkorbClicked(event){
    let buy_button = event.target;
    let article = buy_button.parentElement.parentElement;

    // Wäre natürlich schöner wenn man den Reihen Klassennamen geben würde
    let article_infos = article.getElementsByTagName('td');

    // Artikel in DB einfügen
    article_id = article_infos[0].innerText;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', "/api/shoppingcart",true);
    xhr.setRequestHeader('Content-Type',
        'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                aktualisiereWarenkorb();
            } else {
                console.error(xhr.statusText);
            }
        }
    };
    xhr.send('id=' + article_id);

}

function aktualisiereWarenkorb(){

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

function warenkorbAusgabe(items){

    t_body_r = table.getElementsByTagName('tbody');
    if(t_body_r[0] != null) {
        t_body_r[0].remove();
    }

    let t_body = document.createElement("tbody");
    table.appendChild(t_body);

    for(let i = 0; i < items.length; ++i) {

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
        td_warenkorb.style="display:none";

        let delete_button = document.createElement("button");
        delete_button.innerText = "-";
        delete_button.addEventListener('click',removeWarenkorbClicked);

        td_delete.appendChild(delete_button);
        tr.appendChild(td_id);
        tr.appendChild(td_name);
        tr.appendChild(td_price);
        tr.appendChild(td_delete);
        tr.appendChild(td_warenkorb);
        //document.getElementById("warenkorb_table").appendChild(tr);
        t_body.appendChild(tr);
    }

}

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
                console.log(xhr.responseText);
                aktualisiereWarenkorb();
            } else {
                console.error(xhr.statusText);
            }
        }
    };
    xhr.send();

}

// Aufgabe 4
/*
var xhr = new XMLHttpRequest();
xhr.open('DELETE', "./api/article/32");
xhr.setRequestHeader('Content-Type',
    'application/json');
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        } else {
            console.error(xhr.statusText);
        }
    }
};
xhr.send();
*/
