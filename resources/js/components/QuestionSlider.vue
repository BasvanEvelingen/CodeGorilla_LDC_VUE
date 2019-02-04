<template>
  <div class="md-offset-4">
    <p>
      <strong>{{this.question.id}}</strong>
      {{this.question.name}}
    </p>
    <b-row align-h="center">
      <b-carousel
        id="carousel"
        style="text-shadow: 1px 1px 2px #333;"
        controls
        background="#E6ECED"
        :interval="2000"
        img-width="480"
        img-height="480"
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

    <form>
      <div class="form-group">
        <label for="formControlRange">Ik heb zoveel iets met</label>
        <input
          @change="updateRange"
          v-model="value"
          type="range"
          class="form-control-range"
          id="formControlRange"
          min="0"
          max="100"
          value="0"
        >
      </div>
      <div class="form-group row">
        <input
          @click="prevquestion"
          type="button"
          class="btn btn-primary mr-auto"
          value="vorige vraag"
        >
        <input @click="nextquestion" type="button" class="btn btn-success" value="volgende vraag">
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      value: 50,
      publicPath: process.env.BASE_URL,
      imagenumber: ""
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
      this.question.antwoord = this.value;
    }
  },
  props: ["question"]
};
</script>

<style scoped>
.carousel {
  display: block;
  max-width: 480px;
}
</style>
