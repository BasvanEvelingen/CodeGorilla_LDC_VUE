<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <loading
        :active.sync="isLoading"
        :can-cancel="true"
        :on-cancel="onCancel"
        color="#FF4119"
        :is-full-page="fullPage"
      ></loading>
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-img class="ldc-picture" :src="'/images/ldc_cglogo.svg'"/>
          <b-card-group>
            <b-card no-body class="p-4 rounded-left">
              <b-card-body>
                <h1 class="unselectable">Login</h1>
                <p class="text-muted unselectable">Inloggen op uw account</p>
                <form autocomplete="off" @submit.prevent="login" method="POST">
                  <!-- Gebruikersemail -->
                  <b-input-group class="mb-3">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="icon-user"/>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <b-input
                      v-model="email"
                      type="text"
                      class="form-control"
                      placeholder="Uw email"
                    />
                    <span
                      v-if="$v.$dirty && $v.email.$invalid"
                      class="error-message"
                    >{{emailErrorMessage}}</span>
                  </b-input-group>

                  <!-- wachtwoord -->
                  <b-input-group class="mb-3">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="icon-lock"/>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <b-input
                      v-model="password"
                      type="password"
                      class="form-control"
                      placeholder="Wachtwoord"
                    />
                    <span
                      v-if="$v.$dirty && $v.password.$invalid"
                      class="error-message"
                    >{{passwordErrorMessage}}</span>
                  </b-input-group>
                  <b-row>
                    <b-col cols="6">
                      <b-button type="submit" variant="primary" class="px-4">Inloggen</b-button>
                    </b-col>
                  </b-row>
                </form>
              </b-card-body>
            </b-card>
            <b-card
              no-body
              class="text-white bg-primary py-5 d-md-down-none rounded-right"
              style="width:44%"
            >
              <b-card-body class="text-center">
                <div>
                  <h2 class="unselectable">Registreren?</h2>
                  <p></p>
                  <b-button
                    @click="$router.push('register')"
                    variant="danger"
                    class="active mt-3"
                  >Registreren</b-button>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import { email, required } from "vuelidate/lib/validators";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  components: {
    Loading
  },
  data() {
    return {
      email: "",
      password: "",
      isLoading: false
    };
  },
  validations: {
    email: { required },
    password: { required }
  },
  computed: {
    emailErrorMessage() {
      if (!this.$v.email.required) {
        return "Emailadres is vereist.";
      } else if (!this.$v.email.email) {
        return "Vul alstublieft een geldig email-adres in.";
      }
    },
    passwordErrorMessage() {
      if (!this.$v.password.required) {
        return "Wachtwoord is vereist.";
      }
    }
  },
  methods: {
    login() {
      this.$v.$touch();
      var redirect = this.$auth.redirect();
      var app = this;
      this.isLoading = true;
      this.$auth.login({
        params: {
          email: app.email,
          password: app.password
        },
        success: function() {
          // handle redirection
          this.isLoading = false;
          const redirectTo = redirect
            ? redirect.from.name
            : this.$auth.user().role === 2
            ? "admin.dashboard"
            : "user.dashboard";
          this.$router.push({ name: redirectTo });
        },
        error: function() {
          app.has_error = true;
        },
        rememberMe: true,
        fetchUser: true
      });
    }
  }
};
</script>

<style scoped>
.ldc-picture {
  user-select: none;
  -moz-user-select: none;
  -webkit-user-drag: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  pointer-events: none;
}

.unselectable {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.error-message {
  color: #ff4119;

  font-size: 11px;
  margin: 5px 0 0 5px;
}
</style>
