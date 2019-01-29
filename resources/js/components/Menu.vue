<template>
  <b-nav>
    <ul>
      <!-- niet ingelogd -->
      <div v-if="!$auth.check()">
        <b-nav-item v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </b-nav-item>
      </div>
      <!-- ingelogde gebruiker -->
      <div v-if="$auth.check(1)">
        <b-nav-item v-for="(route, key) in routes.user" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </b-nav-item>
      </div>
      <!-- ingelogde beheerder -->
      <div v-if="$auth.check(2)">
        <b-nav-item v-for="(route, key) in routes.admin" v-bind:key="route.path">
          <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </b-nav-item>
      </div>
      <!-- uitloggen -->
      <b-nav-item v-if="$auth.check()">
        <a href="#" @click.prevent="$auth.logout()">Logout</a>
      </b-nav-item>
    </ul>
  </b-nav>
</template>

<script>
export default {
  data() {
    return {
      routes: {
        // UNLOGGED
        unlogged: [
          {
            name: "Register",
            path: "register"
          },
          {
            name: "Login",
            path: "login"
          }
        ],

        // LOGGED USER
        user: [
          {
            name: "Dashboard",
            path: "user.dashboard"
          }
        ],
        // LOGGED ADMIN
        admin: [
          {
            name: "Dashboard",
            path: "admin.dashboard"
          }
        ]
      }
    };
  },
  mounted() {
    //
  }
};
</script>
