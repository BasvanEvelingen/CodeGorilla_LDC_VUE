<template>
  <div class="app-component">
    <div v-if="this.isLoading==false">
      <question-component
        :question="question"
        @nextquestion="nextquestion"
        @prevquestion="prevquestion"
      ></question-component>
    </div>
    <button class="btn btn_info" v-if="this.completed">Test afronden</button>
  </div>
</template>

<script>
import QuestionComponent from "../components/QuestionSlider.vue";
import axios from "axios";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  data() {
    return {
      questions: [],
      currentQuestion: 0,
      question: { id: "", name: "", antwoord: "" },
      deltaQuestions: [],
      completed: false,
      isLoading: false,
      atStart: true,
      survey_id: -1
    };
  },
  methods: {
    getQuestions() {
      this.isLoading = true;
      axios
        .get("/questions")
        .then(({ data }) => {
          let apiquestions = data["responses"][0]["objects"];
          for (var i in apiquestions) {
            this.question.id = apiquestions[i].id;
            this.question.name = apiquestions[i].name;
            this.question.antwoord = -1;
            this.questions.push(this.question);
            this.question = {};
          }
          this.deltaQuestions = this.questions;
          this.isLoading = false;
          this.question = this.questions[this.currentQuestion];
        })
        .catch(error => console.log(error));
    },
    storeQuestions() {
      this.isLoading = true;
      var json_questions = [];
      for (let i = 0; i < this.questions.length; i++) {
        let question_obj = {};
        question_obj = {
          id: this.questions[i].id,
          name: this.questions[i].name,
          antwoord: this.questions[i].antwoord
        };
        json_questions.push(question_obj);
      }
      if (this.atStart) {
        axios
          .post("/surveys", json_questions)
          .then(({ data }) => {
            this.isLoading = false;
            this.atStart = false;
          })
          .catch(function(error) {
            console.log(error);
          });
      } else if (!this.atStart) {
        axios
          .put("/surveys", json_questions)
          .then(({ data }) => {
            this.isLoading = false;
            this.atStart = false;
          })
          .catch(function(error) {
            console.log(error);
          });
      }
    },
    checkInputs() {
      if (this.question.antwoord > 0) return true;
    },
    checkAnswersChanged() {
      let changed = false;
      for (let i = 0; i < this.questions.length; i++) {
        if (this.questions[i].antwoord != this.deltaQuestions[i].antwoord) {
          changed = true;
          this.deltaQuestions = this.questions;
        }
        return changed;
      }
    },
    updateAnswers(eventArray) {
      for (let i = 0; i < this.questions.length; i++) {
        if (parseInt(this.questions[i].id, 10) == parseInt(eventArray[0], 10)) {
          if (this.questions[i].antwoord != eventArray[1]) {
            let new_question_obj = {
              id: this.questions[i].id,
              name: this.questions[i].name,
              antwoord: eventArray[1]
            };
            this.questions.splice(i, 1, new_question_obj);
          }
        }
      }
    },
    prevquestion(eventArray) {
      this.updateAnswers(eventArray);
      this.checkComplete();
      if (this.currentQuestion > 0) {
        this.currentQuestion--;
        this.question = this.questions[this.currentQuestion];
      }
      this.storeQuestions();
    },
    nextquestion(eventArray) {
      this.updateAnswers(eventArray);
      this.checkComplete();
      if (this.currentQuestion < this.questions.length - 1) {
        this.currentQuestion++;
        this.question = this.questions[this.currentQuestion];
      }
      this.storeQuestions();
    },
    checkComplete() {
      let complete = true;
      for (let i = 0; i < this.questions.length; i++) {
        if (this.questions[i].antwoord == -1) {
          complete = false;
          break;
        }
      }
      if (complete == true) {
        this.completed = true;
      } else {
        this.completed = false;
      }
    }
  },
  mounted() {
    this.isMounted = true;
    this.getQuestions();
  },
  components: { QuestionComponent, Loading }
};
</script>

<style scoped>
</style>
