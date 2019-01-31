<template>
  <div class="container">
    <slider animation="fade">
      <slider-item>
        <img :src="'/img/30_1.jpg'" width="300" height="300">
      </slider-item>
      <slider-item>
        <img :src="'/img/30_2.jpg'" width="300" height="300">
      </slider-item>
      <slider-item>
        <img :src="'/img/30_3.jpg'" width="300" height="300">>
      </slider-item>
      <slider-item>
        <img :src="'/img/30_4.jpg'" width="300" height="300%">
      </slider-item>
    </slider>

    <img :src="'/img/likert.svg'">
    <h2>Iets met voedsel</h2>
  </div>
</template>

<script>
import { Slider, SliderItem } from "vue-easy-slider";
import axios from "axios";
export default {
  components: {
    Slider,
    SliderItem
  },
  data() {
    return {
      list: [
        {},
        { backgroundColor: "#3f51b5", width: "100%", height: "100%" },
        { backgroundColor: "#eee", width: "100%", height: "100%" },
        { backgroundColor: "#f44336", width: "100%", height: "100%" }
      ]
    };
  },
  methods: {
    getQuestions() {
      window.axios
        .get("/api/questions")
        .then(response => {
          console.log(response.data);
        })
        .catch(error => console.log(error));
    }
  },
  created() {
    //this.getQuestions();
  }
};
</script>

<style scoped>
.container {
  margin-left: 30%;
}
</style>
