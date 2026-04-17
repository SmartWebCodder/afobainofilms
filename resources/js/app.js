import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import MainLayout from '@/Layouts/MainLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

createInertiaApp({
    title: (title) => title ? `${title} — Afobaino Films` : 'Afobaino Films',
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        const page = pages[`./Pages/${name}.vue`];
        if (!page.default.layout) {
            page.default.layout = name.startsWith('Admin/') && name !== 'Admin/Login'
                ? AdminLayout
                : name === 'Admin/Login' ? false : MainLayout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#C9A84C',
    },
});