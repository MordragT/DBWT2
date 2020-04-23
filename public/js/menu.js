let htmlMenu = document.createElement("ul");
document.body.appendChild(htmlMenu);

let menuItems = ["Home", "Kategorien", "Verkaufen"];
let menuDropdowns = [["Unternehmen", "Philosophie", "Karriere"]];

for(let item of menuItems) {
    let li = document.createElement("li");
    htmlMenu.appendChild(li);
    let a = document.createElement("button");
    li.appendChild(a);
    a.innerText = item;
    a.className = "menu-item";
}

for(let dropdown of menuDropdowns) {
    let button = document.createElement("button");
    htmlMenu.appendChild(button);
    button.innerText = dropdown[0];
    button.className = "menu-dropdown-button"
    let container = document.createElement("div");
    htmlMenu.appendChild(container);
    //container.id = dropdown[0].toLowerCase();
    container.style.display = "none";

    dropdown.forEach(function(value, index) {
        if(index != 0) {
            let item = document.createElement("a");
            container.appendChild(item);
            item.innerText = value;
            item.className = "menu-dropdown-item";
        }
    });

    button.onclick = function() {
        if(container.style.display == "none") {
            container.style.display = "inline";
        } else {
            container.style.display = "none";
        }
    }
}



function hideDropdown() {
    let dropdownItems = document.getElementsByClassName("menu-dropdown-item");
    for(let item of dropdownItems) {
        item.style.display="none";
    }
}
