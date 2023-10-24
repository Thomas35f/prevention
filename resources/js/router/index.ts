import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'

import Vehicles from '@/components/views/Vehicles.vue'
import Learner from '@/components/views/Learner.vue'
import Dashboard from '@/components/views/Dashboard.vue'
import Trainings from '@/components/views/Training/Trainings.vue'
import CreateTraining from '@/components/views/Training/CreateTraining.vue'
import UpdateTraining from '@/components/views/Training/UpdateTraining.vue'
import StartLesson from '@/components/views/Training/StartLesson.vue'
import Lesson from '@/components/views/Lesson.vue'

const routes: Array<RouteRecordRaw> = [
    {
        path: '/vehicles',
        name: 'vehicles',
        component: Vehicles
    },
    {
        path: '/learner',
        name: 'learner',
        component: Learner
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/trainings/:message?',
        name: 'trainings',
        component: Trainings
    },
    {
        path: '/training/create',
        name: 'create-training',
        component: CreateTraining
    },
    {
        path: '/training/edit/:id',
        name: 'edit-training',
        component: UpdateTraining
    },
    {
        path: '/start-lesson/:id',
        name: 'start-lesson',
        component: StartLesson
    },
    {
        path: '/lesson/:id',
        name: 'lesson',
        component: Lesson
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})
