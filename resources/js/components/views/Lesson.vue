<template>
    <div v-if="lesson">
        <h1 class="title">{{ lesson.grid_name }}</h1>

        <v-container>
            <v-row>
                <!-- Student Info -->
                <v-col cols="12" md="4">
                    <v-card elevation="2" class="mb-5">
                        <v-card-title>Stagiaire</v-card-title>
                        <v-card-text>
                            <p>Nom: {{ lesson.learner_lastname }}</p>
                            <p>Prénom: {{ lesson.learner_firstname }}</p>
                            <p>Entreprise: {{ lesson.learner_subclient }}</p>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Vehicle Info -->
                <v-col cols="12" md="4">
                    <v-card elevation="2" class="mb-5">
                        <v-card-title>Véhicule</v-card-title>
                        <v-card-text v-if="lesson.vehicle_name">
                            <p>Nom: {{ lesson.vehicle_name }}</p>
                        </v-card-text>
                        <v-card-text v-else>
                            <p>Pas de véhicule</p>
                        </v-card-text>
                    </v-card>
                </v-col>

                <!-- Center & Trainer Info -->
                <v-col cols="12" md="4">
                    <v-card elevation="2" class="mb-5">
                        <v-card-title>Centre & Formateur</v-card-title>
                        <v-card-text>
                            <p>Centre: {{ lesson.center_name }}</p>
                            <p>Adresse: {{ lesson.center_address }}</p>
                            <p>Formateur: {{ lesson.trainer_name }}</p>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

        <table class="criteria-table">
            <thead>
            <tr>
                <th> Critères d'observation </th>
                <th> Évaluation </th>
                <th> Thématiques abordées </th>
                <th> Axes de progression </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="criteria in lesson.criteria" :key="criteria.label">
                <td class="criteria-label">{{ criteria.label }}</td>
                <td>
                    <table class="evaluation-table">
                        <tbody>
                        <tr v-for="theme in criteria.themes" :key="theme.label + 'eval'">
                            <td class="evaluation-cell">
                                <div class="radio-container">
                                    <input type="radio" :name="theme.label" v-model="theme.evaluation" value="red" :id="theme.label + '-red-radio'">
                                    <label :for="theme.label + '-red-radio'"></label>
                                </div>
                                <div class="radio-container">
                                    <input type="radio" :name="theme.label" v-model="theme.evaluation" value="orange" :id="theme.label + '-orange-radio'">
                                    <label :for="theme.label + '-orange-radio'"></label>
                                </div>
                                <div class="radio-container">
                                    <input type="radio" :name="theme.label" v-model="theme.evaluation" value="green" :id="theme.label + '-green-radio'">
                                    <label :for="theme.label + '-green-radio'"></label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="themes-table">
                        <tbody>
                        <tr v-for="theme in criteria.themes" :key="theme.label + 'theme'">
                            <td>{{ theme.label }}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="themes-table">
                        <tbody>
                        <tr v-for="theme in criteria.themes" :key="theme.label + 'prog'">
                            <td><input type="text" v-model="theme.progress" placeholder="Progression"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from 'vue';
import useLessons from '../../composables/lessons';
import {useRoute} from 'vue-router';

const { getLessonDetails } = useLessons();
const route = useRoute();
const { params } = useRoute();
const lesson = ref(null);

onMounted(async () => {
    try {
        const lessonId = params.id;
        lesson.value = await getLessonDetails(lessonId);
        console.log(lesson.value);
    } catch (error) {
        console.error("Erreur lors de la récupération des détails de la leçon:", error);
    }
});

</script>

<style scoped>

.title {
    margin-top: 20px;
    margin-left: 20px;
}

.criteria-table {
    width: 99%;
    border-collapse: collapse;
    margin: 15px;
}

.criteria-table th, .criteria-table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

.criteria-table th {
    background-color: #f2f2f2;
    font-size: 1.1em;
    text-align: center;
}

.criteria-label {
    font-size: 1.2em;
    text-align: center;
}

.themes-table {
    width: 100%;
    border-collapse: collapse;
}

.themes-table td {
    border: 1px solid #ccc;
    padding: 14px;
}

.evaluation-cell {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px;
}

.radio-container {
    flex: 1;
    padding: 0 3px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-sizing: border-box;
    border: 1px solid transparent;
}

.radio-container label {
    display: block;
    width: 25px;
    height: 25px;
    border: 1px solid #ccc;
    cursor: pointer;
    border-radius: 50%;
}

.radio-container input[type="radio"][value="red"] + label {
    background-color: #FFB6B6;
}

.radio-container input[type="radio"][value="orange"] + label {
    background-color: #FFD1A1;
}

.radio-container input[type="radio"][value="green"] + label {
    background-color: #B5E7B5;
}

.radio-container input[type="radio"][value="red"]:checked + label {
    background-color: red;
}

.radio-container input[type="radio"][value="orange"]:checked + label {
    background-color: orange;
}

.radio-container input[type="radio"][value="green"]:checked + label {
    background-color: green;
}

.radio-container input[type="radio"] {
    display: none;
}

</style>
