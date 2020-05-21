<template>
  <div id="App">
    <v-app class="LoginDiv">
      <v-layout justify-center>
        <v-flex xs14 sm12 md10>
          <v-dialog v-model="deletedialog">
            <v-card v-model="deletedialog">
                <v-alert
                  v-if="status != null"
                  :type="status.type"
                  outlined
                  text
                  :icon="status.icon"
                  transition="scale-transition"
                  >{{status.message}}
                </v-alert>
            </v-card>
          </v-dialog>

          <v-card class="elevation-12" style="margin-bottom: 5%">
            <v-toolbar color="primary" dark flat align-center>
              <v-btn to="/pets" icon>
                <v-icon x-large>mdi-arrow-left-bold-hexagon-outline</v-icon>
              </v-btn>
              <v-spacer />
              <v-toolbar-title class="toolbarTitle">Medical History #{{medicalHistoryId}}</v-toolbar-title>
              <v-spacer />
            </v-toolbar>

            <v-dialog v-model="add" :persistent="true">
              <NewMedicalRecord v-if="add" :appointment="appointmentToUpdate" @notifyNewAppointment="appointmentAdded" @notifyNewAppointmentStatus="showNewAppointmentStatus" @closeAppointmentForm="closeAppointmentForm"></NewMedicalRecord>
            </v-dialog>

            <v-card-subtitle>
              <v-container fluid grid-list-md text-xs-center> 
                <v-layout row wrap>
                    <v-flex xs12>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Name: {{pet.name}}</v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs4>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Id: {{pet.id}}</v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs4>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Breed: {{pet.breed}}</v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs4>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Age: {{pet.agre}}</v-card-text>
                      </v-card>
                    </v-flex>

                    <v-flex xs12>
                      <v-card dark color="secondary">
                        <v-card-text class="px-0">Owner Information</v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs4>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Name: {{pet.owner.fullname}}</v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs4>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Breed: {{pet.owner.address}}</v-card-text>
                      </v-card>
                    </v-flex>
                    <v-flex xs4>
                      <v-card dark color="primary">
                        <v-card-text class="px-0">Age: {{pet.owner.phoneNumber}}</v-card-text>
                      </v-card>
                    </v-flex>
                </v-layout>
              </v-container>
              
            </v-card-subtitle>
            <v-card-actions>
              <v-spacer></v-spacer>
          
                <v-btn class="ma-2" tile outlined color="blue">
                  <v-icon left @click="addRecord = true">mdi-clipboard-plis-outlined</v-icon> New Medical Record
                </v-btn>
            </v-card-actions>
          </v-card>

          <v-card-text v-if="records.lengt>0">
              <v-expansion-panels multiple>
                
                  <v-expansion-panel v-for="record in records" :key="record.id">
                      <v-expansion-panel-header><v-icon>mdi-calendar-month</v-icon> {{record.date}}</v-expansion-panel-header>
                      <v-expansion-panel-content>
                        <v-card-subtitle>
                          <b>Veterinary:</b> {{record.veterinary.fullname}}
                        </v-card-subtitle>

                        <v-card-subtitle>Consultation Reason</v-card-subtitle>
                        <v-card-text>
                          {{record.consultationreason}}
                        </v-card-text>
                       
                        <v-card-subtitle>Diagnosis</v-card-subtitle>
                        <v-card-text>
                          {{record.diagnosis}}
                        </v-card-text>

                        <v-card-subtitle>Treatment</v-card-subtitle>
                        <v-card-text>
                          {{record.treatments}}
                        </v-card-text>

                      </v-expansion-panel-content>
                    </v-expansion-panel>
              </v-expansion-panels>
            </v-card-text>
            <v-card-text>
              No records available at this moment.
            </v-card-text>
           
           <v-row justify="center">
              <v-dialog v-model="addRecord" persistent max-width="600px">
                <v-card v-model="valid">
                  <v-card-title>
                    <span class="headline">New Medical Record</span>
                  </v-card-title>
                  <v-card-text>
                    
                    <v-form >
                        <v-container>
                          <v-textarea
                              outlined
                              label="Consultation Reason*"
                              :rules="[v => !!v || 'This field is required']"
                              v-model="newRecord.consultationReason"
                            ></v-textarea>

                            <v-textarea
                              outlined
                              label="Diagnosis*"
                              :rules="[v => !!v || 'This field is required']"
                              v-model="newRecord.diagnosis"
                            ></v-textarea>

                            <v-textarea
                              outlined
                              label="Treatments*"
                              :rules="[v => !!v || 'This field is required']"
                              v-model="newRecord.treatments"
                            ></v-textarea>
                          </v-container>
                    </v-form>
                    <small>* indicates required field</small>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="white" text @click="addRecord = false">Close</v-btn>
                    <v-btn type="submit" color="white" text @click="newRecord" >Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-row>
        </v-flex>
      </v-layout>
    </v-app>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "Medical History",
  data() {
    return {
      pet: {
        name : "",
        age: "",
        breed: "",
        id: "",
        owner: {
          fullname: "",
          address: "",
          phoneNumber: ""
        }
      },
      medicalHistoryId: "",
      records: [],
      valid:true,
      edit: false,
      addRecord: false,
      deletedialog: null,
      status: null,
      newRecord:{
        consultationReason:"",
        diagnosis:"",
        treatment:""
      }
    };
  },
  methods: {
   
    async refresh() {
      this.records = [];
      let petData = await axios.get("pets/"+this.$route.params.id)
      let ownerData = await axios.get("users/"+petData.data.data.owner)

      this.pet = {
        name : petData.data.data.name,
        age: petData.data.data.age,
        breed: petData.data.data.breed,
        id: petData.data.data.id,
        owner: {
          fullname: ownerData.data.data.fullname,
          address: ownerData.data.data.address,
          phoneNumber: ownerData.data.data.phonenumber
        }
      }

      this.medicalHistoryId = petData.data.data.medicalhistory
      let recordsData = await axios.get("medicalHistory/medicalREcords/"+this.medicalHistoryId)
      let tempRecords = []
      recordsData.data.data.array.forEach(record => {
          this.tempRecords.push(record);
      });

      if(tempRecords.length>0){
        this.records = recordsData.sort(function(a, b) {
            return a.date - b.date
      });
      }
    },
    showStatus(status)
    {
      this.deletedialog = {}
      this.status = status
      setTimeout(() => {this.status = null;this.deletedialog = null}, 2000);
    },
    newRecord() 
    {
      let editStatus = null
      this.db.collection("entries").doc(this.forum.id).set(
      {
        postdata: this.forum.postdata
      },
      { 
        merge: true 
      }).then(() =>
      {
        editStatus  = 
        {
            type: 'success',
            message: 'Your forum was updated',
            icon: 'mdi-checkbox-marked-circle-outline'
        }
      }).catch(function(error) 
      {
        editStatus = 
        {
          type: "error",
          message: error.message,
          icon: "mdi-skull-outline"
        }
      });
      this.edit = false
      this.showStatus(editStatus)
    }
  },
  mounted: function() {
    this.refresh();
  },
  filters: {
    formatDate: function(value) {
      if (!value) return "";
      return new Date(value.seconds * 1000).toLocaleDateString("es-ES");
    }
  },
  components: {
  }
};
</script>

<style scoped>
.toolbarTitle {
  font-size: 180%;
}
.col {
  padding: 0px;
}
.v-alert{
  margin: 0px;
}
.v-card__actions {
  padding: 0px;
  background: #1976d2;
}
.content{
  margin: 1% 3% 2% 3%;
}
</style>