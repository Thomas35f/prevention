<template>
    <v-app-bar app color="#11223D" dark>
        <v-row no-gutters align="center">
            <v-col cols="auto">
                <a href="/">
                    <v-img
                        class="mx-2"
                        :src="logo"
                    alt="Logo lery technologies"
                    height="70"
                        width="70"
                    contain
                    />
                </a>
            </v-col>
            <v-col cols="auto">
                <a href="/" class="title">
                    <v-toolbar-title>
                        Lery technologies
                    </v-toolbar-title>
                </a>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="auto" class="user-greeting">
                Bonjour, {{ firstname }} {{ lastname }}
            </v-col>


            <!-- Menu déroulant de l'utilisateur -->
            <v-menu style="z-index: 9999;" offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn icon v-bind="attrs" v-on="on">
                        <img src="/img/nav/user.png" alt="user" style="height: 32px; width: 32px;">
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item link="" href="/profile">
                        <v-list-item-title>Profile</v-list-item-title>
                    </v-list-item>
                    <v-list-item link="" href="/formateurs">
                        <v-list-item-title>Formateurs</v-list-item-title>
                    </v-list-item>
                    <v-list-item link="" href="/centres">
                        <v-list-item-title>Centres</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>

        </v-row>
    </v-app-bar>
</template>

<script>
import logo from '../../../images/nav/lery-logo-web.png';
import user from '../../../images/nav/user.png';
import { useUserStore } from "../../store/userStore";


export default {
    data() {
        return {
            logo: logo,
            user: user
        };
    },
    setup() {
        const userStore = useUserStore();
        return {
            firstname: userStore.firstname,
            lastname: userStore.lastname
        }
    }
}
</script>

<style scoped>

.title {
    color: white;
    font-weight: 800;
    font-size: 23px;
    font-family: "Teko", sans-serif;
    text-decoration: none;
}

.user {
    color: white;
    margin-right: 50px;
}

.v-btn {
    outline: none !important;
    box-shadow: none !important;
}

.user-greeting {
    color: white;
    margin-right: 10px;
}


</style>
