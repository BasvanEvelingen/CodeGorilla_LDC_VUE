<template>
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
    </b-row>
    <div id="content">
      <router-view></router-view>
    </div>
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
