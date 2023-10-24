import {ref, onMounted} from 'vue'
import axios from 'axios'
import { postData } from '../utils/apiUtils'

export default function useLearners(): {
    message: any,
    errors: any,
    learner: any,
    learners: any,
    getLearner: (id: number) => Promise<void>,
    getLearnersBySubclient: (id: string) => Promise<void>,
    getLearners: () => Promise<void>,
    storeLearner: (data: object) => Promise<void>,
    storeLearnerForTraining: (data: object) => Promise<void>
} {
    const learner = ref([]);
    const learners = ref([]);
    const message = ref('');
    const errors = ref('');
    const urlGetLearners = '/api/getLearners';
    const urlGetLearner = '/api/learners/${id}';
    const urlStoreLearner = '/api/learners/store';
    const urlStoreLearnerForTraining = '/api/learners/storeForTraining';

    const getLearners = async (): Promise<void> => {
        try {
            let response = await axios.get(urlGetLearners);
            learners.value = response.data.data;
        } catch (error) {
            errors.value = error;
        }
    }

    const getLearnersBySubclient = async (id: string): Promise<void> => {
        try {
            let response = await axios.get(`/api/getLearners/${id}`);
            learners.value = response.data;
        } catch (error) {
            errors.value = error;
        }
    }

    const getLearner = async (id: number): Promise<void> => {
        let response = await axios.get(urlGetLearner);
        learner.value = response.data.data;
    }

    const storeLearner = async (data: object): Promise<void> => {
        const { response, error } = await postData(urlStoreLearner, data);
        if (response) {
            message.value = response.message;
        } else if (error) {
            errors.value = error;
        }
    };

    const storeLearnerForTraining = async (data: object): Promise<void> => {
        const { response, error } = await postData(urlStoreLearnerForTraining, data);
        if (response) {
            message.value = response.message;
        } else if (error) {
            errors.value = error;
        }
    };

    return {
        message,
        errors,
        learner,
        learners,
        getLearner,
        getLearners,
        getLearnersBySubclient,
        storeLearner,
        storeLearnerForTraining
    }
}
