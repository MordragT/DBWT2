<template>
  <div>
    <form v-on:submit.prevent="login" v-if="!this.loggedIn">
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          name="email"
          class="form-control"
          required
          v-model="form.ab_mail"
        />
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
      <p>{{ this.login_error }}</p>
      <button type="submit" class="btn btn-dark">Submit</button>
    </form>
    <div v-if="this.loggedIn">
      <p>You are already logged in.</p>
      <button type="button" class="btn btn-dark" v-on:click="logout">
        Logout
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    login: function () {
      console.log(this.form);
      axios
        .post("/api/login", this.form)
        .then((response) => {
          console.log(response.data);
          window.location.reload();
        })
        .catch((error) => {
          console.log(error.response.data);

          let login_error = error.response.data.error;
          if (login_error != "") {
            this.login_error = login_error;
          }
        });
    },
    logout: function () {
      axios
        .post("/api/logout")
        .then((response) => {
          console.log(response.data);
          window.location.reload();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
  data() {
    return {
      form: {
        ab_mail: "",
        ab_password: "",
      },
      login_error: "",
      loggedIn: false,
    };
  },
  async created() {
    let request = await axios.post("/api/loggedin");
    let failure = request.data.failure;
    if (failure) {
      this.loggedIn = false;
    } else {
      this.loggedIn = true;
    }
  },
  setup() {},
};
</script>