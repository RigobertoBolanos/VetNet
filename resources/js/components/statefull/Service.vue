<template>
   <v-hover
        v-slot:default="{ hover }"
        open-delay="200"
    >
        <v-card :elevation="hover ? 16 : 2">
                <v-img :src= "service.name" height="170px"></v-img>
                <v-card-title >
                    <v-flex justify-center>
                        <h3 style="color:red">{{ service.name}}</h3>       
                    </v-flex>
                </v-card-title>
                <v-card-subtitle >
                    <h5 style="text-align:center">Precio: ${{service.price}}</h5>
                </v-card-subtitle>
                <v-card-text class="font-weight-medium mt-12 text-center">
                    {{ service.description }}
                </v-card-text>
        </v-card>
   </v-hover>
</template>

<script>

export default {
    props: {
        service: {
            type: Object
        }
    },
    created() {
        
    },
}
</script>

<style scoped>
.v-card:not(.v-sheet--tile):not(.v-card--shaped) {
    border-radius: 8%;
}
    
</style>    