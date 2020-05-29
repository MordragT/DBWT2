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
            v-on:click="removeWarenkorbItem(item.ab_article_id, item.ab_shoppingcart_id); getWarenkorb()"
            class="form-control"
          >-</button>
        </td>
      </tr>
    </table>

    <h2 class="my-2">Artikelsuche</h2>
    <input
      type="text"
      v-model="search"
      v-on:input="getArticles"
      placeholder="Suche..."
      class="artikelsuche--color artikelsuche--border my-4"
    />

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
        </tr>
      </thead>

      <tr v-for="article in articles" v-bind:key="article" class="buy_object artikelliste__item--hover">
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
          <button v-on:click="addWarenkorbItem(article.id); getWarenkorb()" class="form-control">+</button>
        </td>
      </tr>
    </table>
    <div class="row my-5">
      <button v-on:click="lastSite" class="form-control mx-auto col-3">&lt;</button>
      <button v-on:click="nextSite" class="form-control mx-auto col-3">&gt;</button>
    </div>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      search: "",
      articles: [],
      offsetArticles: 0,
      warenkorbItems: null,
      limitArticles: 5
    };
  },
  created: function() {
    this.getArticles();
    this.getWarenkorb();
  },
  computed: {
    // not in use anymore
    filteredArticles: function() {
      return this.articles.slice(0, 5);
    }
  },
  methods: {
    nextSite: function() {
      this.offsetArticles += this.limitArticles;
      this.getArticles();
      if (this.articles.length < this.limitArticles) {
        console.log("Ende, graue button aus");
      }
    },
    lastSite: function() {
      this.offsetArticles -= this.limitArticles;
      this.getArticles();
    },
    getArticles: function() {
      let xhr = new XMLHttpRequest();
      let query;
      if (this.search != "" && this.search.length <= 3) {
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
    addWarenkorbItem: function(id) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/api/shoppingcart");
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
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
      xhr.send("id=" + id);
    },
    removeWarenkorbItem: function(id, warenkorbID) {
      var xhr = new XMLHttpRequest();
      xhr.open(
        "DELETE",
        "/api/shoppingcart/" + warenkorbID + "/articles/" + id
      );

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
    }
  }
};
</script>
