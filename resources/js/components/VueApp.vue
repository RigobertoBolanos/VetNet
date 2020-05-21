<template>
    <v-app>
      <div>
        <toolbar></toolbar>
        <router-view></router-view>
      </div>
    </v-app>
</template>

<script>
import Home from './Home'
import Toolbar from './statefull/ToolBar'
export default {
  name: 'App',
  computed: {
  },
  components: {
    toolbar : Toolbar,
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
}
</style>