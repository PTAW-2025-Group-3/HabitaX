import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const host = '127.0.0.1';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: false,
        hmr: { host },
        cors: true,
    },
    build: {
        outDir: 'public/build',
        // manifest: true,
        emptyOutDir: true,
    }
});
