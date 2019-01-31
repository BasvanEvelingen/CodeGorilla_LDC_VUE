<template>
  <b-container>
    <b-nav class="navbar navbar-expand-sm py-0 py-md0 navbar-custom fixed-top">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span>
          <i class="fa fa-bars fa-1x icolor"></i>
        </span>
      </button>

      <router-link :to="{ path: '/' }">
        <a class="navbar-brand">
          <b-img class="ldc-picture" :src="'/images/logo.png'" height="30px"/>
        </a>
      </router-link>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <navigationMenu></navigationMenu>
      </div>
    </b-nav>
    <b-row>
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
  border-bottom: 1px solid #00aeef;
}

.icolor {
  color: #548299;
}
</style>
