<template>
  <b-container>
    <loading :active.sync="isLoading" color="#ff4119"></loading>
    <b-table ref="table" bordered striped :items="items" :fields="fields" responsive>
      <template slot="actions" slot-scope="row">
        <a class="clickable" @click.stop="addTest(row.item.id)">
          <font-awesome-icon class="icon-color" icon="plus-square" size="2x"/>
        </a>
        <a class="clickable" @click.stop="deleteUser(row.item.id)">
          <font-awesome-icon class="icon-color" icon="trash-alt" size="2x"/>
        </a>
      </template>
    </b-table>
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
      has_error: false,
      users: null,
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
        email: {
          label: "Email",
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
    this.getUsers();
  },

  methods: {
    getUsers() {
      this.$http({
        url: `users`,
        method: "GET"
      }).then(
        res => {
          this.items = res.data.users;
        },
        () => {
          this.has_error = true;
        }
      );
    },
    addTest(user_id) {
      console.log("pressed add test: " + user_id);
    },
    deleteUser(user_id) {
      this.isLoading = true;
      axios
        .delete(`/users/${user_id}`)
        .then(({ data }) => {
          console.log("succesvol verwijderd");
          this.isLoading = false;
          //this.$root.$emit('bv::refresh::table', 'userTable');
        })
        .catch(function(error) {
          console.log(error);
        });
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
