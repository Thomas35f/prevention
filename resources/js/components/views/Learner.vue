<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <br>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">Ajouter un Stagiaire</div>
                    <div class="card-body">
                        <div v-if="errors">
                            <p class="text-error">{{ errors.message }}</p>
                            <div v-for="(errorList, errorKey) in errors.errors" :key="errorKey" class="errors">
                                <p v-for="error in errorList" :key="error" class="text-error">
                                    {{ error }}
                                </p>
                            </div>
                        </div>
                        <div v-if="message" class="success">
                            <p class="text-success">{{ message }}</p>
                        </div>
                        <form class="form-learner" @submit.prevent="saveLearner">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom </label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" v-model="form.lastname" required
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">Prénom</label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" v-model="form.firstname" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="form.email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Téléphone</label>
                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control" v-model="form.phone" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Adresse</label>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" v-model="form.address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zip_code" class="col-md-4 col-form-label text-md-right">Code postal</label>
                                <div class="col-md-6">
                                    <input id="zip_code" type="text" class="form-control" v-model="form.zip_code">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="town" class="col-md-4 col-form-label text-md-right">Ville</label>
                                <div class="col-md-6">
                                    <input id="town" type="text" class="form-control" v-model="form.town">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subclient" class="col-md-4 col-form-label text-md-right">Client</label>
                                <div class="col-md-6">
                                    <select id="subclient" v-model="form.subclient_id" class="form-control" required>
                                        <option v-for="subclient in subclients" :value="subclient.id" :key="subclient.id">
                                            {{ subclient.company.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit">
                                Ajouter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { onMounted } from 'vue';
import useLearners from '../../composables/learners'
import useSubclients from '../../composables/subclients'
import {reactive} from 'vue'
import {ref} from "vue/dist/vue";

const form = reactive({
    lastname: '',
    firstname: '',
    email: '',
    phone: '',
    address: '',
    zip_code: '',
    town: '',
    subclient_id: null
})

const {errors, storeLearner, message } = useLearners()

const { getSubclients, subclients } = useSubclients()

const saveLearner = async () => {
    await storeLearner({...form})
}

onMounted(getSubclients);

</script>

<style>

.form-control {
    font-size: 16px;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
    appearance: none;
    background-color: #f7f7f7;
    color: #333;
    transition: box-shadow 0.3s ease;
    width: 100%;
}

.form-control:hover {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
}

.form-control:focus {
    outline: none;
    box-shadow: 0px 2px 8px rgba(66, 153, 225, 0.6);
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
    box-shadow: 0px 2px 8px rgba(66, 153, 225, 0.6);
}

</style>
