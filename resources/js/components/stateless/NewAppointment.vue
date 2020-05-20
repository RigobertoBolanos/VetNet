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
      <v-card-text>
        <v-form v-model="valid">
          <v-col cols="12" md="12">
            <v-text-field
              label="User Id"
              type="text"
              v-model="idUser"
              prepend-icon="mdi-account-circle"
              :rules="[v => !!v || 'Id is required']"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="12">
            <v-select
              v-model="pet"
              :items="pets"
              item-text="name"
              :rules="[v => !!v || 'Pet is required']"
              label="Select pet"
              prepend-icon="mdi-paw"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="12">
            <v-select
              v-model="assigned_to"
              :items="employees"
              prepend-icon="mdi-card-account-details-outline"
              item-text="fullname"
              :rules="[v => !!v || 'Assign the appointment to an employee is required']"
              label="Assign to Employee"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="12">
              <v-select
              v-model="service"
              :items="services"
              prepend-icon="mdi-format-list-checkbox"
              :rules="[v => !!v || 'Service is required']"
              label="Select a service"
              item-text="name"
              required
            ></v-select>
          </v-col>
          <v-col cols="12" md="12">
            <v-dialog
              ref="dialog"
              v-model="modal"
              :return-value.sync="date"
              persistent
              width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="date"
                  label="Appointment's date"
                  prepend-icon="mdi-calendar-month"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="date" scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
              </v-date-picker>
            </v-dialog>
          </v-col>
          <v-col cols="12" md="12">
              <v-select
              v-model="hour"
              :items="hours"
              prepend-icon="mdi-alarm"
              :rules="[v => !!v || 'Hour is required']"
              label="Select the hour of your appointment"
              required
            ></v-select>
            <small>The duration of each appointment is 30 minutes.</small>
          </v-col>
        </v-form>
        <v-spacer>
          <v-btn type="submit" :disabled="!valid" outlined color="primary" @click="addAppointment">
            <v-icon>mdi-login-variant</v-icon>
          </v-btn>
        </v-spacer>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
//import axios from 'axios'
import axios from '../../plugins/axios'

import qs from 'qs'
export default {
  name: "newappointmentform",
  props: ["appointment"],
  data() {
    return {
      date: new Date().toISOString().substr(0, 10),
      modal: false,
      valid: true,
      idUser: "",
      pet: null,
      assigned_to: null,
      service: null,
      employees: [],
      services: [],
      pets: [],
      hour: null,
      hours: 
      [         
        '08:00',
        '08:30',
        '09:00',
        '09:30',
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '14:00',
        '14:30',
        '15:00',
        '15:30',
        '16:00',
        '16:30',
        '17:00',
        '17:30',       
      ]
    };
  },
  methods: {
    closeAppointment(){
      this.$emit("closeAppointmentForm")
    },
    resetFields()
    {
      this.idUser = "",
      this.pet = null,
      this.assigned_to = null,
      this.service = null,
      this.employees = [],
      this.services = [],
      this.pets = [],
      this.hour = null
    },
    addAppointment() 
    {
      //Save Appointment this.$emit("notifyNewForum")
      /*axios.post("api/appointments", {
        date: this.date + " " + this.hour,
        pet: this.pet.id,
        assigned_to: this.assigned_to.id,
        service: this.service.id,
      })
      .then((result) => {
        console.log(result)
        this.$emit("notifyNewAppointment")
      }).catch((err) => {
        console.log(err)
      });
      */
     /*
      const params = new URLSearchParams()
      params.append('date', this.date + " " + this.hour)
      params.append('pet', this.pet.id)
      params.append('assigned_to', this.assigned_to.id)
      params.append('service', this.service.id)
    
      const requestBody = {
        date: this.date + " " + this.hour,
        pet: this.pet.id,
        assigned_to: this.assigned_to.id,
        service: this.service.id,
      } 
      
      const config = 
      {
        headers: 
        {     
          'Content-Type': 'application/x-www-form-urlencoded',
        } 
      }  
      axios.post('api/appointments', qs.stringify(requestBody), config) 
      .then((result) => console.log(result)).catch((err) => console.log(err))
      */        
      axios({
        method: 'post',
        url: 'appointments',
        data: qs.stringify(
        {         
          date: this.date + " " + this.hour,         
          pet: this.pet.id,         
          assigned_to: this.assigned_to.id,         
          service: this.service.id      
        }),
      }).then((response) => console.log(response)).catch((error) =>console.log(error))
      /*
      this.newForumStatus  = 
                  {
                    type: 'success',
                    message: 'The forum was created successfully',
                    icon: 'mdi-checkbox-marked-circle-outline'
                  }
      */
      //  this.$emit("notifyNewAppointmentStatus", this.newAppointmentStatus)
    }
  },
  created()
  {
    if(this.appointment)
    {
      this.pets.push(this.appointment.pet)
      this.pet = this.appointment.pet

      this.services.push(this.appointment.service)
      this.service = this.appointment.service

      this.employees.push(this.appointment.assigned_to)
      this.assigned_to = this.appointment.assigned_to

      this.idUser = this.appointment.pet.owner

      let dateTimeData = this.appointment.date.split(' ')

      let dateData = dateTimeData[0].split('-')
      let date = new Date(dateData[0], dateData[1], dateData[2])

      
      let timeData = dateTimeData[1].split(':', 2)
      let timeString = timeData[0] + ":" + timeData[1]
      this.hours.push(timeString)
      this.hour = timeString
    }
  }
};
</script>

<style scoped>
.toolbarTitle {
  font-size: 180%;
}
</style>