<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar color="rgba(135, 169, 206,0.8)" dark flat align-center>
        <v-btn @click="closePetForm" icon>
                <v-icon x-large>mdi-arrow-left-bold-hexagon-outline</v-icon>
          </v-btn>
        <v-spacer />
        <v-toolbar-title class="toolbarTitle">New Pet</v-toolbar-title>
        <v-spacer />
      </v-toolbar>
      <v-card-text>
        <v-form v-model="valid">
          <v-col cols="12" md="12">
            <v-text-field
              label="Name"
              type="text"
              v-model="pet.name"
              prepend-icon="mdi-paw"
              :rules="[v => (v!=='') || 'The name of the pet is required']"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="12">
          <v-text-field
              label="Breed"
              type="text"
              v-model="pet.breed"
              prepend-icon="mdi-paw"
              :rules="[v => (v!=='') || 'The breed of the pet is required']"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="12">
          <v-text-field
              label="Age"
              type="number"
              v-model="pet.age"
              prepend-icon="mdi-paw"
              :rules="[v => (v!=='') || 'The age of the pet is required']"
              required
            ></v-text-field>
          </v-col>
          <v-col>
            <v-text-field
              label="Owner Id"
              type="text"
              v-model="pet.owner.id"
              prepend-icon="mdi-paw"
              :rules="[
                        v => (v!=='') || 'The id of the owner is required',
                        v => /^([0-9])*$/.test(v) || 'The id must containt only numbers'
                      ]"
              required
            ></v-text-field>
          </v-col>
        </v-form>
        <v-spacer>
          <v-btn type="submit" :disabled="!valid" outlined color="rgba(135, 169, 206,0.8)" @click="petToUpdate?updatePet():addPet()">
            <v-icon>mdi-login-variant</v-icon>
          </v-btn>
        </v-spacer>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import axios from '../../plugins/axios'

export default {
  name: 'NewPet',
  props: ['petToUpdate'],
  data(){
    return{
      newPetStatus: null,
      valid: true,
      pet:{
        name: "",
        breed: "",
        age: "",
        owner:{
          type: Object
        },
        id: ""
      }
    }
  },
  methods:
  {
    closePetForm()
    {
      this.$emit("closePetForm")
    },
    updatePet()
    {
      axios.put('pets/' + this.pet.id, {
        name: this.pet.name,
        breed: this.pet.breed,
        age: this.pet.age,
        owner: this.pet.owner.id,
      })
      .then((response) => 
      {
        this.$emit("notifyNewPetStatus", this.newPetStatus)
        this.closePetForm()
        this.$emit('notifyNewPet')
      }).catch((error) => 
      {
        this.newPetStatus = {
          type: 'error',
          message: error.message,
          icon: 'mdi-skull-outline'
        }
        this.$emit("notifyNewPetStatus", this.newPetStatus)
        this.closePetForm()
      })
    },
    addPet()
    {
      axios.post('pets', {
        name: this.pet.name,
        breed: this.pet.breed,
        age: this.pet.age,
        owner: this.pet.owner.id,
      }).then((response) => 
      {
        axios.post('medical_histories/', {pet: response.data.data.id})
        .then((response) => 
        {
          axios.put('pets/' + response.data.data.pet,
          {
            name: this.pet.name,
            breed: this.pet.breed,
            age: this.pet.age,
            owner: this.pet.owner.id,
            medicalhistory: response.data.data.id
          }).then((response) =>
          {
            this.newPetStatus = {
              type: 'success',
              message: response.data.message,
              icon: 'mdi-checkbox-marked-circle-outline'
            }
            this.$emit("notifyNewPetStatus", this.newPetStatus)
            this.closePetForm()
            this.$emit('notifyNewPet')
          })
        }).catch((error) => 
        {
          this.newPetStatus = {
            type: 'error',
            message: error.message,
            icon: 'mdi-skull-outline'
          }
          this.$emit("notifyNewPetStatus", this.newPetStatus)
          this.closePetForm()
        })
      }).catch((error) => 
      {
        this.newPetStatus = {
          type: 'error',
          message: error.message,
          icon: 'mdi-skull-outline'
        }
        this.$emit("notifyNewPetStatus", this.newPetStatus)
        this.closePetForm()
      })
    }
  },
  created()
  {
    if(this.petToUpdate)
    {
      this.pet.name = this.petToUpdate.name
      this.pet.age = this.petToUpdate.age
      this.pet.breed = this.petToUpdate.breed
      this.pet.owner = this.petToUpdate.owner
      this.pet.id = this.petToUpdate.id
    }
  }
}
</script>

<style>
.toolbarTitle {
  font-size: 180%;
}
</style>