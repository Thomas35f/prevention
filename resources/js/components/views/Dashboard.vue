<template>
    <v-row>
        <v-col cols="12" sm="12" md="6" lg="5">
            <ListTrainings></ListTrainings>
        </v-col>
        <v-col cols="12" sm="12" md="6" lg="7">
            <ListCompanies></ListCompanies>
        </v-col>
    </v-row>
    <v-row>
        <v-col>
            <ListTrainers></ListTrainers>
        </v-col>
        <v-col>
            <ListCenters></ListCenters>
        </v-col>
    </v-row>
</template>

<script lang="ts" setup>
import ListCompanies from "../ListCompanies.vue";
import ListTrainers from "../ListTrainers.vue";
import ListTrainings from "../ListTrainings.vue";
import ListCenters from "../ListCenters.vue";
</script>

<style scoped>

</style>
