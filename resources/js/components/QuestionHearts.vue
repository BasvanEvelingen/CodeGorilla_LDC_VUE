<template>
  <div class="md-offset-4">
    <b-row align-h="center">
      <p>
        <strong>{{this.question.id}}</strong>
        {{this.question.name}}
      </p>
    </b-row>
    <b-row align-h="center">
      <b-carousel
        id="carousel"
        style="text-shadow: 1px 1px 2px #333;"
        controls
        background="#E6ECED"
        :interval="2000"
        img-width="480"
        img-height="480"
        v-model="slide"
        @sliding-start="onSlideStart"
        @sliding-end="onSlideEnd"
      >
        <!-- Afbeelding 1 -->
        <b-carousel-slide>
          <img
            slot="img"
            class="d-block img-fluid"
            width="480"
            height="480"
            :src="'/images/questions/' + this.question.id + '-1' + '.jpg'"
            :alt="this.question.id + '-1.jpg'"
          >
        </b-carousel-slide>
        <!-- Afbeelding 2 -->
        <b-carousel-slide>
          <img
            slot="img"
            class="d-block img-fluid"
            width="480"
            height="480"
            :src="'/images/questions/' + this.question.id + '-2' + '.jpg'"
            :alt="this.question.id + '-2.jpg'"
          >
        </b-carousel-slide>
        <!-- Afbeelding 3 -->
        <b-carousel-slide>
          <img
            slot="img"
            class="d-block img-fluid"
            width="480"
            height="480"
            :src="'/images/questions/' + this.question.id + '-3' + '.jpg'"
            :alt="this.question.id + '-3.jpg'"
          >
        </b-carousel-slide>
        <!-- Afbeelding 4 -->
        <b-carousel-slide>
          <img
            slot="img"
            class="d-block img-fluid"
            width="480"
            height="480"
            :src="'/images/questions/' + this.question.id + '-4' + '.jpg'"
            :alt="this.question.id + '-4.jpg'"
          >
        </b-carousel-slide>
      </b-carousel>
    </b-row>

    <br>
    <b-row align-h="center">
      <heart-rating
        :item-size="25"
        inactive-color="#cc1166"
        active-color="#ff4119"
        :increment="0.01"
        :border-width="3"
        :spacing="0"
        :max-rating="10"
        :show-rating="false"
        :inline="true"
        v-model="value"
      ></heart-rating>
    </b-row>
    <br>
    <b-row align-h="center">
      <input
        @click="prevquestion"
        type="button"
        class="btn btn-primary btn-marge"
        value="vorige vraag"
      >
      <input @click="nextquestion" type="button" class="btn btn-success" value="volgende vraag">
    </b-row>
  </div>
</template>

<script>
import { HeartRating } from "vue-rate-it";
export default {
  data() {
    return {
      value: 0,
      publicPath: process.env.BASE_URL,
      imagenumber: "",
      questionnumber: 1
    };
  },
  methods: {
    nextquestion() {
      this.$emit("nextquestion", [this.question.id, this.question.antwoord]);
    },
    prevquestion() {
      this.$emit("prevquestion", [this.question.id, this.question.antwoord]);
    },
    updateRange() {
      this.question.antwoord = this.value * 10;
    },
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    }
  },
  components: {
    HeartRating
  },
  computed: {},
  props: ["question"]
};
</script>

<style scoped>
.carousel {
  display: block;
  max-width: 480px;
}
.btn-marge {
  margin-right: 10px;
}
</style>
