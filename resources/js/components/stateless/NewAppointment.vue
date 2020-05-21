<template>
  <div id="app">
    <v-card class="elevation-12">
      <v-toolbar color="primary" dark flat align-center>
        <v-btn @click="closeAppointmentForm" icon>
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
              :disabled="appointment != null"
              v-model="idUser"
              v-on:change="updatePets()"
              prepend-icon="mdi-account-circle"
              :rules="[v => (v!=='') || 'Id is required']"
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
              return-object
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
              return-object
            ></v-select>
          </v-col>
          <v-col cols="12" md="12">
              <v-select
              v-model="service"
              :items="services"
              item-text="name"
              prepend-icon="mdi-format-list-checkbox"
              :rules="[v => !!v || 'Service is required']"
              label="Select a service"
              required
              return-object
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
              <v-date-picker v-model="date">
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
          <v-btn type="submit" :disabled="!valid" outlined color="primary" @click="appointment?updateAppointment():addAppointment()">
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
      newAppointmentStatus: null,
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
    closeAppointmentForm()
    {
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
      console.log(this.service.id)
      axios.post('appointments',
      {         
          date: this.date + " " + this.hour,         
          pet: this.pet.id,         
          assigned_to: this.assigned_to.id,         
          service: this.service.id
      }).then((response) => 
      {
        this.newAppointmentStatus = {
          type: 'success',
          message: response.data.message,
          icon: 'mdi-checkbox-marked-circle-outline'
        }
        this.$emit("notifyNewAppointmentStatus", this.newAppointmentStatus)
        this.closeAppointmentForm()
        this.$emit('notifyNewAppointment')
      }).catch((error) => 
      {
        this.newAppointmentStatus = {
          type: 'error',
          message: error.message,
          icon: 'mdi-skull-outline'
        }
        this.$emit("notifyNewAppointmentStatus", this.newAppointmentStatus)
        this.closeAppointmentForm()
      })
    },
    updateAppointment() 
    {
      console.log(this.appointment)
      axios.put('appointments/' + this.appointment.id,
        {         
          date: this.date + " " + this.hour,         
          pet: this.pet.id,         
          assigned_to: this.assigned_to.id,         
          service: this.service.id, 
          id: this.appointment.id     
        }
      )
      .then((response) => 
      {
        this.newAppointmentStatus = 
        {
          type: 'success',
          message: response.data.message,
          icon: 'mdi-checkbox-marked-circle-outline'
        }
        this.$emit("notifyNewAppointmentStatus", this.newAppointmentStatus)
        this.closeAppointmentForm()
        this.$emit('notifyNewAppointment')
      })
      .catch((error) => 
      {
        this.newAppointmentStatus = 
        {
          type: 'error',
          message: error.message,
          icon: 'mdi-skull-outline'
        }
        this.$emit("notifyNewAppointmentStatus", this.newAppointmentStatus)
        this.closeAppointmentForm()
      })
    },
    async updatePets()
    {
      let query = await axios.get("pets")
      let userPets = []
      query.data.data.forEach(pet => 
      {
        if(pet.owner == this.idUser)
        {
          userPets.push(pet)
        }
      })
      this.pets = userPets
    },
    async updateOptions()
    {
      let query = await axios.get("services")
      .catch((error) => console.log(error))
      this.services = query.data.data

      query = await axios.get("employees")
      .catch((error) => console.log(error))
      this.employees = query.data.data
    }
  },
  created()
  {
    if(this.appointment)
    {
      this.services.push(this.appointment.service)
      this.service = this.appointment.service

      this.employees.push(this.appointment.assigned_to)
      this.assigned_to = this.appointment.assigned_to

      this.idUser = this.appointment.pet.owner

      let dateTimeData = this.appointment.date.split(' ')

      this.date = dateTimeData[0]

      
      let timeData = dateTimeData[1].split(':', 2)
      let timeString = timeData[0] + ":" + timeData[1]
      this.hour = timeString

      this.updatePets()
      this.pets.forEach(pet => 
      {
        if(pet.id == this.appointment.pet.id)
        {
          this.pet = pet
        }
      })
      
    }
    this.updateOptions()
  }
};
</script>

<style scoped>
.toolbarTitle {
  font-size: 180%;
}
</style>