<template>
<v-container style="margin-top:3%">
      <v-layout justify-center style="padding-left:8%;padding-right:8%">
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

            <v-toolbar color="rgba(135, 169, 206,0.8)" dark flat align-center>
              <v-btn to="/pets" icon>
                <v-icon x-large>mdi-arrow-left-bold-hexagon-outline</v-icon>
              </v-btn>
              <v-spacer />
              <v-toolbar-title class="toolbarTitle">Medical History No.{{medicalHistoryId}}</v-toolbar-title>
              <v-spacer />
            </v-toolbar>

            <v-card-subtitle>
              <v-container fluid grid-list-md text-xs-center> 
                <v-layout row wrap>
                  <v-flex xs6 child-flex>
                      <v-card   color="rgba(254, 192, 220)">
                        <v-card-text style="color:white; font-size:150%">Pet Info</v-card-text>
                      </v-card>
                      <v-flex style="text-align:left">
                        <v-card  class="elevation-4" style="margin-top:3%;padding-left:3%" >
                            <v-card-text class="px-0"><b>Name:</b> {{pet.name}}</v-card-text>
                          <v-card-text class="px-0"><b>Id:</b> {{pet.id}}</v-card-text>
                          <v-card-text class="px-0"><b>Breed:</b> {{pet.breed}}</v-card-text>
                          <v-card-text class="px-0"><b>Age:</b> {{pet.age}}</v-card-text>
                          <v-card-text class="px-0" style="color:white">.</v-card-text>
                        </v-card>
                      </v-flex>
                  </v-flex>

                  <v-flex xs6>
                      <v-card  color="rgba(254, 192, 220)">
                        <v-card-text style="color:white; font-size:150%">Owner Info</v-card-text>
                      </v-card>
                      <v-flex style="text-align:left">
                        <v-card class="elevation-4" style="margin-top:3%;padding-left:3%" >
                          <v-card-text class="px-0"><b>Name:</b> {{pet.owner.fullname}}</v-card-text>
                          <v-card-text class="px-0"><b>Id:</b> {{pet.owner.id}}</v-card-text>
                          <v-card-text class="px-0"><b>Address:</b> {{pet.owner.address}}</v-card-text>
                          <v-card-text class="px-0"><b>Phone number:</b> {{pet.owner.phoneNumber}}</v-card-text>
                          <v-card-text class="px-0"><b>Email:</b> {{pet.owner.email}}</v-card-text>
                        </v-card>
                      </v-flex>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-subtitle>
            <v-card-actions>
              <v-spacer></v-spacer>
          
                <v-btn class="ma-2" tile  color="rgba(135, 169, 206,0.8)" @click="add =true">
                  <v-icon color="white" >mdi-clipboard-plus-outline</v-icon> <small style="color:white">New Medical Record</small>
                </v-btn>
            </v-card-actions>
          </v-card>

          <v-card-text v-if="records.length>0">
              <v-expansion-panels multiple>
                
                  <v-expansion-panel v-for="record in records" :key="record.id">
                      <v-expansion-panel-header class="justify-self-start" disable-icon-rotate>
                        <div>
                              <v-icon color="rgba(135, 169, 206,0.8)">mdi-calendar-month</v-icon>
                                <span>{{record.date}}</span>
                        </div>
                      </v-expansion-panel-header>

                      <v-expansion-panel-content style="text-align:left">
                        
                        <v-card-subtitle>
                          <b>Veterinary:</b> {{record.veterinary.fullname}}
                        </v-card-subtitle>

                        <v-divider></v-divider>

                        <v-card-subtitle>
                          <b>Consultation Reason</b>
                        </v-card-subtitle>
                        <v-container style="padding-left:5%"> 
                          {{record.consultationreason}} 
                        </v-container>

                        <v-divider></v-divider>

                        <v-card-subtitle>
                          <b>Diagnosis</b>
                          </v-card-subtitle>
                        <v-container style="padding-left:5%">
                          {{record.diagnosis}}
                        </v-container>

                        <v-divider></v-divider>

                        <v-card-subtitle>
                          <b>Treatment</b>
                        </v-card-subtitle>
                        <v-container style="padding-left:5%">
                          {{record.treatments}}
                        </v-container>

                      </v-expansion-panel-content>
                    </v-expansion-panel>
              </v-expansion-panels>
            </v-card-text>
            <v-card-text v-else>
              <span>No records available at this moment.</span> 
            </v-card-text>
            
           <v-row justify="center">
              <v-dialog v-model="add" persistent max-width="600px">
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
                              no-resize
                              :rules="[v => !!v || 'This field is required']"
                              v-model="newRecord.consultationreason"
                            ></v-textarea>

                            <v-textarea
                              outlined
                              label="Diagnosis*"
                              no-resize
                              :rules="[v => !!v || 'This field is required']"
                              v-model="newRecord.diagnosis"
                            ></v-textarea>

                            <v-textarea
                              outlined
                              label="Treatments*"
                              no-resize
                              :rules="[v => !!v || 'This field is required']"
                              v-model="newRecord.treatments"
                            ></v-textarea>
                            <v-select
                              v-model="newRecord.veterinary"
                              :items="veterinaries"
                              prepend-icon="mdi-card-account-details-outline"
                              item-text="fullname"
                              :rules="[v => !!v || 'The veterinary responsible is required']"
                              label="Veterinary"
                              return-object
                            ></v-select>
                            <v-dialog
                              ref="dialog"
                              v-model="modal"
                              :return-value.sync="newRecord.date"
                              persistent
                              width="290px"
                            >
                            <template v-slot:activator="{ on }">
                              <v-text-field
                                v-model="newRecord.date"
                                label="Appointment's date"
                                prepend-icon="mdi-calendar-month"
                                readonly
                                v-on="on"
                              ></v-text-field>
                            </template>
                            <v-date-picker v-model="newRecord.date">
                              <v-spacer></v-spacer>
                              <v-btn text color="rgba(135, 169, 206,0.8)" @click="modal = false">Cancel</v-btn>
                              <v-btn text color="rgba(135, 169, 206,0.8)" @click="$refs.dialog.save(date)">OK</v-btn>
                            </v-date-picker>
                            </v-dialog>
                        </v-container>
                      </v-form>
                      <small>* indicates required field</small>
                      </v-card-text>
                      <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn text @click="closeNewRecord">Close</v-btn>
                          <v-btn type="submit" text @click="addRecord" >Save</v-btn>
                        </v-card-actions>
                      </v-card>
              </v-dialog>
            </v-row>
        </v-flex>
      </v-layout>
    </v-container>
