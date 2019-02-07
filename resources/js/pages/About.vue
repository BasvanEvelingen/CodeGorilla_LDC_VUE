<template>
  <div class="app flex-row align-items-center background">
    <div class="container" v-bind:style="{ backgroundImage: 'url(' + image + ')' }">
      <b-row class="justify-content-center background">
        <b-col md="6">
          <div class="clearfix">
            <h1 class="display-3 mr-4 text-danger">Sebastiaan van Evelingen</h1>
            <h4 class="pt-3 text-white">CodeGorilla Trainee</h4>
            <p class="text-muted">Leeuwarden 2019</p>
          </div>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
data: {
  image: "'/images/laptop.jpg'";
}
</script>

<style scoped>
.background {
  background-size: cover;
}
</style>
