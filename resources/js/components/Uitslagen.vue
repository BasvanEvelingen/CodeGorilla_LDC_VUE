<template>
  <div>
    <h3>Lijst met uitslagen</h3>
    <div class="alert alert-danger" v-if="has_error">
      <p>Fout bij het ophalen van gebruikers.</p>
    </div>

    <table class="table">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Naam test</th>
        <th scope="col">Afgerond op</th>
        <th scope="col">Uitslag</th>
      </tr>

      <!-- <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
        <th scope="row">{{ user.id }}</th>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.created_at}}</td>
      </tr>
      -->
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      has_error: false,
      users: null
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
    }
  }
};
</script>
