import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

console.log(process.env.NODE_ENV)

export default defineConfig({
    // base: process.env.NODE_ENV === 'production' ? '/' : '/portfolio/public/build/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css'
                , 'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // 내부 IP 외부 접근 허용
        port: 5173,
        cors: true,
        hmr: {
            host: '192.168.0.13', // 브라우저가 HMR을 찾을 주소 (또는 윈도우의 로컬 IP)
        },
    },
});
