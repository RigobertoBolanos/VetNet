<template>
    <div id="app">
        <v-app class="LoginDiv">
                <v-layout justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-10">
                    <v-toolbar color="primary" dark flat align-center>
                    <v-spacer />
                        <v-toolbar-title class="toolbarTitle">
                            Log In
                        </v-toolbar-title>
                    <v-spacer />  
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid">

                        <v-text-field
                            label="Email"
                            prepend-icon="mdi-account"
                            type="text"
                            v-model="email"
                            required
                            :rules="emailRules"
                        ></v-text-field>

                        <v-text-field
                            v-model="password"
                            :append-icon="showpassword ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="showpassword ? 'text' : 'password'"
                            label="Password"
                            @click:append="showpassword = !showpassword"
                            prepend-icon="mdi-lock"
                            required
                        ></v-text-field>
                        </v-form>
                        <v-spacer>
                            <v-btn type="submit" outlined color="primary" @click="logIn" :disabled="!valid"><v-icon>mdi-login-variant</v-icon></v-btn>
                        </v-spacer>
                    </v-card-text>
                    <v-spacer>
                        Don't have an account? <a href="/register" style="text-decoration:none">Register.</a>
                     </v-spacer>                    
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
export default {
    name: "loginform",
    data(){
        return{
            status: null,
            valid: true,
            email: "",
            password: "",
            showpassword: false,
            error: null,
            emailRules: 
            [
                email => !!email || "Email is required",
                email => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email) || "Email must be valid"
            ]
        }
    },
    methods: {
        logIn()
        {  

        }
    }
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