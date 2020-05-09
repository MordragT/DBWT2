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

function addWarenkorbClicked(event){
    let buy_button = event.target;
    let article = buy_button.parentElement.parentElement;

    // Wäre natürlich schöner wenn man den Reihen Klassennamen geben würde
    let article_infos = article.getElementsByTagName('td');
    article_name = article_infos[1].innerText;
    article_price = article_infos[2].innerText;

    console.log(article_name, article_price);
    addArticleToWarenkorb(article_name,article_price);
}

function addArticleToWarenkorb(article_name,article_price){

    // Auf Duplikat überprüfen
    let warenkorb_artikel = document.getElementById("warenkorb_table").getElementsByTagName("td");
    for(let i = 0; i < warenkorb_artikel.length; i++){
        if(warenkorb_artikel[i].innerText === article_name){
            return;
        }
    }

    let tr = document.createElement("tr");

    let td_name = document.createElement("td");
    td_name.innerText = article_name;

    let td_price = document.createElement("td");
    td_price.innerText = article_price;

    let td_delete = document.createElement("td");

    let delete_button = document.createElement("button");
    delete_button.innerText = "-";
    delete_button.addEventListener('click',removeWarenkorbClicked);

    td_delete.appendChild(delete_button);
    tr.appendChild(td_name);
    tr.appendChild(td_price);
    tr.appendChild(td_delete);
    document.getElementById("warenkorb_table").appendChild(tr);
}

function removeWarenkorbClicked(event) {
    let delete_button = event.target;
    let tr_article = delete_button.parentElement.parentElement;
    tr_article.remove();

}

// M3_Aufgabe_4
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
