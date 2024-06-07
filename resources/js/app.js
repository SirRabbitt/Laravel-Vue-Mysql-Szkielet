import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import MainLayout from './Layouts/MainLayout.vue';
import { ZiggyVue } from 'ziggy';
import '../css/app.css';
import axios from 'axios';

// Ustawienie domyślnego URL bazowego dla Axios
axios.defaults.baseURL = 'https://8202-88-156-211-123.ngrok-free.app';

// Wymuszenie używania HTTPS
axios.interceptors.request.use(config => {
  if (config.url.startsWith('http://')) {
    config.url = config.url.replace('http://', 'https://');
  }
  return config;
});

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue');
    
    const page = await pages[`./Pages/${name}.vue`]();
    page.default.layout = page.default.layout || MainLayout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el);
  },
});
