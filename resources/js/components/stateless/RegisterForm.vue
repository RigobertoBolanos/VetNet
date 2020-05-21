<template>
    <div id="app">
        <v-app class="LoginDiv">
                <v-layout justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-10">
                    <v-toolbar color="primary" dark flat align-center>
                    <v-spacer />
                        <v-toolbar-title class="toolbarTitle">
                            Register
                        </v-toolbar-title>
                    <v-spacer />  
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid">

                        <v-text-field
                            label="Email"
                            prepend-icon="mdi-account"
                            type="text"
                            v-model="user.email"
                            required
                            :rules="emailRules"
                        ></v-text-field>

                        <v-text-field
                            label="Full name"
                            prepend-icon="mdi-account"
                            type="text"
                            v-model="user.fullName"
                            required
                            :rules="fullNameRules"
                        ></v-text-field>

                        <v-text-field
                            label="Address"
                            prepend-icon="mdi-account"
                            type="text"
                            v-model="user.address"
                            required
                            :rules="addressRules"
                        ></v-text-field>

                        <v-text-field 
                            label="Phone number"
                            prepend-icon="mdi-phone"
                            required
                            :rules="phoneNumberRules"
                            v-mask="'### - ### - ####'"
                            v-model="user.phoneNumber"
                        ></v-text-field>

                        <v-text-field
                            v-model="user.password"
                            :append-icon="showpassword ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="showpassword ? 'text' : 'password'"
                            label="Password"
                            @click:append="showpassword = !showpassword"
                            prepend-icon="mdi-lock"
                            :rules="passwordRules"
                            required
                        ></v-text-field>
                        </v-form>
                        <v-spacer>
                            <v-btn type="submit" outlined color="primary" @click="register" :disabled="!valid">Submit</v-btn>
                        </v-spacer>
                    </v-card-text>                   
                    </v-card>
                    <v-alert
                    v-if="status != null"
                    :type="status.type"
                    outlined
                    text
                    :icon="status.icon"
                    transition="scale-transition"
                    >{{status.message}}</v-alert>
                </v-flex>
                </v-layout>
        </v-app>
    </div>
</template>
<script>
import {mask} from "vue-the-mask"
import axios from 'axios'
export default {
    name: "loginform",
    data(){
        return{
            status: null,
            valid: true,
            user: 
            {
                email: "",
                fullName: "",
                password: "", 
                address: "",
                phoneNumber: "",
            },
            showpassword: false,
            error: null,
            emailRules: 
            [
                email => !!email || "Email is required",
                email => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email) || "Email must be valid"
            ],
            passwordRules:
            [
                password => !!password || "Password is required",
            ],
            fullNameRules:
            [
                fullName => !!fullName || "Full name is required",
            ],
            addressRules:
            [
                address => !!address || "Address is required",
            ],
            phoneNumberRules:
            [
                phone => !!phone || "Phone is required",
                phone => phone.length >= 7 || "Phone number should be 10 digits"
            ]
        }
    },
    methods: {
        register()
        {  
            axios.post('/login', this.user).then(() => 
                console.log('User registered successfully')
            ).catch(err => 
                console.log(err));
        }
    },
    directives: {
        mask,
    },
}
</script>

<style scoped>

.toolbarTitle{
    font-size: 180%;
}
.v-alert{
    margin-top: 6%;
}

</style>