import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/rent.css',
                'resources/css/buy.css',
                'resources/css/properties_create.css',
                'resources/css/properties_show.css',
                'resources/css/properties_edit.css',
                'resources/css/my_offers.css',
                'resources/css/admin.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
