<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-img class="ldc-picture" :src="'/images/ldc_cglogo.svg'"/>
          <b-loading variant="Stretch" background="#00AEEF" id="spinner" cover></b-loading>
          <b-card no-body class="mx-4 rounded">
            <b-card-body class="p-4">
              <h1 class="unselectable">Registreren</h1>
              <p class="text-muted unselectable">Uw account creëren</p>
              <b-form autocomplete="off" @submit.prevent="register" method="POST">
                <!-- Gebruikersnaam -->
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>
                      <i class="icon-user"/>
                    </b-input-group-text>
                  </b-input-group-prepend>
                  <b-input
                    type="text"
                    v-model="username"
                    class="form-control"
                    placeholder="Gebruikersnaam"
                  />
                  <span
                    v-if="$v.$dirty && $v.username.$invalid"
                    class="error-message"
                  >{{usernameErrorMessage}}</span>
                </b-input-group>

                <!-- Email -->
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text class="unselectable">@</b-input-group-text>
                  </b-input-group-prepend>
                  <b-input type="text" v-model="email" class="form-control" placeholder="Email"/>
                  <span
                    v-if="$v.$dirty && $v.email.$invalid"
                    class="error-message"
                  >{{emailErrorMessage}}</span>
                </b-input-group>

                <!-- Wachtwoord -->
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>
                      <i class="icon-lock"/>
                    </b-input-group-text>
                  </b-input-group-prepend>
                  <b-input
                    type="password"
                    v-model="password"
                    class="form-control"
                    placeholder="Wachtwoord"
                  />
                  <span
                    v-if="$v.$dirty && $v.password.$invalid"
                    class="error-message"
                  >{{passwordErrorMessage}}</span>
                </b-input-group>

                <!-- Bevestig wachtwoord -->
                <div class="form-group">
                  <b-input-group class="mb-4">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="icon-lock"/>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <b-input
                      type="password"
                      v-model="password_confirmation"
                      class="form-control"
                      placeholder="Bevestig wachtwoord"
                    />
                    <span
                      v-if="$v.$dirty && $v.password_confirmation.$invalid"
                      class="error-message"
                    >{{passwordConfirmationErrorMessage}}</span>
                  </b-input-group>
                </div>
                <!-- Submit knop -->
                <div class="text-center">
                  <b-button variant="primary" type="submit">Account aanmaken</b-button>
                </div>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<!-- begin javascript sectie -->
<script>
import axios from "axios";
import Swal from "sweetalert2";
import { email, required, sameAs, minLength } from "vuelidate/lib/validators";
import * as Spinner from "vue-loading-spinner";

export default {
  data() {
    return {
      username: "",
      email: "",
      password: "",
      password_confirmation: "",
      isLoading: false,
      variants: _.keys(Spinner)
    };
  },
  validations: {
    username: { required, minLength: minLength(6) },
    email: { required, email },
    password: { required, minLength: minLength(6) },
    password_confirmation: { required, sameAsPassword: sameAs("password") }
  },
  computed: {
    usernameErrorMessage() {
      if (!this.$v.username.required) {
        return "Gebruikersnaam is vereist.";
      }
    },
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
      } else if (!this.$v.password.minLength) {
        return "Het wachtwoord moet minimaal 6 tekens bevatten.";
      }
    },
    passwordConfirmationErrorMessage() {
      if (!this.$v.password_confirmation.required) {
        return "Bevestigen van wachtwoord is vereist.";
      } else if (!this.$v.password_confirmation.sameAs) {
        return "Wachtwoorden komen niet overeen.";
      }
    }
  },
  methods: {
    // methode die user registreert in systeem
    register() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.sAlert();
      } else {
        this.$auth.register({
          data: {
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          },
          success: function() {
            this.success = true;
            this.$router.push({
              name: "login",
              params: { successRegistrationRedirect: true }
            });
          },
          error: function(res) {
            console.log(res.response.data.errors);
          }
        });
      }

      /* oude methode
        axios
          .post("register", {
            name: this.username,
            email: this.email,
            password: this.password,
            password_confirmation: this.passwordConfirmation
          })
          .then(() => {
            this.sSuccess();
          })
          .catch(error => console.log(error));
          */
      // axios api register request.
    },
    sAlert() {
      const swalWithBootstrapButtons = Swal.mixin({
        confirmButtonClass: "btn btn-danger",
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        type: "error",
        title: "Fout in formulier",
        text:
          "Er zijn fouten geconstateerd bij het invullen van het formulier.",
        footer: "druk op ok om fouten te herstellen",
        confirmButtonText: "Ok"
      });
    },
    sSuccess() {
      const swalWithBootstrapButtons = Swal.mixin({
        confirmButtonClass: "btn btn-success",
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        type: "success",
        title: "Gelukt",
        text: "U kunt nu inloggen door op link hieronder te klikken.",
        footer: "<router-link to='login'>Inloggen</router-link",
        confirmButtonText: "Ok"
      });
    }
  }
};
</script>

<!-- alleen stijl voor dit component -->
<style scoped>
/* niet kunnen selecteren van tekst */
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

#spinner::after {
  background: #c7254e !important;
}
</style>
