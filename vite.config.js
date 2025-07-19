import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            server: {
                host: '0.0.0.0', // Allow connections from other devices
                port: 5173,      // Default Vite port
                strictPort: true,
            },
            refresh: true,
        }),
        tailwindcss(),
    ],
});
