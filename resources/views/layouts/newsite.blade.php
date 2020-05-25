<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>NewSite</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet" />

</head>

<body>

    <div id="content" class="container">

        <siteheader></siteheader>

        <sitebody></sitebody>

        <sitefooter></sitefooter>

    </div>

    <!-- Warum nicht in template ? -->
    <!-- https://www.e-recht24.de/impressum-generator.html -->
    <!--script type="text/x-template" id="impressumhtml">
        <div v-if="this.$root.$data.impressumShow">
            <h1>Impressum</h1>

            <h2>Angaben gem&auml;&szlig; &sect; 5 TMG</h2>
            <p>Gruppe 16<br />
                Eupenerstra&szlig;e 70<br />
                52066 Aachen</p>

            <p><strong>Vertreten durch:</strong><br />
                Thomas Wehmoeller<br />
                Julien Ahn</p>

            <h2>Kontakt</h2>
            <p>Telefon: +49 (0) 123 44 55 66<br />
                Telefax: +49 (0) 123 44 55 99<br />
                E-Mail: mustermann@musterfirma.de</p>
        </div>
    </script-->

    <script>
        Vue.component('siteheader', {
            data: function() {
                return {}
            },
            template: '<menum></menum>'
        })

        Vue.component('sitebody', {
            data: function() {
                return {}
            },
            template: `<div>
                <br><br>
                <artikel></artikel>
                <impressum v-bind:visible="this.$root.$data.impressumVisible"></impressum>
            </div>`
        })

        Vue.component('sitefooter', {
            data: function() {
                return {}
            },
            template: '<button v-on:click="this.$root.toggleImpressum">Impressum</button>'
        })

        Vue.component("menu-dropdown-item", {
            props: {
                name: String,
                href: String,
            },
            template: `<li class="menu-dropdown-item">
                        <a class="menu-item-link" v-bind:href="this.href">@{{ this.name }}</a>
                    </li>`
        })

        Vue.component("menu-item", {
            props: {
                name: String,
                href: String,
            },
            data: function() {
                return {
                    dropdownVisible: false,
                    dropdownHovered: false
                }
            },
            methods: {
                showDropdown: function() {
                    this.dropdownVisible = true;
                },
                hideDropdown: function() {
                    if (!this.dropdownHovered) {
                        this.dropdownVisible = false;
                    }
                },
                setDropdownHovered: function(value) {
                    this.dropdownHovered = value;
                }
            },
            template: `<li class="menu-item" v-on:mouseenter="showDropdown" v-on:mouseleave="hideDropdown">
                        <a class="menu-item-link" v-bind:href="this.href">@{{ this.name }}</a>
                        <ul v-if="this.dropdownVisible" class="dropdown" v-on:mouseenter="setDropdownHovered(true)" v-on:mouseleave="setDropdownHovered(false)">
                            <slot></slot>
                        </ul>
                    </li>`
        })

        Vue.component('menum', {
            data: function() {
                return {}
            },
            template: `<ul id="menu">
                <menu-item name="Home" href="/"></menu-item>
                <menu-item name="Kategorien href="/"></menu-item>
                <menu-item name="Verkaufen" href="sell"></menu-item>
                <menu-item name="Unternehmen" href="/">
                    <menu-dropdown-item name="Philosophie" href="/"></menu-dropdown-item>
                    <menu-dropdown-item name="Karriere" href="/"></menu-dropdown-item>
                </menu-item>
           </ul>
           `
            /*
            data: function() {
                return {
                    items: [{
                            name: "Home",
                            href: "/",
                            children: []
                        },
                        {
                            name: "Kategorien",
                            href: "/",
                            children: []
                        },
                        {
                            name: "Verkaufen",
                            href: "sell",
                            children: []
                        },
                        {
                            name: "Unternehmen",
                            href: "/",
                            children: [{
                                    name: "Philosophie",
                                    href: "/",
                                    children: []
                                },
                                {
                                    name: "Karriere",
                                    href: "/",
                                    children: []
                                }
                            ]
                        }
                    ],
                    showdropd: "hidedropd"
                }
            },

            template: `<div>
                        <ul id="menu">

                        <template v-for="item in items">
                            <li class="menu-item" v-on:mouseenter="showdropd = 'showdropd'" v-on:mouseleave="showdropd = 'hidedropd'">
                                <a class="menu-item-link" v-bind:href="item.href"> @{{item.name}} </a>

                                <template v-if="item.children.length > 0">
                                    <ul v-bind:class="showdropd" class="dropdown">
                                        <template v-for="child in item.children">
                                            <li class="menu-dropdown-item">
                                                <a class="menu-item-link" v-bind:href="child.href">@{{ child.name }}</a>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                            </li>
                        </template>

                        </ul>
                    </div>`
            */
        })

        Vue.component('impressum', {
            props: {
                visible: false
            },
            data: function() {
                return {}
            },
            template: `<div v-if="this.visible">
                <h1>Impressum</h1>

                <h2>Angaben gem&auml;&szlig; &sect; 5 TMG</h2>
                <p>Gruppe 16<br />
                    Eupenerstra&szlig;e 70<br />
                    52066 Aachen</p>

                <p><strong>Vertreten durch:</strong><br />
                    Thomas Wehmoeller<br />
                    Julien Ahn</p>

                <h2>Kontakt</h2>
                <p>Telefon: +49 (0) 123 44 55 66<br />
                    Telefax: +49 (0) 123 44 55 99<br />
                    E-Mail: mustermann@musterfirma.de</p>
            </div>`
        })

        Vue.component("artikel", {
            template: `<div id="app">
                        <h2 class="my-2">Warenkorb</h2>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="col-1">ID</th>
                                    <th class="col-6">Name</th>
                                    <th class="col-3">Price</th>
                                    <th class="col-1">Warenkorb</th>
                                    <th class="col-1"></th>
                                </tr>
                            </thead>
                            <tr v-for="item in warenkorbItems">
                                <td> @{{ item.ab_article_id }}</td>
                                <td> @{{ item.ab_name }}</td>
                                <td> @{{ item.ab_price }}</td>
                                <td> @{{ item.ab_shoppingcart_id }}</td>
                                <td> <button v-on:click="removeWarenkorbItem(item.ab_article_id, item.ab_shoppingcart_id); getWarenkorb()" class="form-control">-</button> </td>
                            </tr>
                        </table>

                        <h2 class="my-2">Artikelsuche</h2>
                        <input type="text" v-model="search" v-on:input="getArticles" placeholder="Suche..." class="form-control my-4">

                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr id="table_head">
                                    <th class="col-1"> id </th>
                                    <th class="col-2"> ab_name </th>
                                    <th class="col-1"> ab_price </th>
                                    <th class="col-2"> ab_description </th>
                                    <th class="col-1"> ab_creator_id </th>
                                    <th class="col-1"> ab_createdate </th>
                                    <th class="col-2"> picture </th>
                                    <th class="col-1"> warenkorb </th>
                                </tr>
                            </thead>

                            <tr v-for="article in filteredArticles" class="buy_object">
                                <td> @{{ article.id }} </td>
                                <td> @{{ article.ab_name }} </td>
                                <td> @{{ article.ab_price }} </td>
                                <td> @{{ article.ab_description }} </td>
                                <td> @{{ article.ab_creator_id }} </td>
                                <td> @{{ article.ab_createdate }} </td>
                                <td> <img class="rounded" v-bind:src="'articelpictures/' + article.id + '.jpg'" v-bind:alt="article.ab_name" height="128px"> </td>
                                <td> <button v-on:click="addWarenkorbItem(article.id); getWarenkorb()" class="form-control">+</button> </td>
                            </tr>

                        </table>
                    </div>`,
            data: function() {
                return {
                    search: "",
                    articles: [],
                    warenkorbItems: null,
                }
            },
            created: function() {
                this.getArticles();
                this.getWarenkorb();
            },
            computed: {
                filteredArticles: function() {
                    return this.articles.slice(0, 5);
                }
            },
            methods: {
                getArticles: function() {
                    let xhr = new XMLHttpRequest();
                    let query;
                    if (this.search.length >= 3) {
                        query = "/api/articles?search=" + this.search;
                    } else {
                        query = "/api/articles";
                    }

                    xhr.open("GET", query);
                    xhr.onload = () => {
                        if (xhr.status == 200) {
                            this.articles = JSON.parse(xhr.response);
                        } else {
                            console.log(xhr.statusText);
                            this.articles = [];
                        }
                    }
                    xhr.send();
                },
                addWarenkorbItem: function(id) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', "/api/shoppingcart");
                    xhr.setRequestHeader('Content-Type',
                        'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                //alert("Artikel wurde erfolgreich Ihrem Warenkorb hinzugefügt ");
                            } else {
                                alert("Fehler der Artikel konnte nich hinzugefügt werden.");
                                console.error(xhr.statusText);
                            }
                        }
                    };
                    xhr.send('id=' + id);
                },
                removeWarenkorbItem: function(id, warenkorbID) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', "/api/shoppingcart/" + warenkorbID + "/articles/" + id);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                //alert(xhr.responseText);
                            } else {
                                console.error(xhr.statusText);
                                alert("Der Artikel konnte nicht entfernt werden");
                            }
                        }
                    };
                    xhr.send();
                },
                getWarenkorb: function() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', "/shoppingcart_items");
                    //xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onload = () => {
                        if (xhr.status === 200) {
                            this.warenkorbItems = JSON.parse(xhr.response);
                        } else {
                            console.error(xhr.statusText);
                        }
                    };
                    xhr.send();
                }
            }

        })

        new Vue({
            el: '#content',
            data: {
                impressumVisible: false
            },
            methods: {
                toggleImpressum: function() {
                    this.impressumVisible = !this.impressumVisible;
                }
            }
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>