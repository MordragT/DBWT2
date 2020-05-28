<template>
  <form name="sell" method="post" v-on:submit="submit">
    <p v-if="errors.length">
      <b>Bitte korrigiere folgende Fehler:</b>
      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
    </p>
    <p v-if="success">Der Artikel wurde erfolgreich eingetragen</p>
    <input type="hidden" name="_token" :value="csrf" />
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" v-model="nameMod" name="name" placeholder="Name..."/>
    </div>
    <div class="form-group">
      <label for="name">Beschreibung</label>
      <textarea class="form-control" type="text" v-model="descriptionMod" name="description" placeholder="Beschreibung..."></textarea>
    </div>
    <div class="form-group">
      <label for="price">Preis</label>
      <input class="form-control" type="number" v-model="priceMod" name="price"/>
    </div>
    <button type="submit" class="btn btn-primary">Abschicken</button>
  </form>
</template>

<script>
export default {
  methods: {
    submit: function(event) {
      event.preventDefault();
      if (this.nameMod != "" && this.descriptionMod != "" && this.priceMod > 0) {
        let xhr = new XMLHttpRequest();
        let query = "/api/sell?name=" + this.nameMod + "&description=" + this.descriptionMod + "&price=" + this.priceMod;
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

      this.errors = [];

      if (this.nameMod == "") {
        this.errors.push("Produktname muss angegeben werden");
      }
      if (this.descriptionMod == "") {
        this.errors.push("Bitte beschreibe das Produkt kurz");
      }
      if (this.priceMod == 0) {
        this.errors.push("Der Preis muss 0 überschreiten");
      }

    }
  },
  data: function() {
    return {
      csrf: document.head.querySelector("meta[name='csrf-token']").content,
      nameMod: "",
      descriptionMod: "",
      priceMod: Number,
      errors: [],
      success: false,
    };
  }
};
</script>