<template>
  <div class="services">
    <h1>
      Servicios de Calidad
    </h1>
    <v-container grid-list-md fluid>
      <v-row>
          <v-col xs="12" sm="4" md="3" v-for="service in services" :key="service.id">
            <card-service :service="service"></card-service>
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
    cardService : Service
  },
  data(){
    return{
      services: []
    }
  },
  created(){
    axios.get('api/services').then((response) => this.services = response.data.data)
  }
}
</script>

<style scope>

  .services{
    margin: 5% 12% 15% 12%;
  }
</style>