<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <h1>Register</h1>
              <p class="text-muted">Uw account creëren</p>
              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text>
                    <i class="icon-user"/>
                  </b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="Gebruikersnaam">
              </b-input-group>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text>@</b-input-group-text>
                </b-input-group-prepend>
                <input type="text" class="form-control" placeholder="Email">
              </b-input-group>

              <b-input-group class="mb-3">
                <b-input-group-prepend>
                  <b-input-group-text>
                    <i class="icon-lock"/>
                  </b-input-group-text>
                </b-input-group-prepend>
                <input type="password" class="form-control" placeholder="Wachtwoord">
              </b-input-group>

              <b-input-group class="mb-4">
                <b-input-group-prepend>
                  <b-input-group-text>
                    <i class="icon-lock"/>
                  </b-input-group-text>
                </b-input-group-prepend>
                <input type="password" class="form-control" placeholder="Bevestig wachtwoord">
              </b-input-group>

              <b-button variant="success" block>Account aanmaken</b-button>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default { name: "Register" };
</script>
