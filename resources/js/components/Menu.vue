<template>
  <b-row>
    <b-col sm="12">
      <b-nav>
        <!-- niet ingelogd -->
        <div v-if="!$auth.check()">
          <b-nav-item
            class="nav_link"
            v-for="(route, key) in routes.unlogged"
            v-bind:key="route.path"
          >
            <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
          </b-nav-item>
        </div>
        <!-- ingelogde gebruiker -->
        <div v-if="$auth.check(1)">
          <b-nav-item class="nav_link" v-for="(route, key) in routes.user" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
          </b-nav-item>
        </div>
        <!-- ingelogde beheerder -->
        <div v-if="$auth.check(2)">
          <b-nav-item class="nav_link" v-for="(route, key) in routes.admin" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
          </b-nav-item>
        </div>
        <!-- uitloggen -->
        <b-nav-item class="nav_link" v-if="$auth.check()">
          <a href="#" @click.prevent="$auth.logout()">Logout</a>
        </b-nav-item>
      </b-nav>
    </b-col>
  </b-row>
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
            name: "Dashboard",
            path: "user.dashboard"
          }
        ],
        // beheerder ingelogd
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

<style scoped>
.nav_link {
  font-size: 2rem;
}
</style>
