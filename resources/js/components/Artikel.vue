<template>
  <div>
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
      <tr v-for="item in warenkorbItems" v-bind:key="item">
        <td>{{ item.ab_article_id }}</td>
        <td>{{ item.ab_name }}</td>
        <td>{{ item.ab_price }}</td>
        <td>{{ item.ab_shoppingcart_id }}</td>
        <td>
          <button
            v-on:click="
              removeWarenkorbItem(item.ab_article_id, item.ab_shoppingcart_id);
              getWarenkorb();
            "
            class="btn btn-dark"
          >
            -
          </button>
        </td>
      </tr>
    </table>

    <h2 class="my-2">Artikelsuche</h2>
    <input
      type="text"
      v-model="search"
      v-on:input="
        resetSite();
        getArticles();
      "
      placeholder="Suche..."
      class="form-control my-4"
    />
    <p><b> Letzte Suchbegriffe </b></p>
    <ul>
      <li
        v-for="item in lastsearcharticles"
        v-on:click="
          search = item;
          resetSite();
          getArticles();
          getLastSearchArticles();
        "
      >
        {{ item }}
      </li>
    </ul>

    <table class="table table-striped">
      <thead class="thead-dark">
        <tr id="table_head">
          <th class="col-1">id</th>
          <th class="col-2">ab_name</th>
          <th class="col-1">ab_price</th>
          <th class="col-2">ab_description</th>
          <th class="col-1">ab_creator_id</th>
          <th class="col-1">ab_createdate</th>
          <th class="col-2">picture</th>
          <th class="col-1">warenkorb</th>
          <th class="col-1">angebot</th>
        </tr>
      </thead>

      <tr
        v-for="article in articles"
        v-bind:key="article"
        class="buy_object artikelliste__item--hover"
      >
        <td>{{ article.id }}</td>
        <td>{{ article.ab_name }}</td>
        <td>{{ article.ab_price }}</td>
        <td>{{ article.ab_description }}</td>
        <td>{{ article.ab_creator_id }}</td>
        <td>{{ article.ab_createdate }}</td>
        <td>
          <img
            class="rounded"
            v-bind:src="'articelpictures/' + article.id + '.jpg'"
            v-bind:alt="article.ab_name"
            height="128px"
          />
        </td>
        <td>
          <button
            v-on:click="
              addWarenkorbItem(article.id);
              getWarenkorb();
            "
            class="btn btn-dark"
          >
            +
          </button>
        </td>
        <td>
          <button
            v-if="userID == article.ab_creator_id"
            v-on:click="createAngebot(article.ab_name)"
            class="btn btn-dark"
          >
            +
          </button>
        </td>
      </tr>
    </table>
    <div class="row my-5">
      <div class="mx-auto col-2 btn-group">
        <button v-on:click="lastSite" class="btn btn-dark">&lt;</button>
        <button v-on:click="nextSite" class="btn btn-dark">&gt;</button>
      </div>
    </div>
    <p v-if="lastSiteAttr">Letzte Seite erreicht</p>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      search: "",
      articles: [],
      offsetArticles: 0,
      warenkorbItems: null,
      limitArticles: 5,
      lastSiteAttr: false,
      userID: null,
      lastsearcharticles: [],
    };
  },
  created: function () {
    this.getArticles();
    this.getWarenkorb();
    this.getUserId();
    this.getLastSearchArticles();
    this.websocket();
  },
  computed: {
    // not in use anymore
    filteredArticles: function () {
      return this.articles.slice(0, 5);
    },
  },
  methods: {
    resetSite: function () {
      this.offsetArticles = 0;
    },
    nextSite: function () {
      if (this.articles.length < this.limitArticles) {
        this.lastSiteAttr = true;
      } else {
        this.lastSiteAttr = false;
        this.offsetArticles += this.limitArticles;
        this.getArticles();
      }
    },
    lastSite: function () {
      if (this.offsetArticles > 0) {
        this.lastSiteAttr = false;
        this.offsetArticles -= this.limitArticles;
      }
      this.getArticles();
    },
    getArticles: function () {
      let xhr = new XMLHttpRequest();
      let query;
      if (this.search != "" && this.search.length < 3) {
        return;
      } else if (this.search == "") {
        query =
          "/api/articles?limit=" +
          this.limitArticles +
          "&offset=" +
          this.offsetArticles;
      } else {
        query =
          "/api/articles?search=" +
          this.search +
          "&limit=" +
          this.limitArticles +
          "&offset=" +
          this.offsetArticles;
      }

      console.log(query);

      xhr.open("GET", query);
      xhr.onload = () => {
        if (xhr.status == 200) {
          this.articles = JSON.parse(xhr.response);
        } else {
          console.log(xhr.statusText);
          this.articles = [];
        }
      };
      xhr.send();
    },
    // getArticles: async function() {
    //   if (this.search != "" && this.search.length < 3) {
    //     return;
    //   } else if (this.search == "") {
    //      return await axios.get("/api/articles", {
    //       limit: this.limitArticles,
    //       offset: this.offsetArticles,
    //     }).data;
    //   } else {
    //     axios.get("/api/articles", {
    //       limit: this.limitArticles,
    //       offset: this.offsetArticles,
    //       search: this.search,
    //     })
    //   }
    // },

    getUserId: function () {
      axios
        .get("/getId")
        .then((response) => {
          console.log(response.data);
          this.userID = response.data;
          console.log(this.userID);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    createAngebot: function (name) {
      axios
        .post("/api/angebot", {
          articlename: name,
          userId: this.userID,
        })
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    addWarenkorbItem: function (id) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/api/shoppingcart");
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            //alert("Artikel wurde erfolgreich Ihrem Warenkorb hinzugefügt ");
          } else {
            alert("Fehler der Artikel konnte nicht hinzugefügt werden.");
            console.error(xhr.statusText);
          }
        }
      };
      xhr.send("id=" + id);
    },
    removeWarenkorbItem: function (id, warenkorbID) {
      var xhr = new XMLHttpRequest();
      xhr.open(
        "DELETE",
        "/api/shoppingcart/" + warenkorbID + "/articles/" + id
      );

      xhr.onreadystatechange = function () {
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
    getWarenkorb: function () {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "/shoppingcart_items");
      //xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onload = () => {
        if (xhr.status === 200) {
          this.warenkorbItems = JSON.parse(xhr.response);
        } else {
          console.error(xhr.statusText);
        }
      };
      xhr.send();
    },

    getLastSearchArticles: function () {
      axios
        .get("/api/articles/lastsearch")
        .then((response) => {
          console.log(response.data);
          this.lastsearcharticles = response.data;
          console.log(this.lastsearcharticles);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    websocket: function () {
      let socket = new WebSocket("ws://localhost:8000/angebot");
      socket.onopen = (event) => {
        console.log("Connected");
      };

      socket.onclose = (closeEvent) => {
        console.log(
          "Connection closed" + ": code=",
          closeEvent.code,
          "; reason=",
          closeEvent.reason
        );
      };

      socket.onmessage = (msgEvent) => {
        let data = JSON.parse(msgEvent.data);

        //console.log(data['article']);
        //console.log(data['user']);

        let counter = 0;
        this.articles.forEach((value, index) => {
          if (value.ab_name === data["article"]) {
            counter++;
          }
        });

        if (data["user"] !== this.userID && counter > 0) {
          alert(
            "Der Artikel " +
              data["article"] +
              " wird nun günstiger angeboten! Greifen Sie schnell zu."
          );
        }
      };
    },
  },
};
</script>
