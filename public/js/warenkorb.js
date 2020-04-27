// Warenkorb Inhalt anzeigen lassen
let table = document.createElement("table");
table.setAttribute("id","warenkorb_table");

let tr_head = document.createElement("tr");
tr_head.innerHTML = "<th> Name </th> <th> Price </th> <th> Delete </th>";

table.appendChild(tr_head);
document.getElementById("warenkorb").appendChild(table);

// Füge eine neue Tabellenüberschrift hinzu
let th_warenkorb = document.createElement("th");
th_warenkorb.setAttribute("class","col");
th_warenkorb.innerText = "Warenkorb";
let table_head = document.getElementById('table_head').appendChild(th_warenkorb);

// Store all table rows
let buy_articles = document.getElementsByClassName('buy_object');

for (let i = 0; i < buy_articles.length; i++ ){

    // create "+" button with click event
    let buy_button = document.createElement("button");
    buy_button.setAttribute("class","buy_button");
    buy_button.innerText = "+";
    buy_button.addEventListener('click',addWarenkorbClicked);


    // create column
    let td_button = document.createElement("td");
    td_button.appendChild(buy_button);

    // append column to table row
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
