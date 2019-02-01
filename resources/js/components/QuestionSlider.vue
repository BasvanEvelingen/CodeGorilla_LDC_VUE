<template>
  <b-container>
    <b-card header="<strong>{{this.question.id}}</strong> {{this.question.name}}">
      <b-card-body></b-card-body>
      <b-card-footer>
        <b-form>
          <b-form-group>
          
              <label for="formControlRange">Ik heb zoveel iets met</label>
              <b-input
                @change="updateRange"
                v-model="value"
                type="range"
                class="form-control-range"
                id="formControlRange"
                min="0"
                max="100"
                value="0"
              >
        
          </b-form-group>

          <b-form-group>
          
            
                <!-- <b-input @click="prevquestion" type="button" class="btn btn-primary mr-auto" value="vorige vraag">
                <b-input @click="nextquestion" type="button" class="btn btn-success" value="volgende vraag">-->
            
        
          </b-form-group>
        </b-form>
      </b-card-footer>
    </b-card>
  </b-container>
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
