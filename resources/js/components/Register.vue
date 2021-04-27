<template>
  <div>
    <form v-on:submit.prevent="submit">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          name="name"
          class="form-control"
          required
          v-model="form.ab_name"
        />
        <p>{{ errors.ab_name }}</p>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          name="email"
          class="form-control"
          required
          v-model="form.ab_mail"
        />
        <p>{{ errors.ab_mail }}</p>
      </div>
      <div class="form-group">
        <label for="password">Passwort</label>
        <input
          type="password"
          name="password"
          class="form-control"
          required
          v-model="form.ab_password"
        />
      </div>
      <button type="submit" class="btn btn-dark">Submit</button>
    </form>
    <br /><br />
    <p>{{ success }}</p>
  </div>
</template>

<script>
export default {
  methods: {
    submit: function () {
      console.log(this.form);
      axios
        .post("/api/register", this.form)
        .then((response) => {
          console.log(response.data);
          this.success = "You have succesfully registered.";
          this.errors.ab_name = "";
          this.errors.ab_mail = "";
        })
        .catch((error) => {
          console.log(error.response.data.ab_name[0]);
          console.log(error.response.data.ab_mail[0]);

          let name = error.response.data.ab_name[0];
          let mail = error.response.data.ab_mail[0];
          if (name != "") {
            this.errors.ab_name = name;
          }
          if (mail != "") {
            this.errors.ab_mail = mail;
          }
        });
    },
  },
  data() {
    return {
      form: {
        ab_name: "",
        ab_mail: "",
        ab_password: "",
      },
      errors: {
        ab_name: "",
        ab_mail: "",
      },
      success: "",
    };
  },
  setup() {},
};
</script>