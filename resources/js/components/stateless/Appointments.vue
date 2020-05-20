<template>
  <div class="container">
            <v-alert
              v-if=" newAppointmentStatus != null"
              :type="newAppointmentStatus.type"
              outlined
              text
              :icon="newAppointmentStatus.icon"
              transition="scale-transition"
            >{{newAppointmentStatus.message}}</v-alert>
      <v-toolbar style="background-color:#1976d2">
        <v-toolbar-title style="color: white">Appointments</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-dialog v-model="add" :persistent="true">
          <NewAppointment v-if="add" :appointment="appointmentToUpdate" @notifyNewAppointment="appointmentAdded" @notifyNewAppointmentStatus="showNewAppointmentStatus" @closeAppointmentForm="closeAppointmentForm"></NewAppointment>
        </v-dialog>

        <v-btn v-if="true" small fab color="blue" @click="add = !add">
          <v-icon>{{ add ? 'mdi-minus' : 'mdi-plus' }}</v-icon>
        </v-btn>
      </v-toolbar>
      <v-data-table
      :headers="headers"
      :items="appointments"
      item-key="id"
      class="elevation-1"
      :search="search"
      :custom-filter="filterText"
      calculate-widths:true
      >
      <template v-slot:top>
          <v-text-field v-model="search" label="Search" class="mx-4"></v-text-field>
      </template>

      <template v-if="true" v-slot:item.actions="{ item }" align-left>
        <div class="actionItems">

            
          <div class="itemAction">
            <v-icon v-if="true" color="purple" @click="updateAppointment(item)">mdi-circle-edit-outline</v-icon>
          </div>

          <div class="itemAction">
            <v-icon v-if="true" color="red" @click="deleteAppointment(item)">mdi-trash-can-outline</v-icon>
          </div>

        </div>
      </template>
      </v-data-table>
    </div>
</template>

<script>
import axios from 'axios'
import NewAppointment from './NewAppointment'

export default {
  name: "appointments",
    data(){
        return{
            appointments: [],
            search: '', 
            add: false,
            newAppointmentStatus: null  ,
            appointmentToUpdate: null  
        }
    },
    computed: {
      headers () {
        return [
          {
          text: "Date",
          sortable: true,
          value: "date",
          align: "center"
          },
          {
            text: 'Assigned_to',
            sortable: true,
            value: 'assigned_to.fullname',
            align: 'center'
          },
          {
            text: 'Pet',
            sortable: true,
            value: 'pet.name',
            align: 'center'
          },
          {
            text: 'Services',
            sortable: true,
            value: 'service.name',
            align: 'center'
          },
          { text: "", value: "actions", sortable: false, align: "center" }
        ]
      },
    },
    components: 
    {
      NewAppointment
    },
    methods: {
      filterText(value, search) 
      {
        return (
          value != null &&
          search != null &&
          typeof value === "string" &&
          value.toString().indexOf(search) !== -1
        );
      },
      updateAppointment(item)
      {
        this.appointmentToUpdate = item
        this.add = true
      },
      appointmentAdded() 
      {
        this.add = false;
        this.refresh();
      },
      closeAppointmentForm() 
      {
        this.add = false;
        this.appointmentToUpdate = null;
      },
      showNewAppointmentStatus(status)
      {
        this.newAppointmentStatus = status
        setTimeout(() => this.newAppointmentStatus = null, 3000);
      },
      async refresh()
      {
        let query = await axios.get("appointments")
        console.log(query)
        query.data.data.forEach( async data =>
        {
          let pet =  await axios.get("pets/" + data.pet)
          let assigned_to = await axios.get("users/" + data.assigned_to)
          let service = await axios.get("services/" + data.service)

          this.appointments.push({
            date: data.date,
            pet: pet.data.data,
            assigned_to: assigned_to.data.data,
            service: service.data.data
          })
        });

      }
    },
    created()
    {
        this.refresh();
    },
    filters: 
      {
        formatDate: function(timestamp) {
        if (!timestamp) return "";
        return new Date(timestamp.seconds * 1000).toLocaleDateString("es-ES");
        }
      }
}
</script>

<style>
.v-toolbar__title {
  align-content: center;
  font-size: 180%;
  color: white;
}
.v-dialog_content {
    overflow-y:hidden;
}
.actionItems{
  float: left;
}
.itemAction{
  display: inline;
  margin-left: 20px;
}
.v-dialog {
    width: 50%;
}
</style>