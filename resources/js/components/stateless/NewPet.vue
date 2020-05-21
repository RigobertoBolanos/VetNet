<template>
  <div id="app">
    <v-card class="elevation-12">
      <v-toolbar color="primary" dark flat align-center>
        <v-btn @click="closeAppointment" icon>
                <v-icon x-large>mdi-arrow-left-bold-hexagon-outline</v-icon>
          </v-btn>
        <v-spacer />
        <v-toolbar-title class="toolbarTitle">New Appointment</v-toolbar-title>
        <v-spacer />
      </v-toolbar>
    </v-card>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>