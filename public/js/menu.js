function Item(name, href, children) {
    this.name = name;
    this.href = href;
    this.children = children;
}

class Menu {
    constructor(items) {
        this.items = items;
        this.htmlMenu = document.createElement("ul");
        this.divhtmlMenu = document.createElement("div");
        this.htmlMenu.id = "menu";
        document.getElementById('main').prepend(this.divhtmlMenu);
        this.divhtmlMenu.append(this.htmlMenu);
        for (let item of this.items) {
            this.drawItem(item);
        }
    }
    drawItem(item) {
        let li = document.createElement("li");
        this.htmlMenu.appendChild(li);
        li.className = "menu-item";

        let button = document.createElement("a");
        li.appendChild(button);
        button.className = "menu-item-link"
        button.innerText = item.name;
        button.href = item.href;

        if (item.children.length > 0) {

            let container = document.createElement("ul");
            li.appendChild(container);
            container.className = "dropdown";
            container.style.display = "none";

            for (let child of item.children) {
                let li = document.createElement("li");
                container.appendChild(li);
                li.className = "menu-dropdown-item";

                let item = document.createElement("a");
                li.appendChild(item);
                item.className = "menu-item-link"
                item.innerText = child.name;
                item.href = child.href;
            }
            li.onmouseenter = () => container.style.display = "block";
            li.onmouseleave = () => container.style.display = "none";
            container.onmouseleave = () => container.style.display = "none";
        }
    }
    addItem(item) {
        this.items.push(item);
        this.drawItem(item);
    }
}

let menu = new Menu([
    new Item("Home", "/", []),
    new Item("Kategorien", "/", []),
    new Item("Verkaufen", "/sell", []),
    new Item("Unternehmen", "/", [
        new Item("Philosophie", "/", []),
        new Item("Karriere", "/", []),
    ]),
]);