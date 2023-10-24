<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <br>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">Modification d'une journée de formation</div>
                    <div class="card-body">
                        <div v-if="errors">
                            <div v-if="errors.message" class="errors">
                                <p class="text-error">{{ errors.message }}</p>
                            </div>
                            <div v-else>
                                <div v-for="(errorList, errorKey) in errors" :key="errorKey" class="errors">
                                    <p v-for="error in errorList" :key="error" class="text-error">
                                        {{ error }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="updateTraining">
                            <div class="form-group row">
                                <v-text-field label="Nom de la formation" v-model="training.name" required></v-text-field>
                            </div>
                            <div class="form-group row">

                                <label for="subclient" class="col-form-label">Client</label>
                                <select id="subclient" v-model="training.subclient_id" class="form-control" required>
                                    <option v-for="subclient in subclients" :value="subclient.id" :key="subclient.id">
                                        {{ subclient.company.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="center" class="col-form-label">Centre</label>
                                <select id="center" v-model="training.center_id" class="form-control" required>
                                    <option v-for="center in centers" :value="center.id" :key="center.id">
                                        {{ center.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="grid" class="col-form-label">Grille de notation</label>
                                <select id="grid" v-model="training.grid_id" class="form-control" required>
                                    <option v-for="grid in grids" :value="grid.id" :key="grid.id">
                                        {{ grid.name }}
                                    </option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group row">
                                <v-text-field type="date" label="Date" v-model="training.date"></v-text-field>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <v-btn type="submit">Mettre à jour</v-btn>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import {useRouter} from 'vue-router';
import useTrainings from '../../../composables/trainings';
import useCenters from '../../../composables/centers';
import useSubclients from '../../../composables/subclients';
import useGrids from '../../../composables/grids';
import { usePreferencesStore } from '../../../store/preferencesStore';
import { useMessageStore } from '../../../store/messageStore';

const route = useRoute();
const router = useRouter();
const preferencesStore = usePreferencesStore();
const messageStore = useMessageStore();
const {getTraining, updateTraining, message, errors, training} = useTrainings();
const selectedSubclient = ref(null);
const selectedCenter = ref(null);
const selectedGrid = ref(null);
const selectedSubclientIdFromStore = preferencesStore.getSubclientId;
const selectedGridIdFromStore = preferencesStore.getGridId;
const {getSubclients, subclients} = useSubclients();
const {getCenters, centers} = useCenters();
const {getGrids, grids} = useGrids();

const updateTrainingValues = async () => {
    const relevantData = {
        center_id: training.value.center_id,
        training_name: training.value.name,
        training_date: training.value.date
    };
    preferencesStore.setSubclientId(training.subclient_id);
    preferencesStore.setGridId(training.grid_id);

    await updateTraining(training.value.id, relevantData);

    if (message.value) {
        messageStore.setMessage(message.value);
        await router.push({name: 'trainings'});
    }
};

onMounted(async () => {
    const id = route.params.id;
    await getTraining(id);
    await getSubclients();
    await getCenters();
    await getGrids();

    if (selectedSubclientIdFromStore !== null) {
        training.value.subclient_id = selectedSubclientIdFromStore;
    } else if (subclients.length) {
        training.subclient_id = subclients[0].id;
    }

    if (selectedGridIdFromStore !== null) {
        training.value.grid_id = selectedGridIdFromStore;
    } else if (grids.length) {
        training.grid_id = grids[0].id;
    }
});
</script>

<style scoped>

</style>
