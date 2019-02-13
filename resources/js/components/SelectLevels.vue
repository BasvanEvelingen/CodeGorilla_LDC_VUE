<template>
  <div>
    <b-form-select multiple :select-size="4" v-model="selected" :options="options" class="mb-3"></b-form-select>
    <div>
      Selected:
      <strong>{{ selected }}</strong>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      options: []
    };
  },
  methods: {
    getLevels() {
       this.isLoading = true;
      axios
        .get("/levels")
        .then(({ data }) => {
          let levelData = data["responses"][0]["objects"];
          for (var i in levelData) {
            let level = {};
            Level.value = levelData[i].id;
            Level.text = levelData[i].name;
          
            this.options.push(level);
            Level = {};
          }
        })
        .catch(error => console.log(error));
    }
},
  mounted() {
    this.getLevels();
  }
};
</script>

<style scoped>
</style>
