<template>
  <b-container>
    <b-img
      fluid-grow
      class="ldc-picture mt-5"
      :src="'/images/LDC_Logo_large_outlines_animated.svg'"
    />
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      image: "'/images/laptop.jpg'"
    };
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
</style
