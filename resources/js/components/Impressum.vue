<template>
  <div>
    <button v-on:click="toggleVisibility()" class="btn btn-dark">
      Impressum
    </button>
    <br />
    <br />
    <div v-if="this.visible">
      <h1>Impressum</h1>

      <h2>Angaben gem&auml;&szlig; &sect; 5 TMG</h2>
      <p>
        Gruppe 16<br />
        Eupenerstra&szlig;e 70<br />
        52066 Aachen
      </p>

      <p>
        <strong>Vertreten durch:</strong><br />
        Thomas Wehmoeller<br />
        Julien Ahn
      </p>

      <h2>Kontakt</h2>
      <p>
        Telefon: +49 (0) 123 44 55 66<br />
        Telefax: +49 (0) 123 44 55 99<br />
        E-Mail: mustermann@musterfirma.de
      </p>
    </div>
  </div>
</template>

<script>
export default {
  setup() {},
  data() {
    return {
      visible: false,
    };
  },
  methods: {
    toggleVisibility: function () {
      this.visible = !this.visible;
    },
  },
};
</script>