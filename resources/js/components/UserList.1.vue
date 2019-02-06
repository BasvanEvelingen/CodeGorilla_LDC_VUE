<template>
  <div>
    <loading :active.sync="isLoading" color="#ff4119"></loading>
    <h3>Lijst met gebruikers</h3>
    <div class="alert alert-danger" v-if="has_error">
      <p>Fout bij het ophalen van gebruikers.</p>
    </div>

    <table class="table">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Naam</th>
        <th scope="col">Email</th>
        <th scope="col">Datum van registratie</th>
        <th scope="col">Acties</th>
      </tr>
      <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
        <th scope="row">{{ user.id }}</th>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.created_at}}</td>
        <td>
          <a @click="addTest(user.id)" class="anchor">
            <font-awesome-icon class="icon" icon="plus-square" size="2x"/>
          </a>
          <a @click="deleteUser(user.id)" class="anchor">
            <font-awesome-icon class="icon" icon="trash-alt" size="2x"/>
          </a>
        </td>
      </tr>
    </table>
  </div>
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
      isLoading: false
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
          this.users = res.data.users;
        },
        () => {
          this.has_error = true;
        }
      );
    },
    addTest() {
      console.log("pressed add test");
    },
    deleteUser(user_id) {
      axios

        .delete(`/users/${user_id}`)
        .then(({ data }) => {
          this.isLoading = false;
          this.getUsers();
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.anchor:hover {
  cursor: pointer;
}
.icon {
  color: #00aeef;
}
</style>
