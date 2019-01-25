<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-img :src="'/images/ldc_cglogo.svg'"/>
          <b-alert variant="danger" v-if="error&&!success">
            <p>Er ging iets fout, kon registratie niet afronden.</p>
          </b-alert>
          <b-alert variant="success" v-if="success">
            <p>Registratie gelukt, U kunt nu
              <router-link :to="{name:'login'}">inloggen</router-link>
            </p>
          </b-alert>
          <b-card no-body class="mx-4 rounded">
            <b-card-body class="p-4">
              <h1>Registreren</h1>
              <p class="text-muted">Uw account creëren</p>
              <b-form autocomplete="off" @submit="register" v-if="!success" method="POST">
                <!-- Gebruikersnaam -->
                <div class="form-group" v-bind:class="{ 'has-error': error && errors.name}">
                  <b-input-group class="mb-3">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="icon-user"/>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <input
                      type="text"
                      v-model="name"
                      class="form-control"
                      placeholder="Gebruikersnaam"
                    >
                  </b-input-group>
                </div>
                <!-- Email -->
                <div class="form-group">
                  <b-input-group class="mb-3">
                    <b-input-group-prepend>
                      <b-input-group-text>@</b-input-group-text>
                    </b-input-group-prepend>
                    <input type="text" class="form-control" placeholder="Email">
                  </b-input-group>
                </div>
                <!-- Wachtwoord -->
                <div class="form-group">
                  <b-input-group class="mb-3">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="icon-lock"/>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <input type="password" class="form-control" placeholder="Wachtwoord">
                  </b-input-group>
                </div>
                <!-- Bevestig wachtwoord -->
                <div class="form-group">
                  <b-input-group class="mb-4">
                    <b-input-group-prepend>
                      <b-input-group-text>
                        <i class="icon-lock"/>
                      </b-input-group-text>
                    </b-input-group-prepend>
                    <input type="password" class="form-control" placeholder="Bevestig wachtwoord">
                  </b-input-group>
                </div>
                <!-- Submit knop -->
                <div class="text-center">
                  <b-button variant="primary">Account aanmaken</b-button>
                </div>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Register",
  data() {
    return {
      name: "",
      email: "",
      password: "",
      cpassword: ""
    };
  },
  methods: {
    registerUser() {}
  }
};
</script>
