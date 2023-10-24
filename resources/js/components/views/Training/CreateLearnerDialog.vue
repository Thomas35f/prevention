<template>
    <v-dialog :model-value="showDialog" @update:model-value="showDialog = $event" max-width="500px">
        <v-card>
            <v-card-title class="text-center">Ajout de stagiaire pour "{{ selectedTrainingName }}"</v-card-title>
            <v-card-text>
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
                    <div v-if="message" class="success">
                        <p class="text-success">{{ message }}</p>
                    </div>
                    <form class="form-learner" @submit.prevent="saveLearner">
                        <v-row>
                            <v-col cols="12" md="6">
                                <input id="name" type="text" class="form-control" v-model="form.lastname" required autofocus>
                            </v-col>
                            <v-col cols="12" md="6">
                                <input id="firstname" type="text" class="form-control" v-model="form.firstname" required>
                            </v-col>
                        </v-row>
                        <br>
                        <br>
                        <div class="form-group row">
                            <label for="subclient" class="col-md-4 col-form-label text-md-right">Client</label>
                            <div class="col-md-6">
                                <select id="subclient" v-model="selectedSubclientId" class="form-control" required>
                                    <option v-for="subclient in subclients" :value="subclient.id" :key="subclient.id">
                                        {{ subclient.company.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div v-if="learners.length">
                        <h4 class="smaller-text left-align">Liste des Stagiaires </h4>
                        <v-list class="learner-list" style="max-height: 200px; overflow-y: auto;">
                            <v-list-item v-for="learner in learners" :key="learner.id" @click="selectLearner(learner)" class="mb-2" ripple>
                                <v-list-item-content>
                                    <v-list-item-title>{{ learner.user.lastname }} {{ learner.user.firstname }} </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </div>
                </div>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn @click="saveLearner">Ajouter</v-btn>
                <v-btn  @click="closeDialog">Fermer</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, reactive, onMounted, ref, watch } from 'vue';
import useLearners from "../../../composables/learners";
import useSubclients from '../../../composables/subclients'
import { usePreferencesStore } from '../../../store/preferencesStore';

const { getSubclients, subclients } = useSubclients()
const { getLearnersBySubclient, learners, errors, message, storeLearner, storeLearnerForTraining } = useLearners();
const preferencesStore = usePreferencesStore();
const selectedSubclientId = ref(preferencesStore.getSubclientId);

const props = defineProps({
    showDialog: Boolean,
    selectedTrainingName: String,
    selectedTrainingId: String,
});

const form = reactive({
    lastname: '',
    firstname: '',
    subclient_id: null
});

const emit = defineEmits();

watch(selectedSubclientId, async (newSubclientId) => {
    if(newSubclientId) {
        await getLearnersBySubclient(newSubclientId);
    }
}, { immediate: true });

const saveLearner = async () => {
    form.subclient_id = selectedSubclientId.value;
    const training_id = props.selectedTrainingId;

        await storeLearnerForTraining({ ...form, training_id });

    if (selectedSubclientId.value) {
        await getLearnersBySubclient(selectedSubclientId.value);
    }

    preferencesStore.setSubclientId(selectedSubclientId.value);
    if (message.value) {
        setTimeout(() => {
            closeDialog();
            emit('refresh-training');
        }, 2000);
    }

};

const closeDialog = () => {
    emit('update:modelValue', false);
    form.lastname = '';
    form.firstname = '';
    if (errors.value) errors.value = null;
    if (message.value) message.value = null;
};

const selectLearner = (learner) => {
    form.lastname = learner.user.lastname;
    form.firstname = learner.user.firstname;
};

onMounted(async () => {
    await getSubclients();
    const storedSubclientId = preferencesStore.getSubclientId();
    if (storedSubclientId) selectedSubclientId.value = storedSubclientId;
});

</script>

<style scoped>

.learner-list{
    background-color: #ffffff;
    cursor: pointer;
}
</style>
