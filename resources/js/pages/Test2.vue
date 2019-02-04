<template>
  <div class="app-component">
    <loading :active.sync="isLoading" color="#ff4119"></loading>
    <div v-if="this.isLoading==false">
      <question-component
        :question="question"
        @nextquestion="nextquestion"
        @prevquestion="prevquestion"
      ></question-component>
    </div>
    <br>
    <b-row align-h="center">
      <b-progress :value="currentQuestion
      " :max="maxlength" show-value class="w-50"></b-progress>
    </b-row>

    <b-row>
      <button class="btn btn_warning" v-if="this.completed">Test afronden</button>
    </b-row>
  </div>
</template>

<script>
import QuestionComponent from "../components/QuestionHearts.vue";
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
      maxlength: 31,
      completed: false,
      isLoading: false,
      atStart: false
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
      axios
        .post("/surveys", json_questions)
        .then(({ data }) => {
          this.isLoading = false;
          console.log("data: " + data);
        })
        .catch(function(error) {
          console.log(error);
        });
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
    logQuestionArrays() {
      for (let i = 0; i < this.questions.length; i++) {
        console.log("rquestions: " + this.questions[i].antwoord + "\n");
        console.log("dquestions: " + this.deltaQuestions[i].antwoord + "\n");
        console.log("----------------------");
      }
    },
    checkComplete() {
      let complete = true;
      for (let i = 0; i < this.questions.length; i++) {
        console.log(
          "questions: " +
            this.questions[i].id +
            " :" +
            this.questions[i].antwoord +
            "\n"
        );
        if (this.questions[i].antwoord == -1) {
          complete = false;
          console.log("not completed yet");
          break;
        }
      }
      if (complete == true) {
        console.log("completed!!!");
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
