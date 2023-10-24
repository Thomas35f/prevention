import {ref, onMounted} from 'vue'
import axios from 'axios'
import { postData } from '../utils/apiUtils'

export default function useTrainings(): {
    message: any,
    errors: any,
    training: any,
    trainings: any,
    getTraining: (id: string) => Promise<void>,
    getTrainings: () => Promise<void>,
    createTraining: (data: object) => Promise<void>,
    updateTraining: (id: string, data: object) => Promise<void>
} {
    axios.defaults.withCredentials = true;
    const training = ref([]);
    const trainings = ref([]);
    const message = ref('');
    const errors = ref('');
    const urlGetTrainings = '/api/getTrainings';
    const urlCreateTraining = '/api/trainings/create';

    const getTrainings = async (): Promise<void> => {
        try {
            let response = await axios.get(urlGetTrainings);
            trainings.value = response.data.trainings;
            console.log(trainings.value)
        } catch (error) {
            console.error("Erreur lors de la récupération des formations:", error);
        }
    };

    const getTraining = async (id: string): Promise<void> => {
        try {
            let response = await axios.get(`/api/getTraining/${id}`);
            return response.data.training;
        } catch (error) {
            console.error("Erreur lors de la récupération des formations:", error);
        }
    };

    const createTraining = async (data: object): Promise<void> => {
        const { response, error } = await postData(urlCreateTraining, data);
        if (response) {
            message.value = response.message;
        } else if (error) {
            errors.value = error;
        }
    };

    const updateTraining = async (id: string, data: object): Promise<void> => {
        const { response, error } = await postData(`/api/trainings/update/${id}`, data);
        if (response) {
            message.value = response.message;
        } else if (error) {
            errors.value = error;
        }
    };

    return {
        message,
        errors,
        training,
        trainings,
        getTraining,
        getTrainings,
        createTraining,
        updateTraining
    }
}
