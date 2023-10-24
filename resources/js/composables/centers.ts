import { ref } from 'vue'
import axios from 'axios'

export default function useCenters() {
    axios.defaults.withCredentials = true;
    const center = ref([]);
    const centers = ref([]);
    const message = ref('');
    const errors = ref('');
    const urlGetCenters = '/api/getCenters';
    const urlGetCenter = '/api/centers/${id}';

    const getCenters = async () => {
        let response = await axios.get(urlGetCenters);
        centers.value = response.data.centers;
    }

    const getCenter = async (id: number) => {
        let response = await axios.get(urlGetCenter);
        center.value = response.data.data;
    }

    const storeCenter = async (data: object) => {
        errors.value = '';
        try {
            let response = await axios.post('', data);
            message.value = response.data.message;
        } catch (e) {
            const error = e as any;
            if (error.response.status === 422) {
                for (const key in error.response.data.errors) {
                    errors.value = error.response.data.errors;
                }
            }
        }
    }

    return {
        message,
        errors,
        center,
        centers,
        getCenter,
        getCenters,
        storeCenter
    }
}
