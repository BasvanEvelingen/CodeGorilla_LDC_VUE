<template>
  <b-container fluid>
    <b-nav class="navbar navbar-expand-sm navbar-custom fixed-top">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <a class="navbar-brand" href="#">
        <b-img class="ldc-picture" :src="'/images/logo.png'" height="35px"/>
      </a>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <navigationMenu></navigationMenu>
      </div>
    </b-nav>
    <b-row no-gutters>
      <b-col>
        <router-view/>
      </b-col>
    </b-row>
  </b-container>
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
.ldc-picture {
  user-select: none;
  -moz-user-select: none;
  -webkit-user-drag: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  pointer-events: none;
}

.navbar-custom {
  background-color: #e6eced;
  border-color: #e7e7e7;
}
</style>
