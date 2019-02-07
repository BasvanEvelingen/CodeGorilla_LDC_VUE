<template>
  <b-container>
    <loading :active.sync="isLoading" color="#ff4119"></loading>
    <b-table ref="table" bordered striped :items="items" :fields="fields" responsive>
      <template slot="actions" slot-scope="row">
        <a class="clickable" @click.stop="showOutcome(row.item.id)">
          <font-awesome-icon class="icon-color" icon="plus-square" size="2x"/>
        </a>
      </template>
    </b-table>
  </b-container>
</template>

<script>
import axios from "axios";
import collect from "collect.js";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  components: {
    Loading
  },
  data() {
    return {
      has_error: false,
      surveys: null,
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
        user_id: {
          label: "gebruikers id",
          sortable: false
        },
        created_at: {
          label: "Aangemaakt op",
          sortable: true
        },
        actions: {
          label: "Acties",
          sortable: false
        }
      },
      items: []
    };
  },

  mounted() {
    this.getSurveys();
  },

  methods: {
    getSurveys() {
      this.$http({
        url: `surveys`,
        method: "GET"
      }).then(
        res => {
          this.items = collect(res.data.surveys).all();
          console.log("items: " + this.items);
        },
        () => {
          this.has_error = true;
        }
      );
    },
    showOutcome(id) {
      console.log("pressed add test: " + id);
    }
  }
};
</script>

<style scoped>
.clickable:hover {
  cursor: pointer;
}
.icon-color {
  color: #00aeef;
}
</style>