</template>

<script>
import axios from '../../plugins/axios';
export default {
  name: "MedicalHistory",
  data() {
    return {
      veterinaries: [],
      modal: false,
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
      medicalHistoryStatus: null,
      records: [],
      valid:true,
      edit: false,
      add: false,
      status: null,
      deletedialog: null,
      newRecord:{
        consultationreason:"",
        diagnosis:"",
        treatments:"",
        medicalhistory: "",
        date: new Date().toISOString().substr(0, 10),
        veterinary: null
      }
    };
  },
  methods: {
    closeNewRecord(){
      this.add = false
      this.newRecord.consultationReason = null;
      this.newRecord.diagnosis = null;
      this.newRecord.treatment = null;
    },
    async refresh() {
      this.records = [];
      let petData = await axios.get("pets/" + this.$route.params.petId)
      let ownerData = await axios.get("users/"+petData.data.data.owner)

      let query = await axios.get("veterinaries")
      .catch((error) => console.log(error))
      this.veterinaries = query.data.data

      this.pet = {
        name : petData.data.data.name,
        age: petData.data.data.age,
        breed: petData.data.data.breed,
        id: petData.data.data.id,
        owner: {
          fullname: ownerData.data.data.fullname,
          address: ownerData.data.data.address,
          phoneNumber: ownerData.data.data.phonenumber,
          id: ownerData.data.data.id,
          email: ownerData.data.data.email
        }
      }

      this.medicalHistoryId = petData.data.data.medicalhistory
      let recordsData = await axios.get("medicalHistory/medicalRecords/"+this.medicalHistoryId)
      let tempRecords = []
      recordsData.data.data.forEach(record => {
          tempRecords.push(record);
      });
      if(tempRecords.length>0){
        this.records = tempRecords.sort(function(a, b) {
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
    addRecord() 
    {
      this.newRecord.medicalhistory = this.medicalHistoryId
      this.newRecord.veterinary = this.newRecord.veterinary.id
      axios.post('medical_records', this.newRecord).then(() =>
      {
        this.medicalHistoryStatus  = 
        {
            type: 'success',
            message: 'Record added to History',
            icon: 'mdi-checkbox-marked-circle-outline'
        }
        this.closeNewRecord()
        this.refresh()
      }).catch(function(error) 
      {
        this.medicalHistoryStatus = 
        {
          type: "error",
          message: error.message,
          icon: "mdi-skull-outline"
        }
      });
      this.showStatus(medicalHistoryStatus)
    }
  },
  created() {
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

.content{
  margin: 1% 3% 2% 3%;
}
</style>