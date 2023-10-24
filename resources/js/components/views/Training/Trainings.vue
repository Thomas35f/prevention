<template>
    <div class="route-message" v-if="routeMessage">{{ routeMessage }}</div>
    <div class="main-container">
        <v-card class="training-card">
            <div class="center">
                <v-card-title>Mes Formations</v-card-title>
            </div>
            <v-expansion-panels>
                <v-expansion-panel
                    v-for="(training, index) in trainings"
                    :key="index"
                    @mousedown="training.id ? selectTraining(training.id) : null"
                    :class="{ 'selected-training': selectedTrainingId == training.id }">

                    <v-expansion-panel-header>
                        <div class="d-flex align-items-center">
                            <v-list-item-content class="mr-4">
                                <v-list-item-title>{{ training.name }}</v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ formatDate(training.date) }} - {{ training.center.name }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                            <v-btn class="training-btn" @click="toggleLearners(index)">liste des stagiaires</v-btn>
                            <v-btn class="training-btn" @click.prevent="openDialog(training.name, training.id)">+</v-btn>
                        </div>
                    </v-expansion-panel-header>

                    <v-expansion-panel-content>
                        <v-list v-if="showLearners[index]" dense>
                            <div class="learners-title">Stagiaires :</div>
                            <v-list-item-group v-for="(learner, learnerIndex) in training.learners" :key="learnerIndex">
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            {{ learner.user.lastname }}
                                            {{ learner.user.firstname }}
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{ learner.user.email }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>

            <div class="footer">
                <v-btn class="btn-create" @click="createCourse">Créer une formation</v-btn>
                <v-btn class="btn-start" @click="startLesson">Démarrer</v-btn>
                <v-btn class="btn-modify" @click="modifyTraining">Modifier</v-btn>
                <v-btn class="btn-delete">Supprimer</v-btn>
            </div>
        </v-card>
        <!-- Modale ajout / création de stagiaire -->
        <CreateLearnerDialog :showDialog="showDialog" :selectedTrainingName="selectedTrainingName" :selectedTrainingId="selectedTrainingId" @refresh-training="refreshTraining" @update:modelValue="showDialog = $event"/>
    </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from 'vue';
import {useRouter} from 'vue-router';
import useTrainings from '../../../composables/trainings';
import {useMessageStore} from '../../../store/messageStore';
import CreateLearnerDialog from './CreateLearnerDialog.vue';

const messageStore = useMessageStore();
let routeMessage = ref(messageStore.message);
let showLearners = ref<Array<boolean>>([]);
let showDialog = ref(false);
let selectedTrainingName = ref('');
const router = useRouter();

const refreshTraining = async () => {
    await getTrainings();
    console.log(trainings.value);
};
const openDialog = (trainingName: string, trainingId: string) => {
    selectedTrainingName.value = trainingName;
    selectedTrainingId.value = trainingId;
    showDialog.value = true;
};
const toggleLearners = (index: number) => {
    showLearners.value[index] = !showLearners.value[index];
};
const {trainings, getTrainings} = useTrainings();
onMounted(async () => {
    await getTrainings();
});

const createCourse = () => {
    router.push({name: 'create-training'});
};

let selectedTrainingId = ref<number | null>(null);

const selectTraining = (id: number) => {
    selectedTrainingId.value = id;
};

const modifyTraining = () => {
    if (selectedTrainingId.value !== null) {
        router.push({name: 'edit-training', params: {id: selectedTrainingId.value}});
    } else {
        alert("Veuillez d'abord sélectionner une formation.");
    }
};
const startLesson = () => {
    if (selectedTrainingId.value !== null) {
        router.push({name: 'start-lesson', params: {id: selectedTrainingId.value}});
    } else {
        alert("Veuillez d'abord sélectionner une formation.");
    }
};
const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
};

</script>

<style scoped>
.create-button {
    margin-top: 100px;
    margin-left: 100px;
    background-color: #1C3356;
    color: #fff;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.create-button:hover {
    background-color: #1C3356;
}

.route-message {
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    background-color: #64d268;
    color: #ffffff;
    text-align: center;
    padding: 10px;
    font-size: 16px;
    width: 40%;
}

.action-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.v-btn {
    font-size: 1em;
    border-radius: 10px;
    margin: 20px 10px;
}

.btn-create {
    background-color: #1C3356;
    color: white;
}

.btn-start {
    background-color: #36BB4E;
    color: white;
}

.btn-modify {
    background-color: #BB5E36;
    color: white;
}

.btn-delete {
    background-color: #BB3636;
    color: white;
}

.v-list-item {
    border-bottom: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 5px 0;
    border-radius: 5px;
}

.header-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.selected-item {
    background-color: #f5f5f5;
    border-radius: 5px;
}

.v-expansion-panel {
    margin-bottom: 10px;
}

.learners-header > .v-btn {
    font-size: 0.9rem;
    padding: 8px 12px;
}

.main-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.training-card {
    width: 90%;
    max-width: 1000px;
    overflow: hidden;
}

.v-list-item-title, .v-list-item-subtitle {
    padding-top: 5px;
    padding-left: 20px !important;
}

.footer {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.center {
    text-align: center;
    margin: 20px 0;
}

.v-card-title {
    font-weight: 500;
}

.learners-header > .v-btn {
    background-color: #fff9f5;
    color: #000000;
}

.learners-header > .v-btn:hover {
    background-color: #ffe5d6;
}

.selected-training {
    background-color: #dadada;
}

.training-btn {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
}
</style>

