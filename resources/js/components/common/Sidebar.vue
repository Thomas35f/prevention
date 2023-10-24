<template>
    <v-app-bar-nav-icon
        class="fixed-nav-icon"
        color="white"
        @click="drawer = !drawer"
        v-if="!drawer"
    ></v-app-bar-nav-icon>
    <v-navigation-drawer
        :model-value="drawer"
        @update:model-value="drawer = $event"
        app clipped
        class="sidebar"
    >
        <v-list dense>
            <v-list-item v-for="(link, i) in links" :key="i" class="link-item"
                         :class="{'link-item-active': link.active, 'link-item-inactive': !link.active}"
                         :to="link.route">
                <div class="content-container">
                    <div class="indicator" v-if="link.active"></div>
                    <v-icon class="mr-3 link-icon">{{ link.icon }}</v-icon>
                    <v-list-item-content>
                        <v-list-item-title class="sidebar-link">{{ link.text }}</v-list-item-title>
                    </v-list-item-content>
                </div>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const links = ref([
    { icon: 'mdi-view-dashboard', text: 'Dashboard', active: computed(() => route.path === '/dashboard'), route: '/dashboard' },
    { icon: 'mdi-clock-outline', text: 'Formations', active: computed(() => route.path === '/trainings' || route.name === 'create-training' || route.name === 'edit-training' || route.name === 'start-lesson'), route: '/trainings' },
    { icon: 'mdi-account-multiple', text: 'Clients', active: computed(() => route.path === '/'), route: '/' },
    { icon: 'mdi-human-male-board', text: 'Formateurs', active: computed(() => route.path === '/'), route: '/' },
    { icon: 'mdi-account-group-outline', text: 'Stagiaires', active: computed(() => route.path === '/learner'), route: '/learner' },
    { icon: 'mdi-car', text: 'Véhicules', active: computed(() => route.path === '/vehicles'), route: '/vehicles' },
    { icon: 'mdi-cog-outline', text: 'Paramètres', active: computed(() => route.path === '/'), route: '/' },

]);
const drawer = ref(window.innerWidth > 1268);

const updateDrawer = () => {
    drawer.value = window.innerWidth > 1268;
};

onMounted(() => {
    window.addEventListener('resize', updateDrawer);
});

onUnmounted(() => {
    window.removeEventListener('resize', updateDrawer);
});

</script>

<style scoped>

.fixed-nav-icon {
    position: fixed;
    bottom: 20px;
    left: 10px;
    z-index: 1000;
    padding: 10px;
    border-radius: 50%;
    background-color: rgba(17, 34, 61, 0.9);
}

.sidebar {
    background: #11223D;
}

.sidebar-link {
    color: #ffffff;
    font-size: 20px;
    font-weight: 800;
    font-family: "Teko", sans-serif;
    display: block;
    margin-left: 20px;
}

.link-item {
    display: flex;
    align-items: center;
    padding-left: 0;
    margin-bottom: 20px;
    position: relative;
    text-decoration: none;
}

.content-container {
    display: flex;
    align-items: center;
    width: 100%;
    margin-left: 20px;
}

.indicator {
    background: #FF5F13;
    width: 10px;
    height: 100%;
    border-radius: 30%;
    position: absolute;
    left: -3px;
}
.link-item:hover {
    background-color: #13314f;
}
.link-item .sidebar-link {
    transition: transform 0.3s ease-in-out;
    margin-right: 20px;
}

.link-item:hover .sidebar-link, .link-item:hover .link-icon {
    transform: translateX(10px);
}
.link-item-active {
    background-color: #13314f;
    color : white;
}
.link-icon {
    color: white;
    transition: transform 0.3s ease-in-out;
}

</style>
