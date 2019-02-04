<template>
  <b-container class="mt-5">
    <h1>Welkom bij WatLigtmij</h1>
    <br>
    <b-card-group deck>
      <b-card header="Testen" title="Kies een test">
        <b-card-body>
          <b-list-group flush>
            <b-list-group-item>
              <router-link to="test">
                <a>Test 1</a>
              </router-link>
            </b-list-group-item>
            <b-list-group-item>
              <router-link to="test2">
                <a>Test 2</a>
              </router-link>
            </b-list-group-item>
          </b-list-group>
        </b-card-body>
      </b-card>

      <b-card header="Uitslagen" title="Kies een uitslag">
        <b-card-body>
          <b-list-group flush>
            <b-list-group-item>Uitslag Test</b-list-group-item>
            <b-list-group-item>Uitslag Test 2</b-list-group-item>
          </b-list-group>
        </b-card-body>
      </b-card>
    </b-card-group>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      //
    };
  },
  components: {
    //
  }
};
</script>
