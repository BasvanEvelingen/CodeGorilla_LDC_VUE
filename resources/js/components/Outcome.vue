<template>
  <b-container>
    <loading :active.sync="isLoading" color="#ff4119"></loading>
    <b-table ref="table" bordered striped :items="items" :fields="fields" responsive></b-table>
  </b-container>
</template>

<script>
import axios from "axios";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  components: {
    Loading
  },
  data() {
    return {
      isLoading: false,
      fields: {
        id: {
          label: "Id",
          sortable: true
        },
        name: {
          label: "Naam",
          sortable: true
        },
        matchperc: {
          label: "Match percentage",
          sortable: true
        }
      },
      items: []
    };
  },
  methods: {
    getResults() {
      this.isLoading = true;
      axios
        .post("/questions")
        .then(({ data }) => {
          this.isLoading = false;
          let outcomeDetails = data["responses"][0]["object"];
          for (var i in outcomeDetails) {
            let item = [];
            item.id = outcomeDetails[i].id;
            item.name = outcomeDetails[i].name;
            item.matchperc = outcomeDetails[i].matchperc;
            this.items.push(item);
          }
          this.$refs.table.refresh();
        })
        .catch(error => console.log(error));
    }
  },
  mounted() {
    this.getResults();
  }
};
</script>
