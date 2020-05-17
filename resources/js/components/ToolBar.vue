<template>
  <v-toolbar dense >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>VetNet</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-toolbar>
</template>

<script>

export default {
  name: "Toolbar",
  computed: {
  
  },
  data() {
    return {
      
    };
  },
  methods: {
   
  }
};
</script>

<style scoped>
.v-toolbar.v-sheet {
    max-height: fit-content;
}

</style>
