import { createRouter, createWebHistory } from 'vue-router';
import { Auth } from '../stores/Auth/auth';
import { sweetAlert } from '../composables/sweetAlert';
import home from '../views/home.vue';
import NotFound from '../views/notFound.vue';
import login from '../views/login.vue';
import register from '../views/register.vue';
import myReservation from '../views/myReservation.vue';

const router = createRouter({
    history: createWebHistory('/Pruebas/'), 
    routes: [
        {
            path: '/',
            name: 'home',
            component: home, 
            meta: { requiresAuth: false }
        },
        {
            path: '/:catchAll(.*)',
            name: 'not-found',
            component: NotFound,
        },
        {
            path: '/login',
            name: 'login',
            component: login,

        },
        {
            path: '/register',
            name: 'register',
            component: register,
        },
        {
            path: '/myReservation',
            name: 'myReservation',
            component: myReservation,
            meta: { requiresAuth: true }
        },
    ]
  });
  router.beforeEach(async (to, from, next) => {
    const authStore = Auth(); // Obtén el store de sesión
    const swal = sweetAlert();
    await authStore.checkSession();
    if (authStore.sesion && (to.name === 'login' || to.name === 'register')) {
        swal.showAlert('warning','normal',{title: 'Atencion',text: 'No puedes acceder, ya estas autenticado' ,confirmType: 'normal'})

        return next({ name: 'home' }); // Redirigir al home
    }

    // Si no está autenticado, no puede acceder a myReservation
    if (!authStore.sesion && to.meta.requiresAuth) {
        swal.showAlert('warning','normal',{title: 'Atencion',text: 'No puedes acceder aqui sin inicio de sesion' ,confirmType: 'normal'})

        return next({ name: 'login' }); // Redirigir al login
    }
    // Permitir navegación si todo está correcto
    next();
});



export default router;