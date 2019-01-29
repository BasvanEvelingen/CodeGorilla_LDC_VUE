<template>
  <div id="main">
    <div>text</div>
    <header id="header">
      <div>
        <router-link :to="{name: 'home'}">
          <b-img class="ldc-picture" :src="'/images/ldc_cglogo.svg'"/>
        </router-link>
      </div>
      <navigationMenu></navigationMenu>
    </header>
    <div id="content">
      <router-view></router-view>
    </div>
  </div>
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
