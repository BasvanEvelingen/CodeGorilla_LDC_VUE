<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Admin Dashboard</div>

      <div class="card-body">Welkom bij de administratie sectie</div>
    </div>
    <div class="card card-default">
      <div class="card-header">Lijst van gebruikers</div>

      <div class="card-body">
        <userList></userList>
      </div>
    </div>
  </div>
</template>

<script>
import userList from "../../components/user-list.vue";
export default {
  mounted() {
    //
  },
  components: {
    userList
  }
};
</script>
