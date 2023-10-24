import {ref, onMounted} from 'vue'
import axios from 'axios'

export default function useLearners(): {
    message: any,
    errors: any,
    subclients: any,
    getSubclients: () => Promise<void>,
} {

    const message = ref('');
    const errors = ref('');
    const subclients = ref([]);
    const urlGetSubclients = '/api/getSubclients';

    const getSubclients = async () => {
        try {
            const response = await axios.get(urlGetSubclients);
            subclients.value = response.data;
        } catch (error) {
            console.error('Erreur lors de la récupération des subclients:', error);
        }
    };

    return {
        message,
        errors,
        subclients,
        getSubclients
    }
}
