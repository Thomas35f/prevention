import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/css/materialdesignicons.css'
import DateFnsAdapter from '@date-io/date-fns'
import frLocale from 'date-fns/locale/fr'
import { fr } from 'vuetify/locale';
import axios from 'axios';
import { createPinia } from 'pinia';

const tokenCsrf = document.head.querySelector('meta[name="csrf-token"]');

if (tokenCsrf) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = (tokenCsrf as HTMLMetaElement).content;
}

const vuetify = createVuetify({
    components,
    directives,
    date: {
        adapter: DateFnsAdapter,
        locale: {
            fr: frLocale,
        },
    },
    locale: {
        locale: 'fr',
        messages: { fr },
    },
});

const pinia = createPinia();

createApp(App)
    .use(router)
    .use(vuetify)
    .use(pinia)
    .mount('#app');
