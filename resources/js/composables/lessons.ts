import { ref } from 'vue'
import axios from 'axios'
import { postData } from '../utils/apiUtils'

export default function useLessons() {
    axios.defaults.withCredentials = true;
    const lesson = ref([]);
    const lessons = ref([]);
    const message = ref('');
    const errors = ref('');

    const urlGetLessons = '/api/getLessons';
    const urlCreateLesson = '/api/lessons/create';

    const getLessons = async () => {
        try {
            let response = await axios.get(urlGetLessons);
            lessons.value = response.data.lessons;
        } catch (error) {
            console.error("Erreur lors de la récupération des leçons:", error);
        }
    };

    const getLesson = async (id: string) => {
        try {
            let response = await axios.get(`/api/getLesson/${id}`);
            return response.data.lesson;
        } catch (error) {
            console.error("Erreur lors de la récupération de la leçon:", error);
        }
    };

    const createLesson = async (data: object) => {
        const { response, error } = await postData(urlCreateLesson, data);
        if (response) {
            message.value = response.message;
        } else if (error) {
            errors.value = error;
        }
    };

    const updateLesson = async (id: string, data: object) => {
        const { response, error } = await postData(`/api/lessons/update/${id}`, data);
        if (response) {
            message.value = response.message;
        } else if (error) {
            errors.value = error;
            throw new Error(error);
        }
    };

    const getLessonDetails = async (id) => {
        try {
            let response = await axios.get(`/api/lessons/details/${id}`);
            return response.data;
        } catch (error) {
            console.error("Erreur lors de la récupération des détails de la leçon:", error);
        }
    };

    return {
        message,
        errors,
        lesson,
        lessons,
        getLesson,
        getLessons,
        createLesson,
        updateLesson,
        getLessonDetails
    }
}
