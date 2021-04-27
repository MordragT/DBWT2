<template>
  <form name="sell" method="post" v-on:submit="submit">
    <input type="hidden" name="_token" :value="csrf" />
    <div v-if="errors.length">
      <b>Bitte korrigiere folgende Fehler:</b>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
    </div>
    <p v-if="success">Der Artikel wurde erfolgreich eingetragen</p>
    <div class="form__item1">
      <label for="name">Name</label>
      <input
        type="text"
        v-model="name"
        name="name"
        placeholder="Name..."
        class="form-control"
        required
      />
    </div>
    <div class="form__item2">
      <label for="description">Beschreibung</label>
      <textarea
        type="text"
        v-model="description"
        name="description"
        class="form-control"
        placeholder="Beschreibung..."
        required
      ></textarea>
    </div>
    <div class="form__item3">
      <label for="price">Preis</label>
      <input
        type="number"
        v-model="price"
        name="price"
        class="form-control"
        required
      />
    </div>
    <button type="submit" class="btn btn-dark">Abschicken</button>
  </form>
</template>

<script>
export default {
  methods: {
    submit: function (event) {
      event.preventDefault();
      if (this.price > 0) {
        let xhr = new XMLHttpRequest();
        let query =
          "/api/sell?name=" +
          this.name +
          "&description=" +
          this.description +
          "&price=" +
          this.price;
        xhr.open("POST", query);
        xhr.onload = () => {
          if (xhr.status == 200) {
            this.success = true;
          } else {
            this.errors.push("Fehler mit der Datenbank, sind sie angemeldet?");
          }
        };
        xhr.send();
      }

      // if (this.nameMod == "") {
      //   this.errors.push("Produktname muss angegeben werden");
      // }
      // if (this.descriptionMod == "") {
      //   this.errors.push("Bitte beschreibe das Produkt kurz");
      // }
      if (this.priceMod == 0) {
        this.errors.push("Der Preis muss 0 überschreiten");
      }
    },
  },
  data: function () {
    return {
      csrf: document.head.querySelector("meta[name='csrf-token']").content,
      name: "",
      description: "",
      price: Number,
      errors: [],
      success: false,
    };
  },
};
</script>
