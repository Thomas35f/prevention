<template>
    <v-app>
        <Navbar />
        <v-main class="main-background">
            <v-row no-gutters>
                    <Sidebar />
                <v-col cols="12">
                    <router-view />
                </v-col>
            </v-row>
        </v-main>
    </v-app>
</template>

<script lang="ts">
import { defineComponent, onMounted } from 'vue';
import Navbar from './components/common/Navbar.vue';
import Sidebar from "./components/common/Sidebar.vue";
import { useUserStore } from './store/userStore';
import axios from 'axios';

axios.interceptors.request.use(config => {
    const tokenAuth = localStorage.getItem('authToken');

    if (tokenAuth) {
        config.headers['Authorization'] = `Bearer ${tokenAuth}`;
    } else {
        delete config.headers['Authorization'];
    }

    return config;
}, error => {
    return Promise.reject(error);
});

export default defineComponent({
    components: { Sidebar, Navbar },
    setup() {
        const userStore = useUserStore();

        onMounted(() => {
            const appElement = document.getElementById('app');
            const authToken = appElement?.getAttribute('data-token') || '';
            const firstname = appElement?.getAttribute('data-firstname') || '';
            const lastname = appElement?.getAttribute('data-lastname') || '';

            if (authToken) {
                userStore.setUserData(authToken, firstname, lastname);
            }
        });

        return {};
    }
});
</script>

<style scoped>
.main-background {
    background-color: #F5F5F5;
}
</style>
