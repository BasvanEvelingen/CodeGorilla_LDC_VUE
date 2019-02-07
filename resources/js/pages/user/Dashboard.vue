<template>
  <b-container class="mt-5">
    <h1>Welkom bij WatLigtmij</h1>
    <br>
    <b-card-group deck>
      <b-card header="Testen" title="Kies een test">
        <b-card-body>
          <b-list-group flush>
            <b-list-group-item>
              <router-link to="test2">
                <a>Test Voorbeeld</a>
              </router-link>
            </b-list-group-item>
          </b-list-group>
        </b-card-body>
      </b-card>

      <b-card header="Uitslagen" title="Kies een uitslag">
        <b-card-body>
          <Outcome></Outcome>
        </b-card-body>
      </b-card>
    </b-card-group>
  </b-container>
</template>

<script>
import Outcome from "../../components/Outcome.vue";

export default {
  data() {
    return {
      //
    };
  },
  components: {
    Outcome
  }
};
</script>
