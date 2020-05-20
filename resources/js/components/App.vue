<template>
    <v-app>
      <div>
          <router-view></router-view>
      </div>
    </v-app>
</template>

<script>
export default {
  name: 'App',
  computed: {
  },
  components: {
  }
}
</script>

<style>
body{
   background-color: white;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: white;
}
</style>