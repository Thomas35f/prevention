import { defineStore } from 'pinia';

export const useUserStore = defineStore({
    id: 'user',

    state: () => ({
        token: localStorage.getItem('authToken') || null,
        firstname: localStorage.getItem('firstname') || null,
        lastname: localStorage.getItem('lastname') || null
    }),

    actions: {
        setUserData(authToken: string, firstname: string, lastname: string) {
            this.authToken = authToken;
            this.firstname = firstname;
            this.lastname = lastname;

            localStorage.setItem('authToken', authToken);
            localStorage.setItem('firstname', firstname);
            localStorage.setItem('lastname', lastname);
        },

        logout() {
            this.authToken = null;
            this.firstname = null;
            this.lastname = null;

            localStorage.removeItem('authToken');
            localStorage.removeItem('firstname');
            localStorage.removeItem('lastname');
        }
    }
});
