import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/index.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        cors: true,
        allowedHosts: [
            'ninfa-unweakening-adroitly.ngrok-free.dev',
            '.ngrok-free.dev',
        ],
        hmr: {
            host: 'localhost',
        },
    },
    build: {
        manifest: 'manifest.json',
        outDir: 'public/build',
    },
});