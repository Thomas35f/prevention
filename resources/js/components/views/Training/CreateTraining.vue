<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <br>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">Création d'une journée de formation</div>
                    <div class="card-body">
                        <div v-if="errors">
                            <div v-for="(errorList, errorKey) in errors" :key="errorKey" class="errors">
                                <p v-for="error in errorList" :key="error" class="text-error">
                                    {{ error }}
                                </p>
                            </div>
                        </div>
                        <form @submit.prevent="submitForm">
                            <div class="form-group row">
                                <v-text-field label="Nom de la formation" v-model="nomFormation"
                                              required></v-text-field>
                            </div>
                            <div class="form-group row">
                                <label for="subclient" class="col-form-label">Client</label>
                                <select id="subclient" v-model="selectedSubclient" class="form-control" required>
                                    <option v-for="subclient in subclients" :value="subclient.id" :key="subclient.id">
                                        {{ subclient.company.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="center" class="col-form-label">Centre</label>
                                <select id="center" v-model="selectedCenter" class="form-control" required>
                                    <option v-for="center in centers" :value="center.id" :key="center.id">
                                        {{ center.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="grid" class="col-form-label">Grille de notation</label>
                                <select id="grid" v-model="selectedGrid" class="form-control" required>
                                    <option v-for="grid in grids" :value="grid.id" :key="grid.id">
                                        {{ grid.name }}
                                    </option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group row">
                                <v-text-field type="date" label="Date" v-model="dateFormation"></v-text-field>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <v-btn type="submit">Créer la formation</v-btn>
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
import useCenters from '../../../composables/centers';
import {ref, onMounted} from 'vue';
import useSubclients from '../../../composables/subclients';
import useGrids from '../../../composables/grids';
import {useRouter} from 'vue-router';
import useTrainings from '../../../composables/trainings';
import { useMessageStore } from '../../../store/messageStore';
import { usePreferencesStore } from '../../../store/preferencesStore';

const router = useRouter();
const entreprise = ref('');
const nomFormation = ref('');
const dateFormation = ref('');
const menu = ref(false);
const selectedSubclient = ref(null);
const selectedCenter = ref(null);
const selectedGrid = ref(null);
const {getSubclients, subclients} = useSubclients();
const {getCenters, centers} = useCenters();
const {getGrids, grids} = useGrids();
const {createTraining, message, errors} = useTrainings();
const messageStore = useMessageStore();
const preferencesStore = usePreferencesStore();

onMounted(async () => {
    await getSubclients();

    await getCenters();

    await getGrids();
});

const submitForm = async () => {
    const trainingData = {
        center_id: selectedCenter.value,
        training_name: nomFormation.value,
        training_date: dateFormation.value
    };
    preferencesStore.setSubclientId(selectedSubclient.value);
    preferencesStore.setGridId(selectedGrid.value);

    await createTraining(trainingData);

    if (message.value) {
        messageStore.setMessage(message.value);
        await router.push({name: 'trainings'});
    }
};

defineExpose({
    submitForm,
    entreprise,
    nomFormation,
    dateFormation,
    menu,
    selectedSubclient,
    selectedCenter,
    selectedGrid,
    grids
});
</script>

<style>

.form-control {
    font-size: 16px;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    appearance: none;
    background-color: #f7f7f7;
    color: #333;
    transition: box-shadow 0.3s ease;
    width: 100%;
}

.form-control:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.form-control:focus {
    outline: none;
    box-shadow: 0 2px 8px rgba(66, 153, 225, 0.6);
}

.form-group {
    margin-bottom: 20px;
}

.label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

button {
    padding: 10px 15px;
    border: none;
    box-shadow: 1px 1px 1px 1px #808080;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {

}

select.form-control {
    padding-right: 30px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="4" height="5" viewBox="0 0 4 5"><path fill="%23333" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 8px center;
    background-color: #f7f7f7;
}

select.form-control:focus {
    box-shadow: 0 2px 8px rgba(66, 153, 225, 0.6);
}

.card-body {
    margin: 20px;
}

</style>
