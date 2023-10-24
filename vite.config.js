import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: [
                'resources/js/main.ts',
                'resources/css/app.css',
                'resources/js/app.ts',
                'resources/css/nav.css',
                'resources/js/nav.ts',
                'resources/css/auth.css',
                'resources/css/style.css',
                'resources/css/app.css',
                'resources/css/contact.css',
                'resources/js/contact.ts',
                'resources/js/home.ts',
                'resources/css/offers.css',
                'resources/js/offers.ts',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        outDir: 'public/build/',
        chunkSizeWarningLimit: 600
    }
});
