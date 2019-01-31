<template>
  <ul class="navbar-nav ml-auto">
    <!-- niet ingelogd -->
    <li v-if="!$auth.check()" class="nav-item">
      <a class="nav_link" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
        <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
      </a>
    </li>
    <!-- ingelogde gebruiker -->
    <li v-if="$auth.check(1)" class="nav-item">
      <a class="nav_link" v-for="(route, key) in routes.user" v-bind:key="route.path">
        <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
      </a>
    </li>
    <!-- ingelogde beheerder -->
    <li v-if="$auth.check(2)" class="nav-item">
      <a class="nav_link" v-for="(route, key) in routes.admin" v-bind:key="route.path">
        <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
      </a>
    </li>
    <!-- uitloggen -->
    <li class="nav-item" v-if="$auth.check()">
      <a class="nav_link" href="#" @click.prevent="$auth.logout()">Uitloggen</a>
    </li>
  </ul>
</template>


<script>
export default {
  data() {
    return {
      routes: {
        // niet ingelogd
        unlogged: [
          {
            name: "Registreren",
            path: "register"
          },
          {
            name: "Inloggen",
            path: "login"
          }
        ],

        // gebruiker ingelogd
        user: [
          {
            name: "Hoofdmenu",
            path: "user.dashboard"
          }
        ],
        // beheerder ingelogd
        admin: [
          {
            name: "Hoofdmenu",
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

<style scoped>
.nav_link {
  font-size: 1rem;
  margin-right: 10px;
}
</style>
