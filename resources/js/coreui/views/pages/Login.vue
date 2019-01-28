<template>
  <div class="app flex-row align-items-center ldc-background">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-img class="ldc-picture" :src="'/images/ldc_cglogo.svg'"/>
          <b-card-group>
            <b-card no-body class="p-4 rounded-left">
              <b-card-body>
                <h1 class="unselectable">Login</h1>
                <p class="text-muted unselectable">Inloggen op uw account</p>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>
                      <i class="icon-user"/>
                    </b-input-group-text>
                  </b-input-group-prepend>
                  <b-input
                    v-model="form.username"
                    :state="$v.form.username | state"
                    type="text"
                    class="form-control"
                    placeholder="Gebruikersnaam"
                    required
                  />
                  <b-form-invalid-feedback class="unselectable">Vereist</b-form-invalid-feedback>
                </b-input-group>
                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text>
                      <i class="icon-lock"/>
                    </b-input-group-text>
                  </b-input-group-prepend>
                  <b-input
                    v-model="form.password"
                    :state="$v.form.password | state"
                    type="password"
                    class="form-control"
                    placeholder="Wachtwoord"
                    required
                  />
                  <b-form-invalid-feedback class="unselectable">Vereist</b-form-invalid-feedback>
                </b-input-group>
                <b-row>
                  <b-col cols="6">
                    <b-button variant="primary" class="px-4" @click="submit">Inloggen</b-button>
                  </b-col>
                  <b-col cols="6" class="text-right">
                    <b-button variant="link" class="px-0 unselectable">Wachtwoord vergeten?</b-button>
                  </b-col>
                </b-row>
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
                    @click="$router.push('registerform')"
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
import { required } from "validators";

export default {
  name: "Login",
  data() {
    return {
      form: {
        username: "",
        password: ""
      }
    };
  },
  validations() {
    return {
      form: {
        username: { required },
        password: { required }
      }
    };
  },
  methods: {
    submit() {
      this.$v.$touch();
    }
  }
};
</script>

<style scoped>
.ldc-background {
  background-image: linear-gradient(
    to top,
    #d5d4d0 0%,
    #d5d4d0 1%,
    #eeeeec 31%,
    #efeeec 75%,
    #e9e9e7 100%
  );
}
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
</style>
