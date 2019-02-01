<template>
  <div class="card">
    <div class="card-body">
      <p class="card-text">
        <strong>{{this.question.id}}</strong>
        {{this.question.name}}
      </p>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      value: 50
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
</style>
