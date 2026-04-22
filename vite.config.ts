import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import fs from 'fs';

export default defineConfig({
    server: {
        https: {
            key: fs.readFileSync('./server.key'),
            cert: fs.readFileSync('./server.pem'),
        },
        host: '0.0.0.0',
        port: 5173, // ポートを明示
        strictPort: true, // ポートの競合を防ぐ
        hmr: {
            host: 'localhost',
            protocol: 'wss', // HTTPSの場合は wss (WebSocket Secure) を指定
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        inertia(),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        wayfinder({
            formVariants: true,
        }),
    ],
});
