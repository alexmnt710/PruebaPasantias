import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router/router';
import './index.css'; // Tailwind CSS con DaisyUI
import App from './App.vue';
import registerIcons from './icons'; // Registro de Heroicons

// Crea la aplicación Vue
const app = createApp(App);

// Usa los plugins
app.use(createPinia());
app.use(router);

// Registra los iconos globalmente
registerIcons(app);

// Monta la aplicación
app.mount('#app');

