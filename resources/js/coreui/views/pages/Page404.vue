<template>
  <div class="app flex-row align-items-center background">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6">
          <div class="clearfix">
            <h1 class="float-left display-3 mr-4 text-white">404</h1>
            <h4 class="pt-3 text-white">Oeps, verdwaald...</h4>
            <p class="text-muted">We konden die pagina
              <br>niet vinden...
            </p>
          </div>
          <b-input-group>
            <b-input-group-prepend>
              <b-input-group-text>
                <i class="fa fa-search"/>
              </b-input-group-text>
            </b-input-group-prepend>
            <input
              id="prependedInput"
              class="form-control"
              size="16"
              type="text"
              placeholder="Waar zocht je naar?"
            >
            <b-input-group-append>
              <b-button variant="info">Zoeken</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default { name: "Page404" };
</script>

<style scoped>
.background {
  background-image: url("/images/404.jpg");
}
</style>
