<template>
  <b-container>
    <b-nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <b-img class="ldc-picture" :src="'/images/logo.svg'"/>
        </a>
        <b-button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </b-button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <navigationMenu></navigationMenu>
        </div>
      </div>
    </b-nav>
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-12 text-center">
            <h1 class="font-weight-light">Vertically Centered Masthead Content</h1>
            <p class="lead">A great starter layout for a landing page</p>
          </div>
        </div>
      </div>
    </header>
  </b-container>

  <!-- Full Page Image Header with Vertically Centered Content -->
  <!--
  <b-container>
    <b-row>
      <b-col sm="12" offset-md="3">
        <router-link :to="{name: 'home'}">
          <div class="image-box">
            <b-img center class="ldc-picture" :src="'/images/ldc_cglogo.svg'"/>
          </div>
        </router-link>
      </b-col>
    </b-row>
    <b-row>
      <b-col sm="12" offset-md="3">
        <navigationMenu></navigationMenu>
      </b-col>

      <div id="content">
        <router-view></router-view>
      </div>
    </b-row>
  </b-container>
  -->
</template>

<script>
import navigationMenu from "./components/Menu.vue";
export default {
  data() {
    return {
      //
    };
  },
  components: {
    navigationMenu
  }
};
</script>

<style scoped>
.image-box {
  width: 50%;
  height: 50%;
}

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
</style>
