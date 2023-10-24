<template>
    <div>
        <div v-if="errorMessage" class="error-message">
            {{ errorMessage }}
        </div>
        <v-card>
            <v-card-title>Formation : {{ training.name }}</v-card-title>
            <v-card-subtitle>{{ formatDate(training.date) }}</v-card-subtitle>
            <v-card-text>
                Centre : {{ training?.center?.name }}
            </v-card-text>
        </v-card>

        <v-card>
            <v-card-title>Leçons de conduite <small>(Cliquez pour sélectionner)</small>
                <div v-if="selectedLessonId !== null">
                    <small>
                        Sous-client : {{ selectedLessonLearnerSubclient }}
                    </small>
                </div>
                <div v-if="selectedLessonId">
                    <label for="grid" class="small-label">Grille de notation :</label>
                    <select
                        id="grid"
                        v-model="selectedGrid"
                        class="form-control small-select"
                        required
                    >
                        <option
                            v-for="grid in grids"
                            :value="grid.id"
                            :key="grid.id"
                        >
                            {{ grid.name }}
                        </option>
                    </select>
                </div>
            </v-card-title>

            <v-container>
                <v-row>
                    <v-col v-for="(lesson, index) in training.lessons" :key="index" cols="12" md="4">
                        <v-card
                            :class="{ 'selected-lesson': selectedLessonId === lesson.id }"
                            class="mb-5 d-flex flex-column lesson-card"
                            style="height: 100%;"
                            @click="selectLesson(lesson)"
                        >
                            <v-card-title v-if="lesson.learner">
                                {{ lesson.learner.user.lastname }} {{ lesson.learner.user.firstname }}
                            </v-card-title>
                            <v-card-subtitle v-if="lesson.learner">
                                {{ lesson.learner.user.email }}
                            </v-card-subtitle>
                            <v-card-text class="flex-grow-1">
                                <div v-if="lesson.learner && lesson.learner.vehicle">
                                    <strong>Véhicule :</strong> {{ lesson.learner.vehicle.name }}<br>
                                    <strong>Marque :</strong> {{ lesson.learner.vehicle.brand }}<br>
                                    <strong>Plaque :</strong> {{ lesson.learner.vehicle.license_plate }}
                                </div>
                                <div v-else-if="lesson.learner">
                                    Pas de véhicule présent pour ce stagiaire.
                                </div>
                                <div v-else>
                                    Pas de stagiaire associé à cette leçon.
                                </div>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn v-if="lesson.learner && lesson.learner.vehicle" icon
                                       @click="editVehicle(lesson.learner)">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn v-else-if="lesson.learner" icon @click="addVehicle(lesson.learner)">
                                    <v-icon>mdi-plus</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-card>
    </div>
    <v-btn :disabled="!selectedLessonId" @click="startSession" class="start-session-btn">Démarrer la Session</v-btn>
</template>

<script setup lang="ts">
import {ref, onMounted, computed} from 'vue';
import {useRoute} from 'vue-router';
import {useRouter} from 'vue-router';
import useTrainings from '../../../composables/trainings';
import useGrids from '../../../composables/grids';
import {usePreferencesStore} from '../../../store/preferencesStore';
import useLessons from '../../../composables/lessons';

const route = useRoute();
const router = useRouter();

const {getGrids, grids} = useGrids();
const {training, getTraining} = useTrainings();
const {updateLesson} = useLessons();

const preferences = usePreferencesStore();

const selectedLessonId = ref(null);
const errorMessage = ref(null);
const selectedGrid = ref(null);

const selectLesson = (lesson: any) => {
    if (selectedLessonId.value === lesson.id) {
        selectedLessonId.value = null;
    } else {
        selectedLessonId.value = lesson.id;
    }
};

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
};

const startSession = async () => {
    if (selectedLessonId.value && selectedGrid.value) {
        const updateData = {
            gridId: selectedGrid.value,
        };

        try {
            await updateLesson(selectedLessonId.value, updateData);
            await router.push({name: 'lesson', params: {id: selectedLessonId.value}});
        } catch (error) {
            errorMessage.value = "Une erreur s'est produite lors de la mise à jour de la leçon.";

            return;
        }
    } else {
        errorMessage.value = "L'ID de la leçon ou de la grille n'est pas défini!";
    }
};

const selectedLessonLearnerSubclient = computed(() => {
    if (selectedLessonId.value !== null) {
        const lesson = training.value?.lessons.find((l: any) => l.id === selectedLessonId.value);
        return lesson?.learner?.subclient?.company?.name || 'Sous-client non disponible';
    }
    return '';
});

onMounted(async () => {
    const trainingId = String(route.params.id);
    training.value = await getTraining(trainingId);
    await getGrids();

    preferences.loadPreferencesFromLocalStorage();

    // 1. Si une préférence est trouvée dans le store, pré-sélectionnez celle-ci
    if (preferences.getGridId && preferences.getGridId !== "undefined") {
        selectedGrid.value = preferences.getGridId;
    }
    // 2. Si une seule grille est présente dans la liste grids, pré-sélectionnez cette grille
    else if (grids.value && grids.value.length === 1) {
        selectedGrid.value = grids.value[0].id;
    }
});
</script>

<style>

.error-message {
    color: red;
    font-size: 1.2rem;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid red;
    border-radius: 5px;
    background-color: #ffe6e6;
}

.lesson-card:hover {
    cursor: pointer;
    background-color: #d9d9d9;
}

.selected-lesson {
    background-color: #c3ffc9 !important;
}


.start-session-btn {
    margin-top: 10px;
    margin-left: 10px;
}

.small-label {
    font-size: 0.8em;
}

.small-select {
    width: 250px;
    font-size: 0.8em;
}
</style>
