import Home from './pages/Home.vue';

export const baseURL = "/laravel-calendar/public";
export const routes  = [
    {
        name: 'home',
        path: '/calendar',
        component: Home
    }
];