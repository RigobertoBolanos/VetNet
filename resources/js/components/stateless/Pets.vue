<template>
  <div class="container">
            <v-alert
              v-if=" newPetStatus != null"
              :type="newPetStatus.type"
              outlined
              text
              :icon="newPetStatus.icon"
              transition="scale-transition"
            >{{newPetStatus.message}}</v-alert>
      <v-toolbar style="background-color:#1976d2">
        <v-toolbar-title style="color: white">Pets</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-dialog v-model="add" :persistent="true">
          <NewPet v-if="add" :pet="petToUpdate" @notifyNewPet="petAdded" @notifyNewPetStatus="showNewPetStatus" @closePetForm="closePetForm"></NewPet>
        </v-dialog>

        <v-btn v-if="true" small fab color="blue" @click="add = !add">
          <v-icon>{{ add ? 'mdi-minus' : 'mdi-plus' }}</v-icon>
        </v-btn>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="pets"
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
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                <v-icon v-if="true" v-on="on" color="orange" @click="medicalHistory(item)">mdi-paw</v-icon>
              </template>
              <span>Medical History</span>
            </v-tooltip>
          </div>
          <div class="itemAction">
            <v-icon v-if="true" color="purple" @click="updatePet(item)">mdi-circle-edit-outline</v-icon>
          </div>

          <div class="itemAction">
            <v-icon v-if="true" color="red" @click="deletePet(item)">mdi-trash-can-outline</v-icon>
          </div>

        </div>
      </template>
      </v-data-table>
    </div>
</template>

<script>
import axios from 'axios'
import newPet from './NewPet'

export default {
  name: "pets",
    data(){
        return{
            pets: [],
            search: '', 
            add: false,
            newPetStatus: null  ,
            petToUpdate: null  
        }
    },
    computed: {
      headers () {
        return [
          {
          text: "Name",
          sortable: true,
          value: "name",
          align: "center"
          },
          {
            text: 'Breed',
            sortable: true,
            value: 'breed',
            align: 'center'
          },
          {
            text: 'Age',
            sortable: true,
            value: 'age',
            align: 'center'
          },
          {
            text: 'Owner',
            sortable: true,
            value: 'owner.fullname',
            align: 'center'
          },
          { text: "", value: "actions", sortable: false, align: "center" }
        ]
      },
    },
    components: 
    {
      NewPet
    },
    methods: {
      medicalHistory(pet){

      },
      filterText(value, search) 
      {
        return (
          value != null &&
          search != null &&
          typeof value === "string" &&
          value.toString().indexOf(search) !== -1
        );
      },
      updatePet(item)
      {
        this.petToUpdate = item
        this.add = true
      },
      petAdded() 
      {
        this.add = false;
        this.refresh();
      },
      closePetForm() 
      {
        this.add = false;
        this.petToUpdate = null;
      },
      showNewPetStatus(status)
      {
        this.newPetStatus = status
        setTimeout(() => this.newPetStatus = null, 3000);
      },
      async refresh()
      {
        let query = await axios.get("api/pets")

        query.data.data.forEach( async data =>
        {
          let owner =  await axios.get("api/users/" + data.owner)
         
          this.pets.push({
            name: data.date,
            breed: data.breed,
            age: data.age,
            owner: owner.data.data
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