<template>
  <div class="services">
    <h1>
      Servicios de Calidad
    </h1>
    <v-container grid-list-md fluid>
      <v-row>
          <v-col xs="12" sm="4" md="3" v-for="service in services" :key="service.id">
            <Service :service="service"></Service>
          </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Service from '../statefull/Service';
import axios from 'axios'

export default {
  components: {
    Service
  },
  data(){
    return{
      services: []
    }
  },
  created(){
    axios.get('services').then((response) => this.services = response.data.data).catch((error) => console.log(error))
  }
}
</script>

<style scope>

  .services{
    margin: 5% 12% 15% 12%;
  }
</style>