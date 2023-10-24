import {ref, onMounted} from 'vue'
import axios from 'axios'
import {useRouter} from 'vue-router'


export default function useVehicles(): {
    message: any,
    errors: any,
    vehicle: any,
    vehicles: any,
    getVehicle: (id: number) => Promise<void>,
    getVehicles: () => Promise<void>,
    storeVehicle: (data: object) => Promise<void>,
    updateVehicle: (id: number) => Promise<void>,
} {
    const vehicle = ref([]);
    const vehicles = ref([]);
    const message = ref('');
    const errors = ref('');
    const router = useRouter();
    const urlGetVehicles = '/api/vehicles';
    const urlGetVehicle = '/api/vehicles/${id}';
    const urlStoreVehicle = '/api/vehicles/store';
    const urlUpdateVehicle = '/api/vehicles/${id}';


    const getVehicles = async (): Promise<void> => {
        let response = await axios.get(urlGetVehicles);
        vehicles.value = response.data.data;
    }

    const getVehicle = async (id: number): Promise<void> => {
        let response = await axios.get(urlGetVehicle);
        vehicle.value = response.data.data;
    }

    const storeVehicle = async (data: object): Promise<void> => {
        errors.value = '';
        try {
            let response = await axios.post(urlStoreVehicle, data);
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

    const updateVehicle = async (id: number): Promise<void> => {
        errors.value = ''
        try {
            await axios.patch(urlUpdateVehicle, vehicle.value);
            await router.push({name: 'vehicles.index'});
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
        vehicle,
        vehicles,
        getVehicle,
        getVehicles,
        storeVehicle,
        updateVehicle
    }
}
